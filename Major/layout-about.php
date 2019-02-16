<?php
/**
 * 个人
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<?php $this->need(Major::$commonDir.'/layout-header.php'); ?>

<?php $this->need(Major::$commonDir.'/layout-head.php'); ?>

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
                <?php $this->need(Major::$commonDir.'/res/layout-showfoot.php'); ?>
            </article>
            <!--?php $this->need('comments.php'); ?-->
        </div>
    </div>
    <div class="comment-here">
        <div class="container">
            <?php $this->need(Major::$commonDir.'/res/layout-comments.php'); ?>
        </div>
    </div>

<?php $this->need(Major::$commonDir.'/layout-footer.php'); ?>