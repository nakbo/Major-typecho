<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$newFormat = majors_Plugin::getFormat();
if (Major::postAble($newFormat)) exit; ?>

<?php $this->need(Major::$commonDir.'/layout-header.php'); ?>

<?php $this->need(Major::$commonDir.'/layout-head.php'); ?>

<div class="majors-post-articles post <?php echo $newFormat; ?>" id="main" role="main">
    <div class="container">
        <article class="major-article article-shadow content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="post-content major-text" data-wow-offset="10" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <?php include 'res/layout-showfoot.php'?>
        </article>
    </div>
</div>

<div class="comment-here">
    <div class="container">
        <?php $this->need(Major::$commonDir.'/res/layout-comments.php'); ?>
    </div>
</div>

<?php $this->need(Major::$commonDir.'/layout-footer.php'); ?>