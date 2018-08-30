<?php
/**
 * 个人
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<?php $this->need('header.php'); ?>

    <div class="articles-post post-header">
        <div class="post-head">
            <div class="back">
                <button onclick="window.history.back();return false;" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
            </div>
            <div class="container">
                <div class="title">
                    <h1><?php echo Major::$screenName; ?></h1>
                </div>
            </div>
        </div>
        <div class="post-head-row">
            <div class="container">
                <h5 class="subtitle">
                   <?php echo "I came here ".Major::mdate(Major::$activated);?>
                </h5>
                <?php include 'res/postAuthor.php';?>
            </div>
        </div>
    </div>

    <div class="abouts">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-content major-text personal-infor">
                    <?php $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                    $str = preg_replace('#<li><em>(.*?)</em>(.*?)<strong>(.*?)</strong></li>#','<li class="mdui-list-item mdui-ripple"><i class="mdui-list-item-icon mdui-icon material-icons">$1</i><div class="mdui-list-item-content">$3</div></li>',$str);
                    $str = preg_replace('#<ul>#','<ul class="mdui-list mdui-list-dense">', $str);
                    $str = preg_replace('#</ul>#','</ul>', $str);
                    echo $str;?>
                </div>
                <?php include 'res/showfoot.php'?>
            </article>
            <!--?php $this->need('comments.php'); ?-->
        </div>
    </div>

    <div class="comment-here">
        <div class="container">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>

<?php $this->need('footer.php'); ?>