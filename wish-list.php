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

<h1>
<span lang='en'>My wishlist</span><span lang='fr'>Ma liste des souhaits</span><span lang='ar'>قائمة رغباتي</span></h1>


    <table>
        <tr>
        <th><span lang='en'>Id</span><span lang='fr'></span>Id<span lang='ar'>الأيدي</span></th>
        <th><span lang='en'>Name</span><span lang='fr'>Prénom</span><span lang='ar'>الإسم</span></th>
        <th><span lang='en'>Family Name</span><span lang='fr'>Nom</span><span lang='ar'>اللقب</span></th>
        <th><span lang='en'>Product</span><span lang='fr'>Produit</span><span lang='ar'>المنتوج</span></th>
        <th><span lang='en'>Picture</span><span lang='fr'>Photo</span><span lang='ar'>الصورة</span></th>
        <th><span lang='en'>Price</span><span lang='fr'>Prix</span><span lang='ar'>الثمن</span></th>
        <th><span lang='en'>Date</span><span lang='fr'>Date</span><span lang='ar'>التاريخ</span></th>
        <th><span lang='en'>Delete</span><span lang='fr'>Supprimer</span><span lang='ar'>حذف</span></th>


    </tr>

    <?php
     $sql = "SELECT * FROM wishlist WHERE username='$name' ORDER BY id DESC";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
         while ($saledata = $result-> fetch_assoc()) {
          
          
             echo "<tr><td>". $saledata["id"] ."
             </td><td class='panelusername no-print'>". $saledata["name"] ."
             </td><td class='panelusername no-print'>". $saledata["fname"] ."
             </td><td>". $saledata["product"] ."
             </td><td class='panelusername no-print'><img class='imgt' src='img/products/". $saledata["pic"] ."'>
             </td><td>". $saledata["price"] ." DA
             </td><td>". $saledata["date"] ."
         


         <script>
         function show(x) {
            document.querySelector('.iedit'+x).style.display = 'block';
            document.getElementById('black').style.display = 'block';

        };
         </script>
             </td><td  class='no-print'><form method='POST' action='action/delete-wish.php'>
             <button class='delete' ><span lang='en'>Delete</span><span lang='fr'>Supprimer</span><span lang='ar'>حذف</span></button>
             <input type='hidden' name='id' value='". $saledata['id'] ."'>
             <input type='hidden' name='product' value='". $saledata['product'] ."'>
             </td></tr>";
             
         }
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