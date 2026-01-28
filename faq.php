<html>
<?php
include('nav.php');
require_once "action/db_connect.php";
    $name = $_SESSION["username"];
    $type = $_SESSION["type"];

    if($name!=NULL){

?>
    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/nav.css">

        <title>Admin Panel</title>
</head>
<body>
   
<div class='messages'>
    <style>
        .messages {
    position: absolute;
    left: 300px;
    right: 300px;
}

.rmessage {
    background: white;
    padding: 0px 30px;
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-radius: 5px;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;

}


.author {
    font-size: 30px;
    
    color: black;
    display: block;
    text-align: right;
    margin-bottom: 0px
}

.sss {
    position: absolute;
    font-size: 40px;
    
    top: 50px;
    left: 200px;
}


.rdate {
    color: black;
    font-size: 20px;
}
.sbj {
    font-size: 30px;
    
    display: block;
    margin-bottom: -20px;
    color: black;

}

.rsbj {
    color: black;
}

.rtype {
    font-size: 40px;
    
    text-align: center;
    text-decoration:dashed;
    display: block;
    margin-top: 30px;
}


.msg::before {
    content: "Message : ";
    color: black;
}
.msg {
    border: black 1px solid;
    border-radius: 5px;
    display: block;
        font-size: 20px;
    margin-top: 50px;
    padding: 10px 3px;
}

.msg2 {
    border: black 1px solid;
    border-radius: 5px;
    display: block;
        font-size: 20px;
    
    padding: 10px 3px;
    overflow-y: scroll;
    height: 100px;
    margin-top: 50px;

}


.rmessage2 {
    transform: translate(0px, -40px);
}

.thetext2 {
    overflow-y: scroll;
resize: none;
border: black 1px solid;
border-radius: 5px;
display: block;
    font-size: 20px;

}

.deletemsg {
    position: fixed;
    background-color: white;
    left: 200px;
    right: 200px;
    top: 200px;
    bottom: 200px;
}
.reply {
    background-color: white;
    left: 100px;
    right: 100px;
    top: 800px;
    bottom: 100px;
    margin-bottom: 1000px;

}
.rbtn {
    background-color: black;
    border-radius: 5px;
    color: white;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
    margin-top: 40px;
    
    text-decoration: none;
    cursor: pointer;
    font-size: 30px;
    border: none;
}


.iconreply {
    width: 50px;
}

.iconchat {
    position: absolute;
    width: 50px;

}
    </style>

    <?php
     $sql = "SELECT * FROM replies WHERE category=1 or category=2";
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
        
             <div class='reply reply". $messagedata['id'] ."'>
             <form method='post' action='action/reply-to-message.php'>
             <div class='rmessage rmessage2'>
             <h6 class='rtype' style='color: ". $color ."'>". $msgcategory."</h6>
             <h6 class='sbj'>". $messagedata['subject'] ."</h6>
             <p class='msg2'>". $messagedata['message'] ."</p>
             <h6 class='author'>". $messagedata['username'] ." <span class='rdate'>". $messagedata['message_date'] ."</span></h6>
             <p class='msg2'>". $messagedata['reply'] ."</p>
             <h6 class='author'>". $messagedata['sender'] ." <span class='rdate'>". $messagedata['reply_date'] ."</span></h6>


             </div>
             
            

         
           
             ";
            }
            echo "</div>";

         

     }else{
         echo "<p class='no-message'>Aucune réponse à afficher</p>";
     }
     ?>
    </table>
   
</body> 
<script>
document.body.style.overflow = "visible";

    </script>
</html>
  

<?php
}
else {
    header('location:error.php');
}
?>