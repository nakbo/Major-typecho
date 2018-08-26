<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 *
 * <div class="post-footer">
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
 */
?>

<div class="show-foot">
    <div class="copyright" data-toggle="tooltip" data-html="true" data-original-title="转载请联系作者获得授权，并注明转载地址"><span>© 著作权归作者所有</span>
    </div>
    <div class="notebook">
        <span>最后修改：<?php echo date('Y 年 m 月 d 日', $this->modified);?></span>
    </div>
</div>

