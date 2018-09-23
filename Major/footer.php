<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>


<?php if($this->is('index') && $this->_currentPage<2): ?>
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer-t">
            <p><?php $this->options->viceLeftright();?></p>
            <p><?php $this->options->leftright();?> Theme by <a href="https://github.com/kraity/Major" rel="nofollow" target="_blank">Major</a></p>
        </div>
    </div>
</footer>
<?php endif;?>

<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?6d3d115df85637717aa5fe02b515b250";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

<script type="text/javascript" src="<?php $this->options->themeUrl("vendors/liveTimeAgo/jquery.liveTimeAgo.js"); ?>"></script>
<script type="text/javascript">
    function liveTimeGo() {
        $('.liveTime').liveTimeAgo({
            translate: {
                'year': '% 年前',
                'years': '% 年前',
                'month':'% 个月前',
                'months':'% 个月前',
                'day': '% 天前',
                'days': '% 天前',
                'hour': '% 小时前',
                'hours': '% 小时前',
                'minute': '% 分钟前',
                'minutes': '% 分钟前',
                'seconds': '几秒钟前',
                'error': '几秒钟前',
            }
        });
    }
    liveTimeGo();
</script>

<script src="<?php $this->options->themeUrl("vendors/zoomify/zoomify.min.js"); ?>"></script>
<script type="text/javascript">
    $('.majors-post-articles img').zoomify();
</script>

<?php $this->footer(); ?>

<?php if (!empty($this->options->useBlock) && in_array('usePangu', $this->options->useBlock)): ?>
    <script src="//cdn.bootcss.com/pangu/3.3.0/pangu.min.js"></script>
    <script>pangu.spacingElementByClassName('content-wrap'); /*英文间加上空格*/</script>
<?php endif; ?>

<script  data-no-instant>
    function majorMlog(){
        console.log('\n %c Theme Major by 权那他 <https://krait.cn>  %c 版本 v<?php echo Major::$Major['version']; ?> \n\n','color:rgb(255, 255, 255);background:rgb(50, 190, 166);padding:5px 0;border-radius:3px 0 0 3px;', 'color:rgb(255, 255, 255);background:rgb(0, 0, 0);padding:5px 0;border-radius:0 3px 3px 0;');
    }
    majorMlog();
</script>

<script src="<?php $this->options->themeUrl("js/theme.js?v="); echo Major::$Major['version']; ?>" data-no-instant></script>
<script type="text/javascript">$(document).ready(function() {$().UItoTop();});</script>
<script src="//cdn.bootcss.com/instantclick/3.0.1/instantclick.min.js" data-no-instant></script>
<script data-no-instant>
    /*InstantClick.on('wait', function(){

    });*/
    InstantClick.on('change', function(isInitialLoad) {
        if (isInitialLoad === false) {
            if (typeof MathJax !== 'undefined') {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            }
            if (typeof Prism !== 'undefined') {
                Prism.highlightAll(true,null);
            }
            if (typeof _hmt !== 'undefined'){
                _hmt.push(['_trackPageview', location.pathname + location.search]);
            }
        }
        if (typeof RGBiamge !== 'undefined'){
            RGBiamge();
        }
        majorsMtheme();
        liveTimeGo();

    });
    InstantClick.init('mousedown');
</script>

</body>
</html>