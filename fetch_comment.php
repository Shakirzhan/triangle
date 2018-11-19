<?php
	
	require_once('config/db_params.php');
	require_once('components/db.php');
	$db = connectionToTheDatabase();
    if (isset($_POST['itemID'])) { $itemID = $_POST['itemID']; }

	$query = "SELECT * FROM tbl_comment WHERE parent_comment_id = '0' and itemID = $itemID ORDER BY comment_id DESC";
	$statement = $db->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();
	
	$output = '';
	foreach($result as $row) {
 		$output .= '
    	<div class="post-comment">
            <a class="pull-left" href="#">
                <img class="media-object" width="100" src="template/images/blog/02_photo/no_photo.jpg" alt="">
            </a>
            <div class="media-body">
                <span><i class="fa fa-user"></i>Posted by <a href="#">'.$row["comment_sender_name"].'</a></span>
                <p>'.$row["comment"].'</p>
                <ul class="nav navbar-nav post-nav">
                    <li><a><i class="fa fa-clock-o"></i>'.$row["date"].'</a></li>
                    <li><a class="reply" id="'.$row["comment_id"].'"><i class="fa fa-reply"></i>Reply</a></li>
                </ul>
            </div>
        </div>
 		';
 		$output .= get_reply_comment($db, $row["comment_id"]);
 	}

    echo $output;

    function get_reply_comment($db, $parent_id = 0, $marginleft = 0) {
        $query = "SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'";
        $output = '';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $count = $statement->rowCount();
        if ($parent_id == 0) {
        	$marginleft = 0;
        } else {
            $marginleft = $marginleft + 48;
        }
        if ($count > 0) {
            foreach($result as $row) {
               $output .= '
            	<div class="parrent">
                    <ul class="media-list">
                        <li class="post-comment reply">
                            <a class="pull-left" href="#">
                                <img class="media-object" width="50" src="template/images/blog/02_photo/no_photo.jpg" alt="">
                            </a>
                            <div class="media-body">
                                <span><i class="fa fa-user"></i>Posted by <a href="#">'.$row["comment_sender_name"].'</a></span>
                                <p>'.$row["comment"].'</p>
                                <ul class="nav navbar-nav post-nav">
                                    <li><a href="#"><i class="fa fa-clock-o"></i>'.$row["date"].'</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
               ';
                $output .= get_reply_comment($db, $row["comment_id"], $marginleft);
            }
         }
        return $output;
    }