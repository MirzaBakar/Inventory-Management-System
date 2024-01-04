<?php
    include "header.php";
    include "connection.php";
    $t=0;
if (isset($_POST['submit'])) 
{
    $starttime=$_POST['starttime'];
    $endtime=$_POST['endtime'];

$sql = "SELECT * FROM purchase where created_at>='$starttime' && created_at<'$endtime'";
$res = $conn -> query ($sql);
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
        <h1 class="display-4 font-weight-bold mb-4">Welcome to the purchase Report</h1>
        <p class="lead mb-5">Get to know about the data</p>
    </div>
</header>



<div class="container mt-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="starttime" class="form-label">Start (date and time):</label>
                <input type="datetime-local" id="starttime" name="starttime" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="endtime" class="form-label">End (date and time):</label>
                <input type="datetime-local" id="endtime" name="endtime" class="form-control" required>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Generate Report</button>
    </form>

    <button type="button" onclick="window.print();" class="btn btn-secondary mb-4">Generate PDF Report</button>

    <h5 class="mb-3">Purchase Report</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Unit</th>
                <th scope="col">Total Unit Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['submit'])) {
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $t = $t + ($row['unit'] * $row['unitprice']);
                        ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['unit']; ?></td>
                            <td><?php echo $row['unit'] * $row['unitprice']; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>0 results</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <div class="alert alert-info" role="alert">
        <?php echo "Total= " . $t . " RS"; ?>
    </div>
</div>

</body>
</html>
