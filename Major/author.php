<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->need('header.php'); ?>

    <div class="authors">
        <div class="authot-inner">
            <div class="author-top">
                <p class="author-hello">Good <?php $this->author() ?>!</p>
                <div class="author-user">
                    <img src="<?php echo Major::getGravatar($this->author->mail,"100",$this->options->masterImgUrl,$this->options->useGravatar); ?>" alt="" class="author-user-photo">
                    <span class="author-user-notif"><?php $this->author('uid'); ?></span>
                </div>
                <div class="author-users">
                    <p class="author-users-name"><a href="<?php $this->author('url'); ?>"><?php $this->author() ?></a></p>
                </div>
            </div>
            <div class="author-bot">
                <div class="author-infor">
                    <div class="author-day weekday">Name</div>
                    <div class="author-day weekday">E-mail</div>
                    <div class="author-day weekday">homepage</div>
                    <div class="author-day date"><?php $this->author() ?></div>
                    <div class="author-day date"><?php $this->author('mail'); ?></div>
                    <div class="author-day date"><?php $this->author('url'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="authors-post">
        <?php include 'res/articleList.php'; //映入统一文章列表 ?>
    </div>

<?php $this->need('footer.php'); ?>