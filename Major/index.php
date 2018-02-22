<?php
/**
 * 新Major 科创出品,原创主题,采用兼容性开发!
 * 
 * @package Major
 * @author 权那他
 * @version 1.8
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
            <div class="about-x count" id="sumPostClick">
                <h3><span class="animateNum" id="sumPost" data-animatetarget="<?php $stat->publishedPostsNum() ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x count" id="sumComClick">
                <h3><span class="animateNum" id="sumCom" data-animatetarget="<?php $stat->publishedCommentsNum() ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x count" id="sumViewClick">
                <h3><span class="animateNum" id="sumView" data-animatetarget="<?php majors_Plugin::sumViews(); ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x namets">Posts</div>
            <div class="about-x namets">Comments</div>
            <div class="about-x namets">Views</div>
        </div>
    </div>
</div>
<script>
    var $$ = mdui.JQ;
    function infoSum(c,m) {
        $$(c).on('click', function () {
            mdui.snackbar({
                message: m
            });
        });
    }
    infoSum('#sumPostClick','本站的文章数:'+$("#sumPost").data("animatetarget"));
    infoSum('#sumComClick','本站的评论数:'+$("#sumCom").data("animatetarget"));
    infoSum('#sumViewClick','本站的浏览数:'+$("#sumView").data("animatetarget"));
</script>

<?php $this->need('footer.php'); ?>
