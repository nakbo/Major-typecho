<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="major-post-foot">
    <div id="show-foot-tab1">
        <div class="show-foot">
            <ul class="mdui-list mdui-list-dense">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">copyright</i>
                    <div class="mdui-list-item-content">著作权归作者所有</div>
                </li>
            </ul>
        </div>
    </div>
    <div id="show-foot-tab2">
        <div class="show-foot-info">

            <ul class="mdui-list mdui-list-dense">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">person</i>
                    <div class="mdui-list-item-content"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author" class="intro-author"><?php $this->author(); ?></a></div>
                </li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">play_arrow</i>
                    <div class="mdui-list-item-content"><?php majors_Plugin::theViews(); ?> Views</div>
                </li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">create</i>
                    <div class="mdui-list-item-content"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></div>
                </li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">autorenew</i>
                    <div class="mdui-list-item-content">最后修改：<?php echo date('Y 年 m 月 d 日', $this->modified);?></div>
                </li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">local_offer</i>
                    <div class="mdui-list-item-content listCategoryTags"><?php $this->category(''); ?><?php $this->tags('', true, '无标签'); ?></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="mdui-tab" id="foot-post-tab">
        <a href="#show-foot-tab1" class="mdui-ripple"><i class="mdui-icon material-icons">copyright</i></a>
        <a href="#show-foot-tab2" class="mdui-ripple"><i class="mdui-icon material-icons">info_outline</i></a>
    </div>
    <script type="text/javascript">
        var inst = new mdui.Tab('#foot-post-tab');
    </script>
</div>




