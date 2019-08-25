<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="major-menu-bar">
    <div class="major-mdui-menu">
        <button mdui-menu="{target: '#menu-drawer'}" class="mdui-btn mdui-btn-icon mdui-ripple">
            <i class="mdui-icon material-icons">menu</i>
        </button>
        <ul class="mdui-menu" id="menu-drawer">
            <li>
                <a class="mdui-list-item mdui-ripple" href="<?php $this->options->siteUrl(); ?>">首页</a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <li>
                    <a class="mdui-list-item mdui-ripple <?php if($this->is('page', $pages->slug)): ?>mdui-list-item-active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<?php switch ($krait->footerInfoAble($this->_currentPage)): case true : ?>
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer-t">
            <p><?php $this->options->viceLeftright();?></p>
            <p><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=50022702000383">渝公网安备 50022702000383号</a></p>
            <!-- 好歹也给作者权那他留个版权啊 -->
            <p><?php $this->options->leftright();?>, The theme <a href="<?php _e($krait->Major['github']);?>" rel="nofollow" target="_blank">Major</a></p>
        </div>
    </div>
</footer>
<?php default: endswitch;?>

<?php $this->options->footerCode(); $krait->reflectGlobalFooterScript(); $this->footer(); ?>
<script type="text/javascript">repeated(); $(document).ready(function() {$().UItoTop();});</script>

</body>
</html>