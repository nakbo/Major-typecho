<div class="rewards">
    <p class="reward-bg"></p>
    <div class="reward-com">
        <div class="reward-comint">
            <h3 class="reward-title"><span class="reward-urd">加载中...</span><span class="reward-close"></span></h3>
            <div class="reward-ud">
                <div class="reward-intor">
                    <a class="reward-imx"><img class="reward-hg"></a>
                    <p class="reward-ue">加载中...</p>
                    <img class="reward-code">
                </div>
            </div>
            <div class="reward-pt">
                <p class="reward-paybox">
                    <span class="reward-paywar">打赏无悔，概不退款</span>
                </p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function rewardLoad() {
        var rewardJson = [<?php $this->options->rewardJson(); ?>];
        var reward = rewardJson[0];
        document.getElementsByClassName('reward-urd')[0].innerHTML="给"+reward.name+"打赏";
        document.getElementsByClassName('reward-hg')[0].style.src = reward.uImg;
        $(".reward-hg").attr("src",reward.uImg);
        document.getElementsByClassName('reward-ue')[0].innerHTML="收款人:"+reward.name;
        $(".reward-code").attr("src",reward.codeImg);
    }
    rewardLoad();

</script>