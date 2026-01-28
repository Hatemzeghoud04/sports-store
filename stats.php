<html>
<?php
    include('nav2.php');
    require_once "action/db_connect.php";
    $name = $_SESSION["username"];
    $type = $_SESSION["type"];
    

    if($name!=NULL){
        
       
?>
<?php if($type == 1) : ?>
    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/admin.css">
        <title>Admin Panel</title>
</head>
<body>
<div class='admin-info'>
<?php 
  $cheking_users = mysqli_query($conn,"SELECT * FROM users");
  $users = mysqli_num_rows($cheking_users);
  echo "<p>". $users ."</p>";
?>
<img src='img/icons/users.png'>

</div>
<div class='admin-info'>
<?php 
$products = "SELECT SUM(S + M + L + XL + XXL) AS stock FROM products";
$result1 = $conn->query($products);

if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
        echo "<p>". $row["stock"] ." products";
    }
} else {
    echo "<p>0 products</p>";
};
?>
<img src='img/icons/products.png'>

</div>

<div class='admin-info'>
<?php 
$gain = "SELECT SUM(price) AS gain FROM sales WHERE `state`=3";
$result2 = $conn->query($gain);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        echo "<p>". $row2["gain"] ." DA";
    }
} else {
    echo "<p>0 DA</p>";
};
?>
<img src='img/icons/money.png'>

</div>

    <?php

      $sql2 = "SELECT * FROM products";
      $result2 = $conn-> query($sql2);
      if ($result2-> num_rows > 0) {
          while ($productdata = $result2-> fetch_assoc()) {






            
           $prod = $productdata['name'];
      $sql = "SELECT SUM(`quantity`) AS quantity_Cumule FROM `sales` WHERE product='$prod'";
      $result = $conn-> query($sql);
        while ($sum_row = $result-> fetch_assoc()) {
          $product = [];
        $product = $productdata['name'];
        $perc = $sum_row['quantity_Cumule'];
        $v = array($product, $perc);

        $value[] = $v;
				};


        $theproduct = $productdata['name'];
$cheking_rate = mysqli_query($conn,"SELECT * FROM product_rating WHERE product='$theproduct'");
$users_rate = mysqli_num_rows($cheking_rate);


$sql3 = "SELECT SUM(rating) AS etoiles FROM product_rating WHERE product='$theproduct'";
 $result3 = $conn->query($sql3);
 if ($result3->num_rows > 0 AND $users_rate != 0) {
     while($row = $result3->fetch_assoc()) {
        $sum_rate = $row['etoiles'];
        $note = $sum_rate / $users_rate;
     }
 } else {
     $sum_rate = 0; 
     $note = 0;
 };

$table_rating = array($theproduct, $note);
$rate[] = $table_rating;

      };
    };
    $users=0;
    $nonverified=0;
    $sql3 = "SELECT * FROM users";
      $result3 = $conn-> query($sql3);
      if ($result3-> num_rows > 0) {
          while ($userdata = $result3-> fetch_assoc()) {
            if ($userdata['type'] == 3){
              $users+= 1;
            }elseif ($userdata['type'] == 4){
              $nonverified+= 1;
            }else {
            
            };

          };
          $value2 = " ['verified',     ". $users ."],
          ['non-verified',      ". $nonverified ."]";
        };

     
     ?>
    </table>
    <style>
      .delete {
        
      }
      </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);
      google.charts.setOnLoadCallback(drawChart3);


      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          <?php echo $value2; ?>
          ] );
      
        var options = {
          title: 'Users',
          is3D: false,
          backgroundColor: 'none',
          fontName: 'Raleway',
          fontSize: '10',
          height: '600',
          width: '500',
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }


      function drawChart2() {

var data = new google.visualization.DataTable();
data.addColumn('string', 'Topping');
data.addColumn('number', 'Slices');
data.addRows(
  <?php echo json_encode($value, JSON_NUMERIC_CHECK) ?>
);

var options = {
  title: 'Best sells',
  is3D: false,
  backgroundColor: 'none',
  fontName: 'Raleway',
  fontSize: '20',
  height: '600',
  width: '700',
};

// Instantiate and draw our chart, passing in some options.
var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
chart.draw(data, options);
};


function drawChart3() {

  var data = new google.visualization.DataTable();
data.addColumn('string', 'Topping');
data.addColumn('number', 'Slices');
data.addRows(
  <?php echo json_encode($rate, JSON_NUMERIC_CHECK) ?>
);

var options = {
  title: 'Product_Rate',
  is3D: false,
  backgroundColor: 'none',
  fontName: 'Raleway',
  fontSize: '20',
  height: '600',
  width: '700',
};

// Instantiate and draw our chart, passing in some options.
var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
chart.draw(data, options);
};

    </script>

    
    <div class='chart' id="chart_div"></div>
    <div class='chart' id="chart_div2"></div>
    <div class='chart' id='chart_div3'></div>
  

  </body>
</html>
<?php elseif($type == 3) : ?>
    <script>
            window.location.href = "home.php";
        </script>
<?php endif; ?>

<?php
}
else {
    header('location:error.php');
}
?>