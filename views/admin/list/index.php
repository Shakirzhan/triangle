<?php require_once '../views/admin/layouts/header.php'; ?>		
		<section id="page-breadcrumb" style="margin-bottom: 40px;">
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
		<div class="container">
			<div class="col-md-12 col-sm-12">
				<table class="table--col">
					<tr>
						<th>Дата публикации</th>
						<th>Новость</th>
					</tr>
                    <?php $i = 0; ?>
                    <?php while ($i < count($dataIndex)): ?>
                        <?php 
                            $dateS = $dataIndex[$i]->date;
                            $dateS = explode('-', $dateS);
                            list($year, $month, $day) = $dateS;
                        ?>
                        <tr onclick="location = './?action=edit&itemId=<?=$dataIndex[$i]->id; ?>'">
                            <td><?=date("d.m.Y", mktime(0, 0, 0, $month, $day, $year)); ?></td>
                            <td><?=$dataIndex[$i]->caption; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                        <tr onclick="location = './?action=append'">
                            <td colspan="2">Добавить новость</td>
                        </tr>
				</table>
                <div class="blog-pagination">
                    <ul class="pagination">
                        <?php if ($curpage != $startpage) { ?>
                            <li class="startpage"><a href="?action=list&page=<?php echo $startpage ?>">left</a></li>
                        <?php } ?>
                        <?php if ($curpage >= 2) { ?>
                            <li><a href="?action=list&page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                        <?php } ?>
                        <li class="active"><a href="?action=list&page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
                        <?php if ($curpage != $endpage) { ?>
                            <li><a href="?action=list&page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                            <li class="endpage"><a href="?action=list&page=<?php echo $endpage ?>">right</a></li>
                        <?php } ?>
                    </ul>
                </div>	
			</div>
		</div>
<?php require_once '../views/admin/layouts/footer.php'; ?>