<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (isset($_GET['amp'])){include 'res/ampPost.php';return;}?>

<?php $this->need('header.php'); ?>

    <div class="majors-post-articles" id="main" role="main">
        <div class="container">

            <div class="col-md-9 single-post-contents">
                <article class="major-article article-shadow content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
                    <div class="post-header">
                        <div class="article-title">
                            <h3><?php $this->sticky(); $this->title(); ?></h3>

                        </div>
                        <hr>
                    </div>
                    <div class="reMarct post-content post-text major-text" data-wow-offset="10" itemprop="articleBody">
                        <?php $this->content(); ?>
                    </div>
                    <?php include 'res/PostFooter.php'; ?>
                </article>
            </div>

            <div class="col-md-3 sidebar row-u767">
                <?php $this->need('sidebar.php'); ?>
            </div>
        </div>
    </div>
    <div class="comment-here">
        <div class="container">
            <div class="col-md-9 row">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function reMarct() {
            var resizeMax = document.body.clientWidth;
            var objMart = document.getElementsByClassName('reMarct')[0];
            var objMct = document.getElementsByClassName("sidebar")[0];
            if(resizeMax >1330){
                var h = objMct.offsetHeight - 170;
                var hh = objMart.offsetHeight;
                if(h > hh){
                    objMart.style.minHeight = h+"px";
                }
            }else{
                objMart.style.minHeight = "0";
            }
        }
        reMarct();
        $(window).resize(function() {
            reMarct();
        });

    </script>
<?php $this->need('footer.php'); ?>