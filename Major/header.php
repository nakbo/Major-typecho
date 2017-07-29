<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
include 'function.php';
?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="author" content="Kraity,kraits@qq.com">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
    <meta http-equiv="content-language" content="zh-CN" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s '),
            'search'    =>  _t('所属关键字 %s '),
            'tag'       =>  _t('所属标签 %s '),
            'author'    =>  _t('%s ')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <meta name="keywords" content="<?php $this->options->keywords(); ?>" />
    <meta name="description" content="<?php $this->options->description(); ?>"/>
    <link href="https://cdn.bootcss.com/animate.css/3.3.0/animate.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="<?php $this->options->themeUrl(); ?>css/style.css" rel="stylesheet" />
    <script src="https://cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php $this->options->themeUrl(); ?>js/iconfont.js"></script>

    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php $this->header('description=&keywords=&generator=&template=&pingback=&xmlrpc=&wlw=&commentReply=&rss1=&rss2=&atom='); ?>
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

<div class="majors-h-shadow-layer"></div>
<nav id="main-nav">
    <div class="meuns-header">
        <div class="blog-author" data-rippleria>
            <div class="author-A1"><?php $this->options->majorM(); ?></div>
        </div>
        <ul role="navigation">
            <li <?php if($this->is('index')): ?>class="active"<?php endif; ?>><a class="material-ripple" data-ripple-color="#2ecc71" href="<?php $this->options->siteUrl(); ?>"><span>首页</span></a></li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <li <?php if($this->is('page', $pages->slug)): ?>class="active"<?php endif; ?>><a class="material-ripple" data-ripple-color="#2ecc71" href="<?php $pages->permalink(); ?>"><span><?php $pages->title(); ?></span></a></li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div class="meuns-footer">
        <ul>
            <li><a href="<?php $this->options->adminUrl(); ?>">LOGIN</a></li>
        </ul>
    </div>
    <a href="#0" class="majors-h-close-menu">Close<span></span></a>
</nav>

<div id="major" data-rippleria>

    <?php $formati=formati($format); //对$format进行布尔值赋值 return ?>
    <?php switch ($formati) : case true : //执行return true ?>

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

        <?php // switch ($format) : case 'post':?>

        <?php // break; default: //$format字符default 默认算法?>
            <style>
                .major-A0{
                    background: black;
                    <?php if($this->options->majorA0){ echo 'background: url('.$this->options->majorA0.') 50% 50% no-repeat;'; } ?>
                    background-size: cover;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                }
                .major-A2{
                    <?php if($this->options->majorA2){ echo 'background: url('.$this->options->majorA2.') 50% 50% no-repeat;'; } ?>
                    background-size: cover;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                }
            </style>
        <div class="major-1">
             <div class="major-A0"></div>
             <div class="major-A1"></div>
             <div class="major-A2"></div>
        </div>
        <?php // endswitch; //结束 default 默认算法?>
        <div class="major-t1">
            <div class="container">
                <div class="major-t1-meta">
                    <?php if($this->is('post')): //是否为文章页?>
                        <div class="post-meta">
                            <div class="post-meta-A1">
                                <img src="<?php echo 'https://secure.gravatar.com/avatar/'.md5($this->author->mail).'?s=40&r=G&d=mm'; ?>">
                            </div>
                            <div class="post-meta-A2">
                                <span><?php $this->author->screenName();?></span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    <?php else://非文章页?>
                        <div class="major-meta"><i>in</i> me</div>
                    <?php endif; //结束是否为文章页?>
                </div>
                <h2 class="major-t1-title">
                    <?php if($this->is('index')): //是首页?>
                        <a>
                            <?php echo widget_title($this->options->describes);?>
                        </a>
                    <?php else: //非首页?>
                        <a>
                            <?php $this->archiveTitle(array('category'  => _t('%s '),'search'=> _t('所属关键字 %s '),'tag' => _t('所属标签 %s '),'author'=> _t('%s ')), ''); ?>
                        </a>
                    <?php endif;//结束首页?>
                </h2>
            </div>
        </div>
    </div>
    <?php endswitch; //结束 return ?>


    <div class="majors-h-header">
        <a class="majors-h-menu-trigger" href="#main-nav"><span></span></a>
    </div>

    <?php if(!$formati)://$formati 为flase时输出,使菜单在左边 ?>
        <style>

            .majors-h-header {
                position: initial;
            }
            .majors-h-menu-trigger span {
                background-color: #867A7A;
            }
            .majors-h-menu-trigger {
                position: initial;
            }
            @media only screen and (min-width: 768px){
                .majors-h-header {
                    height: inherit;
                }
            }
            .article-title {
                padding-top: 0;
            }
            .article-title h3 {
                margin-top: 0;
            }
        </style>
    <?php endif;//这里结束为flase ?>
        <script>
            jQuery(document).ready(function($){
                //open menu
                $('.majors-h-menu-trigger').on('click', function(event){
                    event.preventDefault();
                    $('#main-nav').addClass('is-visible');
                    $('.majors-h-shadow-layer').addClass('is-visible');
                });
                //close menu
                $('.majors-h-close-menu').on('click', function(event){
                    event.preventDefault();
                    $('#main-nav').removeClass('is-visible');
                    $('.majors-h-shadow-layer').removeClass('is-visible');
                });
            });

        </script>


</div>

<script>
    function randInt(min, max) {
        var rand = min + Math.random() * (max - min);
        rand = Math.round(rand);
        return rand;
    }

    $('#major,.majors-post,.blog-author').click(function(e) {
       /*e.preventDefault(); 它是不让click里的a标签点击后转跳*/
        $(this).rippleria('changeColor','rgba('+randInt(0,255)+','+randInt(0,255)+','+randInt(0,255)+',0.'+randInt(3,5));
    });

    /*$(".majors-logo a").each(function(){
     $(this).click(function(){
     window.location.href = $(this).attr('href');
     });
     }); 解决e.preventDefault开启后不转接*/

</script>