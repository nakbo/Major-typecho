<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once('lib/Major.php');

/**
 * 主题外观ThemeConfig
 *
 *
 *
 */
function themeConfig($form) { ?>
    <div id="majorModel" class="majorModel"></div>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script>
        function formatDateTime(nS) {
            return new Date(parseInt(nS) * 1000).toLocaleString().substr(0,12)
        }
        var infoMajor = <?php echo file_get_contents(Major::$api['infoMajor']);?>;
       var infoModel = "<div class=\"majorPv\">你正在使用",
            date = infoMajor.Major[0].d,
            ver = infoMajor.Major[0].v,
            updetaTime = "<?php echo Major::$Major['updateTime']; ?>",
            versionNow = "<?php echo Major::$Major['version']; ?>",
            dateNow = formatDateTime(date),
            dataUpGit = "<?php echo Major::$Major['github']; ?>";

       if(date>updetaTime){
           infoModel += '<strong>'+versionNow+'</strong> 版本，'+dateNow+'更新最新版本为 <strong style="color:#000000;">'+ver+'</strong><a href="'+dataUpGit+'"><button type="submit" class="btn btn-warn">前往更新</button></a>';
       }else{
           infoModel += '最新版 '+ver;
       }
        infoModel +="</div>";
       $("#majorModel").html(infoModel);
    </script>
    <script>
        function backData() {
            var newLocal= localStorage.backupData;
            if (newLocal!= "" && newLocal!= undefined) {
                var jsonData = JSON.parse(newLocal);
                var data = jsonData;
                for(var i in data){
                    switch (data[i].type) {
                        case "text":
                            $('#'+document.getElementsByName(data[i].name)[0].id).val(data[i].value);
                            break;
                        case "textarea":
                            $('#'+document.getElementsByName(data[i].name)[0].id).val(data[i].val);
                            break;
                        case "checkbox":
                            switch (data[i].checked) {
                                case 'true':
                                    document.getElementById(data[i].id).checked = true;
                                    break;
                                case 'false':
                                    document.getElementById(data[i].id).checked = false;
                                    break;
                            }
                            break;

                        case "radio":
                            switch (data[i].checked) {
                                case 'true':
                                    $('#'+data[i].id).prop("checked","checked");
                                    break;
                                case 'false':
                                    $('#'+data[i].id).removeAttr("checked");
                            }
                            break;
                    }
                }
            }
        }
        function backupData() {
            var json = [];
            var inputs = $("input");
            var textareas = $("textarea");
            for (i = 0, len = inputs.length; i < len; i++) {
                var j = {};
                var input = inputs[i];
                j.name = input.name;
                j.type = input.type;
                j.id = input.id;
                switch (input.type){
                    case "text":
                        j.value = input.value;
                        break;

                    case "radio":
                        j.checked = ''+input.checked+'';
                        break;

                    case "checkbox":
                        j.checked = ''+input.checked+'';
                        break;
                    default:
                }
                json.push(j);
            }
            for (i = 0, len = textareas.length; i < len; i++) {
                var j = {};
                var textarea = textareas[i];
                j.name = textarea.name;
                j.type = 'textarea';
                j.id = textarea.id;
                j.val = $('#'+textarea.id).val();

                json.push(j);
            }
            var dataUp = JSON.stringify(json);
            localStorage.backupData = dataUp;
        }
        jQuery(function(){
            $(".typecho-option-submit").append("<li><button type=\"button\" class=\"btn primary\" onclick=\"backupData()\">备份</button></li><li><button type=\"button\" class=\"btn primary\" onclick=\"backData()\">恢复</button></li>");
        });
    </script>
    <script type="text/javascript">
        $(function() {
            var Gra1 = $("#useGravatar-ma"),
                Gra0 = $("#useGravatar-gr");
            if(!Gra1.is(":checked")) {
                var Grat = $("#typecho-option-item-masterImgUrl-1");
                Grat.attr("style","color:#999")
                    .find("input").attr("disabled","disabled");
                Gra1.click(function() {
                    Grat.removeAttr("style")
                        .find("input").removeAttr("disabled");
                });
                Gra0.click(function() {
                    Grat.attr("style","color:#999")
                        .find("input").attr("disabled","disabled");
                });
            }
        });
    </script>
    <style>
        .majorModel{
            font-family:'Microsoft Yahei', sans-serif
        }
        .majorModel a {
            color:black;
        }
        .majorModel .btn {
            padding: 0 7px;
            height: 20px;
            margin-left: 10px;
            font-size: 10px;
            margin-top: -7px;
        }
        .typecho-option-submit{
            position: fixed !important;
            bottom: 10px !important;
            right: 30px !important;
        }
        .typecho-option-submit li{
            display: inline;
            margin-right: 5px;
        }
    </style>
    <?php

    $faviconUrl = new Typecho_Widget_Helper_Form_Element_Text('faviconUrl', NULL, '/favicon.ico', _t('Favicon.ico'), _t('此处填入favicon.ico地址'));
    $form->addInput($faviconUrl);

    $useGravatar = new Typecho_Widget_Helper_Form_Element_Radio('useGravatar',
        array('gr' => _t('使用公认头像'),
            'ma' => _t('使用自定头像'),
        ),
        'gr', _t('引用头像方式'), _t('默认启用公认头像，公认头像是全球公认头像(Gravatar),使用的邮箱是管理员的邮箱.自定头像是你自己自定义的头像,在这里的下方设置即可.'));
    $form->addInput($useGravatar);

    $masterImgUrl = new Typecho_Widget_Helper_Form_Element_Text('masterImgUrl', NULL, 'https://secure.gravatar.com/avatar/4e4559eceb7fbd4bca7925710592b1b9?s=70&r=G&d=mm', _t('自定头像'), _t('此处填入头像地址,用于mat头部显示,文章页时显示作者头像 '));
    $form->addInput($masterImgUrl);

    $majorA0 = new Typecho_Widget_Helper_Form_Element_Text('majorA0', NULL, 'https://ws3.sinaimg.cn/large/006U7bU2gy1fun7a9g7foj312w0pwaqx.jpg', _t('Material light 背景图'), _t('此处填入Material light 背景图的路径,页头处的,需要下方勾选背景图才能启用.注意是超链接形式.'));
    $form->addInput($majorA0->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $matAAble = new Typecho_Widget_Helper_Form_Element_Checkbox('matAAble',
        array(
            'A0' => _t('Material light 背景图'),
            'A1' => _t('渲染夹层渐变黑'),
            'A2' => _t('渲染夹层紫红色'),
            'A3' => _t('渲染夹层雅棕色'),
            'mat' => _t('渲染夹方格图层'),
            'svgMountain' => _t('渲染夹层大山')
        ),
        array('A0','mat'), _t('Material light 背景渲染组件'));
    $form->addInput($matAAble->multiMode());


    $lightAble = new Typecho_Widget_Helper_Form_Element_Radio( 'lightAble',  array(
        'ml90'        =>  '黑色高饱和度',
        'ml60'        =>  '黑色中饱和度',
        'ml30'        =>  '黑色低饱和度',
        'ml00'        =>  '黑色无饱和度',),
        'ml30', _t('渐变背景'), _t('Material light 背景的渐变背景') );
    $form->addInput($lightAble->multiMode());

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

    /** Gravatar服务器 **/
    $serverGravatar = new Typecho_Widget_Helper_Form_Element_Radio( 'serverGravatar',  array(
        'https://gravatar.loli.net/avatar'        =>  'loli Gravatar 镜像 ( https://gravatar.loli.net )',
        'https://gravatar.cat.net/avatar'        =>  'cat Gravatar 镜像 ( https://gravatar.cat.net )',
        'https://cdn.v2ex.com/gravatar'   =>  'v2ex Gravatar 镜像 ( https://cdn.v2ex.com )',
        'https://cn.gravatar.com/avatar'        =>  'Gravatar CN ( https://cn.gravatar.com )',
        'https://secure.gravatar.com/avatar'   =>  'Gravatar Secure ( https://secure.gravatar.com )'),
        'https://gravatar.loli.net/avatar', _t('Gravatar选择服务器'), _t('替换Gravatar头像服务器') );
    $form->addInput($serverGravatar->multiMode());

    /** libCdnjs **/
    $libCdnjs = new Typecho_Widget_Helper_Form_Element_Radio( 'libCdnjs',  array(
        'https://cdnjs.loli.net/ajax/libs/'        =>  'cdnjs.loli 公共库 ( https://cdnjs.loli.net/ajax/libs/ )',
        'https://lib.baomitu.com/'        =>  'cdn.baomitu 公共库 ( https://lib.baomitu.com/ )',
        'https://cdnjs.cloudflare.com/ajax/libs/'        =>  'cdnjs.cloudflare 公共库 ( https://cdnjs.cloudflare.com/ajax/libs/ )',
        'https://cdn.bootcss.com/'        =>  'cdn.bootcss 公共库 ( https://cdn.bootcss.com/ )'),
        'https://cdnjs.loli.net/ajax/libs/', _t('选择公共库'), _t('替换选择需要的公共库') );
    $form->addInput($libCdnjs->multiMode());

    $stickyCid = new Typecho_Widget_Helper_Form_Element_Text('stickyCid', NULL, '1739,1738,1671,1628', _t('置顶文章的 cid'), _t('按照排序输入, 请以半角逗号或空格分隔 cid.'));
    $form->addInput($stickyCid);

    $rewardJson = new Typecho_Widget_Helper_Form_Element_Textarea('rewardJson', NULL, '{ reward: [{ name: "支付宝" }, { img: "https://wx4.sinaimg.cn/large/006U7bU2gy1fl6dogepplj30u00u0gps.jpg"}] },{ reward: [{ name: "微信" }, { img: "https://ws3.sinaimg.cn/large/006U7bU2gy1furtrmqw95j30w00w0q6u.jpg"}] },{ reward: [{ name: "QQ" }, { img: "https://ws3.sinaimg.cn/large/006U7bU2gy1fus05omzozj30k00u0abg.jpg"}] }', _t('打赏Json'), _t('此处填入打赏的Json。'));
    $form->addInput($rewardJson);

    $socialJsonUrl = new Typecho_Widget_Helper_Form_Element_Text('socialJsonUrl', NULL, '//at.alicdn.com/t/font_569951_ou3gfpi8iyp.css', _t('社交Json Font class'), _t('此处填入阿里巴巴矢量图标库中你的项目中Font class的在线链接.'));
    $form->addInput($socialJsonUrl);

    $socialJson = new Typecho_Widget_Helper_Form_Element_Textarea('socialJson', NULL, '{s:"github",u:"https://github.com/kraity"},{s:"mayun",u:"https://gitee.com/kraity"},{s:"weibo",u:"https://weibo.com/Kraity"},{s:"qq",u:"javascript:;",content:"QQ 1696674719"},{s:"weixin",u:"javascript:;",content:"微信号 Kraity"},{s:"mail",u:"javascript:;",content:"邮箱 kraits@qq.com"}', _t('社交Json'), _t('此处填入社交的Json。'));
    $form->addInput($socialJson);

    $bloggerGx = new Typecho_Widget_Helper_Form_Element_Text('bloggerGx', NULL, '期待已久的“创造”之旅即将开始', _t('首页描述说明'), _t('此处填入首页描述说明,它用于在首页描述说明。'));
    $form->addInput($bloggerGx);

    $viceLeftright = new Typecho_Widget_Helper_Form_Element_Text('viceLeftright', NULL, 'BY-NC-SA 4.0 版权协议', _t('副页脚版权'), _t('此处填入页脚版权,它用于在页脚显示的版权声明,第一行'));
    $form->addInput($viceLeftright);

    $leftright = new Typecho_Widget_Helper_Form_Element_Text('leftright', NULL, 'Copyright &copy; 2017 权那他 , ', _t('页脚版权'), _t('此处填入页脚版权,它用于在页脚显示的版权声明,第二行'));
    $form->addInput($leftright);

    $useBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('useBlock',
        array(
            'usePangu' => _t('文章里中英文间加空格'),
            'usePostContentImg' => _t('文章里中加入文章缩略图在其中')
        ),
        array('usePangu','usePostContentImg'), _t('其他开关'));
    $form->addInput($useBlock->multiMode());

}


function themeInit($archive) {
    Helper::options()->commentsAntiSpam = false;//评论关闭反垃圾保护

    if ($archive->is('author')) {
        $archive->parameter->pageSize = 20; // 作者页面每20篇文章分页一次
    }
}

function themeFields($layout) {
    $thumbUrl = new Typecho_Widget_Helper_Form_Element_Textarea('thumbUrl', NULL, NULL, _t('thumbUrl'), _t('thumbUrl 展示图.'));
    $layout->addItem($thumbUrl);
}
