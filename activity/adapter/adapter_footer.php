<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="post-footer">
    <div class="container">
        <ul class="author-tool">
            <li>
                <button class="mdui-btn mdui-ripple mdui-color-white major-shadow" mdui-menu="{target: '#maj-rewards'}"><i class="mdui-icon ion-plus-circled material-icons">attach_money</i>点击打赏</button>
                <div class="mdui-menu" id="maj-rewards">
                    <div id="rewards-box"></div>
                </div>
            </li>
            <li>
                <button class="mdui-btn mdui-ripple mdui-color-white major-shadow" mdui-menu="{target: '#maj-share'}"><i class="mdui-icon material-icons">share</i>点击分享</button>
                <ul class="mdui-menu" id="maj-share">
                    <li class="mdui-menu-item" onclick="shareGo('weibo')"><a href="javascript:" class="mdui-ripple">分享到 新浪微博</a></li>
                    <li class="mdui-menu-item" onclick="shareGo('qzone')"><a href="javascript:" class="mdui-ripple">分享到 QQ空间</a></li>
                    <li class="mdui-menu-item" onclick="shareGo('facebook')"><a href="javascript:" class="mdui-ripple">分享到 Facebook</a></li>
                    <li class="mdui-menu-item" onclick="shareGo('telegram')"><a href="javascript:" class="mdui-ripple">分享到 Telegram</a></li>
                    <li class="mdui-menu-item" onclick="shareGo('twitter')"><a href="javascript:" class="mdui-ripple">分享到 Twitter</a></li>
                    <li class="mdui-menu-item" onclick="shareGo('google')"><a href="javascript:" class="mdui-ripple">分享到 Google+</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
