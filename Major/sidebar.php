<?php if (!defined( '__TYPECHO_ROOT_DIR__')) exit; ?>

<aside class="widget widget-w">
    <div class="widget-w-inner">
        <div class="widget-w-title">近期文章</div>
        <div class="widget-w-text">

            <?php $this->widget('Widget_Contents_Post_Recent')->parse('
                    <li class="rippleria-dark" data-rippleria><a href="{permalink}">{title}</a></li>'); ?>

        </div>
    </div>
</aside>

<aside class="widget widget-w">
    <div class="widget-w-inner">
        <div class="widget-w-title">分类</div>
        <div class="widget-w-text">
            <?php $this->widget('Widget_Metas_Category_List')->parse('
             <li class="rippleria-dark" data-rippleria><a href="{permalink}" title="{description}">{name}</a> ({count})</li>'); ?>
        </div>
    </div>
</aside>
