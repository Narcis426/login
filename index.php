<?php

include 'connection.php';

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
 
    redirect("dashboard.php");
}
include 'header.php';
$mode="";
$title = "Autentificare";
if (isset($_POST['mode']))
{
$mode = $_POST['mode'];
}

if ($mode == "loginare") {
    $username = trim($_POST['username']);
    $pass = trim($_POST['user_password']);

    if ($username == "" || $pass == "") {

      // echo ""
     
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass' ";
        $results= mysqli_query($db,$sql);
        if (!$results)
        die('Invalid querry:' .mysqli_error($db));
        else 
            {

         

$sql2 = mysqli_query($db,"SELECT users.Id, users.nume, users.username, user_types.redirect, dash_text.content_text,dash_text.titlu FROM users LEFT JOIN dash_text  ON users.type=dash_text.user_type_id LEFT JOIN user_types ON users.type= user_types.Id WHERE users.username = '$username' AND users.password = '$pass'");
$myrow1=mysqli_fetch_array($sql2,MYSQLI_ASSOC);

$rows= mysqli_num_rows($sql2);

            if ($rows > 0) {
               
        

                $_SESSION["user_id"] = $myrow1["Id"];
                $_SESSION["name"] = $myrow1["nume"];
                $_SESSION["username"] = $myrow1["username"];
                $_SESSION["titlu"] = $myrow1["titlu"];
                $_SESSION["continut"] = $myrow1["content_text"];
           
               


                redirect($myrow1["redirect"]);
                exit;
            } 

        }
    }
    redirect("index.php");
}


?>
    <div class="page-header">
        <h1><?php echo $title ?></h1>
    </div>
<form name="contact_form" id="contact_form" method="post" action="">
    
<div class="row">
<p class="hide"><input type="text" name="mode" value="loginare" ></p>
<div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
        Username: <input type="text" name="username" >
</div>
<div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
        Parola: <input type="password" name="user_password">
</div>
<div class="large-8 medium-8 small-8 columns">
<button type="submit" class="success button" name="submit">Logare</button>
</div>
</div>




                
                
                
				
            </fieldset>
        </form>

    </div>


</div>
<?php include 'footer.php'; ?>