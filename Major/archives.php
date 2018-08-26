<?php
/**
 * 归档
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>

    <div class="articles-post post-header">
        <div class="post-head">
            <div class="back">
                <a href="javascript:;" onclick="javascript:history.back(-1);" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></a>
            </div>
            <div class="container">
                <div class="title">
                    <h1><?php $this->sticky(); $this->title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="post-head-row">
            <div class="container">
                <h5 class="subtitle">
                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                </h5>
            </div>
        </div>
    </div>

    <div class="archives content-wrap">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-archive">

                    <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
                    $year=0; $mon=0; $i=0; $j=0;
                    $ml = $archives->options->rootUrl;
                    $output = '';
                    while($archives->next()):

                        $year_tmp = date('Y',$archives->created);
                        $mon_tmp = date('m',$archives->created);
                        $y=$year; $m=$mon;

                        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul>';
                        if ($year != $year_tmp && $year > 0) $output .= '</div>';
                        if ($year != $year_tmp) {
                            $year = $year_tmp;
                            $output .= ' <div class="archive archive-year" data-date="'. $year .'"><h3>'. $year .'</h3>'; //输出年份

                            if ($mon == $mon_tmp){
                                $year = $year_tmp;
                                $mon = $mon_tmp;
                                if ($this->options->rewrite==0){
                                    $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="' . $ml . '/index.php/'. $year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份
                                }else{
                                    $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="'. $ml .'/'. $year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份
                                }
                            }

                        }

                        if ($mon != $mon_tmp){

                            $year = $year_tmp;
                            $mon = $mon_tmp;
                            if ($this->options->rewrite==0){
                                $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="' . $ml . '/index.php/'. $year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份
                            }else{
                                $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="'. $ml .'/'.$year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份
                            }
                        }


                        $output .= '  <li class="li_guidang archive-post archive-day" data-date="'. $year .''. $mon .''.date('d',$archives->created).'">
                <a class="guidang" href="'.$archives->permalink .'">'. $archives->title .'</a>
                <span class="date">'. $year .'-'.date('m',$archives->created).'-'.date('d',$archives->created).'</span>
            </li>'; //输出文章日期和标题

                    endwhile;
                    $output .= '</div>';
                    echo $output;
                    ?>

                </div>
            </article>
        </div>
    </div>

<?php $this->need('footer.php'); ?>