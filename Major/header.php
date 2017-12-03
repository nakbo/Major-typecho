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
    <link href="<?php $this->options->themeUrl(); ?>css/style.css" rel="stylesheet" />
    <link href="//cdn.bootcss.com/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <script src="<?php $this->options->themeUrl('js/jquery-ias.js'); ?>"></script>
    <script src="//cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php $this->options->themeUrl(); ?>js/iconfont.js" data-no-instant></script>
    <script src="<?php $this->options->themeUrl(); ?>js/toast.script.js"></script>

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
            <div class="major-A0" id="major-A0"></div>
            <div class="major-A1"></div>
            <div class="major-A2" id="major-A2"></div>
            <script>
                $("#major-A0").css({
                    "background":"black",
                    <?php if($this->options->majorA2){ echo '"background":"url('.$this->options->majorA0.') 50% 50% no-repeat",'; } ?>
                    "background-size":"cover",
                    "-webkit-background-size":"cover",
                    "-moz-background-size":"cover",
                    "-o-background-size":"cover"
                });
                $("#major-A2").css({
                    <?php if($this->options->majorA2){ echo '"background":"url('.$this->options->majorA2.') 50% 50% no-repeat",'; } ?>
                    "background-size":"cover",
                    "-webkit-background-size":"cover",
                    "-moz-background-size":"cover",
                    "-o-background-size":"cover"
                });
            </script>
        </div>
        <div class="major-t1 major-tr">
            <div class="container">
                <div class="major-right">
                    <div class="major-master">
                        <div class="master-author">
                            <img src="<?php echo Major::getGravatar(Major::personal()[mail],"100"); ?>">
                            <span class="master-author-note"></span>
                        </div>
                        <div class="master-info">
                            <div class="info-box">
                                <p class="info-name"><?php echo Major::personal()[screenName]; ?></p>
                                <p class="info-infos"><?php echo Major::personal()[mail]; ?></p>
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
    </div>
    <nav id="main-nav">
        <div class="menus-header">
            <ul role="navigation">
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
    </nav>
</div>


