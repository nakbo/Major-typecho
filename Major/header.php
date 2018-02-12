<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="author" content="Kraity,kraits@qq.com">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-CN" />
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s '),
            'search'    =>  _t('所属关键字 %s '),
            'tag'       =>  _t('所属标签 %s '),
            'author'    =>  _t('%s ')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php $this->header('generator=&commentReply='); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="<?php $this->options->themeUrl("style.css?v="); echo Major::$majorv; ?>" rel="stylesheet" />
    <link href="//cdn.bootcss.com/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <script src="<?php $this->options->themeUrl('js/jquery-ias.js'); ?>"></script>
    <script src="//cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php $this->options->themeUrl(); ?>js/iconfont.js" data-no-instant></script>
    <script src="<?php $this->options->themeUrl(); ?>js/toast.script.js"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl(); ?>js/venobox.js"></script>

    <?php if ($this->is('post')): ?>
        <link rel="amphtml" href="<?php $this->permalink() ?>?amp=1">
    <?php endif; ?>

    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
</head>
<body>

<!--[if lt IE 8]>
<div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="https://browsehappy.com">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

<div class="majors-layer" onclick="toastLayer()"></div>

<script>
    function toastLayer(){
        $.Toast("无效操作!", "error", "error", {
            has_icon:true,
            has_close_btn:true,
            fullscreen:false,
            timeout:9000,
            sticky:false,
            has_progress:true,
            rtl:false
        });
    }
</script>

<div id="major" data-rippleria>
    <div class="major-main">
        <div class="container">
            <div class="majors-logo object">
                <a href="<?php $this->options->siteUrl(); ?>">
                    <div class="logo-head shadow object">
                        <ul>
                            <?php if($this->options->logos): ?>
                                <li>
                                    <img src="<?php $this->options->logos(); ?>" />
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </a>
            </div>
        </div>
        <div class="major-1">
            <div class="major-A0" id="major-A0" data-mata0="<?php $this->options->majorA0(); ?>"></div>
            <div class="major-A1"></div>
            <div class="major-A2"></div>
            <svg version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" class="major-svgm">
                <path d="M0 100 L3 50 L50 100 L0 100" fill="rgb(95, 66, 135)"></path>
                <path d="M1 100 L12 0 L30 100 L0 100" fill="rgb(95, 66, 135)"></path>
                <path d="M0 100 L30 50 L40 100 L0 100" fill="rgb(95, 66, 135)"></path>
                <!--path d="M0 100 L3 99 L40 100 L0 100" fill="rgb(250, 250, 250)"></path-->
            </svg>
            <script>
                var MatA0 = $("#major-A0").data("mata0");
                var MatA0Liner ="to bottom, rgba(53, 52, 154, 0.5), rgba(53, 52, 154, 0.5), rgba(0,0,0,0.5)), ";
                $("#major-A0").css({
                    //"background": "-moz-linear-gradient( "+MatA0Liner+"url("+MatA0+") 50% 50% / cover no-repeat ",
                    //"background": "-webkit-linear-gradient( "+MatA0Liner+"url("+MatA0+") 50% 50% / cover no-repeat ",
                    "background": "linear-gradient( "+MatA0Liner+"url("+MatA0+") 50% 50% / cover no-repeat ",
                    "background-size":"cover",
                    "-webkit-background-size":"cover",
                    "-moz-background-size":"cover",
                    "-o-background-size":"cover"
                });
            </script>
            <style>
                .major-A2{
                    background: #5F4287;
                    background: -moz-linear-gradient(<?php $MatGrad = "135deg, rgb(80, 50, 171) 0%, rgb(102, 64, 218) 13%, rgb(99, 69, 191) 34%,rgb(100, 67, 199) 52%, rgb(93, 46, 169) 74%, rgb(71, 54, 119) 91%, rgb(74, 59, 119) 100%"; echo $MatGrad; ?>);
                    background: -webkit-linear-gradient(<?php echo $MatGrad; ?>);
                    background: linear-gradient(<?php echo $MatGrad; ?>);
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#14c757', endColorstr='#25a7f2', GradientType=1);
                }
            </style>
        </div>
        <div class="major-t1 major-tr">
            <div class="container">
                <div class="major-right">
                    <div class="major-master major-hen">
                        <div class="master-author">
                            <img src="<?php echo Major::getGravatar(Major::personal()[mail],"100",$this->options->masterImgUrl,$this->options->useGravatar); ?>">
                            <span class="master-author-note"></span>
                        </div>
                        <div class="master-info">
                            <div class="info-box">
                                <p class="info-name"><?php echo Major::personal()[screenName]; ?></p>
                                <p class="info-infos">
                                    <a href="mailto:<?php echo Major::personal()[mail]; ?>" class="info-mail"><svg class="icon" aria-hidden="true"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-mail"></use></svg></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="major-shows">
                        <h4>
                            <?php $this->options->quoteLg(); ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="major-t1 major-t1n">
            <div class="container">
                <div class="maj-nav">
                    <ul class="maj-ul" role="navigation">
                        <li <?php if($this->is('index')): ?>class="active"<?php endif; ?>>
                            <a class="material-ripple" data-ripple-color="#2ecc71" href="<?php $this->options->siteUrl(); ?>">
                                <span>首页</span></a>
                        </li>
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                            <li <?php if($this->is('page', $pages->slug)): ?>class="active"<?php endif; ?>>
                                <a class="material-ripple" data-ripple-color="#2ecc71" href="<?php $pages->permalink(); ?>">
                                    <span><?php $pages->title(); ?></span></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="major-na is-visible">
        <div class="major-nabox">
            <ul role="navigation">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</div>

<div class="major-dr"><div class="major-drk"></div></div>