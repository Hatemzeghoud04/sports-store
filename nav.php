<?php 
  session_start();
  require_once "action/db_connect.php";
  $pan = 0;
  if (isset($_SESSION['username'])){
    $name = $_SESSION["username"];
    $type = $_SESSION["type"];
    $email = $_SESSION["email"];
      $getdata = mysqli_query($conn,"SELECT * FROM users WHERE username='$name'");
      $userdata = mysqli_fetch_array($getdata);


      $date = $userdata['date'];

 
?>
<div id='nav2' class='no-print'>
</div>

<div id='nav' class='no-print'>
<div class="nav">
            <img src="img/dark-logo.png" class="brand-logo" alt="">

            <div class="nav-items">
            <form method='get' action='search.php'>

                <div class="search">
                    <input name="search" type="text" class="search-box" placeholder="search brand, product">
                    <button type="submit" class="search-btn"><span lang='en'>search</span><span lang='fr'>rechercher</span><span lang='ar'>البحث</span></button>
</form>
                </div>
                <a>
                <?php
    if ($type == 1){
        $thetype = "src='img/icons/admin.png'";
     }elseif ($type == 2){
        $thetype = "src='img/icons/moderator.png'";
     }elseif ($type == 3){
        $thetype = "src='img/icons/user.png'";
     }elseif ($type == 4){
         $thetype = "src='img/icons/new.png'";
     };

?>
                     <img <?php echo $thetype ?> id="user-img" alt="">
                     <div class="login-logout-popup hide">
                         <p class="account-info"><?php echo $name ?></p>
                         <?php if($type == 1) : ?>
                        <button onclick="window.location='stats.php'"class="btn" id="user-btn"><span lang='en'>Admin Panel</span><span lang='fr'>Panneau d'admin</span><span lang='ar'>لوحة الإدارة</span></button>

                            <?php endif; ?>

                         <button onclick="window.location='action/logout.php'"class="btn" id="user-btn"><span lang='en'>Log out</span><span lang='fr'>Déconnexion</span><span lang='ar'>الخروج</span></button>
                     </div>
                     <div class="notif-popup hide">
                     <span lang='en'>Notifications :</span><span lang='fr'>Notifications :</span><span lang='ar'>الاشعارات</span> <br>
                            <?php
    $sqln = "SELECT * FROM notifications WHERE username='$name' OR show_to=1 AND `date`>'$date' ORDER BY `date` DESC LIMIT 3";
    $resultn = $conn-> query($sqln);
    if ($resultn-> num_rows > 0) {
        while ($notifdata = $resultn-> fetch_assoc()) {
            if ($notifdata['type'] == 1) {
                $notification = "Bienvenue ". $notifdata['username'] ." pour bénéficier de toutes les foncionnalités veuillez remplir ce formulaire";
            }else if($notifdata['type'] == 2){
             $notification = $notifdata['username'] ." votre forumulaire a bien été envoyé";
            }else if($notifdata['type'] == 3){
             $notification = $notifdata['username'] ." votre demande a été acceptée, Bienvenue";
            }else if($notifdata['type'] == 4){
             $notification = $notifdata['username'] ." votre demande a été refusée, cause: ". $notifdata['reference'];
            }else if($notifdata['type'] == 5){
             $notification = "Nouveau produit disponible : ". $notifdata['reference'];
            }else if($notifdata['type'] == 6){
             $notification = "Le produit ". $notifdata['reference'] ." n'est plus en stock";
         }else if($notifdata['type'] == 7){
             $notification = "Le produit ". $notifdata['reference'] ." est de nouveau en stock";
         }else if($notifdata['type'] == 8){
             $notification = "votre message a bien été envoyé";
         }else if($notifdata['type'] == 9){
             $notification = $notifdata['username'] ." vous avez reçu une réponse";
         }else if($notifdata['type'] == 10){
             $notification = "votre commande du  ". $notifdata['reference'] ." a été refusée";
         }else if($notifdata['type'] == 11){
             $notification = "votre commande du  ". $notifdata['reference'] ." est en cours...";
         }else if($notifdata['type'] == 12){
             $notification = "votre commande du  ". $notifdata['reference'] ." est validée";
         }else if($notifdata['type'] == 13){
             $notification = "votre commande a bien été envoyée";
         }else if($notifdata['type'] == 14){
             $notification = "le produit ". $notifdata['reference'] ." a été ajouté à la liste";
         }else if($notifdata['type'] == 15){
             $notification = $notifdata['reference'];
         }else if($notifdata['type'] == 16){
            $notification = "le produit ". $notifdata['reference'] ." a été rendu";
        };;
       
             echo "<div class='notif-block'>". $notification ."</div>";

         };
        };
         ?>
                         </div>
                </a>
                <a href="purchases.php"><img title='Purshases' src="img/cart.png" alt=""></a>
                <a href="#"><img id="notif" title='Notifications' src="img/notif.svg" alt=""></a>
                <a href="#"><img id="message" title='Messages' src="img/icons/message.png" alt=""></a>
                <div class="message-popup hide">
                    
                         <button onclick="sendm()"class="msg-btn" ><span lang='en'>Send a message</span><span lang='fr'>Envoyer un message</span><span lang='ar'>ارسال رسالة</span></button>
                         <button onclick="window.location='replies.php'"class="msg-btn"><span lang='en'>My replies</span><span lang='fr'>Mes réponses</span><span lang='ar'>الاجوبة</span></button>
                         <button onclick="window.location='faq.php'"class="msg-btn" ><span lang='en'>The forum</span><span lang='fr'>Le forum</span><span lang='ar'>الرسائل</span></button>
                     </div>

                     <a href="#"><img id="language" title='Language' src="img/icons/language.png" alt=""></a>
                     <div class="language-popup hide">
                         <button onclick="set_language('en')" class="msg-btn" >English</button>
                         <button onclick="set_language('fr')" class="msg-btn">French</button>
                         <button onclick="set_language('ar')" class="msg-btn" >Arabic</button>
                     </div>


                

            </div>
            
        </div>
        <ul class="links-container">
            <li class="link-item"><a href="index.php" class="link"><span lang='en'>home</span><span lang='fr'>page d'acceuil</span><span lang='ar'>الصفحة الرئيسية</span></a></li>
            <li class="link-item"><form method="get" action="product.php"><input name="category" type="hidden" value="women" ><button type="submit" class="link"><span lang='en'>women</span><span lang='fr'>femmes</span><span lang='ar'>النساء</span></button></form></li>
            <li class="link-item"><form method="get" action="product.php"><input name="category" type="hidden" value="men" ><button type="submit" class="link"><span lang='en'>men</span><span lang='fr'>hommes</span><span lang='ar'>الرجال</span></button></form></li>
            <li class="link-item"><form method="get" action="product.php"><input name="category" type="hidden" value="kids" ><button type="submit" class="link"><span lang='en'>kids</span><span lang='fr'>enfants</span><span lang='ar'>الأطفال</span></button></form></li>
        </ul>
                         </div>

    <div id='black'></div>
                         <script src="js/sc3.js"></script>
<script>
    language_set = localStorage.getItem("language");
    if (language_set == undefined){
        document.documentElement.setAttribute('lang', 'en');

    }else{
        document.documentElement.setAttribute('lang', language_set);
    }
function set_language(l){
    localStorage.setItem("language", l);
document.location.reload();
};





const userImageButton = document.querySelector('#user-img');
const userPop = document.querySelector('.login-logout-popup');
const popuptext = document.querySelector('.account-info');
const actionBtn = document.querySelector('#user-btn');

const notifImageButton = document.querySelector('#notif');
const userPop2 = document.querySelector('.notif-popup');

const messageImageButton = document.querySelector('#message');
const userPop3 = document.querySelector('.message-popup');

const languageImageButton = document.querySelector('#language');
const userPop4 = document.querySelector('.language-popup');

userImageButton.addEventListener('click', () => {
    userPop.classList.toggle('hide');
})

notifImageButton.addEventListener('click', () => {
    userPop2.classList.toggle('hide');
})

messageImageButton.addEventListener('click', () => {
    userPop3.classList.toggle('hide');
})

languageImageButton.addEventListener('click', () => {
    userPop4.classList.toggle('hide');
})





const messageBox = document.querySelector('.message-box');
function sendm(){
    document.getElementById('message-box').style.display = "block";
    document.getElementById('black').style.display = "block";

};

if (document.documentElement.lang == "en"){

}else if (document.documentElement.lang == "fr"){
    document.getElementsByName("search")[0].placeholder="Recherchez un produit, une marque...";


}else if (document.documentElement.lang == "ar"){
    document.getElementsByName("search")[0].placeholder="ابحث عن منتوج, علامة...";

};


const d = document.getElementsByClassName("draggable");

for (let i = 0; i < d.length; i++) {
  d[i].style.position = "relative";
}

function filter(e) {
  let target = e.target;

  if (!target.classList.contains("draggable")) {
    return;
  }

  target.moving = true;

  if (e.clientX) {
    target.oldX = e.clientX; 
    target.oldY = e.clientY;
  } else {
    target.oldX = e.touches[0].clientX;
    target.oldY = e.touches[0].clientY;
  }

  target.oldLeft = window.getComputedStyle(target).getPropertyValue('left').split('px')[0] * 1;
  target.oldTop = window.getComputedStyle(target).getPropertyValue('top').split('px')[0] * 1;

  document.onmousemove = dr;
  document.ontouchmove = dr;

  function dr(event) {
    event.preventDefault();

    if (!target.moving) {
      return;
    }
    if (event.clientX) {
      target.distX = event.clientX - target.oldX;
      target.distY = event.clientY - target.oldY;
    } else {
      target.distX = event.touches[0].clientX - target.oldX;
      target.distY = event.touches[0].clientY - target.oldY;
    }

    target.style.left = target.oldLeft + target.distX + "px";
    target.style.top = target.oldTop + target.distY + "px";
  }

  function endDrag() {
    target.moving = false;
  }
  target.onmouseup = endDrag;
  target.ontouchend = endDrag;
}
document.onmousedown = filter;
document.ontouchstart = filter;



function closeM(){
    document.getElementById('message-box').style.display = "none";
    document.getElementById('black').style.display = "none";
}

</script>
<form method='post' action='action/send-message.php'>
<div class='draggable'id='message-box'>
    <div class='close' onclick='closeM()'>X</div>
    <p class='sendamessage'><span lang='en'>Send a message</span><span lang='fr'>Envoyer un message</span><span lang='ar'>ارسال رسالة</span><p>
        <br>
    <label><span lang='en'>Category :</span><span lang='fr'>Catégorie :</span><span lang='ar'>الصنف :</span>
        <div class='linear'>
    <select name="category">
        <option value="1">Help</option>
        <option value="2">Ideas and suggestions</span></option>
        <option value="3">Complaint</option>
        <option value="4">Join</option>
</select><br>
</div>
</label><br>
    <label><span lang='en'>Subject :</span><span lang='fr'>Sujet :</span><span lang='ar'>الموضوع :</span>
    <div class='linear'>

    <input maxlength="30" type="text" name="subject">
</div>

</label><br>
<label><span lang='en'>Message :</span><span lang='fr'>Message :</span><span lang='ar'>الرسالة :</span><br>
<div class='linear2'>

<textarea maxlength="1000" name="message" cols="180" rows="15"></textarea>
</div>

</label><br>
<button type="submit" class='btn'><span lang='en'>Send</span><span lang='fr'>Envoyer</span><span lang='ar'>ارسال</span></button>
</form>



</div>

<?php
}
else {
    include('no_co.php');
}
?>
