<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<!--Author Widget-->
<?php echo widget_author('row m0 widget-author widget','post',$this->author->screenName,'',$this->author->mail,$this->author->permalink,$this->options->socialnav);?>

<aside class="row m0 widget widget-w">
    <div class="widget-w-inner">
        <div class="widget-w-title">Recent articles</div>
        <div class="widget-w-text">

                <?php $this->widget('Widget_Contents_Post_Recent')->parse('
                    <li><a href="{permalink}">{title}</a></li>'); ?>

        </div>
    </div>
</aside>

<aside class="row m0 widget widget-w">
    <div class="widget-w-inner">
        <div class="widget-w-title">Category</div>
        <div class="widget-w-text">
            <?php $this->widget('Widget_Metas_Category_List')->parse('
             <li><a href="{permalink}" title="{description}">{name}</a> ({count})</li>'); ?>
        </div>
    </div>
</aside>

<aside class="row m0 widget widget-w">
    <div class="widget-w-inner">
        <div class="widget-w-title">Tags</div>
        <div class="widget-w-text">
            <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 20))->to($tags); ?>
            <?php while($tags->next()): ?>
                <a rel="tag" class="tag" href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a>
            <?php endwhile; ?>
        </div>
    </div>
</aside>
