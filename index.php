<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Tribu A 15</title>

    <meta name="description" content="UI-Less & Performant Transitions & Animations">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="assets/css/demo/demo.autoprefixed.css">

    <!-- Individual module CSS files here -->
    <!-- Should we combine or not combine? -->
    <link rel="stylesheet" href="assets/css/modules/modals.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/buttons.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/list-items.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/off-screen-nav.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/page-transitions.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/captions.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/list-scroll.autoprefixed.css">
    <link rel="stylesheet" href="assets/css/modules/bootstrap.css">
    <link rel="stylesheet" href="assets/css/modules/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/modules/bootstrap-responsive.css">
    <link rel="stylesheet" href="assets/css/modules/bootstrap-responsive.min.css">

</head>

<body>

  <nav class="effeckt-off-screen-nav" id="effeckt-off-screen-nav">

  <h4>
    Tribu a 15
    <a href="#0" id="effeckt-off-screen-nav-close" class="effeckt-off-screen-nav-close">×</a>
  </h4>

  <ul>
    <li><a href="#0">Home</a></li>
    <li><a href="#0">Profile</a></li>
    <li><a href="#0">Members</a></li>
    <li><a href="#0">Events</a></li>
    <li><a href="#0">Alumni</a></li>
    <li><a href="#0">Contact Us</a></li>
  </ul>

</nav>

  <div class="effeckt-page-transition" id="effeckt-page-transition">
    <?php



include ('members/database_connection.php');
if (isset($_POST['formsubmitted'])) {
    // Initialize a session:
session_start();
    $error = array();//this aaray will store all error messages
  

    if (empty($_POST['e-mail'])) {//if the email supplied is empty 
        $error[] = 'You forgot to enter  your Email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail'])) {
           
            $Email = $_POST['e-mail'];
        } else {
             $error[] = 'Your EMail Address is invalid  ';
        }


    }


    if (empty($_POST['Password'])) {
        $error[] = 'Please Enter Your Password ';
    } else {
        $Password = $_POST['Password'];
    }


       if (empty($error))//if the array is empty , it means no error found
    { 

       

        $query_check_credentials = "SELECT * FROM members WHERE (Email='$Email' AND password='$Password') AND Activation IS NULL";
   
        

        $result_check_credentials = mysqli_query($dbc, $query_check_credentials);
        if(!$result_check_credentials){//If the QUery Failed 
            echo 'Query Failed ';
        }

        if (@mysqli_num_rows($result_check_credentials) == 1)//if Query is successfull 
        { // A match was made.

           


            $_SESSION = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);//Assign the result of this query to SESSION Global Variable
           
            header("Location: page.php");
          

        }else
        { 
            
            $msg_error= 'Either Your Account is inactive or Email address /Password is Incorrect';
        }

    }  else {
        
        

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            
            echo '  <li>'.$values.'</li>';


       
        }
        echo '</ol></div>';

    }
    
    
    if(isset($msg_error)){
        
        echo '<div class="warning">'.$msg_error.' </div>';
    }
    /// var_dump($error);
    mysqli_close($dbc);

} // End of the main Submit conditional.



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>


    
    
    
<style type="text/css">
body {
  font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
  font-size:12px;
    
}
.registration_form {
 position: relative;
top: 20%;
left: 35%;
width: 200px;
margin: -100px 0 0 -100px;
}
label {
  width: 10em;
  float: left;
  margin-right: 0.5em;
  display: block
}
.submit {
  float:right;
  margin-right: 20px;
  margin-bottom: 5px;
}
fieldset {
  background:#EBF4FB none repeat scroll 0 0;
  border:2px solid #B7DDF2;
  width: 500px;
}
legend {
  color: #fff;
  background: #80D3E2;
  border: 1px solid #781351;
  padding: 2px 6px
}
.elements {
  padding:10px;
}
p {
  border-bottom:1px solid #B7DDF2;
  color:#666666;
  font-size:11px;
  margin-bottom:20px;
  padding-bottom:10px;
}
a{
    color:#0099FF;
font-weight:bold;
}
div.verify{
position: relative;
top: 21%;
left: 35%;
width: 300px;
color: #fff;
}


/* Box Style */


 .success, .warning, .errormsgbox, .validation {
  border: 1px solid;
  margin: 0 auto;
  padding:10px 5px 10px 60px;
  background-repeat: no-repeat;
  background-position: 10px center;
     font-weight:bold;
     width:450px;
     
}

.success {
   
  color: #4F8A10;
  background-color: #DFF2BF;
  background-image:url('images/success.png');
}
.warning {

  color: #9F6000;
  background-color: #FEEFB3;
  background-image: url('images/warning.png');
}
.errormsgbox {
 
  color: #D8000C;
  background-color: #FFBABA;
  background-image: url('images/error.png');
  
}
.validation {
 
  color: #D63301;
  background-color: #FFCCBA;
  background-image: url('images/error.png');
}



</style>

</head>
<body>
<div class="effeckt-page-transition-content">

     
      <button class="page-transition-reset-button btn btn-primary">Go Back Home</button>

    </div>


<form action="login.php" method="post" class="registration_form">
  <fieldset>
    <legend>Login Form  </legend>

    <p>Enter Your username and Password Below  </p>
    
    <div class="elements">
      <label for="name">Email :</label>
      <input type="text" id="e-mail" size="25"placeholder="Your Email" />
    </div>
  
    <div class="elements">
      <label for="Password">Password:</label>
      <input type="password" id="Password" name="Password" size="25"placeholder="Your password" />
    </div>
    <div class="submit ">
     <input type="hidden" name="formsubmitted" value="TRUE" />
      <input class="btn btn-primary"type="submit" value="Login" />
    </div>
  </fieldset>
</form>
<div class="verify">
Go Back to <a href="#">Account Verification on sign up</a>
</div>
</body>
</html>

    
</div>


    <!-- dialogs first is important for ~ selector -->
  <div class="effeckt-modal-wrap" id="effeckt-modal-wrap"> <!-- for centering transform -->
  <div class="effeckt-modal" id="effeckt-modal">
    <h3>Modal Dialog</h3>
    <div class="effeckt-modal-content">
      <p>This is a modal window.</p>
      <button class="effeckt-modal-close">Close me!</button>
    </div>
  </div>
  </div>
  <!-- overlay coming after is important for ~ selector -->
  <div class="effeckt-overlay no-transitions" id="effeckt-overlay"></div>

  <div class="page-wrap no-transitions" id="page-wrap">

    <h1>
      <a href="https://www.facebook.com/MaiziiLee28">
        <span>T</span>
        <span>R</span>
        <span>I</span>
        <span>B</span>
        <span>U</span>
        <span>-</span>
        <span>A</span>
        <br class="mobile-break">
        <span>1</span>
        <span>5</span>
        
      </a>
    </h1>
    <subhead>
      Many Links, One Chain!
      
    </subhead>







<section class="effeckt-demo-off-screen-nav">
  <div class="effeckt effeckt-demo-modals">

  <header>
    
    <!-- <span class="source">
      ...
    </span> -->
  </header>

  <div class="button-group">
  <button class="off-screen-nav-button btn btn-primary" data-effeckt="effeckt-off-screen-nav-left-push">Navigation</button>
  </div>

</div>

</section>
<section class="logo">
  <div class="center-logo">
      
        <a href="https://www.facebook.com/maxrizems"><img src="images/Xiao-Tian_01.jpg"></a>
      
  </div>
</section>
<section class="effeckt-demo-page-transitons">
  <div class="effeckt effeckt-demo-modals">

  <header>
    
    <!-- <span class="source">
      ...
    </span> -->
  </header>

  <button class="page-transition-button btn btn-primary" data-transition-in="effeckt-page-transition-right-slide-in" data-transition-out="effeckt-page-transition-right-slide-out">Login</button>

  <button class="page-transition-button btn btn-primary" data-transition-in="effeckt-page-transition-left-slide-in" data-transition-out="effeckt-page-transition-left-slide-out">Register</button>

</div>

</section>





    

  <!-- libs -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="adist/ssets/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
  <!-- for modals-2 -->

  <!-- demo -->
  <script src="dist/assets/js/demo/demo.js"></script>

  <!-- Individual module JS files here -->
  <!-- Should we combine or not combine? -->
  <!-- Should we provide minified versions? -->
  <script src="assets/js/modules/modals.js"></script>
  <script src="assets/js/modules/buttons.js"></script>
  <script src="assets/js/modules/list-items.js"></script>
  <script src="assets/js/modules/off-screen-nav.js"></script>
  <script src="assets/js/modules/page-transitions.js"></script>
  <script src="assets/js/modules/list-scroll.js"></script>
  <script src="assets/js/modules/bootstrap.js"></script>
  <script src="assets/js/modules/bootstrap.min.js"></script>



  <script>
    stroll.bind('.effeckt-demo-list-scroll ul');
  </script>

</body>

</html>
