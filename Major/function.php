<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * format字符配对
 *
 *@remarks: 用于特殊的判断
 */
function formats($mat){
    switch ($mat) :
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
    endswitch;
}

/**
 * format字符配对，并return;
 *
 *@remarks: header.php 中是否return出头部大家伙
 */
function formati($mat){
    switch ($mat) :
        case "post" :
            //标准 post
            return false;
            break;
        case "quote" :
            //引语 quote
            return false;
            break;
        case "aside" :
            //日志 aside
            return true;
            break;
        case "gallery" :
            //相册 gallery
            return true;
            break;
        case "video" :
            //视频 video
            return true;
            break;
        case "link" :
            //链接 link
            return false;
            break;
        case "false" :
            //false
            return false;
            break;
        case "true" :
            //true
            return true;
            break;
        default:
            //其他 post
            return false;
    endswitch;
}


if($this->is('post')):
    $format = majors_Plugin::getFormat();
elseif($this->is('author')):
    $format = "false";
else:
    $format = "true";
endif; //对$format赋值

function widget_title($describes){
    echo $describes;
}

function creativecommons() {
    echo '<span><svg class="icon" aria-hidden="true"><use xlink:href="#icon-creativecommons"></use></svg>版权协议 <a rel="license" class="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/" data-toggle="tooltip" title="本站的原创作品除特殊说明均采用CC BY NC SA 国际4.0" target="_blank" class="external">CC BY NC SA 4.0</a></span>';
}
