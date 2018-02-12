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
                <div class="post-content post-text major-text">


                    <?php
                    $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                    $str = preg_replace('#<li>(.*?)<a href="(.*?)">(.*?)</a></li>#','<div class="item col-xs-12 col-sm-4 col-md-4">
                                <a href="$2" target="_blank">
                                <div class="image">$1</div>
                                <div class="content">
                                <div class="title">
                                 <span class="name"><b>$3</b></span> 
                                 <span class="desc">$2</span>
                                 </div>
                                 </div>
                                </a></div>',$str);
                    $str = preg_replace('#<ul>#','<div class="major-friendly row">', $str);
                    $str = preg_replace('#</ul>#','</div>', $str);
                    $str = preg_replace('#\@\((.*?)\)#','<img src="">',$str);
                    echo $str;
                    ?>

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