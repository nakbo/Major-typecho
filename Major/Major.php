<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- start Major -->
<div id="major">
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
<!-- ends Major -->

<?php if($this->is('index') && $this->_currentPage>1):?>
<div class="post-header">
    <div class="post-head">
        <div class="back">
            <button onclick="historyBack();" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
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
    <style>
        #major{
            display: none!important;
        }
    </style>
<?php else:?>
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
