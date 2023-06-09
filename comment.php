<?php 

$mysqli=mysqli_connect("localhost", "root", "", 'test'); 
if ($mysqli->connect_errno) exit('Ошибка соединения с БД');

// Получим данные с формы
$user_comment=$_POST['user_comment'];
$comment_date=$_POST['comment_date'];
$img_nameToDeleteComment=$_POST['img_nameToDeleteComment'];
$img_name=$_POST['img_name'];

// удаление комментария
if (!empty($img_nameToDeleteComment)) {
    $query = "UPDATE `image` SET `comment` = '' WHERE `name`='$img_nameToDeleteComment' ";
    $success = $mysqli->query($query);
}


// Заносим коментарии
$query = "UPDATE `image` SET `comment` = '$user_comment', `date_comment`= '$comment_date' WHERE `name`='$img_name' ";
$success = $mysqli->query($query);

// СОбираем коментарии
$query = "SELECT * FROM `image` ";
$success = $mysqli->query($query);
$data = mysqli_fetch_assoc($success); 

header("Location: index.php"); 
?>

