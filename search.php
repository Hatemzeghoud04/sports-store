<?php 
include('nav.php');


$name = NULL;
$type = NULL;
if($name!=NULL){

$name = $_SESSION["username"];
$type = $_SESSION["type"];
$email = $_SESSION["email"];

};


if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $thesearch = "WHERE (`name` LIKE '%$search%') OR (`description_en` LIKE '%$search%') OR (`description_fr` LIKE '%$search%') OR (`description_ar` LIKE '%$search%')"; 
    
}else {
    $search = '';
    $thesearch = '';
};
$pan = 0;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for <?php echo $search; ?> </title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">
</head>
<body>

        <?php 
$sql2 = "SELECT * FROM products $thesearch";
$result2 = $conn-> query($sql2);
if ($result2-> num_rows > 0) {
    echo "     <!-- cards-container -->
    <section class='product'>
       <h2 class='product-category'><span lang='en'>Search for ". $search ."</span><span lang='fr'>Résultats de recherche pour ". $search ."</span><span lang='ar'>". $search ." نتائج البحث لـ</span></h2>
       <button class='pre-btn'><img src='img/arrow.png' alt=''></button>
       <button class='nxt-btn'><img src='img/arrow.png' alt=''></button>
       <div class='product-container'>
   ";
    while ($productdata = $result2-> fetch_assoc()) {
        $theproduct = $productdata['name'];
        $cheking_rate = mysqli_query($conn,"SELECT * FROM product_rating WHERE product='$theproduct'");
        $users_rate = mysqli_num_rows($cheking_rate);


        $cheking_buy = mysqli_query($conn,"SELECT * FROM sales WHERE `product`='$theproduct' AND `username`='$name' AND `state`=3");
        $product_buy = mysqli_num_rows($cheking_buy);

        if ($product_buy != 0){
            $rate1 = "<form method='post' action='action/rate.php'>";
            $rate2 = "</form>";

        }else {
            $rate1 = "";
            $rate2 = "<p class='onlyb'>Only buyers can rate this product</p>";
        };



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

         if($note == 1){
            $s1 = 'star.png';
            $s2 = 'empty-star.png';
            $s3 = 'empty-star.png';
            $s4 = 'empty-star.png';
            $s5 = 'empty-star.png';
            }else if($note > 1 AND $note < 2){
                $s1 = 'star.png';
                $s2 = 'half-star.png';
                $s3 = 'empty-star.png';
                $s4 = 'empty-star.png';
                $s5 = 'empty-star.png';
                    }else if($note == 2){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'empty-star.png';
                        $s4 = 'empty-star.png';
                        $s5 = 'empty-star.png';
                    }else if($note > 2 AND $note < 3){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'half-star.png';
                        $s4 = 'empty-star.png';
                        $s5 = 'empty-star.png';
                    }else if($note == 3){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'star.png';
                        $s4 = 'empty-star.png';
                        $s5 = 'empty-star.png';
                    }else if($note > 3 AND $note < 4){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'star.png';
                        $s4 = 'half-star.png';
                        $s5 = 'empty-star.png';
                    }else if($note == 4){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'star.png';
                        $s4 = 'star.png';
                        $s5 = 'empty-star.png';
                    }else if($note > 4 AND $note < 5){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'star.png';
                        $s4 = 'star.png';
                        $s5 = 'half-star.png';
                    }else if($note == 5){
                        $s1 = 'star.png';
                        $s2 = 'star.png';
                        $s3 = 'star.png';
                        $s4 = 'star.png';
                        $s5 = 'star.png';
                    }else if($note == 0){
                        $s1 = 'empty-star.png';
                        $s2 = 'empty-star.png';
                        $s3 = 'empty-star.png';
                        $s4 = 'empty-star.png';
                        $s5 = 'empty-star.png';
                    };
            

    

        if ($productdata['promo'] == 0){
            $mypromo = '';
            $price = "<span class='price'>". $productdata['price'] ."</span>";
            $productprice = "<span class='product-price product-price". $productdata['id'] ."'>". $productdata['price'] ." DA</span>";
            $theprice = $productdata['price'];
        }else{
            $subprice = ($productdata['price'] * $productdata['promo']) /  100;
            $newprice = $productdata['price'] - $subprice;
$mypromo =  "<span class='discount-tag'>". $productdata['promo'] ."% <span lang='en'>off</span><span lang='fr'>réduc</span><span lang='ar'>خصم</span></span></span>";
$price = "<span class='price'>". $newprice ."</span><span class='actual-price'>". $productdata['price'] ."</span>";
$productprice = "          <span class='product-price product-price". $productdata['id'] ."'>". $newprice ." DA</span>
<span class='product-actual-price'>". $productdata['price'] ." DA</span><br>
<span class='product-discount'>( ". $productdata['promo'] ."% <span lang='en'>off</span><span lang='fr'>réduc</span><span lang='ar'>خصم</span>)</span>";
$theprice = $newprice;
        };

  
        if ($productdata['S'] == 0){
            $s = "";
                    }else{
                        $s = "<input type='radio' name='size' value='S' hidden id='s-size". $productdata['name'] ."'>
                        <label for='s-size". $productdata['name'] ."' class='size-radio-btn'>s</label>";
                    };
                    if ($productdata['M'] == 0){
                        $m = "";
                        
                                }else{
                                    $m = "<input type='radio' name='size' value='M' hidden id='m-size". $productdata['name'] ."'>
                                    <label for='m-size". $productdata['name'] ."' class='size-radio-btn'>m</label>";
                                };
                                if ($productdata['L'] == 0){
                                    $l = "";
                                    
                                            }else{
                                                $l = "<input type='radio' name='size' value='L' hidden id='l-size". $productdata['name'] ."'>
                                                <label for='l-size". $productdata['name'] ."' class='size-radio-btn'>l</label>";
                                            };
                                            if ($productdata['XL'] == 0){
                                                $xl = "";
                                                
                                                        }else{
                                                            $xl = "<input type='radio' name='size' value='XL' hidden id='xl-size". $productdata['name'] ."'>
                                                            <label for='xl-size". $productdata['name'] ."' class='size-radio-btn'>xl</label>";
                                                        };
                                                        if ($productdata['XXL'] == 0){
                                                            $xxl = "";
                                                            
                                                                    }else{
                                                                        $xxl = "<input type='radio' name='size' value='XXL' hidden id='xxl-size". $productdata['name'] ."'>
                                                                        <label for='xxl-size". $productdata['name'] ."' class='size-radio-btn'>xxl</label>";
                                                                    };
                                                                    if ($productdata['S'] == 0 AND $productdata['M'] == 0 AND $productdata['L'] == 0 AND $productdata['XL'] == 0 AND $productdata['XXL'] == 0){
                                                                        $add = "";
                                                                        $size = "<p class='product-sub-heading product-out'>This product is out !</p>";
                                                                        $out = "<img class='product-out2' src='img/out.png'>";
                                                                        
                                                                                }else if (($type == 4) or (!isset($_SESSION['username']))){
                                                                                    $add = "";
                                                                                    $size = "<p class='product-sub-heading product-out'>You have to be a client to buy !</p>";
                                                                                    $out = "";
                                                                                }else{
                                                                                    $add = "<button class='btn cart-btn'><span lang='en'>add to panier</span><span lang='fr'>ajouter au panier</span><span lang='ar'>أضف الى السلة</span></button>";
                                                                                    $size = "<p class='product-sub-heading'><span lang='en'>select size</span><span lang='fr'>séléctionnez la taille</span><span lang='ar'>أختر الحجم</span>                                                                                    </p>";
                                                                                    $out = "";
                                                                                };
        echo "
        <section class='product-details product-details". $productdata['id'] ."'>
        <div class='left'>
        </div>

        <div class='image-slider image-slider". $productdata['id'] ."'>
        </div>
        <style>
        .image-slider". $productdata['id'] ." {
        background-image: url('img/products/". $productdata['pic'] ."');
        }
        </style>
        <div class='details'>
            <h2 class='product-brand'>". $productdata['name'] ."</h2>
            <p class='product-short-des'>". $productdata['description_en'] ."</p>
            <form method='post' action='action/buy.php'>

            <label><span lang='en'>Quantity :</span><span lang='fr'>Quantité :</span><span lang='ar'>الكمية :</span>
            <input type='number' value='1' class='quantity". $productdata['id'] ."' onclick='pricechange(". $productdata['id'] .", ". $theprice .")'  name='quantity' min='1' max='5'><br>
            </label>
            
            ". $productprice ."
            ". $size ."
            
            ". $s, $m, $l, $xl, $xxl ."<br>
            <input type='hidden' name='buyer' value='". $name ."'>
            <input type='hidden' name='product' value='". $productdata['name'] ."'>
            <input type='hidden' name='pic' value='". $productdata['pic'] ."'>
            <input type='hidden' class='changeprice". $productdata['id'] ."' name='price' value='". $theprice ."'>
            
            ". $add ."
            </form>
            ". $rate1 ."
            <input type='hidden' name='product' value='". $productdata['name'] ."';>
            <div class='stars2'>
            <INPUT class='star1-". $productdata['id'] ."' value='1' TYPE='image' SRC='img/icons/". $s1 ."'> 
            <INPUT class='star2-". $productdata['id'] ."' value='2' TYPE='image' SRC='img/icons/". $s2 ."'> 
            <INPUT class='star3-". $productdata['id'] ."'  value='3' TYPE='image' SRC='img/icons/". $s3 ."'> 
            <INPUT class='star4-". $productdata['id'] ."'  value='4' TYPE='image' SRC='img/icons/". $s4 ."'> 
            <INPUT class='star5-". $productdata['id'] ."'  value='5' TYPE='image' SRC='img/icons/". $s5 ."'> 

        <input id='star". $productdata['id'] ."' type='hidden' name='etoile'>
            </div>
       ". $rate2 ."
<script>
document.querySelector('.star1-". $productdata['id'] ."').addEventListener('mouseover', function(){
document.getElementById('star". $productdata['id'] ."').value = 1;
});
document.querySelector('.star2-". $productdata['id'] ."').addEventListener('mouseover', function(){
    document.getElementById('star". $productdata['id'] ."').value = 2;
    });
    document.querySelector('.star3-". $productdata['id'] ."').addEventListener('mouseover', function(){
        document.getElementById('star". $productdata['id'] ."').value = 3;
        });
        document.querySelector('.star4-". $productdata['id'] ."').addEventListener('mouseover', function(){
            document.getElementById('star". $productdata['id'] ."').value = 4;
            });
            document.querySelector('.star5-". $productdata['id'] ."').addEventListener('mouseover', function(){
                document.getElementById('star". $productdata['id'] ."').value = 5;
                });


</script>

            <form method='post' action='action/action/wishlist.php'>
            <input type='hidden' name='username' value='". $name ."'>
            <input type='hidden'  name='name' value='". $productdata['name'] ."'>
            <input type='hidden' name='description' value='". $productdata['description_en'] ."'>
            <input type='hidden' name='pic' value='". $productdata['pic'] ."'>
            <input type='hidden' name='price' value='". $theprice ."'>


            <button type='submit' class='btn'><span lang='en'>add to wishlist</span><span lang='fr'>ajouter à la liste des souhaits</span><span lang='ar'>أضف إلى قائمة الامنيات</span></button>
            </form>
            <div class='close' onclick='closethis()'>x</div>

        </div>
    </section>
        
        <div class='product-card'>
            <div class='product-image'>
            ". $mypromo ."
            ". $out ."
            
            <div class='stars'>
            <p>". sprintf("%0.2f",$note) ."  (". $users_rate ." <span lang='en'>ratings</span><span lang='fr'>notes</span><span lang='ar'>تقييمات</span>)</p>
            <img src='img/icons/". $s1 ."' class='star'>
            <img src='img/icons/". $s2 ."' class='star'>
            <img src='img/icons/". $s3 ."' class='star'>
            <img src='img/icons/". $s4 ."' class='star'> 
            <img src='img/icons/". $s5 ."' class='star'> 

        </div>
                <img onclick='show(". $productdata['id'] .")' src='img/products/". $productdata['pic'] ."' class='product-thumb' alt=''>
                <form target='_blank' method='post' action='action/action/wishlist.php'>
                <input type='hidden' name='username' value='". $name ."'>
                <input type='hidden'  name='name' value='". $productdata['name'] ."'>
                <input type='hidden' name='description' value='". $productdata['description_en'] ."'>
                <input type='hidden' name='pic' value='". $productdata['pic'] ."'>
                <input type='hidden' name='price' value='". $theprice ."'>
                <button class='card-btn'><span lang='en'>add to wishlist</span><span lang='fr'>ajouter à la liste des souhaits</span><span lang='ar'>أضف إلى قائمة الامنيات</span></button>
                </form>
              
            </div>
            <div class='product-info'>
                <h2 class='product-brand'>". $productdata['name'] ."</h2>
                <p class='product-short-des'>". $productdata['description_en'] ."</p>
                ". $price ."
            </div>

        </div>
        <script>
        function pricechange(r, p) {
            var m = document.querySelector('.quantity'+r).value;
            var np = (p * m);
            document.querySelector('.changeprice'+r).value = np;
            document.querySelector('.product-price'+r).innerHTML = np+' DA';
        };

        function show(x){
               closethis();
                var element2 = document.getElementsByClassName('pre-btn');
            
                for (var i = 0; i < element2.length; i++){
                    element2[i].style.display = 'none';
                };

                var element3 = document.getElementsByClassName('nxt-btn');
            
                for (var i = 0; i < element3.length; i++){
                    element3[i].style.display = 'none';
                };
            document.getElementById('black').style.display = 'block';
            document.querySelector('.product-details'+x).style.display = 'flex';

        };

        function closethis(){
            var element1 = document.getElementsByClassName('product-details');
            
            for (var i = 0; i < element1.length; i++){
                element1[i].style.display = 'none';
            };
            var element2 = document.getElementsByClassName('pre-btn');
            
            for (var i = 0; i < element2.length; i++){
                element2[i].style.display = 'block';
            };

            var element3 = document.getElementsByClassName('nxt-btn');
        
            for (var i = 0; i < element3.length; i++){
                element3[i].style.display = 'block';
            };
            document.getElementById('black').style.display = 'none';

        };
        </script>

        
        
        ";

    };   echo "</section>";
};
?>
            <div id="black"></div>

    <footer></footer>
    <script src="js/footer.js"></script>
    
</body>
</html>