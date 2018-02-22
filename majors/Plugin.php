<?php
/**
 * Major 集成插件
 * 
 * @package majors 
 * @author 权那他
 * @link https://github.com/kraity/Major
 */
class majors_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        $msg = majors_Plugin::install();


        //Helper::addPanel(4, 'majors/manage.php', 'MAJOR 配置', 'MAJOR 主题配置', 'administrator');

        Helper::addRoute("route_to_obtainQQ","/obtain/quik","majors_Action",'obtainQQ');
			
		//添加文章
        Typecho_Plugin::factory('admin/write-post.php')->option = array('majors_Plugin', 'formatsSelect'); 

        //添加views
        Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('majors_Plugin', 'viewsCounter');
		
		//编辑文章
		Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array('majors_Plugin', 'formatsSet');
        Typecho_Plugin::factory('index.php')->begin = array('majors_Plugin', 'Widget_index_begin');
        Typecho_Plugin::factory('Widget_Archive')->indexHandle = array('majors_Plugin', 'sticky');

        //添加btn在编辑窗口 来自Jrotty/hongweipeng
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array('majors_Plugin', 'areas');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array('majors_Plugin', 'areas');

        //添加LT21的Gravatar Server
        Typecho_Plugin::factory('Widget_Abstract_Comments')->gravatar = array('majors_Plugin', 'reGravatar');

        return _t($msg);
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
        //Helper::removePanel(4, 'majors/manage.php');

        Helper::removeRoute("route_to_obtainQQ");

        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        $config = Typecho_Widget::widget('Widget_Options')->plugin('majors');
        $delmat = $config->delmat;
        if ($delmat == 0) {
            try {
                $db->query("ALTER TABLE `".$prefix."contents` DROP COLUMN `format`");
            } catch (Typecho_Db_Exception $e) {
                throw new Typecho_Plugin_Exception('删除format字段失败');
            }
        }
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){

        $delmat = new Typecho_Widget_Helper_Form_Element_Radio(
            'delmat', array(
            '0' => '删除',
            '1' => '不删除',
        ), '1', '删除数据表:', '请选择是否在禁用插件时，format字段');
        $form->addInput($delmat);

        $areaSwitch1 = new Typecho_Widget_Helper_Form_Element_Radio(
            'areaSwitch1', array(
            '0' => '关闭',
            '1' => '开启',
        ), '1', '编辑器双栏:', '默认开启 markdown 语法下编辑器双栏(编写区和实际预览同时显示)');
        $form->addInput($areaSwitch1);

        $compress_html = new Typecho_Widget_Helper_Form_Element_Checkbox('compress_html', array('compress_html' => '开启压缩HTML'), null, _t('是否开启压缩HTML'), _t('当开启后页面与原来页面不一致时请关闭'));
        $form->addInput($compress_html);
        
        $sticky_cids = new Typecho_Widget_Helper_Form_Element_Text(
          'sticky_cids', NULL, '',
          '置顶文章的 cid', '按照排序输入, 请以半角逗号或空格分隔 cid.');
        $form->addInput($sticky_cids);

        /** Gravatar服务器 **/
        $serverGravatar = new Typecho_Widget_Helper_Form_Element_Radio( 'serverGravatar',  array(
            'https://gravatar.cat.net/avatar'        =>  'cat Gravatar 镜像 ( https://gravatar.cat.net )',
            'https://cdn.v2ex.com/gravatar'   =>  'v2ex Gravatar 镜像 ( https://cdn.v2ex.com )',
            'https://cn.gravatar.com/avatar'        =>  'Gravatar CN ( https://cn.gravatar.com )',
            'https://secure.gravatar.com/avatar'   =>  'Gravatar Secure ( https://secure.gravatar.com )'),
            'https://gravatar.cat.net/avatar', _t('Gravatar选择服务器'), _t('替换Gravatar头像服务器') );
        $form->addInput($serverGravatar->multiMode());

        /** Gravatar默认头像 **/
        $defaultGravatar = new Typecho_Widget_Helper_Form_Element_Radio( 'defaultGravatar',  array(
            'mm'            =>  '<img src=https://secure.gravatar.com/avatar/926f6ea036f9236ae1ceec566c2760ea?s=32&r=G&forcedefault=1&d=mm height="32" width="32" /> 神秘人物',
            'blank'         =>  '<img src=https://secure.gravatar.com/avatar/926f6ea036f9236ae1ceec566c2760ea?s=32&r=G&forcedefault=1&d=blank height="32" width="32" /> 空白',
            ''				=>  '<img src=https://secure.gravatar.com/avatar/926f6ea036f9236ae1ceec566c2760ea?s=32&r=G&forcedefault=1&d= height="32" width="32" /> Gravatar 标志',
            'identicon'     =>  '<img src=https://secure.gravatar.com/avatar/926f6ea036f9236ae1ceec566c2760ea?s=32&r=G&forcedefault=1&d=identicon height="32" width="32" /> 抽象图形（自动生成）',
            'wavatar'       =>  '<img src=https://secure.gravatar.com/avatar/926f6ea036f9236ae1ceec566c2760ea?s=32&r=G&forcedefault=1&d=wavatar height="32" width="32" /> Wavatar（自动生成）',
            'monsterid'     =>  '<img src=https://secure.gravatar.com/avatar/926f6ea036f9236ae1ceec566c2760ea?s=32&r=G&forcedefault=1&d=monsterid height="32" width="32" /> 小怪物（自动生成）'),
            'mm', _t('Gravatar选择默认头像'), _t('当评论者没有设置Gravatar头像时默认显示该头像') );
        $form->addInput($defaultGravatar->multiMode());

		$formats = new Typecho_Widget_Helper_Form_Element_Checkbox('format', array(
            'aside'=>'日志', 
            'gallery'=>'相册', 
            'link'=>'链接', 
            'quote'=>'引语', 
            'status'=>'状态', 
            'video'=>'视频', 
            'audio'=>'音频', 
            'chat'=>'聊天'),array('aside','gallery','link','quote','video'),'选取支持的文章形式',_t('被选择的文章形式将会在编写文章时出现在选项里, 一项也不选择将会默认显示所有'));
		$form->addInput($formats->multiMode()); 
	}

    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}


    public static function install(){

        $configLink = '<a href="' . Helper::options()->adminUrl . 'options-plugin.php?config=majors' . '">请设置</a>';

        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        
        // contents 表中若无 views 字段则添加
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))){
            $db->query('ALTER TABLE `'. $prefix .'contents` ADD `views` INT(10) DEFAULT 0;');
        }
            
        // contents 表中若无 format 字段则添加
        if (!array_key_exists('format', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query("ALTER TABLE `".$prefix."contents` ADD `format` varchar(16) DEFAULT 'post'");
            return '成功创建 format 字段，插件启用成功，' . $configLink;
        } else {
            return 'format 字段已存在，插件启用成功，' . $configLink;
        }
    }


    /**
     * 拓展开发 编辑文章页, 添加 "文章形式" 选项
     *
     *
     * @param string  $args 文章形式
     * @return void
     */
    public static function formatsSelect()
    {
		$options = Typecho_Widget::widget('Widget_Options');
		$formats = $options->plugin('majors');
		$custom_format =  $formats->format;
		$regular_format = array(
            'post'=>'标准', 
            'aside'=>'日志', 
            'gallery'=>'相册', 
            'link'=>'链接', 
            'quote'=>'引语', 
            'status'=>'状态', 
            'video'=>'视频', 
            'audio'=>'音频', 
            'chat'=>'聊天');
		if(count($custom_format)>0){
			$args = array('post'=>'标准');
			foreach($regular_format as $key=>$val){
				if(in_array($key,$custom_format)){
					$args[$key] = $val;
				}
			}
		}else{
			$args = array(
                'post'=>'标准', 
                'aside'=>'日志', 
                'gallery'=>'相册', 
                'link'=>'链接', 
                'quote'=>'引语', 
                'status'=>'状态', 
                'video'=>'视频', 
                'audio'=>'音频', 
                'chat'=>'聊天');
		}
		if(isset($_GET['cid'])){
			$cid = $_GET['cid'];
			$db = Typecho_Db::get();
			$row = $db->fetchRow($db->select('format')->from('table.contents')->where('cid = ?', $cid));
			$format = $row['format'];
		}else{
			$format = "post";
		}
		$output = '';
		foreach( $args as $key => $value ){
			$check = $key == $format ? 'checked="checked"' :'';
			$output .= '<li><input type="radio" name="format" id="format-'.$key.'" value="'.$key.'" '.$check.'><label for="format-'.$key.'">'.$value.'</label></li>';
		}
		echo '<li><label class="typecho-label">形式</label><ul>'.$output.'</ul></li>';
    }
	
    /**
     * 拓展开发 提交文章, 设置文章形式
     *
     * 
     * @return void
     */
	public static function formatsSet($contents, $inst)
	{
		$db = Typecho_Db::get();
		Typecho_Widget::widget('Widget_Contents_Post_Edit')->to($post);	
		$cid = $post->cid;
		if($cid!=null){ // 文章已存在, 直接修改 format 字段
			$db->query($db->update('table.contents')->rows(array('format' => $_POST['format']))->where('cid = ?', $cid));
			return $contents;
		}else{ // 文章不存在, 新建文章
			$options = Typecho_Widget::widget('Widget_Options');
			
			if( $contents['title']!="" ){
				$contents['status'] = $_POST['do']== 'publish' ? 'publish':'draft';
				$cid = $post->insert($contents);

				/** 插入分类 */
				if (array_key_exists('category', $contents)) {
					$post->setCategories($cid, !empty($contents['category']) && is_array($contents['category']) ?
					$contents['category'] : array($options->defaultCategory), false, true);
				}

				/** 插入标签 */
				if (array_key_exists('tags', $contents)) {
					$post->setTags($cid, $contents['tags'], false, true);
				}

				/** 同步附件 */
				$post->attach($cid);
				
				/** 文章形式 */
				$db->query($db->update('table.contents')->rows(array('format' => $_POST['format']))->where('cid = ?', $cid));
				
				$post->fetchRow($post->select()->where('table.contents.cid = ?', $cid)->limit(1), array($post, 'push'));
				
				/** 新建提示 */
				$newPost = $db->fetchRow($post->select()->where('table.contents.cid = ?', $cid)->limit(1));
				$result = Typecho_Widget::widget('Widget_Abstract_Contents')->push($newPost);
				$post->widget('Widget_Notice')->set('publish' == $result['status'] ?
				_t('文章 "<a href="%s">%s</a>" 已经发布', $result['permalink'], $result['title']) :
				_t('文章 "%s" 等待审核', $result['title']), NULL, 'success');

				/** 设置高亮 */
				$post->widget('Widget_Notice')->highlight($cid);
			}
			$post->response->redirect(Typecho_Common::url('manage-posts.php', $options->adminUrl));
			exit;
		}
	}

	/**
     * 拓展开发 输出文章形式
     *
     * 语法: majors_Plugin::getFormat();
     *
     * @access public
     * @return void
     */
	public static function getFormat()
	{
        $db = Typecho_Db::get();
        $cid = Typecho_Widget::widget('Widget_Archive')->cid;
        $row = $db->fetchRow($db->select('format')->from('table.contents')->where('cid = ?', $cid));
		return $row['format'];
	}
    
    
    /**
     * 拓展开发 加入 beforeRender
     * 
     * @access public
     * @return void
     */
    public static function viewsCounter()
    {
        // 访问计数
        if (Typecho_Widget::widget('Widget_Archive')->is('single')) {
            $db = Typecho_Db::get();
            $cid = Typecho_Widget::widget('Widget_Archive')->cid;
            $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views']+1))->where('cid = ?', $cid));
        }
    }

    /**
     * 拓展开发 输出访问次数
     *
     * 语法: Views_Plugin::theViews();
     * 输出: '访问: xx,xxx 次'
     *
     * 语法: Views_Plugin::theViews('有 ', ' 次点击');
     * 输出: '有 xx,xxx 次点击'
     *
     * @access public
     * @param string  $before 前字串
     * @param string  $after  后字串
     * @param bool    $echo   是否显示 (0 用于运算，不显示)
     * @return string
     */
    public static function theViews($echo = 1)
    {
        $db = Typecho_Db::get();
        $cid = Typecho_Widget::widget('Widget_Archive')->cid;
        $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
        if ($echo){
            echo number_format($row['views']);
        }else{
            return $row['views'];
        }
    }
  
     /**
     * 拓展开发 输出浏览总数
     *
     *
     * @access public
     * @return string
     */
    
    public static function sumViews()
    {
      $db = Typecho_Db::get();
      $query= $db->select('sum(views) as num')->from('table.contents');
      $result = $db->fetchAll($query);
      echo $result[0][num];
      
    }

    /**
     * 拓展开发 输出最受欢迎文章
     *
     * 语法: Views_Plugin::theMostViewed();
     *
     * @access public
     * @param int     $limit  文章数目
     * @param string  $before 前字串
     * @param string  $after  后字串
     * @return string
     */
    public static function theMostViewed($limit = 10, $before = '<br/> - ( 访问: ', $after = ' 次 ) ')
    {
        $db = Typecho_Db::get();
        $options = Typecho_Widget::widget('Widget_Options');
        $limit = is_numeric($limit) ? $limit : 10;
        $posts = $db->fetchAll($db->select()->from('table.contents')
                 ->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish')
                 ->order('views', Typecho_Db::SORT_DESC)
                 ->limit($limit)
                 );

        if ($posts) {
            foreach ($posts as $post) {
                $result = Typecho_Widget::widget('Widget_Abstract_Contents')->push($post);
                $post_views = number_format($result['views']);
                $post_title = htmlspecialchars($result['title']);
                $permalink = $result['permalink'];
                echo "<li><a href='$permalink' title='$post_title'>$post_title</a><span style='font-size:70%'>$before $post_views $after</span></li>\n";
            }

        } else {
            echo "<li>N/A</li>\n";
        }
    }


    /**
     * 拓展开发 压缩HTML代码
     *
     * @author 情留メ蚊子 <qlwz@qq.com>
     * @param string $html_source HTML源码
     * @return string 压缩后的代码
     */
    public static function Widget_index_begin() {
        ob_start('majors_Plugin::qlwz_ob_handler');
    }
    public static function qlwz_ob_handler($buffer) {
        $settings = Helper::options()->plugin('majors');
        if ($settings->compress_html) {
            $buffer = self::qlwz_compress_html($buffer);
        }

        return $buffer;
    }
    public static function qlwz_compress_html($html_source) {
        $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
        $compress = '';
        foreach ($chunks as $c) {
            if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
                $c = substr($c, 19, strlen($c) - 19 - 20);
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
                $c = substr($c, 12, strlen($c) - 12 - 13);
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) { // JS代码，包含“//”注释的，单行代码不处理
                $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
                $c = '';
                foreach ($tmps as $tmp) {
                    if (strpos($tmp, '//') !== false) { // 对含有“//”的行做处理
                        if (substr(trim($tmp), 0, 2) == '//') { // 开头是“//”的就是注释
                            continue;
                        }
                        $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                        $is_quot = $is_apos = false;
                        foreach ($chars as $key => $char) {
                            if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                                $is_quot = !$is_quot;
                            } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                                $is_apos = !$is_apos;
                            } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                                $tmp = substr($tmp, 0, $key); // 不是字符串内的就是注释
                                break;
                            }
                        }
                    }
                    $c .= $tmp;
                }
            }
            $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c); // 清除换行符，清除制表符
            $c = preg_replace('/\\s{2,}/', ' ', $c); // 清除额外的空格
            $c = preg_replace('/>\\s</', '> <', $c); // 清除标签间的空格
            $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c); // 清除 CSS & JS 的注释
            $c = preg_replace('/<!--[^!]*-->/', '', $c); // 清除 HTML 的注释
            $compress .= $c;
        }
        return $compress;
    }
    
    
    /**
     * 拓展开发 选取置顶文章
     * 
     * @access public
     * @param object $archive, $select
     * @return void
     */
    public static function sticky($archive, $select)
    {
        $config  = Typecho_Widget::widget('Widget_Options')->plugin('majors');
        $sticky_cids = $config->sticky_cids ? explode(',', strtr($config->sticky_cids, ' ', ',')) : '';
        if (!$sticky_cids) return;

        $db = Typecho_Db::get();
        $paded = $archive->request->get('page', 1);
        $sticky_html = "<strong>[置顶]</strong>";

        foreach($sticky_cids as $cid) {
          if ($cid && $sticky_post = $db->fetchRow($archive->select()->where('cid = ?', $cid))) {
              if ($paded == 1) {                               // 首頁 page.1 才會有置頂文章
                $sticky_post['sticky'] = $sticky_html;
                $archive->push($sticky_post);                  // 選取置頂的文章先壓入
              }
              $select->where('table.contents.cid != ?', $cid); // 使文章不重覆
          }
        }
    }


    /**
     * 拓展开发 Jrotty的editorG ,hongweipeng的EditorLR
     *
     */
    public static function areas(){

        $config = Typecho_Widget::widget('Widget_Options')->plugin('majors');
        $areaSwitch1 = $config->areaSwitch1;

        ?>
        <style>

            <?php if($areaSwitch1==1){?>
            /*EditorLR*/
            .container{max-width:96%}
            form div[role=main],form div[role=complementary]{width:100%}
            #text,#wmd-preview{width:47%}
            #wmd-preview{position:absolute;right:2%;overflow-y:auto}
            #wmd-preview code{background:0 0;font-size:1.08em!important}
            .wmd-editlrtab{float:right;font-size:.92857em;margin-top:3px}
            .wmd-editlrtab a{display:inline-block;height:20px;line-height:20px;margin-left:5px;padding:0 8px}
            .wmd-editlrtab a.active{background:#e9e9e6 none repeat scroll 0 0;color:#999}
            .fullscreen #text,.fullscreen #wmd-button-bar,.fullscreen #wmd-preview,.fullscreen .submit{width:80%}
            pre.prettyprint{display:block;font-family:Menlo,Monaco,Consolas,"Lucida Console","Courier New",monospace!important}
            .pln{color:#000}
            @media screen{.str{color:#080}
                .kwd{color:#008}
                .com{color:#800}
                .typ{color:#606}
                .lit{color:#066}
                .clo,.opn,.pun{color:#660}
                .tag{color:#008}
                .atn{color:#606}
                .atv{color:#080}
                .dec,.var{color:#606}
                .fun{color:red}
            }
            @media print,projection{.str{color:#060}
                .kwd{color:#006;font-weight:700}
                .com{color:#600;font-style:italic}
                .typ{color:#404;font-weight:700}
                .lit{color:#044}
                .clo,.opn,.pun{color:#440}
                .tag{color:#006;font-weight:700}
                .atn{color:#404}
                .atv{color:#060}
            }
            pre.prettyprint{padding:2px}
            ol.linenums{margin-top:0;margin-bottom:0;padding-left:0}
            li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8{list-style-type:none}

            <?php }?>

            /*EditorG*/
            .wmd-button-row {
                height: auto;
            }
            #wmd-majorTag-button span{
                background: none;
                font-size: large;
                text-align: center;
                color: #999999;
                font-family: serif;
            }

        </style>
        <script type="text/javascript">
            /*EditorG*/
            $(document).ready(function(){
                $('#wmd-button-row').append('<li class="wmd-button" id="wmd-majorTag-button" title="代码 - ALT+C"><span>C</span></li>');
                if($('#wmd-button-row').length !== 0){
                    $('#wmd-majorTag-button').click(function(){
                        var rs = "```\nyour code\n```\n";
                        reLoad(rs);
                    })
                }

                function reLoad(tag){var area;if(document.getElementById('text')&&document.getElementById('text').type=='textarea'){area=document.getElementById('text')}else{return false}if(document.selection){area.focus();var sel=document.selection.createRange();sel.text=tag;area.focus()}else if(area.selectionStart||area.selectionStart=='0'){var startPos=area.selectionStart;var endPos=area.selectionEnd;var cursorPos=startPos;area.value=area.value.substring(0,startPos)+tag+area.value.substring(endPos,area.value.length);cursorPos+=tag.length;area.focus();area.selectionStart=cursorPos;area.selectionEnd=cursorPos}else{area.value+=tag;area.focus()}}

                $('body').on('keydown',function(a){
                    if( a.altKey && a.keyCode == "67"){
                        $('#wmd-majorTag-button').click();
                    }
                });
            });

            <?php if($areaSwitch1==1){?>
            /*EditorLR*/
            (function($,h,c){var a=$([]),e=$.resize=$.extend($.resize,{}),i,k="setTimeout",j="resize",d=j+"-special-event",b="delay",f="throttleWindow";e[b]=250;e[f]=true;$.event.special[j]={setup:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.add(l);$.data(this,d,{w:l.width(),h:l.height()});if(a.length===1){g()}},teardown:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.not(l);l.removeData(d);if(!a.length){clearTimeout(i)}},add:function(l){if(!e[f]&&this[k]){return false}var n;function m(s,o,p){var q=$(this),r=$.data(this,d);r.w=o!==c?o:q.width();r.h=p!==c?p:q.height();n.apply(this,arguments)}if($.isFunction(l)){n=l;return m}else{n=l.handler;l.handler=m}}};function g(){i=h[k](function(){a.each(function(){var n=$(this),m=n.width(),l=n.height(),o=$.data(this,d);if(m!==o.w||l!==o.h){n.trigger(j,[o.w=m,o.h=l])}});g()},e[b])}})(jQuery,this);function prettify(){$("pre").addClass("prettyprint");prettyPrint()}$(document).ready(function(){var syn=true;var is_syn_time=true;var mode=1;var is_process=false;function syn_scroll(source,target){source.scroll(function(){if(!syn)return;syn=false;var source_scroll_top=source.scrollTop();var source_scroll_height=source.get(0).scrollHeight;var source_offset_height=source.get(0).offsetHeight;var target_offset_height=target.get(0).offsetHeight;var target_scroll_height=target.get(0).scrollHeight;target.scrollTop(source_scroll_top*(target_scroll_height-target_offset_height)/(source_scroll_height-source_offset_height));setTimeout(function(){syn=true},20)})}var textArea=$('#text');var wmd_preview=$('#wmd-preview');syn_scroll(textArea,wmd_preview);syn_scroll(wmd_preview,textArea);$('.wmd-edittab').remove();wmd_preview.removeClass('wmd-hidetab');textArea.resize(function(){if(is_process)return;wmd_preview.outerHeight(textArea.outerHeight());$('.wmd-editlrtab a').eq(mode).click()});textArea.resize();setInterval(function(){if(!is_syn_time)return;prettify()},500);var div=$('<div class="wmd-editlrtab"></div>');var edit_mode=$('<a href="javascript:void(0);">编辑</a>');var both_mode=$('<a href="javascript:void(0);">实时</a>');var show_mode=$('<a href="javascript:void(0);">浏览</a>');div.append(edit_mode).append(both_mode).append(show_mode);$('#wmd-button-bar').prepend(div);function edit_change(_m){mode=_m;var left,right;is_process=true;if(mode==0){is_syn_time=false;left=100;right=10}else if(mode==1){is_syn_time=true;if($('body').hasClass('fullscreen')){left=right=50}else{left=right=47}}else if(mode==2){is_syn_time=false;if($('body').hasClass('fullscreen')){left=10;right=100}else{left=0;right='full'}}$('.wmd-editlrtab a').removeClass("active");if(left<15){textArea.css('visibility','hidden')}else{textArea.css('visibility','visible')}if(right<15){wmd_preview.css('visibility','hidden')}else{wmd_preview.css('visibility','visible')}textArea.animate({width:left+'%'},200);if(typeof right=='string'){wmd_preview.animate({width:(($('#wmd-editarea').width()-15)/$(window).width())*100+'%'},200)}else{wmd_preview.animate({width:right+'%'},200)}$('.wmd-editlrtab a').eq(mode).addClass('active');setTimeout(function(){is_process=false},500)}edit_mode.click(function(){edit_change(0)});both_mode.click(function(){edit_change(1)});show_mode.click(function(){edit_change(2)});both_mode.addClass('active')});
            <?php }?>

        </script>
        <script type="text/javascript" src="https://cdn.bootcss.com/prettify/r298/prettify.js"></script>
        <?php
    }

    public static function reGravatar($size, $rating, $default, $comments)
    {
        $default = Typecho_Widget::widget('Widget_Options')->plugin('majors')->defaultGravatar;
        $url = self::gravatarUrl($comments->mail, $size, $rating, $default, $comments->request->isSecure());
        echo '<img class="avatar" src="' . $url . '" alt="' . $comments->author . '" width="' . $size . '" height="' . $size . '" />';
    }

    /**
     * 获取gravatar头像地址 来自LT21的Gravatar Server
     *
     * @param string $mail
     * @param int $size
     * @param string $rating
     * @param string $default
     * @param bool $isSecure
     * @return string
     */
    public static function gravatarUrl($mail, $size, $rating, $default, $isSecure = false)
    {
        //$url = $isSecure ? 'https://secure.gravatar.com' : Typecho_Widget::widget('Widget_Options')->plugin('majors')->serverGravatar;
        $url = Typecho_Widget::widget('Widget_Options')->plugin('majors')->serverGravatar;
        $url .= '/';
        if (!empty($mail)) {
            $url .= md5(strtolower(trim($mail)));
        }
        $url .= '?s=' . $size;
        $url .= '&amp;r=' . $rating;
        $url .= '&amp;d=' . $default;
        return $url;
    }
    
}
