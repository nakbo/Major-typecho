<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/*if (!$this->user->hasLogin()){ echo '抱歉啦,权那他正在编写调试 Major2.0 !'; exit;}*/?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="author" content="<?php echo Major::$screenName; ?>,<?php echo Major::$mail; ?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-CN" />
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="icon" href="<?php $this->options->faviconUrl(); ?>">
    <link rel="dns-prefetch" href="//cdn.mathjax.org" />
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
    <link rel="dns-prefetch" href="<?php $this->options->serverGravatar();?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s '),
            'search'    =>  _t('所属关键字 %s '),
            'tag'       =>  _t('所属标签 %s '),
            'author'    =>  _t('%s ')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php $this->header('generator=&commentReply='); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.4.1/css/mdui.min.css">
    <link href="<?php $this->options->themeUrl("style.css?v="); echo Major::$Major['version']; ?>" rel="stylesheet" />
    <link href="//cdn.bootcss.com/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php $this->options->socialJsonUrl(); ?>" rel="stylesheet">
    <script src="//cdn.bootcss.com/mdui/0.4.1/js/mdui.min.js"></script>
    <script src="//cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php $this->options->themeUrl("js/toast.script.js"); ?>"></script>
    <script src="//cdn.bootcss.com/venobox/1.8.3/venobox.min.js"></script>
    <script src="//cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script type="text/javascript">
        window.bzName = "<?php echo Major::$screenName; ?>";
        window.bzMail = "<?php echo Major::$mail; ?>";
    </script>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">jQuery(document).ready(function($) {$(".scroll").click(function(event){event.preventDefault();$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);});});</script>
</head>
<body id="major-grid" class="mdui-loaded intro-effect-grid">

<!--[if lt IE 8]>
<div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="https://browsehappy.com">升级你的浏览器</a>'); ?>.</div>
<![endif]-->


