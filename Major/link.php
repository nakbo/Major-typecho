<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php');?>

    <div class="major-bread">
        <div class="container">
            <h4><?php echo Major::personal()[screenName]; ?>的后院</h4>
            <p><?php $this->archiveTitle(array(
                    'category'  =>  _t('分类 %s 下的文章'),
                    'search'    =>  _t('包含关键字 %s 的文章'),
                    'tag'       =>  _t('标签 %s 下的文章'),
                    'author'    =>  _t('%s 发布的文章')
                ), '', ''); ?></p>
            <div class="major-bth"></div>
        </div>
    </div>

    <div class="links" id="main" role="main">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-content post-text major-text">
                    <?php
                    $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                    $str = preg_replace('#<li>(.*?)<a href="(.*?)">(.*?)</a></li>#','<div class="col-md-3 col-sm-6">
                                <div class="major-card-team"><div class="card-pic">$1</div><div class="card-ct">
                                        <h3 class="card-title">$3</h3><span class="card-text"><a href="$2" target="_blank">$2</a></span></div></div></div>',$str);
                    $str = preg_replace('#<ul>#','<div class="row major-cards">', $str);
                    $str = preg_replace('#</ul>#','</div>', $str);
                    $str = preg_replace('#\@\((.*?)\)#','<img src="/usr/themes/catui/newpaopao/$1.png" class="biaoqing">',$str);
                    echo $str;
                    ?>
                </div>
                <?php include 'res/PostFooter.php'; ?>
            </article>
        </div>
    </div>
    <div class="comment-here">
        <div class="container">
            <div class="col-md-9 row">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
    </div>

<?php $this->need('footer.php'); ?>