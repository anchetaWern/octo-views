<?php
include 'db-config.php';
$db = new Mysqli($host, $user, $password, $db_name); 

$current_date = date('Y-m-d');
$all_time = $db->query("SELECT title, SUM(views) AS view_count FROM tbl_octoblog 
	LEFT JOIN tbl_blogviews ON tbl_octoblog.id = tbl_blogviews.post_id
	GROUP BY title");
?>
<h1>All time</h1>
<table border="1">
	<thead>
		<tr>
			<th>Post</th>
			<th>Views</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($row = $all_time->fetch_object()){
	?>
		<tr>
			<td><?php echo $row->title; ?></td>
			<td><?php echo $row->view_count; ?></td>
		</tr>
	<?php	
	}
	?>
	</tbody>
</table>

<br/>

<?php
$this_month = $db->query("SELECT title, SUM(views) AS view_count FROM tbl_octoblog 
	LEFT JOIN tbl_blogviews ON tbl_octoblog.id = tbl_blogviews.post_id
WHERE MONTH(date) = MONTH('$current_date')
GROUP BY title, YEAR(DATE) , MONTH(DATE)");
?>

<h1>This month</h1>

<table border="1">
	<thead>
		<tr>
			<th>Post</th>
			<th>Views</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($row = $this_month->fetch_object()){
	?>
		<tr>
			<td><?php echo $row->title; ?></td>
			<td><?php echo $row->view_count; ?></td>
		</tr>
	<?php	
	}
	?>
	</tbody>
</table>

<br/>


<?php
$today = $db->query("SELECT title, SUM(views) AS view_count FROM tbl_octoblog 
	LEFT JOIN tbl_blogviews ON tbl_octoblog.id = tbl_blogviews.post_id
WHERE date = '$current_date'
GROUP BY title");
?>

<h1>Today</h1>

<table border="1">
	<thead>
		<tr>
			<th>Post</th>
			<th>Views</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($row = $today->fetch_object()){
	?>
		<tr>
			<td><?php echo $row->title; ?></td>
			<td><?php echo $row->view_count; ?></td>
		</tr>
	<?php	
	}
	?>
	</tbody>
</table>
