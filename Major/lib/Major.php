<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Major {

    /**
     *
     * Major version.
     *
     * @var string
     */
    public static $majorv = "1.5";

    public static function personal(){
        $db = Typecho_Db::get();
        $query= $db->select('uid','name','screenName','mail','url','group')->from('table.users')->where('uid = ?', 1);
        $result = $db->fetchAll($query);
        return $result[0];
    }

    /**
     * @return string
     */
    public static function getGravatar($mail,$s)
    {
        $secure = "https://secure.gravatar.com/avatar/";
        $dt = "953de4234df55c1c973abb1c1588dc2e";
        $s = "?s=".$s;
        $r = "&r=G";
        $d = "&d=";
        $avatar = $secure.md5($mail).$s.$r.$d.$secure.$dt.$s.$r;
        return $avatar;
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
