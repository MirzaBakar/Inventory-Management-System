<?php
 include'header.php';
include'connection.php';
$t=0;
if (isset($_POST['submit'])) 
{
    $starttime=$_POST['starttime'];
    $endtime=$_POST['endtime'];

$sql = "SELECT * FROM sales where created_at>='$starttime' && created_at<'$endtime'";
$result = $conn -> query ($sql);
}
?>

<header class="bg-cover bg-center text-white py-5" style="background-image: url('https://source.unsplash.com/random/1920x1080')">
    <div class="overlay"></div>
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-4">Welcome to the Sales Report</h1>
        <p class="lead mb-5">Get to know about the data</p>
    </div>
</header>

<div class="container">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="starttime">Start (date and time):</label>
  <input type="datetime-local" id="starttime" name="starttime">

  <label for="endtime"> End (date and time):</label>
  <input type="datetime-local" id="endtime" name="endtime">
  <input type="submit" name="submit">
</form>
<button type="button" onclick="window.print();return false;">Pdf Report</button>
<div class="container pendingbody">
  <h5>Sales Report</h5>
<table class="table">
  <thead>
    <tr>

      <th scope="col">Name</th>
      <th scope="col">Unit</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
  <?php
   if(isset($_POST['submit']))
   {
          
  $t=0;
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                    $t=$t+$row["totalprice"];

              ?>
    <tr>

      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["sellunit"] ?></td>
      <td><?php echo $row["totalprice"] ?></td>
    </tr>
    <?php 

    }

        } 
        else 
            echo "0 results";

    }
        ?>
  </tbody>
</table>
<?php echo "Total= " . $t ." RS";?>

</div>


<div class="container mt-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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

    <div class="container pendingbody">
        <h5 class="mb-3">Sales Report</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['submit'])) {
                    $t = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $t = $t + $row["totalprice"];
                            ?>
                            <tr>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["sellunit"] ?></td>
                                <td><?php echo $row["totalprice"] ?></td>
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
            <?php echo "Total= " . $t . " Rs"; ?>
        </div>
    </div>
</div>
