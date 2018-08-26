<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php');?>


    <div class="articles-post post-header">
        <div class="post-head">
            <div class="back">
                <a href="javascript:;" onclick="javascript:history.back(-1);" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></a>
            </div>
            <div class="container">
                <div class="title">
                    <h1><?php $this->sticky(); $this->title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="post-head-row">
            <div class="container">
                <h5 class="subtitle">
                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                </h5>
            </div>
        </div>
    </div>

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
                <?php include 'res/showfoot.php'?>
            </article>
        </div>
    </div>

    <div class="comment-here">
        <div class="container">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>

<?php $this->need('footer.php'); ?>