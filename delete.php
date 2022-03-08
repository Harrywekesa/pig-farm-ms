<?php include 'setting/system.php';?>
<?php include 'setting/db.php'; ?>
<?php

if(!$_GET['id'] OR empty($_GET['id']))
{
	header('location: manage-pig.php');
}else
{
	$id = (int)$_GET['id'];
	$query = $db->query("DELETE FROM pigs WHERE id = $id ");
	if($query){
		header('location: manage-pig.php');
	}
}

