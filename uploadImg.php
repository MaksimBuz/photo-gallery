<?php 

 // Загрузка фаилов
 include './config.php';
 $errors = [];

 if (!empty($_FILES)) {

   for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

     $fileName = $_FILES['files']['name'][$i];

     //  ПРоверка на размер фаила
     if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
       $errors[] = 'Недопустимый размер файла ' . $fileName;
       continue;
     }
     //  ПРоверка на тип фаила
     if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
       $errors[] = 'Недопустимый формат файла ' . $fileName;
       continue;
     }

     //Заносим картинку в бд
     $mysqli = mysqli_connect("localhost", "root", "", 'test');
     if ($mysqli->connect_errno) exit('Ошибка соединения с БД');
     $img_name = $_FILES['files']['name'][$i];
     $query = "SELECT * FROM `image` where `name`='$img_name' ";
     $success = $mysqli->query($query);
     $data = mysqli_fetch_assoc($success);
     if (empty($data)) {
       $query = "INSERT INTO `image` (`id`, `auyhor_img`, `name`, `comment`) VALUES (NULL, 'Dum', '$img_name', '')";
       $success = $mysqli->query($query);
     }

     //Заносим картинку в папку
     $filePath = UPLOAD_DIR . '/' . $_FILES['files']['name'][0];
     move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath);
   }
 }

 header("Location: index.php"); 


?>
