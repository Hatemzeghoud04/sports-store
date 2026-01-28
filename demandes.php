<html>
<?php
include('nav2.php');
require_once "action/db_connect.php";
    $name = $_SESSION["username"];
    $type = $_SESSION["type"];
    $email = $_SESSION["email"];

    if($name!=NULL){

?>
<?php if($type == 1 or $type == 2) : ?>
    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/admin.css">
        <title>Demande d'adhésion</title>
</head>
<body>
   
    <?php
     $sql = "SELECT * FROM formulaires";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
         while ($data = $result-> fetch_assoc()) {
           
            
             echo "<div class='cv'>
             
            <br>
             Prénom : ". $data["name"] ."<br>
             Nom : ". $data["fname"] ."<br>
             Society : ". $data["society"] ."<br>
             Adresse : ". $data["adresse"] ."<br>
             Town : ". $data["town"] ."<br>
             Postal code : ". $data["pcode"] ."<br>

<div class='mailphone'>
         <img class='thetype' src='img/telephone.png'>  <a href='tel:". $data["phone"] ."'>". $data["phone"] ."</a><br>
         <img class='thetype' src='img/arroba.png'>  <a href='mailto:". $data["email"] ."'>". $data["email"] ."</a><br>
</div>

        <form method='post' action='action/accept.php'>
        <input type='hidden' name='id' value='". $data["id"] ."'>
        <input type='hidden' name='email' value='". $data["email"] ."'>
        <input type='hidden' name='name1' value='". $data["name"] ."'>
        <input type='hidden' name='fname' value='". $data["fname"] ."'>
        <input type='hidden' name='society' value='". $data["society"] ."'>
        <input type='hidden' name='adresse' value='". $data["adresse"] ."'>
        <input type='hidden' name='town' value='". $data["town"] ."'>
        <input type='hidden' name='pcode' value='". $data["pcode"] ."'>
        <input type='hidden' name='phone' value='". $data["phone"] ."'>
        <br>
        <br>
        <br>

        <br>
         <button class='demande1' type='submit'>Accepter</button>
         </form>
        
         <form method='post' action='action/deletedemande.php'>
          <button class='demande2' type='submit'>Refuser</button>
          <input type='hidden' name='id' value='". $data["id"] ."'>

          </form>
          <br>
          <br>
          <br>
          <br>


             </div>";
         }
         echo "
         <script>

         var pic = document.querySelector('.picform');
         var src = document.querySelector('.picform').src;

         pic.addEventListener('mouseover', function(){
             document.querySelector('.imform').src = src;
             document.querySelector('.imform').style.display = 'block';
         });

         </script>
         ";

        

    }else{
        echo "<p class='no-message'>Aucune demande à afficher</p>";
    }
     ?>
   
</body>
<script>
document.body.style.overflow = "visible";
    function addp() {
            document.getElementById("addp").style.display = 'block';
            document.getElementById('black').style.display = 'block';

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