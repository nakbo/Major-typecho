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
    
    $masterImgUrl = new Typecho_Widget_Helper_Form_Element_Text('masterImgUrl', NULL, 'https://secure.gravatar.com/avatar/4e4559eceb7fbd4bca7925710592b1b9?s=70&r=G&d=mm', _t('主人的头像地址[暂时停用]'), _t('此处填入头像地址,用于主页头部显示,文章页时显示作者头像'));
    $form->addInput($masterImgUrl);

    $majorA0 = new Typecho_Widget_Helper_Form_Element_Text('majorA0', NULL, 'https://wx2.sinaimg.cn/mw1024/d60fbcc9ly1fgf6vgmprwj21ek11e7wh.jpg', _t('MajorA0大图'), _t('此处填入头部大图路径,A0和A2之间有一成opacity: 0.5黑色透明层,A1是最里一张,合理搭配就是3D效果'));
    $form->addInput($majorA0->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $majorA2 = new Typecho_Widget_Helper_Form_Element_Text('majorA2', NULL, 'https://wx2.sinaimg.cn/large/006U7bU2gy1fm2bwg6lh5j31hc0s0acv.jpg', _t('MajorA2大图'), _t('此处填入头部大图路径,A0和A2之间有一成opacity: 0.5黑色透明层,A2是最外一张,透明度opacity: 0.7,合理搭配就是3D效果'));
    $form->addInput($majorA2->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $rewardJson = new Typecho_Widget_Helper_Form_Element_Textarea('rewardJson', NULL, '{"name":"那他","uImg":"https://secure.gravatar.com/avatar/953de4234df55c1c973abb1c1588dc2e?s=100&r=G&d=mm","codeImg":"https://wx4.sinaimg.cn/large/006U7bU2gy1fl6dogepplj30u00u0gps.jpg"}', _t('打赏Json'), _t('此处填入打赏的Json。'));
    $form->addInput($rewardJson);

    $socialJson = new Typecho_Widget_Helper_Form_Element_Textarea('socialJson', NULL, '{s:"github",u:"https://github.com/kraity"},{s:"weibo",u:"https://weibo.com/Kraity"},{s:"weixin",u:"javascript:;"},{s:"mail",u:"https://krait.cn/d/mailme"}', _t('社交Json'), _t('此处填入社交的Json。'));
    $form->addInput($socialJson);
  
    $quoteLg = new Typecho_Widget_Helper_Form_Element_Text('quoteLg', NULL, '<p>Hey Guys!</p><i>我们正在开发中</i>', _t('应用语录'), _t('此处填入应用语录,它将在头部的博主下展示.'));
    $form->addInput($quoteLg);

    $leftright = new Typecho_Widget_Helper_Form_Element_Text('leftright', NULL, 'Copyright &copy; 2017 那他工作室', _t('页脚版权'), _t('此处填入页脚版权,它用于在页脚显示的版权声明。如有需要,亲手动去修改文件。'));
    $form->addInput($leftright);

    $logos = new Typecho_Widget_Helper_Form_Element_Text('logos', NULL, 'https://krait.cn/usr/Major/images/logo-white-green.png', _t('Logo路径'), _t('此处填入Logo路径,它是在头部显示的Logo图片,建议务必填写'));
    $form->addInput($logos->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $useMathjax = new Typecho_Widget_Helper_Form_Element_Radio('useMathjax',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'able', _t('Mathjax设置'), _t('默认禁止，启用则会对内容页进行数学公式渲染，仅支持 $公式$ 和 $$公式$$ '));
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

function ampInit($archive)
{
    if ($archive->is('single')) {
        $archive->content = str_replace('<img','<amp-img width="900" height="675" layout="responsive" ',$archive->content);
        $archive->content = str_replace('img>','amp-img>',$archive->content);
        $archive->content = str_replace('<!- toc end ->','',$archive->content);
        $archive->content = str_replace('javascript:content_index_toggleToc()','#',$archive->content);
    }

}


function get_post_img($archive)
{
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')
        ->from('table.contents')
        ->where('cid=?', $cid));
    $text = $rs['text'];
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i';
    if (preg_match($patternMDfoot, $text, $img)) {
        $img_url = $img[1];
    } else if (preg_match($patternMD, $text, $img)) {
        $img_url = $img[1];
    } else if (preg_match($pattern, $text, $img)) {
        preg_match("/(?:\()(.*)(?:\))/i", $img[0], $result);
        $img_url = $img[1];
    } else {
        $img_url ='https://wx2.sinaimg.cn/large/006U7bU2gy1fhx6t0d00vj31hc0u0jwz.jpg';
    }
    return $img_url;
}