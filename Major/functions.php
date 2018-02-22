<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once('lib/Major.php');

/**
 * 主题外观ThemeConfig
 *
 *
 *
 */
function themeConfig($form) {

    Major::getVersion();

    $useGravatar = new Typecho_Widget_Helper_Form_Element_Radio('useGravatar',
        array('gr' => _t('使用公认头像'),
            'ma' => _t('使用自定头像'),
        ),
        'gr', _t('引用头像方式'), _t('默认启用公认头像，公认头像是全球公认头像(Gravatar),使用的邮箱是管理员的邮箱.自定头像是你自己自定义的头像,在这里的下方设置即可.'));
    $form->addInput($useGravatar);
    
    $masterImgUrl = new Typecho_Widget_Helper_Form_Element_Text('masterImgUrl', NULL, 'https://secure.gravatar.com/avatar/4e4559eceb7fbd4bca7925710592b1b9?s=70&r=G&d=mm', _t('自定头像'), _t('此处填入头像地址,用于mat头部显示,文章页时显示作者头像 '));
    $form->addInput($masterImgUrl);

    $majorA0 = new Typecho_Widget_Helper_Form_Element_Text('majorA0', NULL, 'https://wx4.sinaimg.cn/large/006U7bU2gy1fomyar7zqij31v20p0kct.jpg', _t('Mat 头图'), _t('此处填入mat头部大图路径,注意是超链接形式.'));
    $form->addInput($majorA0->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $matAAble = new Typecho_Widget_Helper_Form_Element_Checkbox('matAAble',
        array(
            'A1' => _t('渲染夹层黑色'),
            'A2' => _t('渲染夹层紫红色'),
            'svgMountain' => _t('渲染夹层大山')
        ),
        array('A1','svgMountain'), _t('渲染Mat头图组件'));
    $form->addInput($matAAble->multiMode());

    $rewardJson = new Typecho_Widget_Helper_Form_Element_Textarea('rewardJson', NULL, '{"name":"那他","uImg":"https://secure.gravatar.com/avatar/953de4234df55c1c973abb1c1588dc2e?s=100&r=G&d=mm","codeImg":"https://wx4.sinaimg.cn/large/006U7bU2gy1fl6dogepplj30u00u0gps.jpg"}', _t('打赏Json'), _t('此处填入打赏的Json。'));
    $form->addInput($rewardJson);

    $socialJson = new Typecho_Widget_Helper_Form_Element_Textarea('socialJson', NULL, '{s:"github",u:"https://github.com/kraity"},{s:"weibo",u:"https://weibo.com/Kraity"},{s:"weixin",u:"javascript:;"},{s:"mail",u:"https://krait.cn/t/mailme"}', _t('社交Json'), _t('此处填入社交的Json。'));
    $form->addInput($socialJson);

    $postright = new Typecho_Widget_Helper_Form_Element_Text('postright', NULL, '执行 CC BY NC SA 4.0 版权协议', _t('文章版权'), _t('此处填入文章版权,它用于在文章末尾显示的文章版权声明。'));
    $form->addInput($postright);

    $leftright = new Typecho_Widget_Helper_Form_Element_Text('leftright', NULL, 'Copyright &copy; 2017 那他工作室 , 渝ICP备18001767号', _t('页脚版权'), _t('此处填入页脚版权,它用于在页脚显示的版权声明。'));
    $form->addInput($leftright);

    $useMathjax = new Typecho_Widget_Helper_Form_Element_Radio('useMathjax',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'able', _t('Mathjax设置'), _t('默认启用，启用则会对内容页进行数学公式渲染，仅支持 $公式$ 和 $$公式$$ '));
    $form->addInput($useMathjax);

    $useBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('useBlock',
        array(
            'usePangu' => _t('Pangu 文章里中英文间加空格')
            ),
        array('usePangu'), _t('插件显示'));
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
        $link = '<a href="' . $content['permalink'] . '" data-toggle="tooltip" title="旧一篇: ' . $content['title'] . '" rel="prev" class="post-nav-older">' . $content['title'] . '</a>';
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
        $link = '<a href="' . $content['permalink'] . '" data-toggle="tooltip" title="新一篇: ' . $content['title'] . '" rel="next" class="post-nav-newer">' . $content['title'] . '</a>';
        echo $link;
    } else {
        echo $default;
    }
}