<?php
/**
 * 新Major 科创出品,原创主题,采用兼容性开发!
 * 
 * @package Major
 * @author 那他
 * @version 1.4
 * @link https://krait.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); 
?>


<?php if($this->is('index') && $this->_currentPage==1 && $this->options->messages): //判断是否为首页且是第一页，输出message内容?>
<div class="major-2">
    <div class="message-list">
        <article class="messages" itemscope="" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
            <div class="messages-inner">
                <div class="messa-title" itemprop="description">
                    <div datetime="">
                        <?php $this->options->messages(); ?>
                    </div>
                </div>
                <footer class="mess-foot">
                    <a class="mess-ico" href="">
                        <svg class="icon" aria-hidden="true">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-weixin"></use>
                        </svg>
                        <span>状态</span>
                    </a>
                    <span class="mess-span"> / </span>
                </footer>
                <hr>
            </div>
        </article>
    </div>
</div>
<?php endif; //message ?>

<?php include 'lister.php'; //映入统一文章列表 ?>

<?php $this->need('footer.php'); ?>
