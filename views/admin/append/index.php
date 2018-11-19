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
		      <h2>Добавить новость</h2>
		      <?php if (isset($mes)) { echo $mes; } ?>
		      <form name="contact-form" method="post" action="./?action=append" enctype="multipart/form-data">
		      		<div class="form-group">
		      			<input type="file" name="picture">
		      		</div>
		          <div class="form-group">
		              <input type="text" name="caption" class="form-control" required="required" placeholder="Заголовок">
		          </div>
		          <div class="form-group">
		              <textarea name="description" id="message" required="required" class="form-control" rows="8" placeholder="Описание" ></textarea>
		          </div> 
		          <div class="form-group">
		          	<input type="date" name="date" id="publicationDate" placeholder="YYYY-MM-DD" maxlength="10">
		          </div>                      
		          <div class="form-group">
		              <input type="submit" name="append" class="btn btn-submit" value="Добавить">
		          </div>
		          <div class="form-group">
		              <input type="submit" name="cancellation" class="btn btn-submit" value="Отменить" onclick="location = '/admin/'">
		          </div>
		      </form>
		  </div>
	</div>
</div>
<?php require_once '../views/admin/layouts/footer.php'; ?>