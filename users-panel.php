<html>
<?php
include('nav2.php');
require_once "action/db_connect.php";
    $name = $_SESSION["username"];
 

    if($name!=NULL){
        $getdata = mysqli_query($conn,"SELECT * FROM users WHERE username='$name'");
        $userdata = mysqli_fetch_array($getdata);
     ?>
   
<?php if($userdata['type'] == 1) : ?>
    <head>
        <meta charset='UTF-8'/>
        <link rel="stylesheet" href="css/admin.css">
        <title>Admin Panel</title>
</head>
<body>
<?php

if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $where = "WHERE username LIKE '%$search%'";
        }else{
            $where = "WHERE username LIKE '%%'";

        };
        
if(empty($_GET['type'])){
    $where2 = "";
}elseif($_GET['type'] == '*'){
$t = '';
$where2 = "";

}else {
    $tp = $_GET['type'];
    $where2 = "AND type='$tp'";
};




?>
<form method='get' action=''>


<div class="search2">
    <select name="type">
        <option value="*">*</option>
        <option value="1">Staffs</option>
        <option value="3">Users</option>
        <option value="4">Non-verified</option>

</select>
    <input name="search" type="text" class="search-box" placeholder="search user, name, family name, email...">
    <button type="submit" class="search-btn">search</button>

</div>

</form>





    <?php
    
     $sql = "SELECT * FROM users $where $where2 ORDER BY id DESC";
     $result = $conn-> query($sql);
     if ($result-> num_rows > 0) {
        echo "    <table>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Type</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
    
    
    </tr>";
         while ($userdata = $result-> fetch_assoc()) {
             if ($userdata['type'] == 1){
                $thetype = "<img class='thetype' src='img/icons/admin.png'>";
                $thetype2 = "Admin";
             }elseif ($userdata['type'] == 2){
                $thetype = "<img class='thetype' src='img/icons/moderator.png'>";
                $thetype2 = "Moderator";
             }elseif ($userdata['type'] == 3){
                $thetype = "<img class='thetype' src='img/icons/user.png'>";
                $thetype2 = "User";
             }elseif ($userdata['type'] == 4){
                $thetype = "<img class='thetype' src='img/icons/new.png'>";
                $thetype2 = "New";
             };
             echo "<tr><td>". $userdata["id"] ."
             </td><td class='panelusername'>". $userdata["username"] ."
             </td><td>". $userdata["email"] ."
             </td><td>". $userdata["password"] ."
             </td><td>". $thetype ."
             </td><td>". $userdata["date"] ."
             </td><td>
             <button class='edit' onclick='show(". $userdata['id'] .")' >Edit item</button>
             <div class='iedit iedit". $userdata['id'] ."' id='addp'>
             <div class='close' onclick='closethis(". $userdata['id'] .")'>x</div>
             <form method='POST' action='action/edit-user.php'>
             <input type='hidden' name='id' value='". $userdata['id'] ."'>
                <label>Username
             <input class='lbl' name='username' value='". $userdata['username'] ."'>
                </label><br>
                <label>Email
             <input type='email' class='lbl'  name='email' value='". $userdata['email'] ."'>
             </label><br>
             <label>Password
             <input type='password' class='lbl'  name='password' value='". $userdata['password'] ."'>
             </label><br>
             <label >Type
             <select name='type'>
             <option value='". $thetype2 ."'selected hidden>". $thetype2 ."</option>
             <option value='New'>New</option>
             <option value='User'>User</option>
             <option value='Moderator'>Moderator</option>
             <option value='Admin'>Admin</option>
          </select>           <br>  
          <label>Name
          <input class='lbl' name='name' value='". $userdata['name'] ."'>
             </label>
             <label>Family Name
             <input class='lbl' name='fname' value='". $userdata['fname'] ."'>
                </label><br>
                <label>Society
                <input class='lbl' name='society' value='". $userdata['society'] ."'>
                   </label><br>
                   <label>Adresse
                   <input class='lbl' name='adresse' value='". $userdata['adresse'] ."'>
                      </label><br>
                      <label>Town
                      <input class='lbl' name='town' value='". $userdata['town'] ."'>
                         </label>
                         <label>Postal code
                         <input class='lbl' name='pcode' value='". $userdata['pcode'] ."'>
                            </label><br><br>
                            <label>Phone
                            <input type='phone' class='lbl' name='phone' value='". $userdata['phone'] ."'>
                               </label><br><br>
          </label>
             <button class='confirm' ' >Edit item</button>
            </form>

             </div>



         <script>
         function show(x) {
            document.querySelector('.iedit'+x).style.display = 'flex';
            document.getElementById('black').style.display = 'block';

        };

        function closethis(x){
            document.querySelector('.iedit'+x).style.display = 'none';
            document.getElementById('black').style.display = 'none';
        };
         </script>
             </td><td><form method='POST' action='action/delete-user.php'>
             <button class='edit' >Delete item</button>
             <input type='hidden' name='id' value='". $userdata['id'] ."'>
         </form>
             </td></tr>";
         }
         echo "</table><br>";

     }
     ?>
    </table>

    <div id="black"></div>

</body>
<script>

    
document.body.style.overflow = "visible";
    </script>
</html>
<?php elseif($userdata['type'] == 3) : ?>
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