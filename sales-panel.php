<?php
  include('nav2.php');
  require_once "action/db_connect.php";
  $name = $_SESSION["username"];
  $type = $_SESSION["type"];
  $email = $_SESSION["email"];
  $pan = 0;
    

    if($name!=NULL){
        
       
?>
<html>

<?php if($type == 1) : ?>
    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/admin.css">
        <title>Admin Panel</title>
</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Family Name</th>
            <th>Product</th>
            <th>Picture</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Phone</th>
            <th>Adresse</th>
            <th>Date</th>
            <th>State</th>
            <th>Ajouter</th>
            <th>Valider</th>
            <th>Delete</th>


    </tr>

    <?php
     $sql = "SELECT * FROM sales";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
         while ($saledata = $result-> fetch_assoc()) {
           if ($saledata["state"] == 0){
             $state = '❌';
           }else if ($saledata["state"] == 1){
             $state = '📦';
           }else if ($saledata["state"] == 2){
            $state = "<img src='img/loading.gif' class='thetype'>";

           }else if ($saledata["state"] == 3){
            $state = '✅';

           };
          
             echo "<tr><td>". $saledata["id"] ."
             </td><td class='panelusername'>". $saledata["name"] ."
             </td><td class='panelusername'>". $saledata["fname"] ."
             </td><td>". $saledata["product"] ."
             </td><td class='panelusername'><img class='imgt' src='img/products/". $saledata["pic"] ."'>
             </td><td class='panelusername'>". $saledata["size"] ."
             </td><td>". $saledata["quantity"] ."
             </td><td>". $saledata["price"] ." DA
             </td><td>". $saledata["phone"] ."
             </td><td>". $saledata["adresse"] ."
             </td><td>". $saledata["date"] ."
             </td><td>". $state ."
             </td><td><form method='POST' action='action/state.php'>
             <button class='delete'>Ajouter</button>
             <input type='hidden' name='id' value='". $saledata['id'] ."'>
             <input type='hidden' name='state' value='2'>
          </form>
          </td><td><form method='POST' action='action/state.php'>
          <button class='delete'>Valider</button>
          <input type='hidden' name='id' value='". $saledata['id'] ."'>
          <input type='hidden' name='state' value='3'>

       </form>


         <script>
         function show(x) {
            document.querySelector('.iedit'+x).style.display = 'block';
            document.getElementById('black').style.display = 'block';

        };
         </script>
             </td><td><form method='POST' action='action/state.php'>
             <button class='delete' >Refuser</button>
             <input type='hidden' name='id' value='". $saledata['id'] ."'>
             <input type='hidden' name='quantity' value='". $saledata['quantity'] ."'>

             <input type='hidden' name='state' value='0'>
         </form>
             </td></tr>";
             
         }
         echo "</table><br>";

        
     
      };
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
      };
    };

     
     ?>
    </table>
    <style>
     table {
       top: 500px;
     }
      </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      document.body.style.overflow = "visible";

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(
          <?php echo json_encode($value, JSON_NUMERIC_CHECK) ?>
        );
      
        var options = {
                       width : '1200',
                       backgroundColor: 'none',
                       fontName: 'Raleway',
                       height: '300'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

    </script>

    <div id="chart_div"></div>
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