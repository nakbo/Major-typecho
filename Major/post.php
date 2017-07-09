<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->need('header.php'); ?>

<?php $format = majors_Plugin::getFormat(); ?>

    <section class="row content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-<?php switch ($format) { case "gallery": echo'12'; break; default: echo '8'; }?> single-post-contents">
                    <article class="single-post-content row m0 post">
                        <div id="post-id" class="post-content post-text row">
                            <?php $this->content(); ?>
                            <span class="tag-links"><?php $this->tags(', ', true); ?></span>

                        </div>
                        <div class="comment-box"><?php $this->need('comments.php'); ?></div>
                    </article>
                </div>
                <?php if($format !=='gallery'):?>
                    <div class="col-md-4 sidebar">
                        <?php $this->need('sidebar.php'); ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </section>

<?php $this->need('footer.php'); ?>
