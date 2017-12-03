<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="post-footer">
    <div class="post-intro meta-tags row-u767">
        <ul class="post-intro-meta">
            <li>
                <a href="javascript:;" class="reward-mit rm-paypal">打赏</a>
                <a class="share-qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink() ?>&title=<?php $this->title(); ?>&site=<?php $this->siteUrl(); ?>" itemprop="breadcrumb" target="_blank" title="" data-toggle="tooltip" data-original-title="分享到QQ空间" onclick="window.open(this.href, 'qzone-share', 'width=550,height=335');return false;">分享到:空间</a>
                <a class="share-weibo" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink() ?>&title=<?php $this->title(); ?>" target="_blank" itemprop="breadcrumb" title="" data-toggle="tooltip" data-original-title="分享到微博" onclick="window.open(this.href, 'weibo-share', 'width=550,height=335');return false;">分享到:微博</a>
            </li>
            <li class="intro-list">
                <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author" class="intro-author"><?php $this->author(); ?></a>
                <a class="intro-eye"><?php majors_Plugin::theViews(); ?> Views</a>
                <a class="intro-time"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></a>
                <?php $this->category(' '); ?><?php $this->tags(' ', true, ' <a>无标签</a>'); ?>
            </li>
        </ul>
    </div>
</div>