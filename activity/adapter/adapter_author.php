<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="post-author">
    <div class="post-author-left">
        <div class="mdui-card-header">
            <img class="mdui-card-header-avatar" src="<?php echo $krait->getGravatar($this->author->mail); ?>">
            <div class="mdui-card-header-title"><?php $this->author() ?></div>
            <div class="mdui-card-header-subtitle"><?php $this->options->bloggerGx(); ?></div>
        </div>
    </div>
</div>
