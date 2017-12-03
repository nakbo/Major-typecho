<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php include 'res/reward.php'; ?>

<div class="footer-to">
    <ul class="ft-nav">
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php while($pages->next()): ?>
            <li class="ft-to-1 <?php if($this->is('page', $pages->slug)): ?>active<?php endif; ?>">
                <a data-hover="<?php $pages->title(); ?>" href="<?php $pages->permalink(); ?>"><span><?php $pages->title(); ?></span></a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<div class="footer-top">
    <div class="social">
        <ul class="social-nav" id="social-nav"></ul>
        <script type="text/javascript">
            function socialJson() {
                var socialJson=[<?php $this->options->socialJson(); ?>];
                var social = "";
                for(var o in socialJson){
                    social=social+'<li class=\"social_'+socialJson[o].s+'\"><a href=\"'+socialJson[o].u+'\"><svg class=\"icon\" aria-hidden=\"true\"><use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-'+socialJson[o].s+'\"></use></svg></a></li>';
                }
                document.getElementById("social-nav").innerHTML=social;
            }
            socialJson();
        </script>
    </div>
</div>

<footer class="footer text-muted" role="contentinfo">
    <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="svg-bomm">
        <path class="small left" d="M0 0 L50 0 L0 33.3" fill="rgb(238, 238, 238)"></path>
        <path class="small right" d="M100 0 L50 0 L100 33.3" fill="rgb(238, 238, 238)"></path>
        <path d="M0 0 L50 50 L100 0 L0 0" fill="rgb(238, 238, 238)"></path>
    </svg>
    <div>
        <div class="container">
            <div class="footer-t">
                <p><?php $this->options->leftright();?></p>
                <p>Powered by <a href="http://typecho.org" target="_blank">Typecho</a> • Theme <a href="https://github.com/kraity/Major" rel="nofollow" target="_blank">Major</a></p>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    $(function(){
        $('body').running();
    })
</script>

<script type="text/javascript" src="<?php $this->options->themeUrl(); ?>js/mp.mansory.min.js" data-no-instant></script>
<script type="text/javascript">
    function majorsMpmansory(){
        $("#major-posts").mpmansory({
            childrenClass: 'majors-post',
            columnClasses: 'major-post',
            breakpoints: {
                lg: 6,
                md: 6,
                sm: 6,
                xs: 12
            },
            distributeBy: {
                order: false,
                height: false,
                attr: 'data-order',
                attrOrder: 'asc'
            },
            onload: function(items) {
            }
        });
    }
    majorsMpmansory();
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
        console.log('\n %c Major author 那他 <https://krait.cn>  %c 新Major v<?php echo majorv; ?> \n\n','color:rgb(255, 255, 255);background:rgb(50, 190, 166);padding:5px 0;border-radius:3px 0 0 3px;', 'color:rgb(255, 255, 255);background:rgb(0, 0, 0);padding:5px 0;border-radius:0 3px 3px 0;');
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
        }
        majorsMtheme();
        majorsMenu();
        majorsMpmansory();
        majorsMsvg();
        liveTimeGo();
    });
    InstantClick.init('mousedown');
</script>

</body>
</html>