<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<!--Footer-->
<footer class="footer text-muted">
    <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="svg-bomm">
        <path class="small left" d="M0 0 L50 0 L0 33.3" fill="rgb(255,255,255)"></path>
        <path class="small right" d="M100 0 L50 0 L100 33.3" fill="rgb(255,255,255)"></path>
        <path d="M0 0 L50 50 L100 0 L0 0" fill="rgba(255,255,255, 1)"></path>
    </svg>
    <div class="container">
        <p><?php $this->options->leftright();?> • Powered by <a href="http://typecho.org" target="_blank">Typecho</a> • Major made by <a href="https://github.com/kraity" rel="nofollow" target="_blank">那他</a></p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pangu/3.2.1/pangu.min.js"></script>
<script>pangu.spacingElementByClassName('content-wrap'); /*英文间加上空格*/</script>

<?php $this->footer(); ?>

<script src="<?php $this->options->themeUrl(); ?>vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php $this->options->themeUrl(); ?>vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php $this->options->themeUrl(); ?>vendors/imagesLoaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php $this->options->themeUrl(); ?>vendors/isotope/isotope.pkgd.min.js"></script>
<script src="<?php $this->options->themeUrl(); ?>js/theme.js"></script>
<script type="text/javascript">$(document).ready(function() {$().UItoTop();});</script>
</body>
</html>
