<html>
<?php
include('nav2.php');
    require_once "action/db_connect.php";
    $name = $_SESSION["username"];
    $type = $_SESSION["type"];



    if($name!=NULL){
        $getdata = mysqli_query($conn,"SELECT * FROM users WHERE username='$name'");
        $userdata = mysqli_fetch_array($getdata);
       
?>
<?php if($type == 1) : ?>
  
    <head>
        <meta charset='UTF-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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





                <div id="black">
    
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    


<script>
document.body.style.overflow = "visible";


    if (window.location.href.indexOf("users") > -1) {
    loadupanel();
}else if(window.location.href.indexOf("products") > -1) {
    loadppanel();

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