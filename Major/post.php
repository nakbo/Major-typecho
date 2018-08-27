<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$newFormat = majors_Plugin::getFormat();
switch ($newFormat){
    case 'status':
        return;
        break;
    case 'chat':
        return;
        break;
    case 'quote':
        return;
        break;
    default:
}
?>
<?php $this->need('header.php'); ?>

    <div class="articles-post post-header">
        <div class="post-head">
            <div class="back">
                <button onclick="window.history.back();return false;" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
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
                    <span>
                        <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                    </span>
                    <span>
                        <?php $this->category(','); ?>
                    </span>
                    <span>
                        <i class="icon-eye icons"></i>
                        <?php majors_Plugin::theViews(); ?>
                    </span>
                </h5>
            </div>
        </div>
    </div>

    <div class="majors-post-articles post" id="main" role="main">
        <div class="container">
            <article class="major-article article-shadow content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-content major-text" data-wow-offset="10" itemprop="articleBody">
                    <?php if($this->fields->thumbUrl) :?><p><img src="<?php $this->fields->thumbUrl(); ?>" alt="<?php $this->title(); ?>" /></p><?php endif;?>
                    <?php $this->content(); ?>
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