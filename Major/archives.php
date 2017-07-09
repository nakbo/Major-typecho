<?php
/**
 * 归档
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>



<section class="row content-wrap">
    <div class="container">
        <div class="row Archives-box">
            <div class="post-Archive">
            <?php 
                $stat = Typecho_Widget::widget('Widget_Stat');
                Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
                $year=0; $mon=0; $i=0; $j=0;
                $output = '<div id="archives">';
                while($archives->next()){
                    $year_tmp = date('Y',$archives->created);
                    $mon_tmp = date('m',$archives->created);
                    $y=$year; $m=$mon;
                    if ($year > $year_tmp || $mon > $mon_tmp) {
                        $output .= '</div></div>';
                    }
                    if ($year != $year_tmp || $mon != $mon_tmp) {
                        $year = $year_tmp;
                        $mon = $mon_tmp;
                        $output .= '<div class="archive-title"><h3>'.date('Y-m',$archives->created).'</h3><div class="archives" data-date="2017-6">'; 
                    }
                    $output .= '<div class="brick"><a href="'.$archives->permalink .'"><span class="time">  '.date('d日',$archives->created).' </span>'. $archives->title .'</a></div>'; 
                }
                $output .= '</div></div></div>';
                echo $output;
            ?>

            </div>
        </div>
    </div>
</section>
<style>
    .Archives-box {
        position: relative;
    }
    .post-Archive {
        max-width: 800px;
        margin-left: 35px;
        padding-left: 40px
    }

    .post-Archive:before {
        position: absolute;
        left: 34px;
        top: 30px;
        bottom: 40px;
        display: block;
        width: 2px;
        background: #cecece;
        content: "";
        z-index: 0
    }

    .post-Archive:after {
        content: "";
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #EEE;
        position: absolute;
        left: 29px;
        bottom: 35px
    }

    .archive-title {
        padding-bottom: 40px
    }
    
    .archives {
        padding-right: 15px;
    }

    .archives a {
        position: relative;
        display: block;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        color: #333;
        font-style: normal
    }

    .time {
        color: #888;
        padding-right: 35px
    }

    #archives h3 {
        padding-bottom: 10px;
        position: relative
    }

    #archives h3:before {
        content: "";
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #EEE;
        position: absolute;
        left: -47px;
        margin-top: 5px
    }
</style>

<?php $this->need('footer.php'); ?>
