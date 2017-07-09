<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define("Major", "1.3");

/**
 * 主题外观ThemeConfig
 *
 *
 *
 */
function themeConfig($form) {

    echo '<p style="font-size:16px;text-align:center;">Major [ '.Major.' ] made by <a href="https://krait.cn">那他</a> </p>';

    $name = new Typecho_Widget_Helper_Form_Element_Text('name', NULL, '那他', _t('用名'), _t('此处填入你的名字,暂时没有调用它的地方'));
    $form->addInput($name);

    $headjpg = new Typecho_Widget_Helper_Form_Element_Text('headjpg', NULL, 'https://wx1.sinaimg.cn/large/006HxDxWgy1fg2llc4kd4j31iq0p0n2l.jpg', _t('头部大图'), _t('此处填入头部大图路径,若没有填写，加载文件只带图片'));
    $form->addInput($headjpg);

    $describes = new Typecho_Widget_Helper_Form_Element_Text('describes', NULL, '权那他,一个在校高中理科生,优13班.', _t('站长描述'), _t('此处填入头部描述,它只在首页、作者名片里才显示'));
    $form->addInput($describes);

    $socialnav = new Typecho_Widget_Helper_Form_Element_Textarea('socialnav', NULL, '<li><a href="https://github.com/kraity"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-github"></use></svg></a></li>
<li><a href=""><svg class="icon" aria-hidden="true"><use xlink:href="#icon-weibo"></use></svg></a></li>
<li><a href="javascript:;"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-weixin"></use></svg></a></li>
<li><a href=""><svg class="icon" aria-hidden="true"><use xlink:href="#icon-mail"></use></svg></a></li>', _t('Social-nav'), _t('此处填入social-nav, 注意书写格式'));
    $form->addInput($socialnav);

    $leftright = new Typecho_Widget_Helper_Form_Element_Text('leftright', NULL, 'Copyright &copy; 2017 那他 ', _t('页脚版权'), _t('此处填入页脚版权,它用于在页脚显示的版权声明。如有需要,亲手动去修改文件。'));
    $form->addInput($leftright);

    $logos = new Typecho_Widget_Helper_Form_Element_Text('logos', NULL, NULL, _t('Logo路径'), _t('此处填入Logo路径,它是在页脚下显示的Logo图片,建议务必填写'));
    $form->addInput($logos);

}


/**
* 显示下一篇 - 旧的
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created < ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" rel="prev" class="post-nav-older">' . $content['title'] . '</a>';
        echo $link;
    } else {
        echo $default;
    }
}

/**
* 显示上一篇 - 新的
*
* @access public
* @param string $default 如果没有上一篇,显示的默认文字
* @return void
*/
function theNext($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created > ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" rel="next" class="post-nav-newer">' . $content['title'] . '</a>';
        echo $link;
    } else {
        echo $default;
    }
}

function formats($mat){
    switch ($mat) {
        case "post" :
            //标准 post
            echo 'text';
            break;
        case "quote" :
            //引语 quote
            echo 'quote';
            break;
        case "aside" :
            //日志 aside
            echo 'image';
            break;
        case "gallery" :
            //相册 gallery
            echo 'gallery';
            break;
        case "video" :
            //视频 video
            echo "video";
            break;
        case "link" :
            //链接 link
            echo "link";
            break;
        default:
            //其他 post
            echo 'text';
    }
}
