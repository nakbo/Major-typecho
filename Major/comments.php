<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
    ?>

    <li id="li-<?php $comments->theId(); ?>" class="comment-list-item comment even thread-even depth-<?php echo $depth ?> comment-body<?php
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
                    <?php $comments->gravatar(40); ?>
                    <b class="fn <?php echo $commentClass; ?> " itemprop="author">
                        <?php echo $author; ?>
                    </b>
                </div>
                <!-- .comment-author -->

                <?php if ($comments->url) :?>
                    <div class="comment-metadata major-text">
                        <?php
                        $commentUrl = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->url . '</a>';
                        echo $commentUrl;
                        ?>
                    </div>
                <?php endif;?>

                <div class="comment-metadata">
                    <span class="icon-location-pin"></span>
                    <?php
                    echo $comments->ip;
                    ?>
                </div>

                <div class="comment-metadata">
                    <a href="" itemprop="url">
                        <time class="liveTime" id="liveTime" data-lta-value="<?php $comments->date('c'); ?>"></time>
                    </a>
                </div>
                <!-- .comment-metadata -->

            </footer>
            <!-- .comment-meta -->

            <div class="comment-content  major-text">
                <?php $comments->content(); ?>
            </div>
            <!-- .comment-content -->

            <div class="comment-actions">
                <?php $comments->reply('回复'); ?>
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

        <div class="comments-title">
            <span class="comment-num"><?php $this->commentsNum(_t('暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论')); ?></span>
        </div>

        <?php if($this->allow('comment')): ?>
            <div id="<?php $this->respondId(); ?>" class="respond">
                <div class="cancel-comment-reply">
                    <?php $comments->cancelReply(); ?>
                </div>
                <h4 id="response" class="comment-reply-title">
                    <span>发表评论</span>
                    <small>
                        <span class="response">
                            <?php if($this->user->hasLogin()): ?>
                                <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>(已登录) <a href="<?php $this->options->logoutUrl(); ?>" class="icon-logout"></a>
                            <?php else: ?>
                                你是访客 <a href="<?php $this->options->loginUrl(); ?>" class="icon-login"></a>
                            <?php endif; ?>
                        </span>
                    </small>
                    <?php $comments->cancelReply('取消回复'); ?>
                </h4>
                <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form" role="form">
                    <div class="author-infos guest"><img src="//gravatar.com/avatar/?d=mm&s=100" width="100" class="avatar"></div>
                    <div class="comment-form-main">
                        <div class="comment-textarea-wrapper rippleria-dark" data-rippleria>
                            <p class="comment-form-comment"><label for="comment">评论</label>
                                <textarea id="comment" name="text" onclick='document.getElementById("comment-form-do").style.display="block";' cols="45" rows="8" aria-required="true" required="required" placeholder="发泄你的牢骚,留下你的笔言!"><?php $this->remember('text',false); ?></textarea>
                            </p>
                            <div class="comment-form-toolbar">
                            </div>
                        </div>

                        <?php if(!$this->user->hasLogin()): ?>
                            <div class="comment-form-fields" id="comment-form-do">
                                <p class="comment-form-author rippleria-dark" data-rippleria>
                                    <label for="author">昵称</label> <span class="required">*</span>

                                    <input type="text" name="author" maxlength="12" id="author" placeholder="昵称" value="" required>

                                </p>
                                <p class="comment-form-email rippleria-dark" data-rippleria>
                                    <label for="email">邮箱</label> <span class="required">*</span>

                                    <input type="email" name="mail" id="mail" placeholder="邮箱" value="" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                                </p>
                                <p class="comment-form-url rippleria-dark" data-rippleria>
                                    <label for="url">网站</label>

                                    <input type="url" name="url" id="url" placeholder="网站" value="" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>

                                </p>
                            </div>
                        <?php endif; ?>

                        <p class="form-submit">
                            <button name="submit" type="submit" id="submit" class="submit"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-send"></use></svg></button>
                            <?php $security = $this->widget('Widget_Security'); ?>
                            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
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

<script type="text/javascript">
    function iasNew() {
        try
        {
            var iasCent = jQuery.ias({
                container:  '.comment-list',    //大容器
                item:       '.comment-list-item.depth-1',    //循环容器
                pagination: '.page-navigator li',    //分页容器
                next:       '.next a'    //下一页的class
            });

            iasCent.extension(new IASTriggerExtension({
                text: '加载更多', //此选项为需要点击时的文字
                html: '<div class="iasBtn"><a class="btn" href="javascript:;" role="button" data-no-instant>{text}</a></div>',
                offset: 1 //load多少页后显示加载更多按钮
            }));
            iasCent.extension(new IASSpinnerExtension());    //加载时的图片
            iasCent.extension(new IASNoneLeftExtension({text: "已经没有更多评论了"}));    //到底后显示的文字

            iasCent.on('rendered', function(items) {
                liveTimeGo();
            });
        }
        catch(err) {}
    }
    iasNew();
</script>

<script>
    <?php if(!$this->user->hasLogin()): ?>
    function getCommentCookie(name){
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg))
            return unescape(decodeURI(arr[2]));
        else
            return null;
    }
    function addCommentInputValue(){
        document.getElementById('author').value = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_author');
        document.getElementById('mail').value = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_mail');
        document.getElementById('url').value = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_url');
    }
    addCommentInputValue();
    <?php endif; ?>

    (function () {
        window.TypechoComment = {
            dom : function (id) {
                return document.getElementById(id);
            },
            create : function (tag, attr) {
                var el = document.createElement(tag);
                for (var key in attr) {
                    el.setAttribute(key, attr[key]);
                }
                return el;
            },
            reply : function (cid, coid) {
                var comment = this.dom(cid), parent = comment.parentNode,
                    response = this.dom('<?php echo $this->respondId(); ?>'),
                    input = this.dom('comment-parent'),
                    form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                    textarea = response.getElementsByTagName('textarea')[0];
                if (null == input) {
                    input = this.create('input', {
                        'type' : 'hidden',
                        'name' : 'parent',
                        'id'   : 'comment-parent'
                    });
                    form.appendChild(input);
                }
                input.setAttribute('value', coid);
                if (null == this.dom('comment-form-place-holder')) {
                    var holder = this.create('div', {
                        'id' : 'comment-form-place-holder'
                    });
                    response.parentNode.insertBefore(holder, response);
                }
                comment.appendChild(response);
                this.dom('cancel-comment-reply-link').style.display = '';
                if (null != textarea && 'text' == textarea.name) {
                    textarea.focus();
                }
                return false;
            },
            cancelReply : function () {
                var response = this.dom('<?php echo $this->respondId(); ?>'),
                    holder = this.dom('comment-form-place-holder'),
                    input = this.dom('comment-parent');
                if (null != input) {
                    input.parentNode.removeChild(input);
                }
                if (null == holder) {
                    return true;
                }
                this.dom('cancel-comment-reply-link').style.display = 'none';
                holder.parentNode.insertBefore(response, holder);
                return false;
            }
        };
    })();
</script>
<script type = "text/javascript" data-no-instant>
    (function() {
        var event = document.addEventListener ? {
            add: 'addEventListener',
            focus: 'focus',
            load: 'DOMContentLoaded'
        } : {
            add: 'attachEvent',
            focus: 'onfocus',
            load: 'onload'
        };
        document[event.add](event.load, function() {
            var r = document.getElementById('<?php echo $this->respondId(); ?>');
            if (null != r) {
                var forms = r.getElementsByTagName('form');
                if (forms.length > 0) {
                    var f = forms[0],
                        textarea = f.getElementsByTagName('textarea')[0],
                        added = false;
                    if (null != textarea && 'text' == textarea.name) {
                        textarea[event.add](event.focus, function() {
                            if (!added) {
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = '_';
                                input.value = (function() {
                                    var _a8C5A = //'xr'
                                            '8d0' + //'vI'
                                            'vI' + /* 'mj'//'mj' */ '' + //'P'
                                            '06' + 'd' //'chS'
                                            + //'wo'
                                            '0ef' + '41' //'9G'
                                            + '8c8' //'R'
                                            + //'p1'
                                            'd0' + //'mi'
                                            'mi' + 'baf' //'lu'
                                            + 'c' //'dm'
                                            + //'ED'
                                            '1a9' + //'Lh'
                                            'd9' + '6' //'luM'
                                            + //'xH'
                                            'f1' + //'W'
                                            '2c7' + 'f' //'f'
                                            + //'9'
                                            '9' + //'Nd'
                                            'Nd' + /* '8ys'//'8ys' */ '' + '' ///*'6Yc'*/'6Yc'
                                            + //'H'
                                            '0',
                                        _LceE8M = [
                                            [3, 5],
                                            [16, 18],
                                            [31, 32],
                                            [31, 32],
                                            [31, 33]
                                        ];
                                    for (var i = 0; i < _LceE8M.length; i++) {
                                        _a8C5A = _a8C5A.substring(0, _LceE8M[i][0]) + _a8C5A.substring(_LceE8M[i][1]);
                                    }
                                    return _a8C5A;
                                })();
                                f.appendChild(input);
                                added = true;
                            }
                        });
                    }
                }
            }
        });
    })();
</script><!--</nocompress>-->