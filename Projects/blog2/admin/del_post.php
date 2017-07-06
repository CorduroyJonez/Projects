<?php 

session_start();

require 'connection.php';

if (!isset($_SESSION['id']))
{
    header("Location: index.php");
}

$id = $_GET['id'];
$sql="DELETE FROM posts WHERE id= :id";
$stmt= $link->prepare($sql);

$stmt->bindParam(':id', $id);


if ($stmt->execute())
{
	header("Location: postlist.php?id=delete");
}

else {
	die("Error");
}

?>