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

    public static $Widget_Archive;
    public static $archiveType;

    public static $formats;
    public static $formatPostAble;

    public function __construct()
    {
        self::personal();
        self::setMajor();
        self::setApi();
        self::formats();
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
        Typecho_Widget::widget('Widget_Archive')->to(self::$Widget_Archive);
        self::$archiveType = self::$Widget_Archive->_archiveType;
    }

    public static function prints($data){
        echo $data;
    }

    public function setMajor()
    {
        self::$Major = array(
            "developer"=>"Krait",
            "author"=>"权那他",
            "package"=>"Major",
            "version"=>"2.2",
            "github"=>"https://github.com/kraity/Major",
            "updateTime"=>"1541308952"
        );
    }

    public function setApi()
    {
        self::$api = array(
            "infoMajor" => "https://api.krait.cn/version/Major.json",
            "kraitLibrary" => "https://lib.krait.cn/library/",
            "introMajor" => "https://krait.cn/major.html",
            "headimg_dl" => "https://api.krait.cn/api/headimg_dl/",
            "api" => "https://api.krait.cn/"
        );
    }

    public static function getGravatar($mail)
    {
        $gr = Helper::options()->serverGravatar."/".md5($mail)."?s=100&r=G&d=".self::$api['headimg_dl'].$mail;
        $type = array(
            "gr" => $gr,
            "ma" => Helper::options()->masterImgUrl
        );
        return $type[Helper::options()->useGravatar];
    }

    public function formats(){
        self::$formats = array(
            "post" => "text",
            "quote" => "quote",
            "aside" => "image",
            "chat" => "chat",
            "status" => "status",
            "gallery" => "gallery",
            "video" => "video",
            "link" => "link"
        );

        self::$formatPostAble = array(
            "post" => true,
            "quote" => false,
            "aside" => true,
            "chat" => false,
            "status" => false,
            "gallery" => true,
            "video" => true,
            "link" => true
        );

    }

    public static function postAble($newFormat){
        $thisIs = false;/**!self::thisIs("attachment")**/
        if(self::$Widget_Archive->is("attachment") || !self::$formatPostAble[$newFormat]){
            $thisIs = true;
        }
        return $thisIs;
    }

    public static function majorHeaderAble($currentPage){
        $thisIs = false;
        if(self::$Widget_Archive->is("index") && $currentPage <2){
            $thisIs = true;
        }
        return $thisIs;
    }

    public static function footerInfoAble($currentPage){
        return self::majorHeaderAble($currentPage);
    }
}

new \Major();

