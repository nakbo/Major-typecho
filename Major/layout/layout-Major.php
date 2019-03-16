<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- start Major -->
<div class="major mat-<?php echo $this->_currentPage;?> <?php _e(Major::matAble($this->options->majorA0));?>">
    <div class="major-personal">
        <div class="major-mat mat-p<?php echo $this->_currentPage;?>">
            <div class="major-toolbar">
                <div class="mdui-toolbar">
                    <button onclick="historyBack();" class="mdui-btn mdui-btn-icon p1-back"><i class="mdui-icon material-icons">arrow_back</i></button>
                    <div class="mdui-toolbar-spacer"></div>
                    <button href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#log-menu'}"><i class="mdui-icon material-icons">hdr_strong</i></button>
                    <ul class="mdui-menu" id="log-menu">
                        <?php if ($this->user->hasLogin()): ?>
                            <li>
                                <a href="<?php $this->options->adminUrl(); ?>" class="mdui-list-item mdui-ripple" data-no-instant>
                                    <i class="mdui-icon material-icons">account_circle</i>
                                    <span>概要</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php $this->options->adminUrl('options-theme.php'); ?>" class="mdui-list-item mdui-ripple" data-no-instant>
                                    <i class="mdui-icon material-icons">settings</i>
                                    <span>设置</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php $this->options->logoutUrl(); ?>" class="mdui-list-item mdui-ripple" data-no-instant>
                                    <i class="mdui-icon material-icons">exit_to_app</i>
                                    <span>登出</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php $this->options->loginUrl(); ?>" class="mdui-list-item mdui-ripple" data-no-instant>
                                    <i class="mdui-icon material-icons">fingerprint</i>
                                    <span>登录</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php $this->options->adminUrl('register.php'); ?>" class="mdui-list-item mdui-ripple" data-no-instant>
                                    <i class="mdui-icon material-icons">person_add</i>
                                    <span>注册</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="mat-master mat-p<?php echo $this->_currentPage;?>">
                <div class="major-master">
                    <img src="<?php echo Major::getGravatar(Major::$personal['mail']); ?>" />
                </div>
                <div class="major-info">
                    <div class="info-name">
                        <h4 class="screenName" id="major-bloggerName">
                            <?php _e(Major::$personal['screenName']); ?>
                        </h4>
                        <div class="info-qr">
                            <button class="info-btn" mdui-menu="{target: '#social-qr'}">
                                <i class="icon iconfont icon-qrcode"></i>
                            </button>
                            <ul class="mdui-menu social-box maj-shadow" id="social-qr">
                                <div class="info-qrt">
                                    <div class="info-qr-img">
                                        <div id="qrcode"></div>
                                    </div>
                                    <div class="info-qr-text">扫描我分享给朋友</div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="info-des">
                        <div class="major-master-Gx">
                            <p><?php $this->options->bloggerGx(); ?></p>
                        </div>
                    </div>
                    <div class="info-bot">
                        <div class="mdui-tab" id="master-tab">
                            <a href="#mat-activity">
                                <i class="mdui-icon material-icons">linear_scale</i>
                            </a>
                            <a href="#mat-activity-2">
                                <i class="mdui-icon material-icons">timeline</i>
                            </a>
                            <a href="#mat-activity-3">
                                <i class="mdui-icon material-icons">sort</i>
                            </a>
                        </div>
                        <style>
                            .info-bot .mdui-icon {
                                text-align: left;
                            }
                        </style>
                        <div class="bot-console">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- major end -->
</div>

<!-- ends Major -->
<div class="major-menu-bar">
    <div class="major-mdui-menu">
        <button mdui-menu="{target: '#menu-drawer'}" class="mdui-btn mdui-btn-icon mdui-ripple">
            <i class="mdui-icon material-icons">menu</i>
        </button>
        <ul class="mdui-menu" id="menu-drawer">
            <li>
                <a class="mdui-list-item mdui-ripple" href="<?php $this->options->siteUrl(); ?>">首页</a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <li>
                    <a class="mdui-list-item mdui-ripple <?php if($this->is('page', $pages->slug)): ?>mdui-list-item-active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<div id="mat-activity"></div>
<div id="mat-activity-2">
    <?php echo Major::hotArticles('90','3','
    <article class="majors-post chat  mdui-ripple" itemscope="" itemtype="http://schema.org/BlogPosting">
        <div class="majors-postContent">
            <div class="major-chats mdui-card-header">
                <img class="mdui-card-header-avatar" src="{avatar}">
                <div class="chats major-text"><p>围观:{views}    <a href="{permalink}">{title}</a></p></div>
            </div>
            <div class="post-contents major-text" itemprop="articleBody">
            </div>
        </div>
    </article>');?>
</div>
<div id="mat-activity-3">
    <article class="majors-post chat  mdui-ripple" itemscope="" itemtype="http://schema.org/BlogPosting">
        <div class="majors-postContent">
            <div class="major-chats mdui-card-header">
                <img class="mdui-card-header-avatar" src="<?php echo Major::getGravatar(Major::$personal['mail']); ?>">
                <div class="chats major-text"><p>围观: <?php majors_Plugin::sumViews(); ?>    作品: <?php Major::$Widget_Stat->publishedPostsNum() ?>    评论: <?php Major::$Widget_Stat->publishedCommentsNum() ?></p></div>
            </div>
            <div class="post-contents major-text" itemprop="articleBody">
            </div>
        </div>
    </article>
</div>

<style>
    #mat-activity-2,
    #mat-activity-3{
        max-width: 720px;
        margin: 4em auto -2em;
    }
</style>
<script>
    var inst = new mdui.Tab('#master-tab');
    jQuery('#qrcode').qrcode({
        width: 200,
        height: 200,
        text: window.personal.interactive.url.site
    });
</script>
