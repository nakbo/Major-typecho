<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="author" content="<?php echo Major::personal()['screenName']; ?>,<?php echo Major::personal()['mail']; ?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-CN" />
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="icon" href="/favicon.ico">
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
    <link rel="dns-prefetch" href="<?php Typecho_Widget::widget('Widget_Options')->plugin('majors')->serverGravatar();?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s '),
            'search'    =>  _t('所属关键字 %s '),
            'tag'       =>  _t('所属标签 %s '),
            'author'    =>  _t('%s ')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php $this->header('generator=&commentReply='); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.4.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="<?php $this->options->themeUrl("style.css?v="); echo Major::$Major[2]; ?>" rel="stylesheet" />
    <link href="//cdn.bootcss.com/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php $this->options->socialJsonUrl(); ?>" rel="stylesheet">
    <script src="<?php $this->options->themeUrl("js/jquery-ias.js?v="); echo Major::$Major[2]; ?>" data-no-instant></script>
    <script src="//cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="//cdn.bootcss.com/mdui/0.4.0/js/mdui.min.js"></script>
    <script src="<?php $this->options->themeUrl("js/toast.script.js"); ?>"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl("js/venobox.js"); ?>"></script>
    <script src="//cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script type="text/javascript">
        window.bzName = "<?php echo Major::personal()['screenName']; ?>";
        window.bzRoal = "BLOGGER";
        window.bzMail = "<?php echo Major::personal()['mail']; ?>";
    </script>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">jQuery(document).ready(function($) {$(".scroll").click(function(event){event.preventDefault();$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);});});</script>
</head>
<body class="mdui-loaded">

<!--[if lt IE 8]>
<div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="https://browsehappy.com">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

<!-- start Major -->
<div id="major" data-rippleria>
    <div class="major-main">
        <div class="major-1 major-mat">
            <div class="major-A0" id="major-A0" data-mata0="<?php $this->options->majorA0(); ?>"></div>
            <div class="major-A1"></div>
            <div class="major-A2"></div>
            <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="major-svgMountain svgMountainAble">
                <path d="M50 100 L97 50 L100 100 L0 100"></path>
                <path d="M70 100 L88 0 L99 100 L0 100"></path>
                <path d="M60 100 L70 50 L100 100 L0 100"></path>
            </svg>
            <script>
                var AAble = eval('<?php echo json_encode($this->options->matAAble);?>');
                for(var i in AAble){$(".major-"+AAble[i]).addClass(AAble[i]+"Able");}
                var MatA0 = $("#major-A0").data("mata0");$("#major-A0").css({"background": "url("+MatA0+")", "background-position": "center center", "background-repeat": "no-repeat", "background-size": "cover"});
            </script>
        </div>
        <div class="major-t1 major-tr">
            <div class="container">
                <div class="major-right">
                    <div class="major-master">
                        <div class="master-author">
                            <img id="major-bloggerAvatar" src="<?php echo Major::getGravatar(Major::personal()['mail'],"100",$this->options->masterImgUrl,$this->options->useGravatar); ?>">
                            <span class="master-author-note"></span>
                        </div>
                        <div class="master-info">
                            <div class="info-box">
                                <p class="major-bloggerName info-name" id="major-bloggerName"><?php echo Major::personal()['screenName']; ?></p>
                                <p class="major-bloggerRoal user-roal" id="major-bloggerRoal">BLOGGER</p>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="major-shows">
                        <div class="show-social">
                            <ul class="social-nav" id="social-nav-Tr"></ul>
                        </div>
                        <script type="text/javascript">
                            function socialJsonTr() {
                                var socialJson=[<?php $this->options->socialJson(); ?>];var social = "";
                                for(var o in socialJson){social=social+'<li class=\"social_'+socialJson[o].s+'\" data-no-instant><button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><a href=\"'+socialJson[o].u+'\" class=\"sola_'+socialJson[o].s+'\"><i class=\"icon iconfont icon-'+socialJson[o].s+'\"></i></a></button></li>';}
                                document.getElementById("social-nav-Tr").innerHTML=social;
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
                </div>
            </div>
        </div>
        <div class="major-t1 major-t1n">
            <div class="container">
                <div class="maj-nav">
                    <ul class="maj-ul" role="navigation">
                        <li>
                            <button id="maj-moreUl">
                                <i class="mdui-icon material-icons">&#xe8eb;</i>
                            </button>
                        </li>

                        <div id="maj-morePost" style="display: none">
                            <ul class="maj-morePost">
                                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                                <?php while($pages->next()): ?>
                                    <li class="mdui-menu-item">
                                        <a href="<?php $pages->permalink(); ?>" class="mdui-ripple"><?php $pages->title(); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>

                        <script>
                            $(function (){
                                $("#maj-moreUl").popover({
                                    trigger:"focus", placement:"bottom", container:"body", html:true, content: function() {return $('#maj-morePost').html();}
                                });
                            });
                        </script>
                        <li <?php if($this->is('index')): ?>class="active"<?php endif; ?>>
                            <a class="material-ripple" href="<?php $this->options->siteUrl(); ?>">
                                <span>首页</span></a>
                        </li>
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                            <li <?php if($this->is('page', $pages->slug)): ?>class="active"<?php endif; ?>>
                                <a class="material-ripple" href="<?php $pages->permalink(); ?>">
                                    <span><?php $pages->title(); ?></span></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="major-drawer">
            <div class="mdui-textfield-icon mdui-btn mdui-btn-icon" id="toggle">
                <i class="mdui-icon material-icons">&#xe5d2;</i>
            </div>
        </div>
    </div>
</div>
<!-- ends Major -->

<!-- start Major mdui-drawer -->
<div class="major-mdui-drawer">
    <div class="mdui-drawer mdui-drawer-close mdui-shadow-1" id="drawer">
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple drawer-master">
                <i class="mdui-list-item-icon mdui-icon material-icons">bubble_chart</i>
                <div class="mdui-list-item-content" id="drawer-masterName"></div>
            </li>
            <li class="mdui-list-item mdui-ripple" onclick="javascript:linkGo('<?php $this->options->siteUrl(); ?>')">
                <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                <div class="mdui-list-item-content">主页</div>
            </li>
            <li class="mdui-list-item mdui-ripple dropdown">
                <div class="mdui-list-item ripple-effect dropdown-toggle" data-toggle="dropdown">
                    <i class="mdui-list-item-icon mdui-icon material-icons">view_carousel</i>
                    <div class="mdui-list-item-content">独立页面 <b class="caret"></b></div>
                </div>
                <ul class="dropdown-menu">
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                        <li <?php if($this->is('page', $pages->slug)): ?>class="active"<?php endif; ?>>
                            <a  href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </li>
            <li class="mdui-list-item mdui-ripple dropdown">
                <div class="mdui-list-item ripple-effect dropdown-toggle" data-toggle="dropdown">
                    <i class="mdui-list-item-icon mdui-icon material-icons">apps</i>
                    <div class="mdui-list-item-content">分类 <b class="caret"></b></div>
                </div>
                <ul class="dropdown-menu">
                    <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}" title="{description}">{name} <span class="dropdown-menu-count">{count}</span></a></li>'); ?>
                </ul>
            </li>
            <li class="mdui-subheader">Other</li>
            <li class="mdui-list-item mdui-ripple" onclick="javascript:linkGo('https://github.com/kraity/Major')">
                <div class="mdui-list-item-content">主题 - 新Major</div>
                <i class="mdui-list-item-icon mdui-icon material-icons major-mdui-color-1">error</i>
            </li>
        </ul>
    </div>
    <script>
        document.getElementById("drawer-masterName").innerHTML= window.bzName;
        var inst = new mdui.Drawer('#drawer',{overlay: true});
        $("#toggle").click(function(){inst.toggle();});
        function linkGo(l){window.location.href=l;}
    </script>
</div>
<!-- ends Major mdui-drawer -->

<div class="major-tools">
    <div class="container">
        <ul class="tools-box mdui-float-right">
            <li>
                <button class="mdui-textfield-icon mdui-btn mdui-btn-icon maj-share" id="maj-share">
                    <i class="mdui-icon material-icons">share</i>
                </button>
            </li>
            <li>
                <a href="#rewards" class="mdui-textfield-icon mdui-btn mdui-btn-icon maj-share" id="rewards-me" data-vbtype="inline" data-no-instant>
                    <i class="mdui-icon material-icons">attach_money</i>
                </a>
            </li>
        </ul>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#rewards-me').venobox({
                    framewidth: '380px',
                    frameheight: '100%',
                    border: '0'
                });
            });
        </script>
        <style>
            .tools-box li{
                display:inline;
            }
        </style>
        <div id="maj-share-post" style="display: none">
            <ul class="maj-share-post">
                <li class="mdui-list-item" onclick="javascript:shareGo('weibo')"><a href="javascript:;" class="mdui-ripple">分享到 新浪微博</a></li>
                <li class="mdui-list-item" onclick="javascript:shareGo('qzone')"><a href="javascript:;" class="mdui-ripple">分享到 QQ空间</a></li>
                <li class="mdui-list-item" onclick="javascript:shareGo('facebook')"><a href="javascript:;" class="mdui-ripple">分享到 Facebook</a></li>
                <li class="mdui-list-item" onclick="javascript:shareGo('telegram')"><a href="javascript:;" class="mdui-ripple">分享到 Telegram</a></li>
                <li class="mdui-list-item" onclick="javascript:shareGo('twitter')"><a href="javascript:;" class="mdui-ripple">分享到 Twitter</a></li>
                <li class="mdui-list-item" onclick="javascript:shareGo('google')"><a href="javascript:;" class="mdui-ripple">分享到 Google+</a></li>
            </ul>
        </div>
        <script>
            function shareGo(g) {
                var linkShare=window.location.href;var titleShare=document.title;var screenName=window.bzName;var siteUrl=document.location.protocol+"//"+document.domain;var l=linkShare;
                switch(g){case"weibo":l="http://service.weibo.com/share/share.php?appkey=&title="+titleShare+"&url="+linkShare+"&pic=&searchPic=false&style=simple";break;case"qzone":l="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+linkShare+"&title="+titleShare+"&site="+siteUrl;break;case"facebook":l="https://www.facebook.com/sharer/sharer.php?u="+linkShare;break;case"telegram":l="https://telegram.me/share/url?url="+linkShare+"&text="+titleShare;break;case"twitter":l="https://twitter.com/intent/tweet?text="+titleShare+"&url="+linkShare+"&via="+screenName;break;case"google":l="https://plus.google.com/share?url="+linkShare;break}
                window.open(l);
            }
            $(function (){
                $("#maj-share").popover({
                    trigger:"focus", placement:"bottom", container:"body", html:true, content: function() {return $('#maj-share-post').html();}
                });
            });
        </script>
    </div>
</div>