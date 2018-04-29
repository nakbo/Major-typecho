<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$newFormat = majors_Plugin::getFormat();

switch ($newFormat){
    case 'status':
        return;
        break;
    case 'chat':
        return;
        break;
    case 'quote':
        return;
        break;
    default:
}
?>

<?php $this->need('header.php'); ?>

    <div class="majors-post-articles" id="main" role="main">
        <div class="container">
            <article class="major-article article-shadow content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-header">
                    <div class="article-title">
                        <h2><?php $this->sticky(); $this->title(); ?></h2>
                    </div>
                </div>
                <div class="post-content major-text" data-wow-offset="10" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>
            </article>
        </div>
    </div>

<?php //include 'res/PostFooter.php'; ?>

    <nav class="toc" id="toc">
        <ul id="posTitles"></ul>
        <svg class="toc-marker" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
            <path stroke="#444" stroke-width="3" fill="transparent" stroke-dasharray="0, 0, 0, 1000" stroke-linecap="round" stroke-linejoin="round" transform="translate(-0.5, -0.5)" />
        </svg>
    </nav>

    <div class="comment-here">
        <div class="container">
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
    <script type="text/javascript">
        $(window).ready(function(){
            function setPostTitle(m){var h=$(m);for(i=0,len=h.length;i<len;i++){$(m)[i].className='posTitle'}}setPostTitle(".post-content>h2,.post-content>h3,.post-content>h4,.post-content>h5");var tables=$(".posTitle");for(i=0,len=tables.length;i<len;i++){tables[i].id="posTitle-"+i}var posTitle="";var iu=0;for(i=0,len=tables.length;i<len;i++){tables[i].id="posTitle-"+i;var h,hh;var name=tables.get(i).tagName;if(i==0){hh=0}else{var names=tables.get(i-1).tagName;switch(names){case'H2':hh=2;break;case'H3':hh=3;break;case'H4':hh=4;break;case'H5':hh=5;break}}switch(name){case'H2':h=2;break;case'H3':h=3;break;case'H4':h=4;break;case'H5':h=5;break}var pos='<li><a href="#posTitle-'+i+'">'+tables[i].innerHTML+'</a></li>';if(i==0){posTitle+=pos}else if(h==hh){posTitle+=pos}else if(h>hh){posTitle+='<ul>'+pos;iu++}else if(h<hh){posTitle+='</ul>'+pos;iu--}}for(var i=0;i<iu;i++){posTitle+="</ul>"}document.getElementById("posTitles").innerHTML=posTitle;var b,c;var group=$("#main");$(window).scroll(function(){b=$(this).scrollTop();c=group.offset().top;var toc=document.getElementById('toc');if(b>c){$('#toc').addClass('is-toc')}else{$('#toc').removeClass('is-toc')}});
            function tocs(){var toc=document.querySelector('.toc');var tocPath=document.querySelector('.toc-marker path');var TOP_MARGIN=0.1,BOTTOM_MARGIN=0.2;var pathLength;window.addEventListener('resize',drawPath,false);window.addEventListener('scroll',sync,false);drawPath();function drawPath(){tocItems=[].slice.call(toc.querySelectorAll('li'));tocItems=tocItems.map(function(item){var anchor=item.querySelector('a');var target=document.getElementById(anchor.getAttribute('href').slice(1));return{listItem:item,anchor:anchor,target:target}});tocItems=tocItems.filter(function(item){return!!item.target});var path=[];var pathIndent;tocItems.forEach(function(item,i){var x=item.anchor.offsetLeft-5,y=item.anchor.offsetTop,height=item.anchor.offsetHeight;if(i===0){path.push('M',x,y,'L',x,y+height);item.pathStart=0}else{if(pathIndent!==x)path.push('L',pathIndent,y);path.push('L',x,y);tocPath.setAttribute('d',path.join(' '));item.pathStart=tocPath.getTotalLength()||0;path.push('L',x,y+height)}pathIndent=x;tocPath.setAttribute('d',path.join(' '));item.pathEnd=tocPath.getTotalLength()});pathLength=tocPath.getTotalLength();sync()}function sync(){var windowHeight=window.innerHeight;var pathStart=pathLength,pathEnd=0;var visibleItems=0;tocItems.forEach(function(item){var targetBounds=item.target.getBoundingClientRect();if(targetBounds.bottom>windowHeight*TOP_MARGIN&&targetBounds.top<windowHeight*(1-BOTTOM_MARGIN)){pathStart=Math.min(item.pathStart,pathStart);pathEnd=Math.max(item.pathEnd,pathEnd);visibleItems+=1;item.listItem.classList.add('visible')}else{item.listItem.classList.remove('visible')}});if(visibleItems>0&&pathStart<pathEnd){tocPath.setAttribute('stroke-dashoffset','1');tocPath.setAttribute('stroke-dasharray','1, '+pathStart+', '+(pathEnd-pathStart)+', '+pathLength);tocPath.setAttribute('opacity',1)}else{tocPath.setAttribute('opacity',0)}}}
        tocs();
        });
    </script>
<?php $this->need('footer.php'); ?>