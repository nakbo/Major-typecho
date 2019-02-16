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

    public static $bodyType;
    public static $Widget_Archive;
    public static $Widget_Stat;

    public static $formats;
    public static $formatPostAble;
    public static $commonDir = 'layout';

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
        Typecho_Widget::widget('Widget_Stat')->to(self::$Widget_Stat);

        self::$bodyType = self::$Widget_Archive->getArchiveType();

    }

    public function setMajor()
    {
        self::$Major = array(
            "developer"=>"Krait",
            "author"=>"权那他",
            "package"=>"Major",
            "version"=>"2.4",
            "github"=>"https://github.com/kraity/Major",
            "updateTime"=>"1550289600"
        );
    }

    public function setApi()
    {
        self::$api = array(
            "infoMajor" => "https://api.krait.cn/version/Major.json",
            "kraitLibrary" => "https://lib.krait.cn/library/",
            "introMajor" => "https://krait.cn/major.html",
            "headPortrait" => "https://api.krait.cn/api/tencent/headPortrait/",
            "api" => "https://api.krait.cn/"
        );
    }

    public static function getGravatar($mail)
    {
        $gr = Helper::options()->serverGravatar."/".md5($mail)."?s=100&r=G&d=".self::$api['headPortrait'].$mail;
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
        $thisIs = false; /**!self::thisIs("attachment")**/
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


    public static function hotArticles($day = 90,$num = 3,$defaults){
        $db = Typecho_Db::get();
        $sql = $db->select()->from('table.contents')
            ->where('created >= ?', time() - (24 * 60 * 60 * $day))
            ->where('type = ?', 'post')
            ->limit($num)
            ->order('views',Typecho_Db::SORT_DESC);
        $result = $db->fetchAll($sql);
        $returns = "";
        foreach($result as $val){
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
            $returns .= str_replace(array('{permalink}', '{title}', '{views}', '{avatar}'), array($val['permalink'], $val['title'], $val['views'],Major::getGravatar(Major::$mail)), $defaults);
        }
        return $returns;

    }

    public static function reRouter(){
        $validated = false;
        $archiveType = self::$bodyType;
        $archiveSlug = self::$Widget_Archive->getArchiveSlug();
        $themeDir = self::$Widget_Archive->getThemeDir();
        $themeFileNull = '';
        $dirMid = self::$commonDir.'/layout-';

        //~ 首先找具体路径, 比如 category/default.php
        if (!empty($archiveSlug)) {
            $themeFile = $archiveType . '/' . $archiveSlug . '.php';
            if (file_exists($themeDir . $dirMid . $themeFile)) {
                $themeFileNull = $themeFile;
                $validated = true;
            }
        }

        //~ 然后找归档类型路径, 比如 category.php
        if (!$validated) {
            $themeFile = $archiveType . '.php';
            if (file_exists($themeDir . $dirMid . $themeFile)) {
                $themeFileNull = $themeFile;
                $validated = true;
            }
        }

        //针对attachment的hook
        if (!$validated && 'attachment' == $archiveType) {
            if (file_exists($themeDir . $dirMid . 'page.php')) {
                $themeFileNull = 'page.php';
                $validated = true;
            } else if (file_exists($themeDir. $dirMid . 'post.php')) {
                $themeFileNull = 'post.php';
                $validated = true;
            }
        }

        //~ 最后找归档路径, 比如 archive.php 或者 single.php
        if (!$validated && 'index' != $archiveType && 'front' != $archiveType) {
            $themeFile = self::$Widget_Archive->_archiveSingle ? 'single.php' : 'archive.php';
            if (file_exists($themeDir . $dirMid . $themeFile)) {
                $themeFileNull = $themeFile;
                $validated = true;
            }
        }

        if (!$validated) {
            $themeFile = 'index.php';
            if (file_exists($themeDir . $dirMid . $themeFile)) {
                $themeFileNull = $themeFile;
                $validated = true;
            }
        }

        /** 文件不存在 */
        if (!$validated) {
            Typecho_Common::error(500);
        }

        /** 输出模板 */
        return  $themeDir . $dirMid . $themeFileNull;

    }

}

new Major();
