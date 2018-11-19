<?php 
    $dateS = $dataId['date'];
    $dateS = explode('-', $dateS);
    list($year, $month, $day) = $dateS;
?>
<?php require_once ROOT.'/views/layouts/header.php'; ?>

    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <?php if (isset($_SESSION['session_username'])): ?>
                                <h1 class="title" style="font-family: Arial;">Добро пожаловать, <span> <?=$_SESSION['session_username']; ?> </span>!</h1>
                                <p><a href="/logout/" class="color-red">Выйти</a> из системы...</p>
                            <?php else: ?>
                                <h1 class="title">Blog</h1>
                                <p>Blog with right sidebar</p>
                            <?php endif; ?>
                        </div>                                                                                
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#page-breadcrumb-->

    <section id="blog-details" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                            <div class="single-blog blog-details two-column">
                                <div class="post-thumb">
                                    <a href="#"><img src="<?=$dataId['picture']; ?>" class="img-responsive" alt=""></a>
                                    <div class="post-overlay">
                                        <span class="uppercase"><a href="#"><?=date("d", mktime(0, 0, 0, $month, $day, $year)); ?> <br><small><?=date("M", mktime(0, 0, 0, $month, $day, $year)); ?></small></a></span>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="#"><?=$dataId['caption']; ?></a></h2>
                                    <h3 class="post-author"><a href="#">Posted by micron News</a></h3>
                                    <p><?=$dataId['description']; ?></p>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a href="#"><i class="fa fa-tag"></i>Creative</a></li>
                                            <?php if (exists($_SESSION['session_username'].'-'.$dataId['id'])): ?>
                                                <li id="tutorial-<?=$dataId['id']; ?>">
                                                    <input type="hidden" id="likes-<?=$dataId['id']; ?>" value="<?=$dataId['love']; ?>">
                                                    <a>
                                                        <span class="btn-likes"><i title="Unlike" class="fa fa-heart unlike" onclick="addLikes(<?=$dataId['id']; ?>,'unlike')"></i></span>
                                                        <span class="label-likes"><?=$dataId['love']; ?></span> 
                                                        <span>Love</span>
                                                    </a>
                                                </li>
                                            <?php elseif (isset($_SESSION['session_username']) && !exists($_SESSION['session_username'].'-'.$dataId['id'])): ?>
                                                <li id="tutorial-<?=$dataId['id']; ?>">
                                                    <input type="hidden" id="likes-<?=$dataId['id']; ?>" value="<?=$dataId['love']; ?>">
                                                    <a>
                                                        <span class="btn-likes"><i class="fa fa-heart" onclick="addLikes(<?=$dataId['id']; ?>,'like')"></i></span>
                                                        <span class="label-likes"><?=$dataId['love']; ?></span> 
                                                        <span>Love</span>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a>
                                                        <span><i class="fa fa-heart"></i></span>
                                                        <span class="label-likes"><?=$dataId['love']; ?></span> 
                                                        <span>Love</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <li><a href="#"><i class="fa fa-comments"></i><?=countComment($dataId['id']); ?> Comments</a></li>
                                        </ul>
                                    </div>
                                    <div class="blog-share">
                                        <span class='st_facebook_hcount'></span>
                                        <span class='st_twitter_hcount'></span>
                                        <span class='st_linkedin_hcount'></span>
                                        <span class='st_pinterest_hcount'></span>
                                        <span class='st_email_hcount'></span>
                                    </div>
                                    <div class="author-profile padding">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <img src="template/images/blog/02_photo/no_photo.jpg" alt="">
                                            </div>
                                            <div class="col-sm-10">
                                                <h3>Rodrix Hasel</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliq Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                                <span>Website:<a href="www.jooomshaper.com"> www.jooomshaper.com</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="response-area">
                                    <h2 class="bold">Comments</h2>
                                    <form id="main-contact-form" name="comment_form" method="post">
                                        <input type="hidden" name="itemID" id="itemID" value="<?=$dataId['id'] ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" id="comment_email" class="form-control" required="required" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="comment_content" id="message" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
                                        </div>                        
                                        <div class="form-group">
                                            <input type="hidden" name="comment_id" id="comment_id" value="0" />
                                            <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                                        </div>
                                    </form>
                                    <span id="comment_message"></span>
                                    <ul class="media-list">
                                        <li class="media" id="display_comment"></li>
                                    </ul>                   
                                </div><!--/Response-area-->
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item  recent">
                            <h3>Comments</h3>
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#"><img src="images/portfolio/project1.jpg" alt=""></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit,</a></h4>
                                    <p>posted on  07 March 2014</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#"><img src="images/portfolio/project2.jpg" alt=""></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit,</a></h4>
                                    <p>posted on  07 March 2014</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#"><img src="images/portfolio/project3.jpg" alt=""></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit,</a></h4>
                                    <p>posted on  07 March 2014</p>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-item categories">
                            <h3>Categories</h3>
                            <ul class="nav navbar-stacked">
                                <li><a href="#">Lorem ipsum<span class="pull-right">(1)</span></a></li>
                                <li class="active"><a href="#">Dolor sit amet<span class="pull-right">(8)</span></a></li>
                                <li><a href="#">Adipisicing elit<span class="pull-right">(4)</span></a></li>
                                <li><a href="#">Sed do<span class="pull-right">(9)</span></a></li>
                                <li><a href="#">Eiusmod<span class="pull-right">(3)</span></a></li>
                                <li><a href="#">Mockup<span class="pull-right">(4)</span></a></li>
                                <li><a href="#">Ut enim ad minim <span class="pull-right">(2)</span></a></li>
                                <li><a href="#">Veniam, quis nostrud <span class="pull-right">(8)</span></a></li>
                            </ul>
                        </div>
                        <div class="sidebar-item tag-cloud">
                            <h3>Tag Cloud</h3>
                            <ul class="nav nav-pills">
                                <li><a href="#">Corporate</a></li>
                                <li><a href="#">Joomla</a></li>
                                <li><a href="#">Abstract</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Product</a></li>
                            </ul>
                        </div>
                        <div class="sidebar-item popular">
                            <h3>Latest Photos</h3>
                            <ul class="gallery">
                                <li><a href="#"><img src="images/portfolio/popular1.jpg" alt=""></a></li>
                                <li><a href="#"><img src="images/portfolio/popular2.jpg" alt=""></a></li>
                                <li><a href="#"><img src="images/portfolio/popular3.jpg" alt=""></a></li>
                                <li><a href="#"><img src="images/portfolio/popular4.jpg" alt=""></a></li>
                                <li><a href="#"><img src="images/portfolio/popular5.jpg" alt=""></a></li>
                                <li><a href="#"><img src="images/portfolio/popular1.jpg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#blog-->


<?php require_once ROOT.'/views/layouts/footer.php'; ?>