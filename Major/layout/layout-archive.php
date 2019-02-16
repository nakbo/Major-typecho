<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need(Major::$commonDir.'/layout-header.php'); ?>
<?php $this->need(Major::$commonDir.'/layout-head.php'); ?>

<div class="major-3 object" id="main" role="main">
    <?php include 'res/layout-list.php'; //映入统一文章列表 ?>
</div>

<script>
    var newToast = new Array();
    newToast[0] = "<?php $this->archiveTitle(array(
        'category'  =>  _t('分类 %s'),
        'search'    =>  _t('包含关键字 %s'),
        'tag'       =>  _t('标签 %s'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ''); ?>";
    newToast[1] = "<?php $this->archiveTitle(array(
        'category'  =>  _t('分类 %s 下的文章'),
        'search'    =>  _t('包含关键字 %s 的文章'),
        'tag'       =>  _t('标签 %s 下的文章'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ''); ?>";
    listAble = <?php if ($this->have()){ echo "true"; }else{ echo "false"; }; ?>;

    switch (listAble) {
        case true:
            $.Toast(newToast[0], newToast[1], "notice", {
                has_icon:true,
                has_close_btn:true,
                fullscreen:false,
                timeout:0,
                sticky:false,
                has_progress:true,
                rtl:false
            });
            break;
        default:
    }

</script>

<?php $this->need(Major::$commonDir.'/layout-footer.php'); ?>
