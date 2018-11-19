<?php 
    $dateS = $dataId['date'];
    $dateS = explode('-', $dateS);
    list($year, $month, $day) = $dateS;
?>
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
		  <div class="contact-form bottom">
		      <h2>Редактировать новость</h2>
		      <?php if (isset($message)) { echo $message; } ?>
		      <?php if (isset($messageIMG)) { echo $messageIMG; } ?>
		      <form name="contact-form" method="post" action="<?=$uri ?>" enctype="multipart/form-data">
		      		<div class="form-group">
		      			<input type="file" name="picture">
		      		</div>
		          <div class="form-group">
		              <input type="text" name="caption" class="form-control" required="required" placeholder="Заголовок" value="<?=$dataId['caption'] ?>">
		          </div>
		          <div class="form-group">
		              <textarea name="description" id="message" required="required" class="form-control" rows="8" placeholder="Описание" ><?=$dataId['description'] ?></textarea>
		          </div> 
		          <div class="form-group">
		          	<input type="date" name="date" id="publicationDate" placeholder="YYYY-MM-DD" maxlength="10" value="<?=date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)); ?>">
		          </div>                      
		          <div class="form-group">
		              <input type="submit" name="save" class="btn btn-submit" value="Сохранить">
		          </div>
		          <div class="form-group">
		              <input type="submit" name="cancellation" class="btn btn-submit" value="Отменить">
		          </div>
		          <div class="form-group">
		              <input type="submit" name="delete" class="btn btn-submit" value="Удалить">
		          </div>
		      </form>
		  </div>
	</div>
</div>
<?php require_once '../views/admin/layouts/footer.php'; ?>