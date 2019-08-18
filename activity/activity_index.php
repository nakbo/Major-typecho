<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
include 'activity_main_header.php';
?>

<?php include 'activity_main_Major.php'; ?>

<div class="major-hot">
    <div class="container">
        <div class="hot-container">

        </div>
    </div>
</div>

<div class="major-3 object" id="main" role="main">
    <?php include 'adapter/adapter_list.php';?>
</div>

<?php include 'activity_main_footer.php'; ?>
