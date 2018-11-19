<?php
	
	function append()
	{
		$db = connectionToTheDatabase();
		if (isset($_POST['append'])) {
			if (!empty($_POST['caption']) && !empty($_POST['description']) && !empty($_POST['date'])) {
				$caption = $_POST['caption'];
				$description = $_POST['description'];
				$date = $_POST['date'];

				if (!empty($_FILES['picture']['name'])) {
					$path = '../img/';
					$tmp_path = 'tmp/';
					$types = array('image/gif', 'image/png', 'image/jpeg');
					$size = 1024000; // 1024000


						
					$ext = array_pop(explode('.',$_FILES['picture']['name']));
		  		$_FILES['picture']['name'] = date('d.m.Y').'.'.time().'.'.$ext;
		  		
		  		if (!in_array($_FILES['picture']['type'], $types)) {
		  			return '<div class="alert alert-danger" role="alert">Запрещённый тип файла.</div>';
		  		}
		  		
		  		if ($_FILES['picture']['size'] > $size) {
		  			return '<div class="alert alert-danger" role="alert">Слишком большой размер файла.</div>';
		  		}
		  		
		 			if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])) {
		  			return '<div class="alert alert-danger" role="alert">Что-то пошло не так</div>';
		  		} else {
		 				$mes = '<div class="alert alert-success" role="alert">Загрузка удачна</div>';
		  		}

					$sql = 'INSERT INTO news (picture, caption, description, date) VALUES(:picture, :caption, :description, :date)'; 
					$picture = 'img/'.$_FILES['picture']['name'];

					$data = $db->prepare($sql);
					$data->bindParam(':picture', $picture, PDO::PARAM_STR);
					$data->bindParam(':caption', $caption, PDO::PARAM_STR);
					$data->bindParam(':description', $description, PDO::PARAM_STR);
					$data->bindParam(':date', $date);
					$res = $data->execute();
	  		} else {
	  			$sql = 'INSERT INTO news (caption, description, date) VALUES(:caption, :description, :date)';
					$picture = 'img/'.$_FILES['picture']['name'];

					$data = $db->prepare($sql);
					$data->bindParam(':caption', $caption, PDO::PARAM_STR);
					$data->bindParam(':description', $description, PDO::PARAM_STR);
					$data->bindParam(':date', $date);
					$res = $data->execute();	
	  		}

	  		if ($res) {
					return '<div class="alert alert-success" role="alert">Вы успешно отправили данные!</div>';
				} else {
					return '<div class="alert alert-danger" role="alert">Ошибка!</div>';
				}
			}	
		} 
	}