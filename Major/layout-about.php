<?php
/**
 * 个人
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<?php $this->need(Major::$commonDir.'/layout-header.php'); ?>

<?php $this->need(Major::$commonDir.'/layout-Major.php'); ?>

    <div class="abouts">
        <div class="container">
            <article class="major-article content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="activity-social">
                    <div class="show-social">
                        <ul class="social-nav" id="social-nav"></ul>
                    </div>
                    <script type="text/javascript">
                        function socialJsonTr() {
                            var social = "",socialJson = window.personal.interactive.social.json;
                            for(var o in socialJson){
                                var code,
                                    goLink = '<a href=\"'+socialJson[o].u+'\" class=\"sola_'+socialJson[o].s+'\" target="_blank">', goLinks = '</a>';
                                if(typeof socialJson[o].content !== 'undefined' && typeof socialJson[o].img !== 'undefined') {
                                    code = '<ul class="mdui-menu social-box have-img" id="social-' + socialJson[o].s + '"><img src="' + socialJson[o].img + '" class="social-img"/>' + socialJson[o].content + '</ul>';goLink = '';goLinks = '';
                                }else if(typeof socialJson[o].content !== 'undefined'){
                                    code = '<ul class="mdui-menu social-box" id="social-' + socialJson[o].s + '">' + socialJson[o].content + '</ul>';goLink = '';goLinks = '';
                                }else if(typeof socialJson[o].img !== 'undefined'){
                                    code = '<ul class="mdui-menu social-box have-img" id="social-' + socialJson[o].s + '"><img src="' + socialJson[o].img + '" class="social-img"/></ul>';goLink = '';goLinks = '';
                                }else{
                                    code = "";
                                }
                                social =
                                    social+ '<li class=\"social_'+socialJson[o].s+'\" data-no-instant>' + '<button class=\"mdui-textfield-icon mdui-btn mdui-btn-icon" mdui-menu=\"{target: \'#social-'+socialJson[o].s+'\'}">' + goLink+ '<i class=\"icon iconfont icon-'+socialJson[o].s+'\"></i>' + goLinks + '</button>' + code + '</li>';
                            }
                            document.getElementById("social-nav").innerHTML=social;
                        }
                        socialJsonTr();
                        try {
                            document.getElementsByClassName("sola_weibo")[0].setAttribute("data-vbtype","iframe");
                            $(document).ready(function(){$('.sola_weibo').venobox({framewidth: '90%', frameheight: '100vh', border: '0'});});
                        } catch(err) {
                            console.log("Execution of venobox framework error")
                        }
                    </script>
                </div>
                <div class="post-content major-text personal-infor">
                    <?php $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                    $str = preg_replace('#<li><em>(.*?)</em>(.*?)<strong>(.*?)</strong></li>#','<li class="mdui-list-item mdui-ripple"><i class="mdui-list-item-icon mdui-icon material-icons">$1</i><div class="mdui-list-item-content">$3</div></li>',$str);
                    $str = preg_replace('#<ul>#','<ul class="mdui-list mdui-list-dense">', $str);
                    $str = preg_replace('#</ul>#','</ul>', $str);
                    echo $str;?>
                </div>
                <?php $this->need(Major::$commonDir.'/res/layout-showfoot.php'); ?>
            </article>
            <!--?php $this->need('comments.php'); ?-->
        </div>
    </div>
    <div class="comment-here">
        <div class="container">
            <?php $this->need(Major::$commonDir.'/res/layout-comments.php'); ?>
        </div>
    </div>

<?php $this->need(Major::$commonDir.'/layout-footer.php'); ?>