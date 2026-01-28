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
    <?php

if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $where = "WHERE name LIKE '%$search%'";
        }else{
            $where = "WHERE name LIKE '%%'";

        };
        
if(empty($_GET['category'])){
    $where2 = "";
}elseif($_GET['category'] == '*'){
$where2 = "";

}else {
    $ct = $_GET['category'];
    $where2 = "AND category='$ct'";
};

if(empty($_GET['type'])){
    $where3 = "";
}elseif($_GET['type'] == '*'){
$where3 = "";

}else {
    $tp = $_GET['type'];
    $where3 = "AND type='$tp'";
};

if(empty($_GET['number'])){
    $where5 = "";
}else{
    $where5 = "AND (S = 0 OR M = 0 OR L = 0 OR XL = 0 OR XXL = 0)";
}
    ;

    if(empty($_GET['promo'])){
        $where4 = "";
    }else{
        $where4 = "AND promo!=0";
    }
        ;




?>
<form method='get' action=''>


<div class="search2">
<p class='addp' onclick='addp()'>Add product</p>


<select name="category">
        <option value="*">Category</option>
        <option value="Men">Men</option>
        <option value="Women">Women</option>
        <option value="Men/Women">Men/Women</option>
        <option value="Kids">Kids</option>
        <option value="All">All</option>
</select>

<select name="type">
        <option value="*">Type</option>
        <option value="Shoes">Shoes</option>
        <option value="Shirts">Shirts</option>
        <option value="Shorts">Shorts</option>
        <option value="Accesories">Accesories</option>


</select>
<label>Promo
<input class="sinput" type="checkbox" name="promo">
</label>

<label>Sold out:
    <input class="sinput" type="checkbox" name="number">
</label>
    <input name="search" type="text" class="search-box" placeholder="search brand, product">
    <button type="submit" class="search-btn">search</button>

</div>

</form>


    <?php
     $sql = "SELECT * FROM products $where $where2 $where3 $where4 $where5 ORDER BY id DESC";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
         echo "  
           <table>
         <tr>
         
             <th>Id</th>
             <th>Category</th>
             <th>Type</th>
             <th>Name</th>
             <th>Description_en</th>
             <th>Description_fr</th>
             <th>Description_ar</th>
             <th>Picture</th>
             <th>S</th>
             <th>M</th>
             <th>L</th>
             <th>XL</th>
             <th>XXL</th>
             <th>Price</th>
             <th>Promo</th>
             <th>Edit</th>
             <th>Delete</th>
 
 
 
     </tr>";
         while ($productdata = $result-> fetch_assoc()) {
        if ($productdata['category'] == 'Men'){
            $categorycolor = '#0a357b';
        }else if($productdata['category'] == 'Women'){
            $categorycolor = 'rgb(255, 0, 81)';

        }else if($productdata['category'] == 'Kids'){
            $categorycolor = 'orange';
    }else if($productdata['category'] == 'Men/Women'){
        $categorycolor = 'grey';
    }else{
            $categorycolor = '';

        };
     
            
             echo "<tr><td>". $productdata["id"] ."
             </td><td class='panelusername category". $productdata["id"] ."'>". $productdata["category"] ."
             </td><td class='panelusername'>". $productdata["type"] ."
             </td><td class='panelusername'>". $productdata["name"] ."
             </td><td>". $productdata["description_en"] ."
             </td><td>". $productdata["description_fr"] ."
             </td><td>". $productdata["description_ar"] ."
             </td><td><img class='imgt' src='img/products/". $productdata["pic"] ."'>
             </td><td>". $productdata["S"] ."
             </td><td>". $productdata["M"] ."
             </td><td>". $productdata["L"] ."
             </td><td>". $productdata["XL"] ."
             </td><td>". $productdata["XXL"] ."
             </td><td class='price-after'>". $productdata["price"] ." DA
             </td><td class='price-after'>". $productdata["promo"] ." %
             </td><td>
             <button class='edit' onclick='show(". $productdata['id'] .")' >Edit item</button>
             <div class='iedit iedit". $productdata['id'] ."'>
             <form method='POST' action='action/edit-product.php' enctype='multipart/form-data'>
             <div class='close' onclick='closethis2(". $productdata['id'] .")'>x</div>
             <input type='hidden' name='id' value='". $productdata['id'] ."'>
             <h3>Add a product</h3>

             <label>Category
                 <select name='category'>
    <option>Men</option>
    <option>Women</option>
    <option>Men/Women</option>
    <option>Kids</option>
    <option>All</option>
        </select>
                </label>
                <label>Type
                <select name='type'>
    <option>Shoes</option>
    <option>Shirts</option>
    <option>Shorts</option>
    <option>Accesories</option>
        </select>            </label>
                <label>Name
             <input class='lbl' maxlength='30' name='name'  value='". $productdata['name'] ."' >
                </label><br>
                <label>Description_en
             <input class='lbl'  maxlength='30' name='description_en' value='". $productdata['description_en'] ."' >
             </label><br>
             <label>Description_fr
             <input class='lbl'  maxlength='30' name='description_fr' value='". $productdata['description_fr'] ."' >
             </label><br>
             <label>Description_ar
             <input class='lbl'  maxlength='30' name='description_ar' value='". $productdata['description_ar'] ."' >
             </label><br>
             <label>Picture
             <input type='file' name='new_pic' id='preuve1' >
             </label><br>
             <label >s
             <input type='number' class='lbl'  name='s' placeholder='88' value='". $productdata['S'] ."'>
          </label><br>
          <label >m
             <input type='number' class='lbl'  name='m' placeholder='88' value='". $productdata['M'] ."'>
          </label><br>
          <label >l
             <input type='number' class='lbl'  name='l' placeholder='88' value='". $productdata['L'] ."'>
          </label><br>
          <label >xl
             <input type='number' class='lbl'  name='xl' placeholder='88' value='". $productdata['XL'] ."'>
          </label><br>
          <label >xxl
             <input type='number' class='lbl'  name='xxl' placeholder='88' value='". $productdata['XXL'] ."'>
          </label><br>
          <label >Price
          <input type='number' class='lbl' name='price' placeholder='800' value='". $productdata['price'] ."' >
       </label>
       <label >Promo
          <input type='number' min='0' max='100' class='lbl' name='promo' placeholder='50' value='". $productdata['promo'] ."'>
       </label><br><br>
             <button class='confirm' ' >Edit item</button>
            </form>

             </div>



         <script>
         function show(x) {
            document.querySelector('.iedit'+x).style.display = 'flex';
            document.getElementById('black').style.display = 'block';

        };

        function closethis2(x){
            document.querySelector('.iedit'+x).style.display = 'none';
            document.getElementById('black').style.display = 'none';
        };
         </script>
             </td><td><form method='POST' action='action/delete-product.php'>
             <button class='edit' >Delete item</button>
             <input type='hidden' name='id' value='". $productdata['id'] ."'>
         </form>

         <style>
         .category". $productdata["id"] ."{
             color: ". $categorycolor .";
         }
         </style>
         

             </td></tr>";
         }
         echo "</table><br>";

        
     };


     ?>
    </table>
    <div class='iedit' id='addp'>
    <div class='close' onclick='closethis()'>x</div>
         <form method='POST' action='action/add-product.php' enctype="multipart/form-data">
         <h3>Add a product</h3>

         <label>Category
             <select name='category'>
<option>Men</option>
<option>Women</option>
<option>Men/Women</option>
<option>Kids</option>
<option>All</option>
    </select>
            </label>
            <label>Type
            <select name='type'>
<option>Shoes</option>
<option>Shirts</option>
<option>Shorts</option>
<option>Accesories</option>
    </select>            </label>
            <label>Name
         <input class='lbl' maxlength='30' name='name' placeholder='Product XX' required>
            </label><br>
            <label>Description_en
         <input class='lbl'  maxlength='30' name='description_en' placeholder='This product is ...' required>
         </label><br>
         <label>Description_fr
         <input class='lbl'  maxlength='30' name='description_fr' placeholder='This product is ...' required>
         </label><br>
         <label>Description_ar
         <input class='lbl'  maxlength='30' name='description_ar' placeholder='This product is ...' required>
         </label><br>
         <label>Picture
         <input type='file' name="photo" id="preuve1" required>
         </label><br>
         <label >s
         <input type="number" class='lbl'  name='s' placeholder='88'>
      </label><br>
      <label >m
         <input type="number" class='lbl'  name='m' placeholder='88'>
      </label><br>
      <label >l
         <input type="number" class='lbl'  name='l' placeholder='88'>
      </label><br>
      <label >xl
         <input type="number" class='lbl'  name='xl' placeholder='88'>
      </label><br>
      <label >xxl
         <input type="number" class='lbl'  name='xxl' placeholder='88'>
      </label><br>
      <label >Price
      <input type="number" class='lbl' name='price' placeholder='800' required>
   </label>
   <label >Promo
      <input type="number" min="1" max="100" class='lbl' name='promo' placeholder='50'>
   </label><br><br>

         <button type="submit" class='confirm'  >Add item</button>
        </form>
    </div>

<div id="black"></div>
   
</body>
<script>
    function addp() {
            document.getElementById("addp").style.display = 'flex';
            document.getElementById("black").style.display = 'block';


        };


        function closethis(){
            document.getElementById("addp").style.display = 'none';
            document.getElementById('black').style.display = 'none';
        };
    </script>
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