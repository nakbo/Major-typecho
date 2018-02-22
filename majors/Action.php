<?php
class majors_Action implements Widget_Interface_Do {

    public function execute() {
        //Do nothing
    }

    public function action(){}

    public function obtainQQ(){
        header("Content-type: text/html; charset=GBK");
        $html = file_get_contents('http://r.pengyou.com/fcg-bin/cgi_get_portrait.fcg?uins='.$_GET["qq"]);
        echo $html;
    }
}