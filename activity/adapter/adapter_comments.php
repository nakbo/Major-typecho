<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels + 1;
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }

    $secure = Helper::options()->serverGravatar;
    $s = "100";
    $secure = $secure . "/";
    $s = "?s=" . $s;
    $r = "&r=G";
    $d = "&d=";
    $qqUrl = "https://api.krait.cn/api/tencent/headPortrait/" . $comments->mail;
    $avatar = $secure . md5($comments->mail) . $s . $r . $d . $qqUrl;

    ?>

    <li id="li-<?php $comments->theId(); ?>"
        class="comment-list-item comment even thread-even depth-<?php echo $depth ?> comment-body<?php
        if ($comments->levels > 0) {
            echo ' comment-child';
            $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
        } else {
            echo ' comment-parent';
        }
        $comments->alt(' comment-odd', ' comment-even');
        ?>">
        <article id="<?php $comments->theId(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <img class="avatar" src="<?php echo $avatar; ?>" alt="<?php echo $comments->author; ?>" width="40"
                         height="40">
                    <?php /*$comments->gravatar(40);*/ ?>
                    <b class="fn <?php echo $commentClass; ?> " itemprop="author">
                        <?php echo $author; ?>
                    </b>
                </div>
                <!-- .comment-author -->

                <div class="comment-metadata">
                    <a href="" itemprop="url">
                        <time class="liveTime" id="liveTime" data-lta-value="<?php $comments->date('c'); ?>"></time>
                    </a>
                </div>
                <!-- .comment-metadata -->

            </footer>
            <!-- .comment-meta -->

            <div class="comment-content">
                <span class="comment-content-true"><?php $comments->content(); ?></span>
            </div>
            <!-- .comment-content -->

            <div class="comment-actions">
                <?php $comments->reply('<i class="icon-action-undo icons" style="margin-right:3px;"></i>回复'); ?>
                <!-- .comment-actions -->
            </div>
        </article>

        <?php if ($comments->children) { ?>
            <div class="children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
    </li>
<?php } ?>


<div id="comments" data-no-instant>
    <div class="comment-respond">
        <?php $this->comments()->to($comments); ?>

        <?php if ($this->allow('comment')): ?>
            <div id="<?php $this->respondId(); ?>" class="respond">

                <h4 id="response" class="comment-reply-title">
                    <?php $comments->cancelReply('取消回复'); ?>
                </h4>
                <div class="cancel-comment-reply">

                </div>
                <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form"
                      role="form">
                    <div class="author-infos guest" id="comment-form-avatar"><img
                                src="<?php $this->options->serverGravatar(); ?>/?d=mm&s=100" width="100" class="avatar">
                    </div>
                    <div class="comment-form-main">
                        <div class="comment-textarea-wrapper mdui-ripple">
                            <p class="comment-form-comment"><label for="comment">评论</label>
                                <textarea style="" id="textarea"
                                          name="text"  <?php if (!$this->user->hasLogin()): ?> onclick='document.getElementById("comment-form-do").style.display="block";'<?php endif; ?>  cols="45"
                                          rows="8" aria-required="true" required="required"
                                          placeholder="发泄你的牢骚,留下你的笔言!"><?php $this->remember('text', false); ?></textarea>
                            </p>
                            <div class="comment-form-toolbar">
                                <?php if (isset($this->options->plugins['activated']['Smilies'])) $comments->smilies(); ?>

                            </div>
                        </div>

                        <div class="comment-form-fields" id="comment-form-do">
                            <?php if (!$this->user->hasLogin()): ?>
                                <p class="comment-form-author">
                                    <label for="author">昵称</label> <span class="required">*</span>
                                    <input type="text" name="author" maxlength="12" id="author" placeholder="昵称"
                                           value="" required>
                                </p>
                                <p class="comment-form-email">
                                    <label for="email">邮箱</label> <?php if ($this->options->commentsRequireMail): ?>
                                        <span class="required">*</span><?php endif; ?>
                                    <input type="email" name="mail" id="mail" placeholder="邮箱" value=""
                                           class="inputElem" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                                </p>
                                <p class="comment-form-url">
                                    <label for="url">网站</label> <?php if ($this->options->commentsRequireURL): ?>
                                        <span
                                                class="required">*</span><?php endif; ?>

                                    <input type="url" name="url" id="url" placeholder="网站"
                                           value="" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                                </p>
                            <?php endif; ?>
                        </div>

                        <p class="form-submit">
                            <button name="submit" type="submit" id="submit" class="submit mdui-color-theme">
                                <i class="icon iconfont icon-send"></i></button>
                            <?php $security = $this->widget('Widget_Security'); ?>
                            <input type="hidden" name="_"
                                   value="<?php echo $security->getToken($this->request->getReferer()) ?>">
                        </p>
                    </div>
                    <div class="comment-form-extra">

                    </div>
                </form>
            </div>
        <?php endif; ?>
        <?php if ($comments->have()): ?>
            <?php $comments->listComments(); ?>
            <?php $comments->pageNav('&laquo;', '&raquo;'); ?>

        <?php endif; ?>
    </div>
</div>
<!--<nocompress>-->
<script>
    <?php if(!$this->user->hasLogin()): ?>
    function getCommentCookie(name) {
        let arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg))
            return unescape(decodeURI(arr[2]));
        else
            return null;
    }

    function addCommentInputValue() {
        let authorGet = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_author');
        let md5Get = '<?php echo md5($this->request->getUrlPrefix()); ?>';
        document.getElementById('author').value = authorGet;
        document.getElementById('mail').value = getCommentCookie(md5Get + '__typecho_remember_mail');
        document.getElementById('url').value = getCommentCookie(md5Get + '__typecho_remember_url');
        document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = "<?php $this->options->serverGravatar();?>/" + md5(getCommentCookie(md5Get + '__typecho_remember_mail')) + "?s=100&r=G&d=mm";
    }

    $(document).on("input propertychange", "#mail", function (event) {
        event.preventDefault();
        let tval = $(this).val();
        let mail = window.setTimeout(function () {
            let nval = $("#mail").val();
            if (nval.length > 0 && tval == $("#mail").val()) {
                document.getElementById("noUserText").innerHTML = '你好,' + $("#author").val();
                document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = "<?php $this->options->serverGravatar();?>/" + md5($("#mail").val()) + "?s=100&r=G&d=mm";
            }
        }, 400);
    });

    addCommentInputValue();
    <?php else:?>
    document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = "<?php $this->options->serverGravatar();?>/" + md5("<?php $this->author->mail(); ?>") + "?s=100&r=G&d=mm";
    <?php endif; ?>
</script>