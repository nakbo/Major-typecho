<?php
/**
 * 友链
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>

    <section class="row content-wrap links" id="main" role="main">
        <div class="container">
            <div class="post-content post-text">
                <?php
                $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                $str = preg_replace('/\s{2,}|　/',' ',$str);
                $str = preg_replace('#<li><p><a href="(.*?)" title="(.*?)">(.*?)</a><img src="(.*?)" alt="(.*?)" /></p></li>#','<div class="userIb-member userIb"><div class="member-image"><img src="$4" alt="$2" /></div><div class="member-info"><h3>$3</h3><h5>$5</h5><div class="userIb-touch"><a class="fb-touch" href="$1" target="_blank">点击访问</a></div></div></div> ',$str);
                $str = preg_replace('#<ul>#','<div class="userItems">', $str);
                $str = preg_replace('#</ul>#','</div>', $str);
                echo $str;
                ?>
            </div>
        </div>
    </section>

    <style>
        h2 {
            font-weight: 700;
        }

        .post-content {
            max-width: 1170px;
        }

        .links {
            background: white;
            padding: 30px;
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

        .userIb-member {
            width: 15%;
            float: left;
            margin: 30px 2.5%;
            background-color: #fff;
            text-align: center;
            position: relative;
        }

        .member-image img {
            max-width: 100%;
            vertical-align: middle;
        }

        h3 {
            font-size: 15px;
            font-weight: normal;
            margin: 10px 0 0;
            text-transform: uppercase;
        }

        h5 {
            font-size: small;
            font-weight: 300;
            margin: 4px 0 15px;
        }

        .userIb-touch a {
            border-radius: 3px;
            padding: 4px;
            color: #fff;
            display: inline-block;
            background: rgb(250, 108, 111);
            vertical-align: middle;
            opacity: 0.7;
            transition: 0.3s;
        }

        .userIb-touch a:hover {
            opacity: 1;
            transition: 0.3s;
        }


        .userIb {
            max-height: 240px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .userIb h3 {
            line-height: 22px;
        }

        .userIb .member-image {
            border-bottom: 5px solid #EFEFEF;
            transition: 0.4s;
            width: 100%;
            display: inline-block;
            float: none;
            vertical-align: middle;
        }

        .userIb .member-info {
            transition: 0.4s;
        }

        .userIb .member-image img {
            width: 100%;
            vertical-align: bottom;
        }

        .userIb .userIb-touch {
            float: left;
            left: 0;
            bottom: 0;
            overflow: hidden;
            padding: 5px 0;
            width: 100%;
            transition: 0.4s;
        }

        .userIb:hover .member-image {
            border-bottom: 0;
            border-radius: 0 0 50px 50px;
            display: inline-block;
            overflow: hidden;
            width: 110px;
            transition: 0.4s;
        }


        @media screen and (max-width:1200px) {

            .userIb-member {
                width: 20%;
            }
            .userIb {
                max-height: 250px;
            }
        }


        @media screen and (max-width:1000px) {

            h3 {
                font-size: 16px;
            }
            h5 {
                font-size: small;
            }
            .userIb {
                max-height: 200px;
            }

            .userIb:hover .member-image {
                width: 70px;
                border-radius: 0 0 70px 70px;
            }
        }

        @media screen and (max-width:768px) {

            h3 {
                font-size: 16px;
            }
            h5 {
                font-size: small;
            }

            .userIb-member {
                width: 45%;
            }
            .userIb {
                max-height: 360px;
            }

            .userIb:hover .member-image {
                width: 200px;
                border-radius: 0 0 200px 200px;
            }
        }

        @media screen and (max-width:600px) {

            .userIb:hover .member-image {
                width: 150px;
                border-radius: 0 0 150px 150px;
            }
        }

        @media screen and (max-width:500px) {

            .userIb:hover .member-image {
                width: 120px;
                border-radius: 0 0 120px 120px;
            }
        }
    </style>


    <div class="comment-here">
        <div class="container">
            <div class="comment-box"><?php $this->need('comments.php'); ?></div>
        </div>
    </div>

<?php $this->need('footer.php'); ?>