<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php');?>

    <div class="links" id="main" role="main">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-content major-text">
                    <?php $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                    $str = preg_replace('#<li>(.*?)<a href="(.*?)">(.*?)</a></li>#','<a class="mdui-ripple" href="$2" target="_blank">$1<p>$3</p></a>',$str);
                    $str = preg_replace('#<ul>#','<div class="link-group">', $str);
                    $str = preg_replace('#</ul>#','</div>', $str);
                    $str = preg_replace('#\@\((.*?)\)#','<img src="">',$str);
                    echo $str;?>

                </div>
                <?php include 'res/PostFooter.php'; ?>
            </article>
        </div>
    </div>

    <div class="comment-here">
        <div class="container">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>

<?php $this->need('footer.php'); ?>