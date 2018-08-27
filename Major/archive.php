<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="post-header">
    <div class="post-head">
        <div class="back">
            <button onclick="window.history.back();return false;" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
        </div>
        <div class="container">
            <div class="title">
                <h1><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->archiveTitle(array(
                        'category'  =>  _t('分类 %s'),
                        'search'    =>  _t('包含关键字 %s'),
                        'tag'       =>  _t('标签 %s'),
                        'author'    =>  _t('%s 发布的文章')
                    ), '', ''); ?></h1>
            </div>
        </div>
    </div>
    <div class="post-head-row">
        <div class="container">
            <h5 class="subtitle">
                <span><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?></span>
            </h5>
        </div>
    </div>
</div>

<div class="major-3 object" id="main" role="main">
    <?php include 'res/articleList.php'; //映入统一文章列表 ?>
</div>

<script>
    var articleListHave = false;
    articleListHave = "<?php if ($this->have()){ echo "true"; }; ?>";
    if(articleListHave){
        $.Toast("<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s'),
            'search'    =>  _t('包含关键字 %s'),
            'tag'       =>  _t('标签 %s'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?>", "<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?>", "notice", {
            has_icon:true,
            has_close_btn:true,
            fullscreen:false,
            timeout:0,
            sticky:false,
            has_progress:true,
            rtl:false
        });
    }
</script>

<?php $this->need('footer.php'); ?>
