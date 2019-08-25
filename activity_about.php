<?php
/**
 * 个人
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$krait = declareInterfaces();
include 'activity/activity_main_header.php';
include 'activity/adapter/adapter_author.php';
?>

    <div class="abouts">
        <article class="major-article content-wrap">
            <div class="post-content major-text personal-info">
                <?php $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                $str = preg_replace('#<li><em>(.*?)</em>(.*?)<strong>(.*?)</strong></li>#','<li class="mdui-list-item mdui-ripple"><i class="mdui-list-item-icon mdui-icon material-icons">$1</i><div class="mdui-list-item-content">$3</div></li>',$str);
                $str = preg_replace('#<ul>#','<ul class="mdui-list mdui-list-dense">', $str);
                $str = preg_replace('#</ul>#','</ul>', $str);
                echo $str;?>
            </div>
            <?php include 'activity/adapter/adapter_footer.php'; ?>
        </article>
    </div>

    <div class="comment-here">
        <div class="container">
            <?php include 'activity/adapter/adapter_comments.php'; ?>
        </div>
    </div>

<?php include 'activity/activity_main_footer.php'; ?>