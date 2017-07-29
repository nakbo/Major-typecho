<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="major-3 object" id="main" role="main">
    <div class="container">
        <div class="row content-wrap" id="major-posts">
            <?php if ($this->have()): ?>
                <?php while($this->next()): $format = majors_Plugin::getFormat();?>

                    <article class="majors-post" itemscope itemtype="http://schema.org/BlogPosting" data-rippleria>
                        <?php switch ($format) { case 'aside':?>
                            <?php if($this->fields->thumbUrl) :?>

                                <a href="<?php $this->permalink() ?>">
                                    <div class="A3-image row"><img src="<?php $this->fields->thumbUrl(); ?>" class="grow" /></div>
                                </a>
                            <?php endif;?>
                        <?php }?>

                        <h3 class="post-title" itemprop="name headline">
                            <div class="title-img">
                                <img src="<?php echo 'https://secure.gravatar.com/avatar/'.md5($this->author->mail).'?s=40&r=G&d=mm'; ?>">
                            </div>
                            <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title(); ?></a>
                        </h3>
                        <div class="post-contents" itemprop="articleBody">
                            <p><?php $this->excerpt(77, '...'); ?></p>
                        </div>
                        <footer class="row">
                            <div class="response-count">
                                <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('F j, Y');?></time>
                            </div>
                        </footer>
                    </article>

                <?php endwhile; ?>
            <?php else: ?>
                <div>没有哦!#F5F4F4</div>
            <?php endif; ?>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php $this->options->themeUrl(); ?>js/mp.mansory.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#major-posts").mpmansory({
            childrenClass: 'majors-post',
            columnClasses: 'major-post',
            breakpoints: {
                lg: 4,
                md: 4,
                sm: 6,
                xs: 12
            },
            distributeBy: {
                order: false,
                height: false,
                attr: 'data-order',
                attrOrder: 'asc'
            },
            onload: function(items) {
            }
        });
    });
</script>


<div class="major-4 object">
    <div class="majors-A4">
        <div class="pageNav-in">
            <?php $this->pageNav('&laquo;', '&raquo;'); ?>
        </div>
    </div>
</div>