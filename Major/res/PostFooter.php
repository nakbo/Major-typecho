<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="post-footer">

    <div class="rewards-ch">
        <a href="#rewards" class="rewards-inline" data-vbtype="inline" data-no-instant>赏</a>
    </div>

    <blockquote>
        <div class="post-declare"><p>本文由 @<a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> 原创发布。未经许可，禁止转载。</p></div>
    </blockquote>

    <div class="post-intro meta-tags row-u767">
        <ul class="post-intro-meta">
            <li>
                <a class="rewards-inline" data-vbtype="inline" href="#rewards" data-no-instant>打赏</a>
                <a class="share-qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink() ?>&title=<?php $this->title(); ?>&site=<?php $this->siteUrl(); ?>" itemprop="breadcrumb" target="_blank" title="" data-toggle="tooltip" data-original-title="分享到QQ空间" onclick="window.open(this.href, 'qzone-share', 'width=550,height=335');return false;">分享到:空间</a>
                <a class="share-weibo" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink() ?>&title=<?php $this->title(); ?>" target="_blank" itemprop="breadcrumb" title="" data-toggle="tooltip" data-original-title="分享到微博" onclick="window.open(this.href, 'weibo-share', 'width=550,height=335');return false;">分享到:微博</a>
            </li>
            <li class="intro-list">
                <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author" class="intro-author"><?php $this->author(); ?></a>
                <a class="intro-eye"><?php majors_Plugin::theViews(); ?> Views</a>
                <a class="intro-time"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></a>
                <a class="intro-count"><?php echo Major::artCount($this->cid); ?>个字</a>
                <?php $this->category(' '); ?><?php $this->tags(' ', true, ' <a>无标签</a>'); ?>
            </li>
        </ul>
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