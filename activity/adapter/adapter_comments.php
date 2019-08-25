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
                    <img class="avatar" src="<?php echo \Krait\Major::getGravatarNew($comments->mail); ?>"
                         alt="<?php echo $comments->author; ?>" width="40"
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
                                <label for="textarea"></label>
                                <textarea style="" id="textarea" class="textarea"
                                          name="text"  <?php if (!$this->user->hasLogin()): ?> onclick='document.getElementById("comment-form-do").style.display="block";'<?php endif; ?>  cols="45"
                                          rows="8" aria-required="true" required="required"
                                          placeholder="发泄你的牢骚,留下你的笔言!"><?php $this->remember('text'); ?></textarea>
                            </p>
                            <div class="comment-form-toolbar">
                                <?php if (isset($this->options->plugins['activated']['Smilies'])) $comments->smilies(); ?>
                            </div>
                        </div>

                        <div class="comment-form-toolbar-OwO">
                            <div class="OwO"></div>
                        </div>

                        <div class="comment-form-fields" id="comment-form-do">
                            <?php if (!$this->user->hasLogin()): ?>
                                <p class="comment-form-author">
                                    <label for="author">昵称</label> <span class="required">*</span>
                                    <input type="text" name="author" maxlength="12" id="author" placeholder="昵称"
                                           value="<?php $this->remember('author'); ?>" required>
                                </p>
                                <p class="comment-form-email">
                                    <label for="email">邮箱</label> <?php if ($this->options->commentsRequireMail): ?>
                                        <span class="required">*</span><?php endif; ?>
                                    <input type="email" name="mail" id="mail" placeholder="邮箱"
                                           value="<?php $this->remember('mail'); ?>"
                                           class="inputElem" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                                </p>
                                <p class="comment-form-url">
                                    <label for="url">网站</label> <?php if ($this->options->commentsRequireURL): ?>
                                        <span
                                                class="required">*</span><?php endif; ?>
                                    <input type="url" name="url" id="url" placeholder="网站"
                                           value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                                </p>
                                <p class="comment-form-fast">
                                    <label for="url">Github快速评论</label>
                                    <input placeholder="Github用户名输入快速评论" id="githubNum" type="text"
                                           style="font-size: 12px;">
                                </p>
                                <p class="comment-form-fast">
                                    <label for="url">QQ快速评论</label>
                                    <input placeholder="QQ账号输入快速快评论" id="qqNum" type="text" style="font-size: 12px;">
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
<link rel="stylesheet" href="<?php $this->options->themeUrl('res/plugins/OwO/OwO.min.css'); ?>">
<script src="<?php $this->options->themeUrl('res/plugins/OwO/OwO.js'); ?>"></script>
<script>
    let OwO_demo = new OwO({
        logo: 'OωO',
        container: document.getElementsByClassName('OwO')[0],
        target: document.getElementsByClassName('textarea')[0],
        api: '<?php $this->options->themeUrl("res/plugins/OwO/OwO.json"); ?>',
        position: 'down',
        width: '100%',
        maxHeight: '250px'
    });
</script>
<script>
    <?php if(!$this->user->hasLogin()): ?>
    function isEmpty(obj) {
        return typeof obj == "undefined" || obj == null || obj == "";
    }
    $(document).on("input propertychange", "#qqNum", function (event) {
        event.preventDefault();
        let oldVal = $(this).val();
        let qq = window.setTimeout(function () {
            let newVal = $("#qqNum").val();
            if (newVal.length > 0 && oldVal === $("#qqNum").val() && !newVal.isNaN) {
                $.ajax({
                    url: 'https://api.krait.cn/?interface=personage&target=tencent&object=' + newVal,
                    dataType: 'jsonp',
                    jsonpCallback: 'portraitCallBack',
                    scriptCharset: "GBK",
                    contentType: "text/html; charset=GBK",
                    success: function (data) {
                        console.log(data);
                        document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = data["avatar_encryption_url"];
                        $('#author').val(data["nickname"]);
                        $('#mail').val(data["email"]);
                    }
                })
            }
        }, 500);
    });

    $(document).on("input propertychange", "#githubNum", function (event) {
        event.preventDefault();
        let oldVal = $(this).val();
        let github = window.setTimeout(function () {
            let newVal = $("#githubNum").val();
            if (newVal.length > 0 && oldVal === $("#githubNum").val()) {
                $.ajax({
                    url: 'https://api.github.com/users/' + newVal,
                    dataType: 'jsonp',
                    scriptCharset: "GBK",
                    contentType: "text/html; charset=GBK",
                    success: function (data) {
                        console.log(data);
                        let personal = data["data"];
                        document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = personal["avatar_url"];
                        $('#author').val(isEmpty(personal["name"]) ? personal["login"] : personal["name"]);
                        $('#url').val(isEmpty(personal["blog"]) ? personal["html_url"] : personal["blog"]);
                        $('#mail').val(isEmpty(personal["email"]) ? personal["login"] + "@" : personal["email"]);
                    }
                })
            }
        }, 1000);
    });

    $(document).on("input propertychange", "#mail", function (event) {
        event.preventDefault();
        let oldVal = $(this).val();
        let mail = window.setTimeout(function () {
            let newVal = $("#mail").val();
            if (newVal.length > 0 && oldVal === $("#mail").val()) {
                document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = "<?php $this->options->serverGravatar();?>/" + md5($("#mail").val()) + "?s=100&r=G&d=mm";
            }
        }, 400);
    });

    document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = "<?php echo \Krait\Major::getGravatarNew(Typecho_Cookie::get("__typecho_remember_mail", null));?>";
    <?php else:?>
    document.getElementById("comment-form-avatar").getElementsByTagName("img")[0].src = "<?php echo \Krait\Major::getGravatarNew($this->author->mail);?>";
    <?php endif; ?>
</script>