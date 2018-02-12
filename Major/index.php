<?php
/**
 * 新Major 科创出品,原创主题,采用兼容性开发!
 * 
 * @package Major
 * @author 权那他
 * @version 1.7
 * @link https://krait.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); 
?>

<div class="major-3 object" id="main" role="main">
    <?php include 'res/articleList.php'; //映入统一文章列表 ?>
</div>

<div class="major-about">
    <div class="container">
        <div class="about-infor" id="about-infor">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <div class="about-x count">
                <h3><span class="animateNum" data-animatetarget="<?php $stat->publishedPostsNum() ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x count">
                <h3><span class="animateNum" data-animatetarget="<?php $stat->publishedCommentsNum() ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x count">
                <h3><span class="animateNum" data-animatetarget="<?php majors_Plugin::sumViews(); ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x namets">Posts</div>
            <div class="about-x namets">Comments</div>
            <div class="about-x namets">Views</div>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>
