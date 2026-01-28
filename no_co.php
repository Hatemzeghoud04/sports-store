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
                <img src='img/icons/login.png' id="user-img" alt="">
                    <style>
                        #user-img {
                            width: 40px;
                            transform: translate(10px, 0px);
                        }

                        
                        </style>
                     <div class="login-logout-popup hide">
                         <p class="account-info"> </p>
                        
                         <button onclick="window.location='login.php'"class="btn" id="user-btn"><span lang='en'>Login</span><span lang='fr'>Connexion</span><span lang='ar'>الدخول</span></button>
                         <button onclick="window.location='signup.php'"class="btn" id="user-btn"><span lang='en'>Register</span><span lang='fr'>Inscription</span><span lang='ar'>التسجيل</span></button>

                     </div>
                <a>
               
                    
                     <div class="login-logout-popup hide">
                         <p class="account-info"></p>


                         <button onclick="window.location='action/logout.php'"class="btn" id="user-btn"><span lang='en'>Log out</span><span lang='fr'>Déconnexion</span><span lang='ar'>الخروج</span></button>
                     </div>
               
                </a>
                <a href="#"><img id="message" src="img/icons/message.png" alt=""></a>
                <div class="message-popup hide">
                         <button onclick="window.location='action/send-message.php'"class="msg-btn"><span lang='en'>My replies</span><span lang='fr'>Mes réponses</span><span lang='ar'>الاجوبة</span></button>
                         <button onclick="window.location='action/send-message.php'"class="msg-btn" ><span lang='en'>The forum</span><span lang='fr'>Le forum</span><span lang='ar'>الرسائل</span></button>
                     </div>

                     <a href="#"><img id="language" src="img/icons/language.png" alt=""></a>
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


const messageImageButton = document.querySelector('#message');
const userPop3 = document.querySelector('.message-popup');

const languageImageButton = document.querySelector('#language');
const userPop4 = document.querySelector('.language-popup');

userImageButton.addEventListener('click', () => {
    userPop.classList.toggle('hide');
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






</script>
<style>
    .login-logout-popup {
left: 80%;                      
 }
</style>
<form method='post' action='action/send-message.php'>
<div id='message-box'>
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