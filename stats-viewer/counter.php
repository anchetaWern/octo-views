<?php
include 'db-config.php';
$db = new Mysqli($host, $user, $password, $db_name); 

$post_title = $_GET['title'];
$date = date('Y-m-d');

$get_post = $db->query("SELECT id FROM tbl_octoblog WHERE title = '$post_title'");
if($get_post->num_rows > 0){
	$post = $get_post->fetch_object();
	$post_id = $post->id;
	echo $post_id;

	$get_post_count = $db->query("SELECT id, views FROM tbl_blogviews WHERE post_id = '$post_id' AND date = '$date'");
	if($get_post_count->num_rows > 0){
		$post_views = $get_post_count->fetch_object();
		$views = (int) $post_views->views;
		$views += 1;
		$db->query("UPDATE tbl_blogviews SET views = '$views' WHERE post_id = '$post_id'");
	}else{
		$db->query("INSERT INTO tbl_blogviews SET post_id = '$post_id', views = 1, date = '$date'");
	}
}else{
	$db->query("INSERT INTO tbl_octoblog SET title = '$post_title'");
	$post_id = $db->insert_id;
	$db->query("INSERT INTO tbl_blogviews SET views = 1, post_id = '$post_id', date = '$date'");
}
