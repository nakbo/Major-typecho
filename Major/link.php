<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>

<section class="row content-wrap">
    <div class="container">
        <h2>友链<h5>这是后宫</h5></h2>

<?php
$str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
$str = preg_replace('#<li>(.*?)<a href="(.*?)">(.*?)</a></li>#','<div class="userItem"><div class="userItem--inner"><div class="userItem-content">$1<div class="userItem-name"><a href="$2" target="_blank">$3</a></div></div> </div> </div> ',$str);
$str = preg_replace('#<ul>#','<div class="userItems">', $str);
$str = preg_replace('#</ul>#','</div>', $str);
echo $str;
?>
            
            
<!--?php Links_Plugin::output("date",'
    <div class="userItem">
        <div class="userItem--inner">
            <div class="userItem-content">
<img src="{image}">
<div class="userItem-name"><a href="{url}" target="_blank">{name}</a></div>
            </div>
        </div>
    </div>
'); ?-->
    
    </div>
</section>

<style>
    .widget-links-inner {
        background: white;
        border-radius: 4px;
        padding: 10px 15px;
    }
    
    h2 {
        font-weight: 700;
    }

    .comment-in {
        padding: 50px 0;
        border-top: solid 3px #F7F7F7;
        clear: both
    }
    
    /*友情链接*/

    .userItems {
        margin-top: 20px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap
    }

    .userItem {
        width: 20%;
        box-sizing: border-box;
        padding-left: 10px;
        padding-right: 10px
    }

    .userItem--inner {
        border: 1px solid #eee;
        border-radius: 3px;
        position: relative;
        padding-bottom: 100%;
        height: 0;
        border-bottom: 4px solid #eee;
    }

    .userItem-content {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-flex-flow: column wrap;
        -ms-flex-flow: column wrap;
        flex-flow: column wrap;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center
    }

    .userItem-content img {
        border-radius: 100%;
        height:64px;
        width:64px;
        margin: 0 !important;
    }

    .userItem-name {
        margin-top: 8px;
        text-align: center
    }

    .userItem-name a {
        color: rgba(0, 0, 0, .6);
    }

    @media (max-width:900px) {
        .userItem {
            width: 33.33333%
        }
    }

    @media (max-width:600px) {
        .userItem {
            width: 50%
        }
    }
</style>

<div class="comment-in">
    <div class="container">
        <div class="col-md-8">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>
