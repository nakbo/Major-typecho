<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- start Major -->
<div class="major-grids">
    <div id="major">
        <div class="major-main <?php $this->options->lightAble(); ?>">
            <div class="major-1 major-mat" data-rippleria>
                <div class="major-A0" id="major-A0" data-mata0="<?php $this->options->majorA0(); ?>"></div>
                <div class="major-A3"></div>
                <div class="major-A1"></div>
                <div class="major-A2"></div>
                <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="major-svgMountain">
                    <path d="M50 100 L97 50 L100 100 L0 100"></path>
                    <path d="M70 100 L88 0 L99 100 L0 100"></path>
                    <path d="M60 100 L70 50 L100 100 L0 100"></path>
                </svg>
                <script>
                    var AAble = eval('<?php echo json_encode($this->options->matAAble);?>');
                    for(var i in AAble){
                        $(".major-"+AAble[i]).addClass(AAble[i]+"Able");
                    }
                    var MatA0 = $("#major-A0").data("mata0");
                    if (MatA0) {
                        $("#major-A0").css({
                            "background": "url("+MatA0+")",
                            "background-position": "center center",
                            "background-repeat": "no-repeat",
                            "background-size": "cover"
                        });
                    }
                </script>
            </div>

            <div class="major-menu-bar">
                <button id="menu-toggle" class="mdui-btn mdui-btn-icon mdui-ripple">
                    <i class="mdui-icon material-icons">menu</i>
                </button>
            </div>

            <div class="major-t1 scroll-view-t1">
                <div class="scroll-view">
                </div>
            </div>

            <div class="major-menu-icon">
                <div class="show-social">
                    <ul class="social-nav" id="social-nav"></ul>
                </div>
                <script type="text/javascript">
                    function socialJsonTr() {
                        var socialJson=[<?php $this->options->socialJson(); ?>];var social = "";
                        for(var o in socialJson){
                            var code;
                            var goLink = '<a href=\"'+socialJson[o].u+'\" class=\"sola_'+socialJson[o].s+'\">';
                            var goLinks = '</a>';
                            switch (socialJson[o].s) {
                                case "weixin":
                                    code = '<ul class="mdui-menu social-box" id="social-'+socialJson[o].s+'">'+socialJson[o].content+'</ul>';
                                    goLink ='';
                                    goLinks ='';
                                    break;

                                default :
                                    if(typeof socialJson[o].content !== 'undefined'){
                                        code = '<ul class="mdui-menu social-box" id="social-'+socialJson[o].s+'">'+socialJson[o].content+'</ul>';;
                                        goLink ='';
                                        goLinks ='';
                                    }else{
                                        code = "";
                                    }
                            }

                            social = social+
                                '<li class=\"social_'+socialJson[o].s+'\" data-no-instant>' +
                                '<button class=\"mdui-textfield-icon mdui-btn mdui-btn-icon" mdui-menu=\"{target: \'#social-'+socialJson[o].s+'\'}">' + goLink+ '<i class=\"icon iconfont icon-'+socialJson[o].s+'\"></i>' + goLinks +
                                '</button>' + code +
                                '</li>';
                        }
                        document.getElementById("social-nav").innerHTML=social;
                    }
                    socialJsonTr();
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
            <div class="major-t1 major-personal">
                <div class="major-master">
                    <img src="<?php echo Major::getGravatar(Major::$mail); ?>" />
                </div>
                <h3 id="major-bloggerName"><?php echo Major::$screenName; ?></h3>
                <p><?php $this->options->bloggerGx(); ?></p>
                <!--a class="trigger nectar-button" href="#main">查看笔记</a-->
            </div>
        </div>
    </div>
</div>
<!-- ends Major -->

<script type="text/javascript">
    function scrollMajor(){
        var classScroll = document.getElementById('major-grid');
        var newSwitch = <?php if($this->is('index') && $this->_currentPage<2){ echo "true";} else{ echo "false";}?>;
        if(newSwitch) {
            classScroll.classList.add("grid-top");
            classScroll.classList.add("major-home");
            $(document).scroll(function(){
                var reveal = false;
                if ($(document).scrollTop() >= 1) reveal = true;
                if (reveal && document.body.offsetWidth > 1500) {
                    classScroll.classList.add("modify");
                    classScroll.classList.remove("grid-top");
                }
                else {
                    classScroll.classList.remove("modify");
                    classScroll.classList.add("grid-top");
                }
            });
        }else{
            classScroll.classList.add("modify");
            classScroll.classList.remove("major-home");
        }
    }
    scrollMajor();
</script>

<?php if($this->is('index') && $this->_currentPage>1):?>
<div class="post-header">
    <div class="post-head">
        <div class="back">
            <button onclick="window.history.back();return false;" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
        </div>
        <div class="container">
            <div class="title">
                <h1><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->options->title(); ?></h1>
            </div>
        </div>
    </div>
    <div class="post-head-row">
        <div class="container">
            <h5 class="subtitle">
                <span><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页'; ?></span>
            </h5>
        </div>
    </div>
</div>
<?php else:?>
<div class="dossier">
    <div class="container">
        <div class="dossier-box">
            <ul class="dossier-count">
                <li><?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?><?php $stat->publishedPostsNum() ?></li>
                <li><?php $stat->publishedCommentsNum() ?></li>
                <li><?php majors_Plugin::sumViews(); ?></li>
            </ul>
            <ul class="dossier-target">
                <li>作品</li>
                <li>评论</li>
                <li>围观</li>
            </ul>
        </div>
    </div>
</div>
<?php endif;?>

<!-- start Major mdui-drawer -->
<div class="major-mdui-drawer">
    <div class="mdui-drawer mdui-drawer-close mdui-shadow-1" id="menu-drawer">
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple" onclick="javascript:linkGo('<?php $this->options->siteUrl(); ?>')">
                <div class="mdui-list-item-content">首页</div>
            </li>
            <li class="mdui-list-item mdui-ripple dropdown">
                <div class="mdui-list-item ripple-effect dropdown-toggle" data-toggle="dropdown">
                    <div class="mdui-list-item-content">归档 <b class="caret"></b></div>
                </div>
                <ul class="dropdown-menu">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
                </ul>
            </li>
            <li class="mdui-list-item mdui-ripple dropdown">
                <div class="mdui-list-item ripple-effect dropdown-toggle" data-toggle="dropdown">
                    <div class="mdui-list-item-content">分类 <b class="caret"></b></div>
                </div>
                <ul class="dropdown-menu">
                    <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}" title="{description}">{name} <span class="dropdown-menu-count">{count}</span></a></li>'); ?>
                </ul>
            </li>
            <li class="mdui-divider"></li>

            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <li>
                    <a class="mdui-list-item mdui-ripple <?php if($this->is('page', $pages->slug)): ?>mdui-list-item-active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                </li>
            <?php endwhile; ?>

        </ul>
    </div>
    <script>
        //document.getElementById("drawer-masterName").innerHTML= window.bzName;
        var inst = new mdui.Drawer('#menu-drawer', {overlay: true, swipe: true});
        $("#menu-toggle").click(function(){
            inst.toggle();
        });
        $(".major-mdui-drawer-close").click(function(){
            inst.toggle();
        });
        function linkGo(l){
            window.location.href=l;
        }
    </script>
</div>
<!-- ends Major mdui-drawer -->

<div id="rewards">
    <div class="rewards" >
        <div class="reward-com">
            <div class="reward-comint">
                <h3 class="reward-title"><span class="reward-urd">加载中...</span></h3>
                <div class="reward-ud">
                    <div class="reward-intor">
                        <a class="reward-imx"><img class="reward-hg"></a>
                        <p class="reward-ue">加载中...</p>
                        <img class="reward-code">
                    </div>
                </div>
                <div class="reward-pt">
                    <p class="reward-paybox">
                        <span class="reward-paywar">打赏无悔，概不退款</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function rewardLoad() {
        var rewardJson = [<?php $this->options->rewardJson(); ?>];
        var reward = rewardJson[0];
        document.getElementsByClassName('reward-urd')[0].innerHTML="给"+reward.name+"打赏";
        document.getElementsByClassName('reward-hg')[0].style.src = reward.uImg;
        $(".reward-hg").attr("src",reward.uImg);
        document.getElementsByClassName('reward-ue')[0].innerHTML="收款人:"+reward.name;
        $(".reward-code").attr("src",reward.codeImg);
    }
    rewardLoad();
</script>


