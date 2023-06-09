<?php 
    $mysqli=mysqli_connect("localhost", "root", "", 'test'); 
    if ($mysqli->connect_errno) exit('Ошибка соединения с БД');

    // Получим данные с формы
    $img_nameToDelete=$_POST['img_nameToDelete'];
    $img_nameToDelete=trim($img_nameToDelete);
    $query = "DELETE FROM `image` WHERE `name` = '$img_nameToDelete' ";
    $success = $mysqli->query($query);
    $files = scandir('./img', SCANDIR_SORT_DESCENDING);

    // удаление из папки
    echo $img_nameToDelete;
    foreach ($files as $key => $value) {
        if ($value==$img_nameToDelete) {
            unlink('./img/'.$img_nameToDelete);
        }
    }
    header("Location: index.php"); 
 

?>
