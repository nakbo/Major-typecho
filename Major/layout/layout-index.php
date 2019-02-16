<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need(Major::$commonDir.'/layout-header.php');
?>

<?php $this->need(Major::$commonDir.'/layout-Major.php'); ?>

<div class="major-3 object" id="main" role="main">
    <?php include 'res/layout-list.php'; //映入统一文章列表 ?>
</div>

<?php $this->need(Major::$commonDir.'/layout-footer.php'); ?>
