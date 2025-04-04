<?php
ini_set("display","1");

require 'DB.php';

if(isset($_POST['upload']))
{
    $name = $POST['name'];

    $targetDir = "img/";
    $targetFIle = $targetDir . basename($_FILES['image']['name']);
    $type = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));
    $suppoerted = ['image/jpg', 'image/jpeg', 'image/png', ];


    if(!in_array(mime_content_type($_FILES['image']["tmp_name"]), $suppoerted))
    {
        echo "not correct type";
        exit();
    }
    
    if(file_exists($targetFIle))

    {   
        echo"File already exists";
        exit();
    }

    if($_FILES['image']['size'] > 3000000 || $_FILES['image']['size'] == 0)

    {
        echo "FIles size error";
        exit();
    }

    if(!getimagesize($_FILES["image"]["tmp_name"]))
    {
        echo "File is not an image";
    }


    if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile))
    {
        $db = new DB;

       $query = $db->connect()->prepare("INSERT into tbl_products (name, image) Values ('$name', '$$targetFile')");
       $query-> execute();

       header('Location: ' . $_SERVER['HTTP_REFERER']) ;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Create a New Product</h1>

    <form method="post" action="create.php" enctype="nultipart/form-data">
        <label for="name"> New Product Name</label><br>
        <input type="text" placeholder="Enter a product name.." id="name" name="name">


        <label for="image">Select an image</label><br>
        <input type="file" id="image" accept="image/*"><br>

        <input type="submit" name=" upload" value = "Create">







    </form>
</body>

</html>