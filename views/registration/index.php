<?php require_once ROOT.'/views/layouts/header.php'; ?>
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
	<div class="col-md-4 col-sm-12">
		<?php if (!isset($_SESSION['session_username'])): ?>
		  <div class="contact-form bottom">
		      <h2>Регистрация</h2>
		      <?php if (isset($numrows)) { echo $numrows; } ?>
		      <form name="contact-form" method="post" action="/registration/">
		          <div class="form-group">
		              <input type="text" name="username" class="form-control" required="required" placeholder="Login">
		          </div>
		          <div class="form-group">
		              <input type="password" name="password" class="form-control" required="required" placeholder="Password">
		          </div>                       
		          <div class="form-group">
		              <input type="submit" name="register" class="btn btn-submit" value="Зарегистрироваться">
		          </div>
		      </form>
		  </div>
		  <p style="color: #686868;">Уже зарегистрированы? <a href="/login/">Введите имя пользователя</a>!</p>
		<?php endif; ?>
	</div>
</div>
<?php require_once ROOT.'/views/layouts/footer.php'; ?>