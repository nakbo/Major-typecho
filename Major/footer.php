<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php include 'res/reward.php'; ?>

<div class="major-about rippleria-dark" data-rippleria>
    <div class="container">
        <div class="about-infor" id="about-infor">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <div class="about-x count" id="sumPostClick">
                <h3><span class="animateNum" id="sumPost" data-animatetarget="<?php $stat->publishedPostsNum() ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x count" id="sumComClick">
                <h3><span class="animateNum" id="sumCom" data-animatetarget="<?php $stat->publishedCommentsNum() ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x count" id="sumViewClick">
                <h3><span class="animateNum" id="sumView" data-animatetarget="<?php majors_Plugin::sumViews(); ?>"></span></h3>
                <i></i>
            </div>
            <div class="about-x namets">作文</div>
            <div class="about-x namets">吐槽</div>
            <div class="about-x namets">围观</div>
        </div>
    </div>
</div>
<script>
    var $$ = mdui.JQ;
    function infoSum(c,m) {
        $$(c).on('click', function () {
            mdui.snackbar({
                message: m
            });
        });
    }
    infoSum('#sumPostClick','本站的文章数:'+$("#sumPost").data("animatetarget"));
    infoSum('#sumComClick','本站的评论数:'+$("#sumCom").data("animatetarget"));
    infoSum('#sumViewClick','本站的浏览数:'+$("#sumView").data("animatetarget"));
</script>

<footer class="footer" role="contentinfo">
    <div>
        <div class="container">
            <div class="footer-t">
                <p><?php $this->options->viceLeftright();?></p>
                <p><?php $this->options->leftright();?> , Powered by <a href="http://typecho.org" target="_blank">Typecho</a> , Theme <a href="https://github.com/kraity/Major" rel="nofollow" target="_blank">Major</a></p>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    $(function(){
        $('body').running();
    });
    /*$(function () { $("[data-toggle='tooltip']").tooltip(); });*/
</script>

<script>
    function randInt(min, max) {
        var rand = min + Math.random() * (max - min);
        rand = Math.round(rand);
        return rand;
    }
    $('#major').click(function(e) {
        $(this).rippleria('changeColor','rgba('+randInt(0,255)+','+randInt(0,255)+','+randInt(0,255)+',0.'+randInt(3,5));
    });
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
                'error': '未知的时间',
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

<script  data-no-instant>
    function majorMlog(){
        console.log('\n %c Theme Major by 权那他 <https://krait.cn>  %c 版本 v<?php echo Major::$Major[2]; ?> \n\n','color:rgb(255, 255, 255);background:rgb(50, 190, 166);padding:5px 0;border-radius:3px 0 0 3px;', 'color:rgb(255, 255, 255);background:rgb(0, 0, 0);padding:5px 0;border-radius:0 3px 3px 0;');
    }
    majorMlog();
</script>

<script src="<?php $this->options->themeUrl("js/theme.js?v="); echo Major::$Major[2] ?>" data-no-instant></script>
<script type="text/javascript">$(document).ready(function() {$().UItoTop();});</script>
<script src="//cdn.bootcss.com/instantclick/3.0.0/instantclick.min.js" data-no-instant></script>
<script data-no-instant>
    InstantClick.on('change', function(isInitialLoad) {
        if (isInitialLoad === false) {
            if (typeof MathJax !== 'undefined') {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            }
            if (typeof Prism !== 'undefined') {
                var pres = document.getElementsByTagName('pre');
                for (var i = 0; i < pres.length; i++){
                    if (pres[i].getElementsByTagName('code').length > 0)
                        pres[i].className  = 'line-numbers';
                }
                Prism.highlightAll(true,null);
            }
            if(typeof tocs === "function") {
                tocs();
            }

            if (typeof _hmt !== 'undefined'){
                _hmt.push(['_trackPageview', location.pathname + location.search]);
            }

        }
        majorsMtheme();
        liveTimeGo();
        if(typeof tocs === "function") {
            tocs();
        }
    });
    InstantClick.init('mousedown');
</script>

</body>
</html>