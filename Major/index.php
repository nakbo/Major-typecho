<?php
/**
 * 新Major 科创出品,原创主题,采用兼容性开发!
 * 
 * @package Major
 * @author 权那他
 * @version 2.1
 * @link https://krait.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); 
?>

<?php $this->need('Major.php'); ?>

<div class="major-3 object" id="main" role="main">
    <?php include 'res/articleList.php'; //映入统一文章列表 ?>
</div>

<?php $this->need('footer.php'); ?>
