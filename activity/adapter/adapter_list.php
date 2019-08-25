<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/** 文章置顶 */
$sticky = $this->options->stickyCid;; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
if ($sticky && $this->is('index') || $this->is('front')) {
    $sticky_cids = explode(',', strtr($sticky, ' ', ','));//分割文本
    $sticky_html = "<strong>[置顶]</strong>"; //置顶标题的 html
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post', 'publish', time());
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';
    foreach ($sticky_cids as $i => $cid) {
        if ($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order(null, "(case cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序
    if ($this->_currentPage == 1) foreach ($db->fetchAll($select1) as $sticky_post) { //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
    $uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if ($uid) $select2->orWhere('authorId = ? && status = ?', $uid, 'private');
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
    foreach ($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal() - count($sticky_cids)); //置顶文章不计算在所有文章内
}
?>
<div class="major-posts" id="major-posts">
    <?php if ($this->have()): ?>
        <?php while ($this->next()): $newFormat = $this->fields->format == null ? "post" : $this->fields->format; ?>
        <article class="majors-post <?php echo $newFormat; ?>  mdui-ripple" itemscope
                 itemtype="http://schema.org/BlogPosting">
            <div class="majors-postContent">
                <?php if ($this->fields->thumbUrl) : ?>
                    <a href="<?php $this->permalink() ?>">
                        <div class="A3-image row"><img src="<?php $this->fields->thumbUrl(); ?>" class="grow"/></div>
                    </a>
                <?php endif; ?>

                <?php switch ($newFormat) : case 'aside': ?>
                    <?php break;
                    case 'status': ?>
                        <i class="status-icon icon iconfont icon-xiaoxi2"></i>
                        <?php break; endswitch; ?>
                <?php switch ($newFormat) {
                    case 'status':
                        break;
                    case 'chat':
                        ?>
                        <div class="major-chats mdui-card-header">
                            <img class="mdui-card-header-avatar"
                                 src="<?php echo $krait->getGravatar($this->author->mail) ?>"/>
                            <div class="chats major-text"><?php $this->content(); ?></div>
                        </div>
                        <?php break;
                    case 'quote':
                        ?>
                        <?php break;
                    default: ?>
                        <h3 class="post-title" itemprop="name headline">
                            <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->sticky();
                                $this->title(); ?></a>
                        </h3>
                    <?php } ?>
                <div class="post-contents" itemprop="articleBody">
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
                            echo '<p>';
                            $this->excerpt(143, '...');
                            echo '</p>';
                    endswitch; ?>

                </div>

                <?php switch ($newFormat) {
                    case 'status':
                        break;
                    case 'chat':
                        break;
                    case 'quote':
                        break;
                    default: ?>
                        <footer class="row">
                            <div class="response-m">
                                <div class="text-right">
                                    <time class="liveTime" id="liveTime"
                                          data-lta-value="<?php $this->date('c'); ?>"></time>
                                </div>
                            </div>
                        </footer>
                    <?php } ?>

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
                has_icon: true,
                has_close_btn: true,
                fullscreen: false,
                timeout: 0,
                sticky: false,
                has_progress: true,
                rtl: false
            });

        </script>
    <?php endif; ?>

</div>

<div class="pagination">
    <?php $this->pageNav('&laquo;', '&raquo;'); ?>
</div>

