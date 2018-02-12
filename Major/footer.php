<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php include 'res/reward.php'; ?>

<div class="footer-top">
    <div class="social">
        <!--div class="footer-topsvg">
            <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 L10 50 L100 100 L0 100" fill="rgb(95, 66, 135)"></path>
                <path d="M10 100 L35 0 L70 100 L0 100" fill="rgb(95, 66, 135)"></path>
                <path d="M0 100 L70 50 L70 100 L0 100" fill="rgb(95, 66, 135)"></path>
            </svg>
        </div-->
        <ul class="social-nav" id="social-nav"></ul>
        <script type="text/javascript">
            function socialJson() {
                var socialJson=[<?php $this->options->socialJson(); ?>];
                var social = "";
                for(var o in socialJson){
                    social=social+'<li class=\"social_'+socialJson[o].s+'\" data-no-instant><a href=\"'+socialJson[o].u+'\" class=\"sola_'+socialJson[o].s+'\"><svg class=\"icon\" aria-hidden=\"true\"><use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-'+socialJson[o].s+'\"></use></svg></a></li>';
                }
                document.getElementById("social-nav").innerHTML=social;
            }
            socialJson();
            document.getElementsByClassName("sola_weibo")[0].setAttribute("data-vbtype","iframe");
            $(document).ready(function(){
                $('.sola_weibo').venobox({
                    framewidth: '90%',
                    frameheight: '100vh',
                    border: '0'
                });
            });
        </script>
    </div>
</div>

<footer class="footer text-muted" role="contentinfo">
    <!--svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="svg-bomm">
        <path class="small left" d="M0 0 L50 0 L0 33.3" fill="rgb(238, 238, 238)"></path>
        <path class="small right" d="M100 0 L50 0 L100 33.3" fill="rgb(238, 238, 238)"></path>
        <path d="M0 0 L50 50 L100 0 L0 0" fill="rgb(238, 238, 238)"></path>
    </svg-->
    <div>
        <div class="container">
            <div class="footer-t">
                <p><a href="https://github.com/kraity/Major" rel="nofollow" target="_blank">Major v<?php echo Major::$majorv; ?></a>, 执行 <a href="https://en.wikipedia.org/wiki/MIT_License" target="_blank">MIT</a> 许可证开源,<a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/"target="_blank">CC BY NC SA 4.0</a> 版权协议。</p>
                <p><?php $this->options->leftright();?> , Powered by <a href="http://typecho.org" target="_blank">Typecho</a> , Theme <a href="https://github.com/kraity/Major" rel="nofollow" target="_blank">Major</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- Matomo -->
<script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//piwik.krait.cn/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '2']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->

<script type="text/javascript">
    $(function(){
        $('body').running();
    });
</script>

<script>
    function randInt(min, max) {
        var rand = min + Math.random() * (max - min);
        rand = Math.round(rand);
        return rand;
    }
    $('#major,.majors-post,.blog-author').click(function(e) {
        $(this).rippleria('changeColor','rgba('+randInt(0,255)+','+randInt(0,255)+','+randInt(0,255)+',0.'+randInt(3,5));
    });
</script>

<script type="text/javascript" src="<?php $this->options->themeUrl(); ?>vendors/liveTimeAgo/jquery.liveTimeAgo.js"></script>
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

<script src="<?php $this->options->themeUrl(); ?>vendors/zoomify/zoomify.min.js"></script>
<script type="text/javascript">
    $('.post-content img').zoomify();
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

<script>
    function majorMlog(){
        console.log('\n %c Theme Major by 权那他 <https://krait.cn>  %c 版本 v<?php echo Major::$majorv; ?> \n\n','color:rgb(255, 255, 255);background:rgb(50, 190, 166);padding:5px 0;border-radius:3px 0 0 3px;', 'color:rgb(255, 255, 255);background:rgb(0, 0, 0);padding:5px 0;border-radius:0 3px 3px 0;');
    }
    majorMlog();
</script>

<script src="<?php $this->options->themeUrl(); ?>js/theme.js"></script>
<script type="text/javascript">$(document).ready(function() {$().UItoTop();});</script>
<script src="https://cdn.bootcss.com/instantclick/3.0.0/instantclick.min.js" data-no-instant></script>
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
        }
        majorsMtheme();
        majorsMenu();
        majorsMsvg();
        liveTimeGo();
        if(typeof tocs === "function") {
            tocs();
        }
    });
    InstantClick.init('mousedown');
</script>

</body>
</html>