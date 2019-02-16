<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need(Major::$commonDir.'/layout-header.php');?>
<?php $this->need(Major::$commonDir.'/layout-head.php'); ?>

    <div class="links" id="main" role="main">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-content">
                    <?php $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                    $str = preg_replace('#<li><img src="(.*?)" alt="(.*?)" title="(.*?)">(.*?)<a href="(.*?)">(.*?)</a></li>#','<div class="post-list-item col-sm-6 col-xs-12">
                        <div class="post-list-item-container">
                            <div class="item-label">
                                <div class="item-title">
                                    <a href="$5" target="_blank">$6</a>
                                </div>
                                <div class="item-meta clearfix">
                                    <div class="item-meta-ico bg-ico-book" style="background: url($1) no-repeat;background-size: 40px auto;"></div>
                                    <div class="item-meta-cat"> <a href="$5" target="_blank">$3</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>',$str);
                    $str = preg_replace('#<ul>#','<div class="post-lists-body">', $str);
                    $str = preg_replace('#</ul>#','</div><div class="clear"></div>', $str);
                    echo $str;?>

                </div>
                <?php $this->need(Major::$commonDir.'/res/layout-showfoot.php'); ?>
            </article>
        </div>
    </div>
    <div class="comment-here">
        <div class="container">
            <?php $this->need(Major::$commonDir.'/res/layout-comments.php'); ?>
        </div>
    </div>

<?php $this->need(Major::$commonDir.'/layout-footer.php'); ?>