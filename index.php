<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
  <ul class="auth-menu">
    <li class="auth-menu-item">
      <a href="./login.php">Войти</a>
    </li>
    <li class="auth-menu-item">
      <a href="./register.php">Зарегестрироватся</a>
    </li>
  </ul>

  <!-- СОбираем коментарии -->
  <?php
    $mysqli = mysqli_connect("localhost", "root", "", 'test');
    $query = "SELECT * FROM `image` ";
    $success = $mysqli->query($query);
    $data = mysqli_fetch_assoc($success);
  ?>

    <div class="gallery-wrapper">
  <?php
  // Выводим коментарии и галерею
  while ($row = $success->fetch_array()) {
  ?>
    <div class="gallery-item">
      <div class="gallery-img">
        <ul >
          <li>
            <img src=<?= './img/' . $row['name'] ?> alt="">
          </li>
        </ul>
      </div>
      <div class="gallery-text">
        <p>Автор: <?php echo $row['auyhor_img']; ?></p>
        <p>Название картинки: <?php echo $row['name']; ?></p>
        <p>Комментарий: <?php echo $row['comment']; ?></p>
        <p>Дата: <?php echo $row['date_comment']; ?></p>
      </div>
    </div>

  <?php
  }
  ?>
</div>
  <!-- Загрузка изображения если пользователь вошел -->
  <?php
  if (isset($_COOKIE['auths'])) {
  ?>
    <h2>Загрузить фотку</h2>
    <form method='post' action="./uploadImg.php" enctype="multipart/form-data">
      <input type='file' name="files[]" multiple required ><br>
      <input type='submit' value='Загрузить' class="submit">
    </form>
    <?php

  

    // Вывод ошибок
    ?>
    <?php if (!empty($errors)) : ?>

      <div>
        <ul>
          <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

    <?php endif; ?>

    <!-- Форма для коментариев  -->
    <div class="forms">
    <h2>Добавить комментарий к картинке</h2>
    <form method='post' action="./comment.php">
      <input type='text' name="img_name" placeholder="Название картинки"><br>
      <input type='text' name="user_comment" placeholder="Текст комкомментария"><br>
      <input type="date" name="comment_date"><br>
      <input type='submit' value='Отправить' class="submit">
    </form>


    <!-- Форма для удаления картинки  -->
    <h2>Удалить картинку</h2>
    <form method='post' action="./delete_img.php">
      <input type='text' name="img_nameToDelete" placeholder="Название картинки"><br>
      <input type='submit' value='Отправить' class="submit">
    </form>

    <!-- Форма для удаления картинки  -->
    <h2>Удалить коментарий</h2>
    <form method='post' action="./comment.php">
      <input type='text' name="img_nameToDeleteComment" placeholder="Название картинки"><br>
      <input type='submit' value='Отправить' class="submit">
    </form>
  </div>
  <?php
  }
  ?>
</body>
</html>