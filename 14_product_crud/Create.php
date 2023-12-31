<?php

require_once "functions.php";

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$pdo-> setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// echo'<pre>';
// var_dump($_FILES);
// echo'</pre>';

// echo'<pre>';
// var_dump($_POST);
// echo'</pre>';



$errors = [];

$title = '';
$description = '';
$price = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $date = date('Y-m-d H:i:s');


      $image = $_FILES['image'] ?? null;
      $imagePath = '';
  
      if (!is_dir('images')) {
          mkdir('images');
      }

      if ($image && $image['tmp_name']) {
        $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
        mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'], $imagePath);
    }
        if(!$title)
        {
          $errors [] = 'Product title is requiered';
        }
        if(!$price)
        {
          $errors [] = 'Price title is requiered';
        }
        if(empty($errors)){ 
      $statement = $pdo-> prepare("INSERT INTO products (title, image, description, price, create_date)
                      VALUES(:title, :image, :description, :price, :date)");
      $statement-> bindValue(':title', $title);
      $statement-> bindValue(':image', $imagePath);
      $statement-> bindValue(':description', $description);
      $statement-> bindValue(':price', $price);
      $statement-> bindValue(':date', $date);
      $statement-> execute();
      header('Location: index.php');
        }
      }

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href= "app.css">
            <title>Products CRUD</title>
</head>
<body>
<h1>Create new Products</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Product Image</label>
    <br>
    <input type="file" name="image">
    
  </div>
  <div class="form-group">
    <label>Product Title</label>
    <input type="text" name="title" class="form-control" value= "<?php echo $title?>">
  </div>
  <div class="form-group">
    <label>Product Description</label>
    <textarea class="form-control" name="description"><?php echo $description?></textarea> 
  </div>
  <div class="form-group">
    <label>Product Price</label>
    <input type="number" step=".01" name="price" class="form-control" value= "<?php echo $price?>">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</body>
</html>