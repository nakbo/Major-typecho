/*!
 Theme Name: Major
 Author: 权那他(krait)
 Author URI: https://krait.cn
 Description: 以科学、高端为主,采用兼容性开发!

 */

/*! https://github.com/kraity/Major */

function loginGithub() {
    let iWidth = 360;                          //弹出窗口的宽度;
    let iHeight = 620;                         //弹出窗口的高度;
    let iTop = (window.screen.availHeight - 30 - iHeight) / 2;
    let iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
    window.open('/oauth/github/', '_blank', 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no');
}

function repeated() {
    $('.liveTime').liveTimeAgo({
        translate: {
            'year': '% 年前',
            'years': '% 年前',
            'month': '% 个月前',
            'months': '% 个月前',
            'day': '% 天前',
            'days': '% 天前',
            'hour': '% 小时前',
            'hours': '% 小时前',
            'minute': '% 分钟前',
            'minutes': '% 分钟前',
            'seconds': '几秒钟前',
            'error': '几秒钟前'
        }
    });
    $('.majors-post-articles img').zoomify();
    pangu.spacingElementByClassName("content-wrap");

    let grid = $("#major-grid");
    if (grid.hasClass("major-body-post")
        || grid.hasClass("major-body-page")) {

        let data = window.personal.interactive.reward.json,
            str = "",
            strmsg = "",
            i;
        for (i in data) {
            strmsg += '<a href=\"#reward-tab' + i + '\" class=\"mdui-ripple\">' + data[i].reward[0].name + '</a>';
            str += '<div id=\"reward-tab' + i + '\" class=\"mdui-p-a-2\"><img src=\"' + data[i].reward[1].img + '\" class=\"reward-code\" alt=\"\"></div>';
        }
        document.getElementById("rewards-box").innerHTML = '<div class="mdui-tab" id="rewards-tab">' + strmsg + '</div>' + str;
        let inst = new mdui.Tab('#rewards-tab');

        let articleLastTime = document.getElementById("post-modified").dataset.lasttime,
            timeStamp = new Date().getTime(),
            differentialTimestamp = timeStamp - articleLastTime,
            differTime = Math.ceil(differentialTimestamp / (24 * 60 * 60 * 1000));
        if (differTime >= 180) {
            $.Toast(
                '温馨提示',
                '这是一个最后修改于 ' + differTime + ' 天前的主题，其中的信息可能已经有所发展或是发生改变。',
                "notice", {
                    has_icon: true,
                    has_close_btn: true,
                    fullscreen: false,
                    timeout: 0,
                    sticky: false,
                    has_progress: true,
                    rtl: false
                }
            );
        }

    }
}

function shareGo(g) {
    let linkShare = window.location.href,
        titleShare = document.title,
        screenName = window.personal.identity.name,
        siteUrl = document.location.protocol + "//" + document.domain,
        l = linkShare;
    switch (g) {
        case"weibo":
            l = "http://service.weibo.com/share/share.php?appkey=&title=" + titleShare + "&url=" + linkShare + "&pic=&searchPic=false&style=simple";
            break;
        case"qzone":
            l = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + linkShare + "&title=" + titleShare + "&site=" + siteUrl;
            break;
        case"facebook":
            l = "https://www.facebook.com/sharer/sharer.php?u=" + linkShare;
            break;
        case"telegram":
            l = "https://telegram.me/share/url?url=" + linkShare + "&text=" + titleShare;
            break;
        case"twitter":
            l = "https://twitter.com/intent/tweet?text=" + titleShare + "&url=" + linkShare + "&via=" + screenName;
            break;
        case"google":
            l = "https://plus.google.com/share?url=" + linkShare;
            break
    }
    window.open(l);
}

(function ($) {
    $.fn.UItoTop = function (options) {
        var defaults = {
                min: 200,
                inDelay: 600,
                outDelay: 400,
                containerID: "toTop",
                containerHoverID: "toTopHover",
                scrollSpeed: 1200,
                easingType: "linear"
            },
            settings = $.extend(defaults, options),
            containerIDhash = "#" + settings.containerID,
            containerHoverIDHash = "#" + settings.containerHoverID;
        if (!document.getElementById(settings.containerID)) {
            $("body").append('<a href="#" id="' + settings.containerID + '"></a>')
        }
        $(containerIDhash).hide().on("click.UItoTop", function () {
            $("html, body").animate({
                scrollTop: 0
            }, settings.scrollSpeed, settings.easingType);
            $("#" + settings.containerHoverID, this).stop().animate({
                "opacity": 0
            }, settings.inDelay, settings.easingType);
            return false
        }).prepend(function (n) {
            if (!document.getElementById(settings.containerHoverID)) {
                return '<i id="' + settings.containerHoverID + '" class="mdui-icon material-icons">arrow_upward</i>'
            } else {
                return ""
            }
        }).hover(function () {
            $(containerHoverIDHash, this).stop().animate({
                "opacity": 1
            }, 700, "linear")
        });
        $(window).scroll(function () {
            var sd = $(window).scrollTop();
            if (typeof document.body.style.maxHeight === "undefined") {
                $(containerIDhash).css({
                    "position": "absolute",
                    "top": sd + $(window).height() - 50
                })
            }
            if (sd > settings.min) {
                $(containerIDhash).fadeIn(settings.inDelay)
            } else {
                $(containerIDhash).fadeOut(settings.Outdelay)
            }
        })
    }
})(jQuery);