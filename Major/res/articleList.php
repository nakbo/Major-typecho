<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>


<div class="major-posts" id="major-posts">
    <?php if ($this->have()): ?>
        <?php while($this->next()): $newFormat = majors_Plugin::getFormat();?>

        <article class="majors-post <?php echo $newFormat;?>  mdui-ripple" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="majors-postContent">

                <?php switch ($newFormat) : case 'aside':?>
                    <?php if($this->fields->thumbUrl) :?>

                        <a href="<?php $this->permalink() ?>">
                            <div class="A3-image row"><img src="<?php $this->fields->thumbUrl(); ?>" class="grow" /></div>
                        </a>
                    <?php endif;?>

                <?php break; case 'status':?>
                    <i class="status-icon icon iconfont icon-xiaoxi2"></i>
                <?php break; endswitch;?>

                <?php switch ($newFormat){
                    case 'status':
                        break;
                    case 'chat':?>
                        <div class="major-chats mdui-card-header">
                            <img class="mdui-card-header-avatar" src="<?php echo Major::getGravatar($this->author->mail) ?>"/>
                            <div class="chats major-text"><?php $this->content(); ?></div>
                        </div>
                    <?php break;
                    case 'quote':?>

                        <?php break;
                    default: ?>
                <h3 class="post-title" itemprop="name headline">
                    <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title(); ?></a>
                </h3>
                <?php } ?>

                <div class="post-contents major-text" itemprop="articleBody">
                    <?php switch ($newFormat) :
                        case 'status':
                            $this->content();
                            break;
                        case 'chat':
                            //$this->content();
                            break;

                        case 'quote':
                            //$this->content();
                            break;
                        default:
                            echo '<p>'; $this->excerpt(143, '...');
                            echo '</p>';
                    endswitch; ?>
                </div>

                <?php switch ($newFormat){
                    case 'status':
                        break;
                    case 'chat':
                        break;
                    case 'quote':
                        break;
                    default: ?>
                <footer class="row">
                    <div class="response-m">
                        <span><i class="mdui-icon material-icons">&#xe902;</i> <a href="<?php $this->permalink() ?>">深入全文</a></span>
                    </div>
                </footer>
                <?php }?>

            </div>
        </article>

    <?php endwhile; ?>
    <?php else: ?>
        <div class="postError">
            <h3>Error!</h3>
            <p>没有找到内容,请换别的关键字进行检索!</p>
            <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
        </div>
        <script>
            $.Toast("Error!", "没有找到内容,请换别的关键字进行检索!", "error", {
                has_icon:true,
                has_close_btn:true,
                fullscreen:false,
                timeout:0,
                sticky:false,
                has_progress:true,
                rtl:false
            });

        </script>
    <?php endif; ?>

</div>

<div class="pagination">
    <?php $this->pageNav('&laquo;', '&raquo;'); ?>
</div>

