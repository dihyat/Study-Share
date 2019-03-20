
<?php
include 'Guest.php';

if(isset($_POST['loginSubmit']))
{
  guestLogin();
} 

if(isset($_POST['signupbtn']))
{
  guestRegister();
}

function guestLogin(){
  $userName = $_POST['uname'];
  $password = $_POST['psw'];

  $guestObj = new Guest;
  $acountExists = $guestObj->login($userName,$password);
  console_log($acountExists);
  if($acountExists == true){
    session_start();
    $_SESSION['userName'] = $userName;
    $_SESSION['logged_in'] = true;

    header("location: index.php");
  }
  else{
    echo'<script>
        alert("Incorrect username/password");
        </script>';
  }
}

function guestRegister(){
  $email = $_POST['email'];
  $userName = $_POST['username'];
  $password = $_POST['psw'];
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $name = $fname . " " . $sname;


  $guestObj = new Guest;
  $guestObj->register($email,$userName,$name,$password);
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

echo '<!DOCTYPE html>
<html class="no-js">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Login/Sign up</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li id="logo">Study Share</li>
        <li><a href="./index.php">Home</a></li>
      </ul>
    </div>

    
    <body>
      <center>
        <div class="FormDiv">
          <table class="FormTable">
            <tr>
              <td valign="top" style="border-right:1px solid #ccc;">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
              </td> 

              <td valign="top" style="padding-left: 20px;">
                  <h1>Login</h1>
                  <p>Please fill in this form to login.</p>
              </td>

            </tr>

            <tr>
              
              <td valign="top">
                <hr></hr>
                <form action="login.php" class="formbody"  method ="post">
                  <table>
                    <tr><td valign="top" class="TextBoxPart">
                      <p>
                        <label for="email"><b>Email</b></label>
                      </p>
                        <input type="text" placeholder="Enter Email" name="email" required>
                  
                      <p>
                        <label for="username"><b>Username</b></label>
                      </p>
                        <input type="text" placeholder="Enter username" name="username" required>
                        <p>
                        <label for="username"><b>Firstname</b></label>
                    </p>
                    <input type="text" placeholder="Enter firstname" name="fname" required>
                  
                    <p>
                        <label for="username"><b>Surename</b></label>
                    </p>
                        <input type="text" placeholder="Enter surename" name="sname" required>
                      <p>
                        <label for="psw"><b>Password</b></label>
                      </p>
                        <input type="password" placeholder="Enter Password" name="psw" required>
                    
                      <p>
                        <label for="psw-repeat"><b>Repeat Password</b></label>
                      </p>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                        
                    <br/><br/>
                          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                        
                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
                      </td></tr>

                    <tr><td valign="bottom">
                      <button class="btn" type="submit" name="signupbtn">Sign Up</button>
                    </td></tr>

                    </table>
                  </form>
              </td>

              <td valign="top">
                <hr></hr>
                  <form action="login.php" class="formbody"  method ="post">
                    <table>
                      <tr><td valign="top" class="TextBoxPart" style="padding-left: 20px;">
                      <p style="color:red;" id="error"></div>
                        <p>
                          <label for="uname"><b>Username</b></label>
                        </p>
                        <input type="text" placeholder="Enter Username" name="uname" required>
                        
                        <p>
                          <label for="psw"><b>Password</b></label>
                        </p>
                        <input type="password" placeholder="Enter Password" name="psw" required>
                        <span class="psw"> <a href="#">Forgot password?</a></span>
                        <br/><br/>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                      </td></tr>

                    <tr><td valign="bottom">
                      <button class="btn" type="submit" name="loginSubmit">Login</button>
                    </td></tr>
                  </table>

                </form>
              </td>

            </tr>

            <tr>

              <td>
                <hr></hr>
              </td>

              <td>
              <hr></hr>
            </td>

            </tr>
          </table>

        </div>
      </center>
    </body>

  </body>
</html>
';

?>