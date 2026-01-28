<html>
<?php
include('nav2.php');
require_once "action/db_connect.php";
    $name = $_SESSION["username"];
    $type = $_SESSION["type"];

    if($name!=NULL){

?>
<?php if($type == 1 or 2) : ?>
    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/admin.css">
        <title>Admin Panel</title>
</head>
<body>
   
<div class='messages'>

    <?php
     $sql = "SELECT * FROM messages ";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
         while ($messagedata = $result-> fetch_assoc()) {
             if ($messagedata['category'] == 1){
                $color = "yellow";
                $msgcategory = "Help";
             }else if($messagedata['category'] == 2) {
                 $color = "green";
                 $msgcategory = "Ideas and suggestions";

             }else if ($messagedata['category'] == 3){
                $color = "red";
                $msgcategory = "Help";
                $msgcategory = "Reclamation";



             }else if ($messagedata['category'] == 3){
                $color = "blue";
                $msgcategory = "Rejoindre";


             };


            
             echo "
             <div class='deletemsg deletemsg". $messagedata['id'] ."'>
             <form method='post' action='delete-message.php'>
             <input name='id' type='hidden' value='". $messagedata['id'] ."'>
             <button class='rbtn'>Delete</button>
             <button class='rbtn'>Close</button>
             </form>
             </div>
             <div class='reply reply". $messagedata['id'] ."'>
             <form method='post' action='action/reply-to-message.php'>
             <div class='rmessage rmessage2'>
             <h6 class='rtype' style='color: ". $color ."'>". $msgcategory."</h6>
             <h6 class='sbj'>". $messagedata['subject'] ."</h6>
             <p class='msg2'>". $messagedata['message'] ."</p>
             <h6 class='author'>". $messagedata['username'] ." <span class='rdate'>". $messagedata['date'] ."</span></h6>
             <textarea placeholder='reply' class='thetext2' name='reply' rows='9' cols='120'></textarea>
             <input name='id' type='hidden' value='". $messagedata['id'] ."'>
             <input name='username' type='hidden' value='". $messagedata['username'] ."'>
             <input name='subject' type='hidden' value='". $messagedata['subject'] ."'>
             <input name='message' type='hidden' value='". $messagedata['message'] ."'>
             <input name='category' type='hidden' value='". $messagedata['category'] ."'>
             <input name='date' type='hidden' value='". $messagedata['date'] ."'>
             <input name='sender' type='hidden' value='". $name ."'>
             <button class='rbtn'>Reply</button>
             </div>
             
            

             </form>
             </div>
             <div class='rmessage'>
             <h6 class='rtype' style='color: ". $color ."'>". $msgcategory ."</h6>
             <h6 class='sbj'>". $messagedata['subject'] ."</h6>
             <p class='msg'>". $messagedata['message'] ."</p>
             <h6 class='author'>". $messagedata['username'] ." <span class='rdate'>". $messagedata['date'] ."</span></h6>
             <button onclick='show(". $messagedata['id'] .")' class='rbtn'>Reply</button>
             <button onclick='show2(". $messagedata['id'] .")' class='rbtn'>Delete</button>
             </div>
             <script>

               function show(x){
                document.querySelector('.reply'+x).style.display = 'flex';
                document.getElementById('black').style.display = 'block';
    
               };

               function show2(x){
                document.querySelector('.deletemsg'+x).style.display = 'block';
                document.getElementById('black').style.display = 'block';
               };
             </script>
           
             ";
            }
            echo "</div>";

         

     }else{
         echo "<p class='no-message'>Aucun message à afficher</p>";
     }
     ?>
    </table>
   
</body> 
<script>
document.body.style.overflow = "visible";

    </script>
</html>
<?php elseif($type == 3) : ?>
    <script>
            window.location.href = "index.php";
        </script>
<?php endif; ?>

<?php
}
else {
    header('location:error.php');
}
?>