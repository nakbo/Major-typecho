<?php
/**
 * 归档
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>

    <div class="archives content-wrap">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-archive">
                    <?php
                    $stat = Typecho_Widget::widget('Widget_Stat');
                    Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
                    $year=0; $mon=0; $i=0; $j=0;
                    $output = '<div id="try">';
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
                            $output .= '<div class="arc-falt"><div class="arc-date">'.date('Y-m',$archives->created).'</div><div class="aec-lists" data-date="2017-6">';
                        }
                        $output .= '<div class="arc-list-item"><a href="'.$archives->permalink .'" data-toggle="tooltip" title="写于'.date('d日',$archives->created) . '的' . $archives->title .'"><span class="time">  '.date('d日',$archives->created).' </span>'. $archives->title .'</a></div>';
                    }
                    $output .= '</div></div></div>';
                    echo $output;
                    ?>
                </div>
                <?php include 'res/PostFooter.php'; ?>
            </article>
        </div>
    </div>

<?php $this->need('footer.php'); ?>