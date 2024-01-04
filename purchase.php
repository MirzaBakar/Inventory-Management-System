<?php
    include "header.php";
    include "connection.php";

    if (isset($_POST['submit'])) 
    {
    $name=$_POST['name'];
    $des=$_POST['des'];
    $unit=$_POST['unit'];
    $unitprice=$_POST['unitprice'];

    $insertsql = "INSERT INTO product(name, des, unit, unitprice) VALUES ('$name', '$des', '$unit','$unitprice')";

    $insertsql1 = "INSERT INTO purchase(name, des, unit, unitprice) VALUES ('$name', '$des', '$unit','$unitprice')";
    if ($conn->query($insertsql1) === TRUE) 
    {
      echo "";
    } else 
    {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    if ($conn->query($insertsql) === TRUE) 
    {
      echo "   New record created successfully";
    } else 
    {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
<header class="bg-cover bg-center text-white py-5" style="background-image: url('https://source.unsplash.com/random/1920x1080')">
    <div class="overlay"></div>
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-4">Purchase section</h1>
        <p class="lead mb-5">Fill in the details below</p>
    </div>
</header>
    <div class="container">
        <h5>Purchase</h5>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="mb-3">
    <label for="exampleInputName" class="form-label">Product Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputName">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputDes" class="form-label">Description</label>
    <input type="text" name="des" class="form-control" id="exampleInputDes">
  </div>
  <div class="mb-3">
    <label for="exampleInputUnit" class="form-label">Unit</label>
    <input type="number" name="unit" class="form-control" id="exampleInputUnit">
  </div>
  <div class="mb-3">
    <label for="exampleInputUnitprice" class="form-label">Unit Price</label>
    <input type="number" name="unitprice" class="form-control" id="exampleInputUnitprice">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
    </div>
</body>
</html>