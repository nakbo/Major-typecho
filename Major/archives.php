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
                    <h4>标签云</h4>
                    <ul class="arc-tag">
                        <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 20))->to($tags); ?>
                        <?php while($tags->next()): ?>
                            <li><a rel="tag" href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <h4>独立页归档</h4>
                    <ul class="arc-page">
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                            <li>
                                <a href="<?php $pages->permalink(); ?>" class="mdui-ripple"><?php $pages->title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                    <h4>分类归档</h4>
                    <ul class="arc-category">
                        <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}" title="{description}">{name}</a></li>'); ?>
                    </ul>

                    <h4>文章归档</h4>
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
                            $output .= '<div class="arc-falt"><h4>'.date('Y-m',$archives->created).'</h4><div class="aec-lists" data-date="2017-6">';
                        }
                        $output .= '<div class="arc-list-item"><a href="'.$archives->permalink .'" target="_blank" title="写于'.date('d日',$archives->created) . '的' . $archives->title .'"><span class="time">  '.date('d日',$archives->created).' </span>'. $archives->title .'</a></div>';
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