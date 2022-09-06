<?php
require 'keydb.php';
if(isset($_POST["submit"])){
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Nieprawidłowy format');
      </script>
      ";
    }
    else if($fileSize > 100000000){
      echo
      "
      <script>
        alert('Plik jest za duży');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'upload/' . $newImageName);
      $query = "INSERT INTO upload VALUES('', '$newImageName')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Dodano plik!');
        document.location.href = 'zdjecia.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html lang="pl">
    <head>
        <meta charset='UTF-8'>
        <link rel="stylesheet" href="css/style.css">
        <title>Panel Sterowania</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&family=Dancing+Script&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <header>
                <div id="head">Panel Sterowania</div>

        </header>
        <article>
            <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                <label for="image">Obraz : </label>
                <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
                <button type = "submit" name = "submit">Wyślij</button>
            </form>
            <a href="data.php">
        </article>
    </body>
</html>