<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Major {

    /**
     *
     * Major version.
     *
     * @var string
     */
    public static $majorv = "1.8";

    public static function personal(){
        $db = Typecho_Db::get();
        $query= $db->select('uid','name','screenName','mail','url','group')->from('table.users')->where('uid = ?', 1);
        $result = $db->fetchAll($query);
        return $result[0];
    }

    /**
     * @return string
     */
    public static function getGravatar($mail,$s,$u,$t)
    {
        $secure = Typecho_Widget::widget('Widget_Options')->plugin('majors')->serverGravatar;
        switch ($t){
            case 'gr':
                $secure = $secure."/";
                $dt = "953de4234df55c1c973abb1c1588dc2e";
                $s = "?s=".$s;
                $r = "&r=G";
                $d = "&d=";;
                return $gr = $secure.md5($mail).$s.$r.$d.$secure.$dt.$s.$r;

                break;
            case 'ma':
                return $ma = $u;
        }
    }

    public static function artCount($cid){
        $db=Typecho_Db::get ();
        $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
        return mb_strlen($rs['text'], 'UTF-8');
    }

    /**
     * format字符配对
     *
     *@remarks: 用于特殊的判断
     */
    public static function formats($mat)
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

    /**
     * @return string
     */
    public static function getVersion()
    {
        $newVer = file_get_contents("https://krait.cn/majorv.txt");
        if ($newVer > self::$majorv){
            echo '<div class="majorPv">你正在使用 <strong>'.self::$majorv.'</strong> 版本的新Major，最新版本为 <strong style="color:red;">'.$newVer.'</strong><a href="https://krait.cn/major.html"><button type="submit" class="btn btn-warn">前往更新</button></a></div>';
        }else {
            echo '<div class="majorPv">你正在使用最新版的新Major '.self::$majorv.' made by <a href="https://krait.cn">那他</a></div>';
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
     font-size:15px;
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