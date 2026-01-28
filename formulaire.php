
<?php
include('nav.php');
  require_once "action/db_connect.php";
  $name = $_SESSION["username"];
  $type = $_SESSION["type"];
  $email = $_SESSION["email"];
    $cheking = mysqli_query($conn,"SELECT * FROM formulaires WHERE email='$email'");
    $checkcount = mysqli_num_rows($cheking);
    if ($checkcount ==0){
    
?>

<html>
    <head>
        <meta charset='UTF-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/home.css"/>
        <title>Formulaire</title>
</head>
<body>
<div id="formulaire">
    <form method="post" action="action/send-f.php" enctype="multipart/form-data">
    <h1>Formulaire</h1><br>
    <h6>Les champs avec * sont obligatoires</h6><br>
    <style>
        h6 {
            font-size: 15px;
            color: red;
        }
    </style>


    <label>Family name* :

    <input  type="text" name="fname" class="form-control" required> <br>
    </label>

    <input type="hidden" name="email" value="<?php echo $email; ?>"><br>
    <label>Name* :

        <input  type="text" name="name1" class="form-control" required> <br>
        </label><br>
        <label>Society :

        <input  type="text" name="society" class="form-control" ><br>
        </label><br>
        <label>Adresse* :

        <input  type="text" name="adresse" class="form-control"  required><br>
        </label><br>
        <label>Town* :

        <input  type="text" name="town" class="form-control" required> <br>
        </label><br>

        <label>Postal code* :

        <input  type="text" name="pcode" class="form-control" required><br>
        </label><br>

        <label>Phone* :
        <input  type="text" name="phone" class="form-control" required><br>
    </label>
 


 


<br>
<br>
<br>



        <button class="Send" type="submit"><span lang="en">Send</span><span lang="fr">Envoyer</span><span lang="ar">ارسال</span></button>
        
    </form>
</div>
<br>
<br>


<div id="black"></div>

</body>
<script>
if (window.location.href.indexOf("error=1") > -1) {
    shake();
}else if (window.location.href.indexOf("error=2") > -1) {

    document.querySelector(".login").style.display = "none";
        document.querySelector(".register").style.display = "flex";
        document.querySelector("h2").innerHTML = "<span lang='en'>Already have an account ? Login here</span><span lang='fr'>Tu as déja un compte? connecte-toi ici</span><span lang='ar'>الديك حساب؟ ادخل من هنا</span>";
        shake();
        document.getElementById('error').innerHTML = "<span lang='en'>this username already exist !</span><span lang='fr'>Ce nom d'utilisateur existe déja !</span>";
}else if (window.location.href.indexOf("error=3") > -1) {

document.querySelector(".login").style.display = "none";
    document.querySelector(".register").style.display = "flex";
    document.querySelector("h2").innerHTML = "<span lang='en'>Already have an account ? Login here</span><span lang='fr'>Tu as déja un compte? connecte-toi ici</span><span lang='ar'>الديك حساب؟ ادخل من هنا</span>";
    shake();
    document.getElementById('error').innerHTML = "<span lang='en'>wrong email form</span><span lang='fr'>mauvais email</span>";
}else if (window.location.href.indexOf("error=4") > -1) {

document.querySelector(".login").style.display = "none";
    document.querySelector(".register").style.display = "flex";
    document.querySelector("h2").innerHTML = "<span lang='en'>Already have an account ? Login here</span><span lang='fr'>Tu as déja un compte? connecte-toi ici</span><span lang='ar'>الديك حساب؟ ادخل من هنا</span>";
    shake();
    document.getElementById('error').innerHTML = "<span lang='en'>password don't match !</span><span lang='fr>les mots de passe ne correspondent pas !</span>";
}else if (window.location.href.indexOf("error=5") > -1) {

document.querySelector(".login").style.display = "none";
    document.querySelector(".register").style.display = "flex";
    document.querySelector("h2").innerHTML = "<span lang='en'>Already have an account ? Login here</span><span lang='fr'>Tu as déja un compte? connecte-toi ici</span><span lang='ar'>الديك حساب؟ ادخل من هنا</span>";
    shake();
    document.getElementById('error').innerHTML = "<span lang='en'>this email already exist !</span><span lang='fr'>Cette email existe déja !</span>";
}else{
};
        let b = true;

    function changeBox() {
        if (b == true) {
            register();
            b = false;

        } else {
            login();
            b = true;

        };
    

    function register() {

        document.querySelector(".login").style.display = "none";
        document.querySelector(".register").style.display = "flex";
        document.querySelector("h2").innerHTML = "<span lang='en'>Already have an account ? Login here</span><span lang='fr'>Tu as déja un compte? connecte-toi ici</span><span lang='ar'>الديك حساب؟ ادخل من هنا</span>";
    };
    function login() {
        document.querySelector(".login").style.display = "flex";
        document.querySelector(".register").style.display = "none";
        document.querySelector("h2").innerHTML = "<span lang='en'>Don't have an account ? Register here</span><span lang='fr'>Pas de compte ? Inscris-toi ici</span><span lang='ar'>لا تملك حساب؟ سجل من هنا</span";
    };
};

function shake(){
    document.body.style.animation="screenshake .5s, screenred .5s ease-in";
    document.getElementById("error").style.display="block";

};

someVarName = localStorage.getItem("thisob");
if (someVarName == undefined) {
        document.getElementById("langmenu").style.display = "block";
        document.getElementById("black").style.display = "block";
        document.documentElement.setAttribute('lang', 'en');
remember();

 } else {
        document.getElementById("langmenu").style.display = "none";
        document.getElementById("black").style.display = "none";
        document.documentElement.setAttribute('lang', someVarName);


};
function show(){
document.getElementById("langmenu").style.display = "block";
        document.getElementById("black").style.display = "block";
};

function remember(){
    someVarName = document.getElementById("langoptions").value;
localStorage.setItem("thisob", someVarName);
document.location.reload();
};

if (document.documentElement.lang == "en"){

}else if (document.documentElement.lang == "fr"){
    document.title = 'Gica ciment';
    document.getElementsByName("email")[0].placeholder="Adresse email";
    document.getElementsByName("username")[0].placeholder="Nom d'utilisateur";
    document.getElementsByName("username")[1].placeholder="Nom d'utilisateur";
    document.getElementsByName("password")[0].placeholder="Mot de passe";
    document.getElementsByName("password")[1].placeholder="Mot de passe";
    document.getElementsByName("cpassword")[0].placeholder="Confirmer le mot de passe"

}else if (document.documentElement.lang == "ar"){
    document.title = 'جيكا للإسمنت';
    document.getElementsByName("email")[0].placeholder="البريد الالكتروني";
    document.getElementsByName("username")[0].placeholder="المستخدم";
    document.getElementsByName("username")[1].placeholder="المستخدم";
    document.getElementsByName("password")[0].placeholder="كلمة السر";
    document.getElementsByName("password")[1].placeholder="كلمة السر";
    document.getElementsByName("cpassword")[0].placeholder="تأكيد كلمة السر";
 };

 <?php
 }else{
        echo"
        <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <link rel='stylesheet' href='css/home.css'/>
        <title>Formulaire</title>
</head>
        <p class='no-message'>Vous avez déja envoyé un formulaire<p>";
 };
 ?>












    </script>
</html>