<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="post-author">
    <div class="post-author-left">
        <div class="mdui-card-header">
            <img class="mdui-card-header-avatar" src="<?php echo Major::getGravatar($this->author->mail); ?>">
            <div class="mdui-card-header-title"><?php $this->author() ?></div>
            <div class="mdui-card-header-subtitle">作者</div>
        </div>
    </div>
    <div class="post-author-right">
        <ul class="author-tool">

            <li>
                <button class="mdui-btn mdui-btn-icon mdui-ripple" mdui-menu="{target: '#maj-rewards'}">
                    <i class="mdui-icon material-icons">attach_money</i>
                </button>
                <div class="mdui-menu" id="maj-rewards">
                    <div id="rewards-box"></div>
                    <script type="text/javascript">
                        function rewardLoad() {
                            var data = [<?php $this->options->rewardJson(); ?>];
                            var str = "";
                            var strmsg = "";
                            for (var i = 0; i < data.length; i++) {
                                strmsg += '<a href=\"#reward-tab'+i+'\" class=\"mdui-ripple\">'+data[i].reward[0].name+'</a>';
                                str += '<div id=\"reward-tab'+i+'\" class=\"mdui-p-a-2\"><img src=\"'+data[i].reward[1].img+'\" class=\"reward-code\"></div>';
                            }
                            document.getElementById("rewards-box").innerHTML = '<div class="mdui-tab" id="rewards-tab">'+strmsg+'</div>'+str;
                            var inst = new mdui.Tab('#rewards-tab');
                        }
                        rewardLoad();
                    </script>
                </div>
            </li>
            <li>
                <button class="mdui-btn mdui-btn-icon mdui-ripple" mdui-menu="{target: '#maj-share'}">
                    <i class="mdui-icon material-icons">share</i>
                </button>
                <ul class="mdui-menu" id="maj-share">
                    <li class="mdui-menu-item" onclick="javascript:shareGo('weibo')"><a href="javascript:;" class="mdui-ripple">分享到 新浪微博</a></li>
                    <li class="mdui-menu-item" onclick="javascript:shareGo('qzone')"><a href="javascript:;" class="mdui-ripple">分享到 QQ空间</a></li>
                    <li class="mdui-menu-item" onclick="javascript:shareGo('facebook')"><a href="javascript:;" class="mdui-ripple">分享到 Facebook</a></li>
                    <li class="mdui-menu-item" onclick="javascript:shareGo('telegram')"><a href="javascript:;" class="mdui-ripple">分享到 Telegram</a></li>
                    <li class="mdui-menu-item" onclick="javascript:shareGo('twitter')"><a href="javascript:;" class="mdui-ripple">分享到 Twitter</a></li>
                    <li class="mdui-menu-item" onclick="javascript:shareGo('google')"><a href="javascript:;" class="mdui-ripple">分享到 Google+</a></li>
                </ul>
                <script>
                    function shareGo(g) {
                        var linkShare=window.location.href;var titleShare=document.title;var screenName=window.bzName;var siteUrl=document.location.protocol+"//"+document.domain;var l=linkShare;
                        switch(g){case"weibo":l="http://service.weibo.com/share/share.php?appkey=&title="+titleShare+"&url="+linkShare+"&pic=&searchPic=false&style=simple";break;case"qzone":l="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+linkShare+"&title="+titleShare+"&site="+siteUrl;break;case"facebook":l="https://www.facebook.com/sharer/sharer.php?u="+linkShare;break;case"telegram":l="https://telegram.me/share/url?url="+linkShare+"&text="+titleShare;break;case"twitter":l="https://twitter.com/intent/tweet?text="+titleShare+"&url="+linkShare+"&via="+screenName;break;case"google":l="https://plus.google.com/share?url="+linkShare;break}
                        window.open(l);
                    }
                </script>
            </li>
        </ul>
    </div>

</div>
