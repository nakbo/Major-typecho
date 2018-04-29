<?php
/**
 * KraitMajor 集成插件
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


        //Helper::addPanel(4, 'majors/manage.php', 'MAJOR 配置', 'MAJOR 主题配置', 'administrator')
			
		//添加文章
        Typecho_Plugin::factory('admin/write-post.php')->option = array('majors_Plugin', 'formatsSelect');

        //添加views
        Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('majors_Plugin', 'viewsCounter');
		
		//编辑文章
		Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array('majors_Plugin', 'formatsSet');
        Typecho_Plugin::factory('Widget_Archive')->indexHandle = array('majors_Plugin', 'sticky');

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

        $formats = new Typecho_Widget_Helper_Form_Element_Checkbox('format', array(
            'aside'=>'日志',
            'gallery'=>'相册',
            'link'=>'链接',
            'quote'=>'引语',
            'status'=>'状态',
            'video'=>'视频',
            'audio'=>'音频',
            'chat'=>'聊天'),array('aside','gallery','link','quote','status','video','chat'),'选取支持的文章形式',_t('被选择的文章形式将会在编写文章时出现在选项里, 一项也不选择将会默认显示所有'));
        $form->addInput($formats->multiMode());

        $sticky_cids = new Typecho_Widget_Helper_Form_Element_Text(
          'sticky_cids', NULL, '',
          '置顶文章的 cid', '按照排序输入, 请以半角逗号或空格分隔 cid.');
        $form->addInput($sticky_cids);

        /** Gravatar服务器 **/
        $serverGravatar = new Typecho_Widget_Helper_Form_Element_Radio( 'serverGravatar',  array(
            'https://gravatar.cat.net/avatar'        =>  'cat Gravatar 镜像 ( https://gravatar.cat.net )',
            'https://gravatar.loli.net/avatar'        =>  'loli Gravatar 镜像 ( https://gravatar.loli.net )',
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
      echo $result[0]['num'];
      
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
