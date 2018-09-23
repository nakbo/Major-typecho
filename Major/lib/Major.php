<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Major
{
    public static $Major;
    public static $personal;
    public static $name;
    public static $screenName;
    public static $mail;
    public static $url;
    public static $group;
    public static $activated;
    public static $logged;
    public static $api;
    public static $uid = 1;

    public function __construct()
    {
        self::personal();
        self::setMajor();
        self::setApi();
    }

    public function personal()
    {
        $db = Typecho_Db::get();
        $query= $db->select("uid","name","screenName","mail","url","group","activated","logged")->from('table.users')->where('uid = ?', self::$uid);
        $return = $db->fetchAll($query);
        self::$personal = $return[0];
        $m = $return[0];
        self::$name = $m['name'];
        self::$screenName = $m['screenName'];
        self::$mail = $m['mail'];
        self::$url = $m['url'];
        self::$group = $m['group'];
        self::$activated = $m['activated'];
        self::$logged = $m['logged'];
    }

    public function setMajor()
    {
        self::$Major = array(
            "developer"=>"Krait",
            "author"=>"权那他",
            "package"=>"Major",
            "version"=>"2.0",
            "updateTime"=>"1537714970"
        );
    }

    public function setApi()
    {
        self::$api = array(
            "infoMajor" => "https://api.krait.cn/version/Major.json",
            "introMajor" => "https://krait.cn/major.html",
            "headimg_dl" => "https://api.krait.cn/api/headimg_dl/",
            "api" => "https://api.krait.cn/"
        );
    }

    public static function getGravatar($mail)
    {
        $secure = Helper::options()->serverGravatar;
        $use = Helper::options()->useGravatar;
        $Img = Helper::options()->masterImgUrl;
        $s = "100";
        if($use == "gr"){
            $secure = $secure."/";
            $s = "?s=".$s;
            $r = "&r=G";
            $d = "&d=";
            $qqUrl = self::$api['headimg_dl'].$mail;
            return $gr = $secure.md5($mail).$s.$r.$d.$qqUrl;
        }else{
            return $Img;
        }
    }

    public static function mdate($time = NULL) {
        $text = '';
        $time -=1;
        $time = $time === NULL || $time > time() ? time() : intval($time);
        $t = time() - $time;
        $y = date('Y', $time)-date('Y', time());
        switch($t){
            case $t < 60 * 60 * 24:
                $text = "It's today";
                break;
            case $t < 60 * 60 * 24 * 30:
                $text = 'Just a few days ago';
                break;
            case $t < 60 * 60 * 24 * 365 && $y==0:
                $text = 'Just a few months ago';
                break;
            default:
                $text = "Just several years ago";
                break;
        }
        return $text;
    }



    public function formats($mat)
    {
        switch ($mat) :
            case "post" :
                //标准 post
                echo 'text';
                break;
            case "quote" :
                //引语 quote
                echo 'quote';
                break;
            case "aside" :
                //日志 aside
                echo 'image';
                break;
            case "chat" :
                //聊天 chat
                echo 'chat';
                break;
            case "status" :
                //状态 status
                echo 'status';
                break;
            case "gallery" :
                //相册 gallery
                echo 'gallery';
                break;
            case "video" :
                //视频 video
                echo "video";
                break;
            case "link" :
                //链接 link
                echo "link";
                break;
            default:
                //其他 post
                echo 'text';
        endswitch;
    }

    public static function getVersion()
    {
        $infoMajor = json_decode(file_get_contents(self::$api['infoMajor']));
        $date = $infoMajor->Major[0]->d;
        $ver = $infoMajor->Major[0]->v;

        if($date > self::$Major['updateTime']){
            echo '<div class="majorPv">你正在使用 <strong>'.self::$Major['version'].'</strong> 版本，'.date("Y-m-d",$date). '更新最新版本为 <strong style="color:#000000;">' .$ver.'</strong><a href="'.self::$api['introMajor'].'"><button type="submit" class="btn btn-warn">前往更新</button></a></div>';
        }else {
            echo '<div class="majorPv">你正在使用最新版 '.self::$Major['version'].'</div>';
        }

        $str=<<<EOT
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript">
	$(function() {
		var Gra1 = $("#useGravatar-ma"),
			Gra0 = $("#useGravatar-gr");
		if(!Gra1.is(":checked")) {
			var Grat = $("#typecho-option-item-masterImgUrl-1");
			Grat.attr("style","color:#999")
			.find("input").attr("disabled","disabled");
			Gra1.click(function() {
				Grat.removeAttr("style")
				.find("input").removeAttr("disabled");
			});
			Gra0.click(function() {
				Grat.attr("style","color:#999")
				.find("input").attr("disabled","disabled");
			});
		}
	});
	</script>       
        
<style>
   .majorPv{
     font-family:'Microsoft Yahei', sans-serif
   }
   .majorPv a {
      color:black;
   }
   .majorPv .btn {
    padding: 0 7px;
    height: 20px;
    margin-left: 10px;
    font-size: 10px;
    margin-top: -7px;
   }
</style>
EOT;
        echo $str;
    }


}

new \Major();

