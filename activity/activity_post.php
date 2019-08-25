<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$newFormat = isset($this->fields->format) ? $this->fields->format : "post";

if ($krait->postAble($newFormat)) return;

include 'activity_main_header.php';
include 'adapter/adapter_author.php';

?>

    <div class="majors-post-articles post <?php echo $newFormat; ?>" id="main" role="main">
        <article class="major-article article-shadow content-wrap" itemscope
                 itemtype="http://schema.org/BlogPosting">
            <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
            <ul class="post-meta">
                <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
                <li id="post-modified" data-lasttime="<?php $this->modified();?>000"><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
                <li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
            </ul>
            <div class="post-content major-text" data-wow-offset="10" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <p itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, 'none'); ?></p>
            <?php include 'adapter/adapter_footer.php'; ?>
        </article>
    </div>

    <script type="text/javascript">
        (function () {
                let articleLastTime = '<?php $this->modified(); _e('000');?>',
                    timeStamp = new Date().getTime(),
                    differentialTimestamp = timeStamp - articleLastTime,
                    differTime = Math.ceil(differentialTimestamp / (24 * 60 * 60 * 1000));
                if (differTime >= 365) {
                    $.Toast(
                        '温馨提示',
                        '这是一个最后修改于 ' + differTime + ' 天前的主题，其中的信息可能已经有所发展或是发生改变。',
                        "notice", {
                            has_icon: true,
                            has_close_btn: true,
                            fullscreen: false,
                            timeout: 0,
                            sticky: false,
                            has_progress: true,
                            rtl: false
                        }
                    );
                }
            }
        )();
    </script>

    <div class="comment-here">
        <div class="container">
            <?php include 'adapter/adapter_comments.php'; ?>
        </div>
    </div>

<?php include 'activity_main_footer.php'; ?>