<?php

namespace Krait;
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho_Db,
    Helper,
    Typecho_Common,
    Typecho_Widget;

class Major
{
    public $Major;
    public $personal;
    public $api;
    public $bodyType;
    public $Widget_Archive;
    public $Widget_Stat;
    public $formats;
    public $options;
    public $formatPostAble;

    public $activityDir = 'activity';

    public function __construct()
    {
        $this->options = Helper::options();
        Typecho_Widget::widget('Widget_Archive')->to($this->Widget_Archive);
        Typecho_Widget::widget('Widget_Stat')->to($this->Widget_Stat);
        $this->bodyType = $this->Widget_Archive->getArchiveType();

        $this->personal();
        $this->setMajor();
        $this->setApi();
        $this->formats();
    }

    public function personal()
    {
        $db = Typecho_Db::get();
        $query = $db->select("uid", "name", "screenName", "mail", "url", "group", "activated", "logged")->from('table.users')->where('uid = ?', $this->options->uid);
        $return = $db->fetchAll($query);
        $this->personal = $return[0];
    }

    public function setMajor()
    {
        $this->Major = array(
            "developer" => "Krait",
            "author" => "权那他",
            "package" => "Major",
            "version" => "3.0",
            "github" => "https://github.com/kraity/Major",
            "updateTime" => "1566090000"
        );
    }

    public function setApi()
    {
        $this->api = array(
            "infoMajor" => "https://api.krait.cn/version/Major.json",
            "kraitLibrary" => "https://lib.krait.cn/library/",
            "introMajor" => "https://krait.cn/major.html",
            "headPortrait" => "https://api.krait.cn/api/tencent/headPortrait/",
            "api" => "https://api.krait.cn/"
        );
    }

    public function getGravatar($mail)
    {
        $gr = $this->options->serverGravatar . "/" . md5($mail) . "?s=100&r=G&d=" . $this->api['headPortrait'] . $mail;
        $type = array(
            "gr" => $gr,
            "ma" => $this->options->masterImgUrl
        );
        return $type[$this->options->useGravatar];
    }

    public function getAuthorMeta()
    {
        _e($this->personal['screenName'] . ',' . $this->personal['mail']);
    }

    public function getBodyType()
    {
        _e($this->bodyType);
    }

    public function formats()
    {
        $this->formats = array(
            "post" => "text",
            "quote" => "quote",
            "aside" => "image",
            "chat" => "chat",
            "status" => "status",
            "gallery" => "gallery",
            "video" => "video",
            "link" => "link"
        );

        $this->formatPostAble = array(
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

    public function getBodyClass()
    {
        echo "major-body-" . $this->bodyType . " mdui-loaded mdui-theme-primary-" . $this->options->primaryColor . " mdui-theme-accent-" . Helper::options()->accentColor;
    }

    public function reflectGlobalScript()
    {
        $scriptUrl = array(
            $this->api['kraitLibrary'] . "jquery/2.1.1/jquery.min.js",
            $this->api['kraitLibrary'] . "bootstrap/3.3.7/js/bootstrap.min.js",
            $this->options->libCdnjs . "mdui/0.4.2/js/mdui.min.js",
            $this->options->libCdnjs . "modernizr/2.8.3/modernizr.min.js",
            $this->options->themeUrl . "/res/js/toast.script.js",
            $this->options->libCdnjs . "jquery.qrcode/1.0/jquery.qrcode.min.js",
            $this->options->libCdnjs . "blueimp-md5/2.10.0/js/md5.min.js"
        );
        $scripArray = "";
        foreach ($scriptUrl as $value) {
            $scripArray .= "<script src=\"" . $value . "\"></script>" . "\n";
        }
        echo $scripArray;
    }

    public function reflectGlobalFooterScript()
    {
        $scriptUrl = array(
            $this->options->themeUrl . "/res/plugins/liveTimeAgo/jquery.liveTimeAgo.js",
            $this->options->themeUrl . "/res/plugins/zoomify/zoomify.min.js",
            $this->options->libCdnjs . "pangu/3.3.0/pangu.min.js",
            $this->options->themeUrl . "/res/js/theme.js?v=" . time()
        );
        $scripArray = "";
        foreach ($scriptUrl as $value) {
            $scripArray .= "<script src=\"" . $value . "\"></script>" . "\n";
        }
        echo $scripArray;
    }

    public function reflectGlobalStylesheet()
    {
        $styleUrl = array(
            $this->api['kraitLibrary'] . "bootstrap/3.3.7/css/bootstrap.min.css",
            $this->options->libCdnjs . "mdui/0.4.2/css/mdui.min.css",
            $this->options->themeUrl . "/res/css/style.css?v=" . time(),
            $this->options->libCdnjs . "simple-line-icons/2.4.1/css/simple-line-icons.css",
            $this->options->alicdnAtUrl
        );
        $sheet = "";
        foreach ($styleUrl as $value) {
            $sheet .= "<link href=\"" . $value . "\" rel=\"stylesheet\" type=\"text/css\">" . "\n";
        }
        echo $sheet;
    }

    public function reflectDnsPrefetch()
    {
        $prefetchUrl = array(
            "//cdn.mathjax.org",
            $this->options->siteUrl,
            $this->api['kraitLibrary'],
            $this->options->libCdnjs,
            $this->options->serverGravatar

        );
        $cdnPrefetch = "<meta http-equiv=\"x-dns-prefetch-control\" content=\"on\">" . "\n";
        foreach ($prefetchUrl as $value) {
            $cdnPrefetch .= "<link rel=\"dns-prefetch\" href=\"" . $value . "\" />" . "\n";
        }
        echo $cdnPrefetch;
    }

    public function reflectLayoutImageAble($is)
    {
        $layoutImageAble = function ($is) {
            $useArray = array(
                "0" => "unUsePostContentImg",
                "1" => "usePostContentImg"
            );
            switch ($this->bodyType) {
                case "page":
                case "post":
                    if ($is->fields->thumbUrl && !empty($this->options->useBlock) && in_array('usePostContentImg', $this->options->useBlock)) {
                        return $useArray["1"];
                    }
                    break;
                case "index":
                    return $useArray["0"];
                    break;
                default:
                    return $useArray["0"];
                    break;
            }
            return $useArray["0"];
        };
        echo $layoutImageAble($is);
    }

    public function postAble($newFormat)
    {
        $thisIs = false;
        /**!self::thisIs("attachment")**/
        if ($this->Widget_Archive->is("attachment") || !$this->formatPostAble[isset($newFormat) ? $newFormat : "post"]) {
            $thisIs = true;
        }
        return $thisIs;
    }

    public function majorHeaderAble($currentPage)
    {
        $thisIs = false;
        if ($this->Widget_Archive->is("index") && $currentPage < 2) {
            $thisIs = true;
        }
        return $thisIs;
    }

    public function footerInfoAble($currentPage)
    {
        return self::majorHeaderAble($currentPage);
    }

    public function matAble($currentPage)
    {
        if ($currentPage == 1 && $this->Widget_Archive->is("index")) {
            return true;
        } else {
            return false;
        }
    }

    public function hotArticles($day = 90, $num = 3, $defaults)
    {
        $db = Typecho_Db::get();
        $sql = $db->select()->from('table.contents')
            ->where('created >= ?', time() - (24 * 60 * 60 * $day))
            ->where('type = ?', 'post')
            ->limit($num)
            ->order('views', Typecho_Db::SORT_DESC);
        $result = $db->fetchAll($sql);
        $returns = "";
        foreach ($result as $val) {
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
            $returns .= str_replace(array('{permalink}', '{title}', '{views}', '{avatar}'), array($val['permalink'], $val['title'], $val['views'], Major::getGravatar(Major::$personal['mail'])), $defaults);
        }
        return $returns;

    }

    public function fields($cid, $type)
    {
        $db = Typecho_Db::get();
        $sql = $db->select()->from('table.fields')
            ->where('table.fields.cid = ?', $cid)
            ->where('table.fields.name = ?', $type)
            ->limit(1);
        $fields = $db->fetchAll($sql);
        if ($fields) {
            return $fields[0]['str_value'];
        } else {
            return "";
        }
    }

    public function reRouter()
    {
        $validated = false;
        $archiveType = $this->bodyType;
        $archiveSlug = $this->Widget_Archive->getArchiveSlug();
        $themeDir = $this->Widget_Archive->getThemeDir();
        $themeFileNull = '';
        $dirMid = $this->activityDir . '/activity_';

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
            } else if (file_exists($themeDir . $dirMid . 'post.php')) {
                $themeFileNull = 'post.php';
                $validated = true;
            }
        }

        //~ 最后找归档路径, 比如 archive.php 或者 single.php
        if (!$validated && 'index' != $archiveType && 'front' != $archiveType) {
            $themeFile = $this->Widget_Archive->_archiveSingle ? 'single.php' : 'archive.php';
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

        /** INCLUDE模板 */
        return $themeDir . $dirMid . $themeFileNull;

    }

}
