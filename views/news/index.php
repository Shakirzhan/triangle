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

    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row demo-table">
                        <!-- demo-table -->
                    	<?php $i = 0; ?>
                    	<?php while ($i < count($dataIndex)): ?>
                            <?php 
                                $dateS = $dataIndex[$i]->date;
                                $dateS = explode('-', $dateS);
                                list($year, $month, $day) = $dateS;
                            ?>
                    		<div class="col-sm-12 col-md-12">
                            <div class="single-blog single-column">
                                <div class="post-thumb">
                                    <a href="/?action=item&newsId=<?=$dataIndex[$i]->id; ?>"><img src="<?=$dataIndex[$i]->picture; ?>" class="img-responsive" alt=""></a>
                                    <div class="post-overlay">
                                       <span class="uppercase"><a href="#"><?=date("d", mktime(0, 0, 0, $month, $day, $year)); ?> <br><small><?=date("M", mktime(0, 0, 0, $month, $day, $year)); ?></small></a></span>
                                   </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="/?action=item&newsId=<?=$dataIndex[$i]->id; ?>"><?=$dataIndex[$i]->caption; ?></a></h2>
                                    <h3 class="post-author"><a href="#">Posted by micron News</a></h3>
                                    <p><?=mb_strimwidth($dataIndex[$i]->description, 0, 450, "..."); ?></p>
                                    <a href="#" class="read-more">View More</a>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a href="#"><i class="fa fa-tag"></i>Creative</a></li>
                                            <?php if (exists($_SESSION['session_username'].'-'.$dataIndex[$i]->id)): ?>
                                                <li id="tutorial-<?=$dataIndex[$i]->id; ?>">
                                                    <input type="hidden" id="likes-<?=$dataIndex[$i]->id; ?>" value="<?=$dataIndex[$i]->love; ?>">
                                                    <a>
                                                        <span class="btn-likes"><i title="Unlike" class="fa fa-heart unlike" onclick="addLikes(<?=$dataIndex[$i]->id; ?>,'unlike')"></i></span>
                                                        <span class="label-likes"><?=$dataIndex[$i]->love; ?></span> 
                                                        <span>Love</span>
                                                    </a>
                                                </li>
                                            <?php elseif (isset($_SESSION['session_username']) && !exists($_SESSION['session_username'].'-'.$dataIndex[$i]->id)): ?>
                                                <li id="tutorial-<?=$dataIndex[$i]->id; ?>">
                                                    <input type="hidden" id="likes-<?=$dataIndex[$i]->id; ?>" value="<?=$dataIndex[$i]->love; ?>">
                                                    <a>
                                                        <span class="btn-likes"><i class="fa fa-heart" onclick="addLikes(<?=$dataIndex[$i]->id; ?>,'like')"></i></span>
                                                        <span class="label-likes"><?=$dataIndex[$i]->love; ?></span> 
                                                        <span>Love</span>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a>
                                                        <span><i class="fa fa-heart"></i></span>
                                                        <span class="label-likes"><?=$dataIndex[$i]->love; ?></span> 
                                                        <span>Love</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <li><a href="#"><i class="fa fa-comments"></i><?=countComment($dataIndex[$i]->id); ?> Comments</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                      <?php endwhile; ?>
                    </div>
                    <div class="blog-pagination">
                        <ul class="pagination">
                            <?php if ($curpage != $startpage) { ?>
                                <li class="startpage"><a href="?action=new&page=<?php echo $startpage ?>">left</a></li>
                            <?php } ?>
                            <?php if ($curpage >= 2) { ?>
                                <li><a href="?action=new&page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                            <?php } ?>
                            <li class="active"><a href="?action=new&page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
                            <?php if ($curpage != $endpage) { ?>
                                <li><a href="?action=new&page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                                <li class="endpage"><a href="?action=new&page=<?php echo $endpage ?>">right</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                 </div>
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item  recent">
                            <h3>Comments</h3>
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#"><img src="template/images/portfolio/project1.jpg" alt=""></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit,</a></h4>
                                    <p>posted on  07 March 2014</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#"><img src="template/images/portfolio/project2.jpg" alt=""></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit,</a></h4>
                                    <p>posted on  07 March 2014</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#"><img src="template/images/portfolio/project3.jpg" alt=""></a>
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
                                <li><a href="#"><img src="template/images/portfolio/popular1.jpg" alt=""></a></li>
                                <li><a href="#"><img src="template/images/portfolio/popular2.jpg" alt=""></a></li>
                                <li><a href="#"><img src="template/images/portfolio/popular3.jpg" alt=""></a></li>
                                <li><a href="#"><img src="template/images/portfolio/popular4.jpg" alt=""></a></li>
                                <li><a href="#"><img src="template/images/portfolio/popular5.jpg" alt=""></a></li>
                                <li><a href="#"><img src="template/images/portfolio/popular1.jpg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#blog-->
<?php require_once ROOT.'/views/layouts/footer.php'; ?>