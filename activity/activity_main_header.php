<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans" class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="author" content="<?php $krait->getAuthorMeta();?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-CN" />
    <link rel="icon" href="<?php $this->options->faviconUrl(); ?>">
    <?php $krait->reflectDnsPrefetch();?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s '),
            'search'    =>  _t('所属关键字 %s '),
            'tag'       =>  _t('所属标签 %s '),
            'author'    =>  _t('%s ')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php $this->header(); ?>
    <?php $krait->reflectGlobalStylesheet();?>
    <script type="text/javascript">
        /* Call Global */
        function personal() {
            /* Initialization information */
            var personal;
            personal = {
                identity:{
                    name: "<?php _e($krait->personal['screenName']); ?>",
                    mail: "<?php _e($krait->personal['mail']); ?>"
                },
                interactive:{
                    url:{
                        theme: "<?php $this->options->themeUrl();?>",
                        site: "<?php $this->options->siteUrl(); ?>"
                    },
                    api:{
                        url:<?php _e(json_encode($krait->api));?>   /**/
                    },
                    reward:{
                        json: [<?php $this->options->rewardJson(); ?>]
                    },
                    dossier: {
                        number:{
                            sumPost: "<?php $krait->Widget_Stat->publishedPostsNum() ?>",
                            sumComment: "<?php $krait->Widget_Stat->publishedCommentsNum() ?>"
                        }
                    }
                }
            };
            return personal;
        }
        window.personal = personal();
        try {
            console.log(window.personal);
        } catch(err) {
            console.log("Execute new object error");
        }

    </script>
    <?php $krait->reflectGlobalScript();$this->options->headCode();?>
    <style>
        @media screen and (min-width: 700px){
            .mat-1.Able .major-mat{
                background: url(<?php $this->options->majorA0(); ?>) no-repeat center;
                background-size: cover;
                -webkit-box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.62);
                box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.62);
            }
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
</head>
<body id="major-grid" class="<?php $krait->getBodyClass();?>">
