<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- start Major -->
<?php if($krait->matAble($this->_currentPage)):?>
<div class="major mat-1 Able">
    <div class="major-personal">
        <div class="major-mat mat-p<?php echo $this->_currentPage;?>">
            <div class="major-toolbar">
                <div class="mdui-toolbar">
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
                                <a onclick="loginGithub()" class="mdui-list-item mdui-ripple" data-no-instant>
                                    <i class="mdui-icon material-icons">fingerprint</i>
                                    <span>登录</span>
                                </a>
                            </li>
                            <li>
                                <a onclick="loginGithub()" class="mdui-list-item mdui-ripple" data-no-instant>
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
                    <img src="<?php echo $krait->getGravatar($krait->personal['mail']); ?>" alt=""/>
                </div>
                <div class="major-info">
                    <div class="info-name">
                        <h4 class="screenName" id="major-bloggerName">
                            <?php _e($krait->personal['screenName']); ?>
                        </h4>
                        <div class="info-qr">
                            <button class="info-btn" mdui-menu="{target: '#social-qr'}">
                                <i class="icon iconfont icon-qrcode"></i>
                            </button>
                            <div class="mdui-menu social-box maj-shadow" id="social-qr">
                                <div class="info-qrt">
                                    <div class="info-qr-img">
                                        <div id="qrcode"></div>
                                    </div>
                                    <div class="info-qr-text">扫描我分享给朋友</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-des">
                        <div class="major-master-Gx">
                            <p><?php $this->options->bloggerGx(); ?></p>
                        </div>
                    </div>
                    <div class="info-bot">
                        <div class="mdui-tab" id="master-tab">
                            <a href="#mat-activity-1">
                                <i class="mdui-icon material-icons">linear_scale</i>
                            </a>
                            <a href="#mat-activity-2">
                                <i class="mdui-icon material-icons">timeline</i>
                            </a>
                            <a href="#mat-activity-3">
                                <i class="mdui-icon material-icons">sort</i>
                            </a>
                        </div>
                        <div class="bot-console"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- major end -->
</div>
<!-- ends Major -->
<?php else: include 'adapter/adapter_author.php'; ?>
<?php endif;?>

<div id="mat-activity"></div>
<script type="text/javascript">
    (function () {
        let activityLayout =
            "<div id=\"mat-activity-1\"></div>\n" +
            "<div id=\"mat-activity-2\"></div>\n" +
            "<div id=\"mat-activity-3\"></div>";
        document.getElementById("mat-activity").innerHTML = activityLayout;
        var inst = new mdui.Tab('#master-tab');
        jQuery('#qrcode').qrcode({
            width: 200,
            height: 200,
            text: window.personal.interactive.url.site
        });
    })();
</script>
