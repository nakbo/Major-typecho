<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->need('header.php'); ?>


<?php $format = majors_Plugin::getFormat(); ?>
    <div class="post-articles" id="main" role="main">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-header">
                    <div class="article-title">
                        <h3><a><?php $this->sticky(); $this->title(); ?></a></h3>
                        <ul class="posts-meta">
                            <li itemprop="author" itemscope itemtype="http://schema.org/Person">
                                <div class="author-img">
                                    <img src="<?php echo 'https://secure.gravatar.com/avatar/'.md5($this->author->mail).'?s=40&r=G&d=mm'; ?>">
                                </div>
                                <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a>
                            </li>
                            <li data-microtip="写于 <?php $this->date('Y 年 m 月 d 日');?> | 最后更新于 <?php echo date('Y 年 m 月 d 日', $this->modified);?> " data-microtip-position="top-left"> • <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y 年 m 月 d 日');?></time></li>
                            <li> • <?php $this->category(' , '); ?></li>
                            <li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"> • <?php $this->commentsNum('等你评论', '1条评论', '%d条评论'); ?></a></li>
                            <?php if($this->user->hasLogin()):?>
                                <li><a href="<?php $this->options->adminUrl(); ?>write-<?php if($this->is('post')): ?>post<?php else: ?>page<?php endif;?>.php?cid=<?php echo $this->cid;?>" class="category-link"  target="_blank"> • 编辑</a></li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <hr>
                </div>
                <div class="wow fadeInY post-content post-text" data-wow-offset="10" itemprop="articleBody">
                    <?php $this->content(); ?>
                    <div itemprop="keywords" class="keywords ">标签: <?php $this->tags(' , ', true, '无'); ?></div>
                </div>

                <div class="post-footer">
                    <!--l class="post-near">
                    <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
                    <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
                </ul-->
                </div>
            </article>
        </div>
    </div>

    <script src="<?php $this->options->themeUrl(); ?>vendors/zoomify/zoomify.min.js"></script>
    <script type="text/javascript">
        $('.post-content img').zoomify();
    </script>

    <div class="comment-here">
        <div class="container">
            <div class="comment-box"><?php $this->need('comments.php'); ?></div>
        </div>
    </div>

<?php $this->need('footer.php'); ?>