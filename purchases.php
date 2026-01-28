<?php 
include('nav.php');
$name = $_SESSION["username"];
$type = $_SESSION["type"];
$email = $_SESSION["email"];


    if($name!=NULL){
      $getdata = mysqli_query($conn,"SELECT * FROM users WHERE username='$name'");
      $userdata = mysqli_fetch_array($getdata);
      $myphone = $userdata['phone'];
       
?>
<html>

    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/admin.css">
        <title>Purshases</title>
</head>
<body>

<h1  class='no-print'>
<span lang='en'>My purshases</span><span lang='fr'>Mes achats</span><span lang='ar'>مشترياتي</span>
</h1>

<button class='no-print' id='wl' onclick="window.location.href='wish-list.php'"><span lang='en'>Wishlist</span><span lang='fr'>Liste des souhaits</span><span lang='ar'>قائمة الرغبات</span></button>

<h1  class='print-infos print'>
<?php echo"Name : ". $userdata['name'] ."<br>Family : ". $userdata['fname'] ."<br>"; ?>
</h1>

<img src='img/dark-logo.png' class='print'>
<button onclick="window.print();"  class='no-print print-button'>
<span lang='en'>Print</span><span lang='fr'>Imprimer</span><span lang='ar'>طباعة</span>
    </button>
    <table>
        <tr>
            <th><span lang='en'>Id</span><span lang='fr'></span>Id<span lang='ar'>الأيدي</span></th>
            <th class='no-print'><span lang='en'>Name</span><span lang='fr'>Prénom</span><span lang='ar'>الإسم</span></th>
            <th class='no-print'><span lang='en'>Family Name</span><span lang='fr'>Nom</span><span lang='ar'>اللقب</span></th>
            <th><span lang='en'>Product</span><span lang='fr'>Produit</span><span lang='ar'>المنتوج</span></th>
            <th class='no-print'><span lang='en'>Picture</span><span lang='fr'>Photo</span><span lang='ar'>الصورة</span></th>
            <th><span lang='en'>Size</span><span lang='fr'>Taille</span><span lang='ar'>الحجم</span></th>
            <th><span lang='en'>Quantity</span><span lang='fr'>Quantité</span><span lang='ar'>الكمية</span></th>
            <th><span lang='en'>Price</span><span lang='fr'>Prix</span><span lang='ar'>الثمن</span></th>
            <th class='no-print'><span lang='en'>Phone</span><span lang='fr'>Phone</span><span lang='ar'>الهاتف</span></th>
            <th class='no-print'><span lang='en'>Adresse</span><span lang='fr'>Adresse</span><span lang='ar'>العنوان</span></th>
            <th><span lang='en'>Date</span><span lang='fr'>Date</span><span lang='ar'>التاريخ</span></th>
            <th><span lang='en'>State</span><span lang='fr'>Etat</span><span lang='ar'>الحالة</span></th>
            <th class='no-print'><span lang='en'>Delete</span><span lang='fr'>Supprimer</span><span lang='ar'>حذف</span></th>


    </tr>

    <?php
     $sql = "SELECT * FROM sales WHERE phone='$myphone' and phone!='' ORDER BY id DESC";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
         while ($saledata = $result-> fetch_assoc()) {
           if ($saledata["state"] == 0){
             $state = '❌';
             $rendre = "<span lang='fr'>L'achat a été refusé</span><span lang='ar'>تم رفض الشراء</span><span lang='en'>The purchase has been refused</span>";
           }else if ($saledata["state"] == 1){
             $state = '📦'; 
             $rendre = "<form method='POST' action='action/product-sent.php'>
             <button class='delete' ><span lang='en'>Pass back</span><span lang='fr'>Rendre</span><span lang='ar'>إرجاع</span></button>
             <input type='hidden' name='id' value='". $saledata['id'] ."'>
             <input type='hidden' name='quantity' value='". $saledata['quantity'] ."'>
             <input type='hidden' name='size' value='". $saledata['size'] ."'>
             <input type='hidden' name='product' value='". $saledata['product'] ."'>



             <input type='hidden' name='state' ". $saledata['state'] ."'>
         </form>";
           }else if ($saledata["state"] == 2){
            $state = "<img src='img/loading.gif' class='thetype'>";
            $rendre = "<span lang='en'>This product is already being delivered</span><span lang='fr'>Ce produit est déja en cours de livraison</span><span lang='ar'>سيتم تسليم هذا المنتوج</span>";

           }else if ($saledata["state"] == 3){
            $state = '✅';
            $rendre = "<span lang='en'>This product was delivered</span><span lang='fr'>Ce produit a été livré</span><span lang='ar'>تم تسليم هذا المنتج</span>";

           };
          
             echo "<tr><td>". $saledata["id"] ."
             </td><td class='panelusername no-print'>". $saledata["name"] ."
             </td><td class='panelusername no-print'>". $saledata["fname"] ."
             </td><td>". $saledata["product"] ."
             </td><td class='panelusername no-print'><img class='imgt' src='img/products/". $saledata["pic"] ."'>
             </td><td class='panelusername'>". $saledata["size"] ."
             </td><td>". $saledata["quantity"] ."
             </td><td>". $saledata["price"] ." DA
             </td><td class='no-print'>". $saledata["phone"] ."
             </td><td class='no-print'>". $saledata["adresse"] ."
             </td><td>". $saledata["date"] ."
             </td><td>". $state ."
         


         <script>
         function show(x) {
            document.querySelector('.iedit'+x).style.display = 'block';
            document.getElementById('black').style.display = 'block';

        };
         </script>
             </td><td  class='no-print'>". $rendre ."
             </td></tr>";
             
         }
         $sql5 = "SELECT SUM(price) AS facture FROM sales WHERE phone='$myphone'";
         $result5 = $conn->query($sql5);
         
         if ($result5->num_rows > 0) {
             while($row = $result5->fetch_assoc()) {
                 echo "<p class='print'><span lang='en'>the bill is : </span><span lang='fr'>la facture est de  : </span><span lang='ar'>الفاتورة هي : </span>" . $row["facture"] ." DA</p>";
             }
         } else {
             echo "0";
         };
    



        
     
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
       top: 300px;
     }

     .search {
       display: none;
     }
      </style>

  </body>
</html>
 

<?php
}
else {
    header('location:error.php');
}
?>