<?php
/**
 * 个人
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>

    <div class="abouts">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-content post-text major-text">
                    <div class="personal-infor">
                        <div class="major-friendly row">
                            <div class="item col-md-6">
                                <a href="https://krait.cn" target="_blank">
                                    <div class="image">
                                        <img src="https://secure.gravatar.com/avatar/4e4559eceb7fbd4bca7925710592b1b9?s=120&amp;r=G&amp;d=mm" alt="权那他" title="权那他" class="zoomify">
                                    </div>
                                    <div class="content">
                                        <div class="title">
                                            <span class="name"><b>权那他</b></span>
                                            <span class="desc">笔名 权那他 / 实名 陆双龙</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php $this->content(); ?>
                    </div>

                </div>
                <?php include 'res/PostFooter.php'; ?>
            </article>
            <!--?php $this->need('comments.php'); ?-->
        </div>
    </div>
    <div class="comment-here">
        <div class="container">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
    <script>
        function toastAbout(){
            $.Toast("那他关于信息", "将公开部分可公开的信息,打赏清单往下滑哦!", "success", {
                has_icon:true,
                has_close_btn:true,
                fullscreen:false,
                timeout:12000,
                sticky:false,
                has_progress:true,
                rtl:false
            });
        }
        toastAbout();
    </script>
<?php $this->need('footer.php'); ?>