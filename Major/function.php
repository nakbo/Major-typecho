<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
* 
*
*
*/

function widget_author($class,$loca,$screenName,$p,$mail,$url,$social){
    
    $gravatar='https://secure.gravatar.com/avatar/'.md5($mail).'?s=100&r=G&d=mm';
    
    $author = '<aside class="'.$class.'">';
    $author .= '<div class="widget-author-inner">';
    $author .= '<div class="author-avatar row"><img src="'.$gravatar.'" alt="" class="img-circle"></div>';
    $author .='<a href="'.$url.'"><h2 class="author-name">'.$screenName.'</h2></a>';
    
    switch ($loca) {
        case "index":
            $author .= '<h5 class="author-title">'.$p.'</h5><ul class="nav social-nav">'.$social.'</ul>';
            
    }
    
    $author .='</div>';
    $author .='</aside>'; 
    
    echo  $author;
}

function widget_title($describes){
    echo $describes;
}
