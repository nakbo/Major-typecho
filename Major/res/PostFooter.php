<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="post-footer">
    <div class="post-infoBox">
        <li>
            <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author" class="intro-author"><?php $this->author(); ?></a>
        </li>
        <li>
            <?php majors_Plugin::theViews(); ?> Views
        </li>
        <li>
            <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
        </li>
        <li>
            <?php echo Major::artCount($this->cid); ?>个字
        </li>
        <li>
            <?php $this->category(','); ?><?php $this->tags(',', true, '无标签'); ?>
        </li>
    </div>
</div>