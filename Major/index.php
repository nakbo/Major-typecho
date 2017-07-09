<?php
/**
 * 新Major 基于chivalric模板且以科学、高端为主,采用兼容性开发!
 * 
 * @package Major
 * @author 权那他
 * @version 1.3
 * @link https://krait.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); 
?>

<section class="row content-wrap">
    <div class="container">
        <div class="row" id="post-masonry">
            
            <?php if($this->is('index') & $this->_currentPage==1 ):?>
            <!--Author Widget-->
            <?php echo widget_author('col-sm-4 widget-author widget widget-with-posts post dispmin','index',$this->author->screenName,$this->options->describes,$this->author->mail,$this->author->permalink,$this->options->socialnav);?>
            <?php endif;?>
            
            <?php if ($this->have()): ?>
            <?php while($this->next()): $format = majors_Plugin::getFormat();?>
            
            <!--Blog Post-->
            <article class="col-sm-4 post post-masonry post-format-<?php echo formats($format); ?>">
                <div class="post-wrapper row">
                    <div class="featured-content row">
                        
                        <?php switch ($format) { case "video" : ?>
                        
                        
                        <?php if($this->fields->thumbUrl) :?>
                        <a href="<?php $this->permalink(); ?>">
                            <img src="<?php $this->fields->thumbUrl(); ?>" alt="" class="img-responsive">
                            <img src="<?php $this->options->themeUrl('images/play-btn.png'); ?>" alt="" class="video-mark">
                        </a>
                        <?php endif;?>
                        
                        
                        <?php break; case 'aside':?>
                        
                        <?php if($this->fields->thumbUrl) :?>
                        <a href="<?php $this->permalink() ?>"><img src="<?php $this->fields->thumbUrl(); ?>" alt="" class="img-responsive"></a>
                        <?php endif;?>
                        
                        <?php break; case 'gallery':?>
                        
                        <?php if($this->fields->gallery) :?>
                        <div class="gallery-of-post">
                            <?php
                                  $gallerys = explode("\r\n",$this->fields->gallery);
                                  foreach ($gallerys as $value) {
                                       echo '<div class="item"><img src="'.$value.'" alt=""></div>';
                                  }?>
                        </div>
                        <?php endif;?>
                        
                        <?php }?>
                        
                    </div>
                    
                    <div class="post-excerpt row">
                        <h3 class="post-title">
                            <?php switch ($format) { case "link":break; default:?>
                            <a href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title(); ?></a>
                            <?php }?>
                        </h3>
                        <p><?php $this->excerpt(77, '...'); ?></p>
                        <footer class="row">
                            <div class="response-count"><?php $this->date('F j, Y');?></div>
                        </footer>
                    </div>
                </div>
            </article>

            <?php endwhile; ?>
            <?php else: ?>
                <div>没有哦!#F5F4F4</div>
            <?php endif; ?>
        </div>
    </div>

</section>

<div class="pageNav-in">
    <?php $this->pageNav('&laquo;', '&raquo;'); ?>
</div>


<?php $this->need('footer.php'); ?>
