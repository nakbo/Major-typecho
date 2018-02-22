<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="post-footer">
    <div class="rewards-ch">
        <a href="#rewards" class="rewards-inline" data-vbtype="inline" data-no-instant>赏</a>
    </div>
    <div class="post-declare">
        <p><?php $this->options->postright();?></p>
    </div>
    <div class="post-infoBox">
        <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author" class="intro-author"><?php $this->author(); ?></a>
        <a class="intro-eye"><?php majors_Plugin::theViews(); ?> Views</a>
        <a class="intro-time"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></a>
        <a class="intro-count"><?php echo Major::artCount($this->cid); ?>个字</a>
        <?php $this->category(' '); ?><?php $this->tags(' ', true, ' <a>无标签</a>'); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.rewards-inline').venobox({
            framewidth: '380px',
            frameheight: '100%',
            border: '0'
        });
    });
</script>