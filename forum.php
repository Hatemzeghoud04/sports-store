<?php 
include('nav.php');
$name = $_SESSION["username"];
$type = $_SESSION["type"];
$email = $_SESSION["email"];



$pan = 0;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for <?php echo $search; ?> </title>

    <link rel="stylesheet" href="css/forum.css">
</head>
<body>

<div id='forum-categories'>
    <div class='forum-category'>Help</div>
    <div class='forum-category'>Ideas and suggestions</div>

</div>

     
            <div id="black"></div>

    <footer></footer>
    <script src="js/footer.js"></script>
    
</body>
</html>