<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- start Major -->
<div class="major">
    <div id="major" class="mdui-color-theme">
        <div class="major-main <?php $this->options->lightAble(); ?>">
            <div class="major-1 major-mat">
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
                    var AAble = window.personal.AAble;
                    for(var i in AAble){
                        $(".major-"+AAble[i]).addClass(AAble[i]+"Able");
                    }
                    var MatA0 = $("#major-A0").data("mata0");
                    if (MatA0) {
                        $("#major-A0").css({
                            "background":"url("+MatA0+") 50% 50% no-repeat",
                            "background-size":"cover",
                            "-webkit-background-size":"cover",
                            "-moz-background-size":"cover",
                            "-o-background-size":"cover"
                        });
                    }
                </script>
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
                        var social = "",
                            socialJson = window.personal.socialJson;
                        for(var o in socialJson){
                            var code,
                                goLink = '<a href=\"'+socialJson[o].u+'\" class=\"sola_'+socialJson[o].s+'\">',
                                goLinks = '</a>';
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
                    try {
                        document.getElementsByClassName("sola_weibo")[0].setAttribute("data-vbtype","iframe");
                        $(document).ready(function(){
                            $('.sola_weibo').venobox({
                                framewidth: '90%',
                                frameheight: '100vh',
                                border: '0'
                            });
                        });
                    } catch(err) {
                        console.log("Execution of venobox framework error")
                    }
                </script>
            </div>

        </div>
    </div>
    <div class="major-mats major-personal">
        <div class="majorMaster">
            <div class="major-master">
                <img src="<?php echo Major::getGravatar(Major::$mail); ?>" />
            </div>
            <h4 id="major-bloggerName"><?php Major::prints(Major::$screenName); ?></h4>
        </div>
        <div class="major-master-Gx">
            <p><?php $this->options->bloggerGx(); ?></p>
        </div>
    </div>
    <div class="dossier">
        <div class="container">
            <div class="dossier-box">
                <ul class="dossier-count">
                    <li id="publishedPostsNum"></li>
                    <li id="publishedCommentsNum"></li>
                    <li id="sumViews"></li>
                </ul>
                <ul class="dossier-target">
                    <li id="publishedPostsNumName"></li>
                    <li id="publishedCommentsNumName"></li>
                    <li id="sumViewsName"></li>
                </ul>
            </div>
            <script>
                function dossier() {
                    var array = [
                        ["sumViews",window.personal.sumViews],
                        ["publishedPostsNum",window.personal.publishedPostsNum],
                        ["publishedCommentsNum",window.personal.publishedCommentsNum],
                        ["sumViewsName","围观"],
                        ["publishedPostsNumName","作品"],
                        ["publishedCommentsNumName","评论"]
                    ];
                    for(var i in array){
                        document.getElementById(array[i][0]).innerHTML = array[i][1];
                    }
                }
                dossier();
            </script>
        </div>
    </div>
</div>
<!-- ends Major -->

<?php switch (Major::majorHeaderAble($this->_currentPage)): case true : ?>
<!-- start Major mdui-drawer -->
<div class="major-menu-bar">
    <div class="major-mdui-menu">
        <button mdui-menu="{target: '#menu-drawer'}" class="mdui-btn mdui-btn-icon mdui-ripple">
            <i class="mdui-icon material-icons">menu</i>
        </button>
        <ul class="mdui-menu" id="menu-drawer">
            <li>
                <a class="mdui-list-item mdui-ripple" href="<?php $this->options->siteUrl(); ?>">首页</a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <li>
                    <a class="mdui-list-item mdui-ripple <?php if($this->is('page', $pages->slug)): ?>mdui-list-item-active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<!-- ends Major mdui-drawer -->

<?php break; case false :?>
<div class="post-header">
    <div class="post-head mdui-color-theme">
        <div class="back">
            <button onclick="historyBack();" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
        </div>
        <div class="container">
            <div class="title">
                <h1><?php Major::prints('第 '.$this->_currentPage.' 页 - '); ?><?php $this->options->title(); ?></h1>
            </div>
        </div>
    </div>
    <div class="post-head-row">
        <div class="container">
            <h5 class="subtitle">
                <span><?php Major::prints('第 '.$this->_currentPage.' 页'); ?></span>
            </h5>
        </div>
    </div>
</div>
    <style>
        .major{
            display: none!important;
        }
    </style>
<?php default: endswitch; ?>