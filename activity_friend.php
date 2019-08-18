<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$krait = declareInterfaces();
include 'activity/activity_main_header.php';
include 'activity/adapter/adapter_author.php';
?>

    <div class="links" id="main" role="main">
        <article class="major-article content-wrap">
            <div class="post-content">
                <?php $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                $str = preg_replace('#<li>(.*?)<img src="(.*?)" alt="(.*?)" title="(.*?)">(.*?)<a href="(.*?)">(.*?)</a>(.*?)</li>#','
                            <div class="col-sm-6 col-xs-12">
                            <div class="item">
                                <div class="link-avatar">
                                    <img alt="" src="$2" class="avatar avatar-80 photo" height="80" width="80">
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <a href="$6" target="_blank">$4<i class="iconfont icon-Raidobox-selectedRai"></i></a>
                                    </div>
                                    <div class="meta button">
                                        <a href="$6" target="_blank">$6</a>
                                    </div>
                                </div>
                                <div class="description">$7</div>
                            </div>
                            </div>',$str);
                $str = preg_replace('#<ul>#','<div class="links-main"><div class="link-cats">', $str);
                $str = preg_replace('#</ul>#','</div><div class="clear"></div></div>', $str);
                echo $str;?>
            </div>
        </article>
    </div>

     <?php include 'activity/adapter/adapter_footer.php'; ?>

    <div class="comment-here">
        <div class="container">
            <?php include 'activity/adapter/adapter_comments.php'; ?>
        </div>
    </div>

<?php include 'activity/activity_main_footer.php'; ?>