<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define("majorv", "1.4");

/**
 * 主题外观ThemeConfig
 *
 *
 *
 */
function themeConfig($form) {

    $majorv = file_get_contents("https://krait.cn/majorv.txt");
    if ($majorv > majorv){
        echo '<div class="majorPv">你正在使用 <strong>'.majorv.'</strong> 版本的新Major，最新版本为 <strong style="color:red;">'.$majorv.'</strong><a href="https://krait.cn/major.html"><button type="submit" class="btn btn-warn">前往更新</button></a></div>';
    }else {
        echo '<div class="majorPv">你正在使用最新版的新Major '.majorv.' made by <a href="https://krait.cn">那他</a></div>';
    }

    $str=<<<EOT
<style>
   .majorPv{
     font-size:15px;
     font-family:'Microsoft Yahei', sans-serif
   }
   .majorPv a {
      color:black;
   }
   .majorPv .btn {
    padding: 0 7px;
    height: 20px;
    margin-left: 10px;
    font-size: 10px;
    margin-top: -7px;
   }
</style>
EOT;
    echo $str;

    $majorM = new Typecho_Widget_Helper_Form_Element_Text('majorM', NULL, '那他', _t('用名'), _t('此处填入你的名字,用于菜单meun应用名字'));
    $form->addInput($majorM);

    $describes = new Typecho_Widget_Helper_Form_Element_Text('describes', NULL, '霸气的来描述我啊.', _t('站点描述'), _t('此处填入头部描述,它只在首页、作者名片里才显示'));
    $form->addInput($describes);

    $messages = new Typecho_Widget_Helper_Form_Element_Text('messages', NULL, NULL, _t('通报'), _t('此处填入通报的内容,用于首页的通报里,目前暂时支持一行'));
    $form->addInput($messages);

    $majorA0 = new Typecho_Widget_Helper_Form_Element_Text('majorA0', NULL, 'https://wx2.sinaimg.cn/large/006U7bU2gy1fhx2w3bugrj31ek11ewz3.jpg', _t('MajorA0大图'), _t('此处填入头部大图路径,A0和A2之间有一成opacity: 0.5黑色透明层,A1是最里一张,合理搭配就是3D效果'));
    $form->addInput($majorA0->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $majorA2 = new Typecho_Widget_Helper_Form_Element_Text('majorA2', NULL, 'https://wx2.sinaimg.cn/large/006U7bU2gy1fhx6t0d00vj31hc0u0jwz.jpg', _t('MajorA2大图'), _t('此处填入头部大图路径,A0和A2之间有一成opacity: 0.5黑色透明层,A2是最外一张,透明度opacity: 0.7,合理搭配就是3D效果'));
    $form->addInput($majorA2->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $leftright = new Typecho_Widget_Helper_Form_Element_Text('leftright', NULL, 'Copyright &copy; 2017 company ', _t('页脚版权'), _t('此处填入页脚版权,它用于在页脚显示的版权声明。如有需要,亲手动去修改文件。'));
    $form->addInput($leftright);

    $logos = new Typecho_Widget_Helper_Form_Element_Text('logos', NULL, 'https://krait.cn/usr/Major/images/logo-white-green.png', _t('Logo路径'), _t('此处填入Logo路径,它是在头部显示的Logo图片,建议务必填写'));
    $form->addInput($logos->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

    $useMathjax = new Typecho_Widget_Helper_Form_Element_Radio('useMathjax',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('Mathjax设置'), _t('默认禁止，启用则会对内容页进行数学公式渲染，仅支持 $公式$ 和 $$公式$$ '));
    $form->addInput($useMathjax);

    $useBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('useBlock',
        array(
            'useWow' => _t('Wow 动态'),
            'usePangu' => _t('Pangu 文章里中英文间加空格'),
            'useAnchorHover' => _t('AnchorHover 进行对指定a链接添加特效')
            ),
        array('useWow','usePangu','useAnchorHover'), _t('插件显示'));
    $form->addInput($useBlock->multiMode());

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