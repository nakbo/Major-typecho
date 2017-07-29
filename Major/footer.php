<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer class="footer text-muted" role="contentinfo">
    <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="svg-bomm">
        <path class="small left" d="M0 0 L50 0 L0 33.3" fill="rgb(238, 238, 238)"></path>
        <path class="small right" d="M100 0 L50 0 L100 33.3" fill="rgb(238, 238, 238)"></path>
        <path d="M0 0 L50 50 L100 0 L0 0" fill="rgb(238, 238, 238)"></path>
    </svg>
    <div>
    <div class="container">
        <div class="footer-t">
           <p><?php $this->options->leftright();?> • Powered by <a href="http://typecho.org" target="_blank">Typecho</a> • Major made by <a href="https://github.com/kraity" rel="nofollow" target="_blank">那他</a></p>
        </div>
    </div>
    </div>
</footer>

<?php if (!empty($this->options->useBlock) && in_array('useAnchorHover', $this->options->useBlock)): ?>
<script src="<?php $this->options->themeUrl(); ?>vendors/anchorHover/anchorHoverEffect.js"></script>
<script>
    $(".posts-meta a,.keywords a,.author-users-name a").anchorHoverEffect();
    $(".meuns-header a").anchorHoverEffect({type: 'brackets'});
    $(".major-t1-title a").anchorHoverEffect({type: 'flip'});
    $(".response a,.post-content a,.footer-t a").anchorHoverEffect({type: 'borderBottom'});
</script>
<?php endif; ?>

<?php $this->footer(); ?>

<?php if (!empty($this->options->useBlock) && in_array('usePangu', $this->options->useBlock)): ?>
<script src="https://cdn.bootcss.com/pangu/3.3.0/pangu.min.js"></script>
<script>pangu.spacingElementByClassName('content-wrap'); /*英文间加上空格*/</script>
<?php endif; ?>


<?php if ($this->options->useMathjax == 'able'): ?>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({
    showProcessingMessages: false,
    messageStyle: "none",
    extensions: ["tex2jax.js"],
    jax: ["input/TeX", "output/HTML-CSS"],
    tex2jax: {
        inlineMath: [ ['$','$'], ["\\(","\\)"] ],
        displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre','code','a'],
        ignoreClass:"comment-content"
    },
    "HTML-CSS": {
        availableFonts: ["STIX","TeX"],
        showMathMenu: false
    }
});
MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
</script>
<script src="//cdn.bootcss.com/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<?php endif; ?>

<script>
console.log('\n %c Major author 那他 <https://krait.cn>  %c 新Major v<?php echo majorv; ?> \n\n','color:rgb(255, 255, 255);background:rgb(50, 190, 166);padding:5px 0;border-radius:3px 0 0 3px;', 'color:rgb(255, 255, 255);background:rgb(0, 0, 0);padding:5px 0;border-radius:0 3px 3px 0;');
</script>

<?php if (!empty($this->options->useBlock) && in_array('useWow', $this->options->useBlock)): ?>
<script type="text/javascript" src="https://cdn.bootcss.com/wow/1.0.2/wow.min.js"></script>
<script type="text/javascript">
    new WOW().init();
</script>
<?php endif; ?>


<script src="//cdn.bootcss.com/fastclick/1.0.6/fastclick.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        FastClick.attach(document.body);
    }, false);
</script>
<script type='application/javascript'>
    window.addEventListener('load', function() {
        new FastClick(document.body);
    }, false);
</script>
<script src="<?php $this->options->themeUrl(); ?>js/theme.js"></script>
<script type="text/javascript">$(document).ready(function() {$().UItoTop();});</script>

</body>
</html>