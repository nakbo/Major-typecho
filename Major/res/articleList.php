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
                            <img class="mdui-card-header-avatar" src="<?php echo Major::getGravatar($this->author->mail,"100",$this->options->masterImgUrl,$this->options->useGravatar); ?>"/>
                            <div class="chats"><?php $this->content(); ?></div>
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
                <footer class="row major-text">
                    <div class="response-count">
                        <time class="post-mated" datetime="<?php $this->date('c'); ?>" itemprop="datePublished">发布于 <?php $this->date();?></time>
                        <span class="post-mated intro-eye">&nbsp;&nbsp;<?php majors_Plugin::theViews(); ?> 次围观</span>
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

<div class="pagination" style="display:none">
    <?php $this->pageLink('下一页','next'); ?>
</div>

<script type="text/javascript">
    function iasNew() {
        try
        {
            var iasArt = jQuery.ias({
                container:  '#major-posts',    //大容器
                item:       '.majors-post',    //循环容器
                pagination: '.pagination',    //分页容器
                next:       '.next'    //下一页的class
            });

            iasArt.extension(new IASTriggerExtension({
                html: '<div class="iasBtn mdui-ripple"><span>下一页</span><button class="mdui-textfield-icon mdui-btn mdui-btn-icon" role="button" data-no-instant><i class="mdui-icon material-icons">&#xe913;</i></button></div>',
                offset: 1 //load多少页后显示加载更多按钮
            }));
            iasArt.extension(new IASSpinnerExtension());    //加载时的图片
            iasArt.extension(new IASNoneLeftExtension({text: '<span>深入低了</span><i class="mdui-icon material-icons">&#xe3f1;</i>'}));    //到底后显示的文字


            iasArt.on('rendered', function(items) {
                $.Toast("加载成功!", "成功加载了下一页作品.", "success", {
                    has_icon:true,
                    has_close_btn:true,
                    fullscreen:false,
                    timeout:3000,
                    sticky:false,
                    has_progress:true,
                    rtl:false
                });
                if (typeof MathJax !== 'undefined') {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            });
        }
        catch(err) {}
    }
    iasNew();

</script>
