<?php
  // Initialize sessions
  session_start();
  require_once "config/config.php";
	// Define variables and initialize with empty values
    $email = $password = $re_password = "";
    $email_err = $password_err = $re_password_err = "";

  // Process submitted form data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : null;
    switch($action){
        case 'register':
        // Check if email is empty
		if (empty(trim($_POST['email']))) {
            echo "<script>alert('Please enter a email.');</script>";
			$email_err = "Please enter a email.";
			// Check if email already exist
		} else {
			// Prepare a select statement
			$sql = 'SELECT id FROM coffee WHERE email = ?';

			if ($stmt = $mysql_db->prepare($sql)) {
				// Set parmater
				$param_email = trim($_POST['email']);
			

				// Bind param variable to prepares statement
				$stmt->bind_param('s', $param_email);

				// Attempt to execute statement
				if ($stmt->execute()) {
					
					// Store executed result
					$stmt->store_result();

					if ($stmt->num_rows == 1) {
                        echo "<script>alert('This email is already taken.');</script>";
						$email_err = 'This email is already taken.';
					} else {
						$email = trim($_POST['email']);
					}
				} else {
                    echo "<script>alert('Oops! ${$email}, something went wrong. Please try again later.');</script>";
					echo "Oops! ${$email}, something went wrong. Please try again later.";
				}

				// Close statement
				$stmt->close();
			} else {

				// Close db connction
				$mysql_db->close();
			}
		}

		// Validate password
	    if(empty(trim($_POST["password"]))){
            echo "<script>alert('Please enter a password.');</script>";
	        $password_err = "Please enter a password.";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
            echo "<script>alert('Password must have atleast 6 characters');</script>";
	        $password_err = "Password must have atleast 6 characters.";
	    } else{
	        $password = trim($_POST["password"]);
	    }
    
	    // Validate confirm password
	    if(empty(trim($_POST["re_password"]))){
            echo "<script>alert('Please confirm password.');</script>";
	        $re_password_err = "Please confirm password.";     
	    } else{
	        $re_password = trim($_POST["re_password"]);
	        if(empty($password_err) && ($password != $re_password)){
	            $re_password_err = "Password did not match.";
                echo "<script>alert('Password did not match');</script>";
	        }
	    }

	    // Check input error before inserting into database

	    if (empty($email_err) && empty($password_err) && empty($re_password_err)) {

	    	// Prepare insert statement
			$sql = 'INSERT INTO coffee (email,password,name,number,country,address) VALUES (?,?,?,?,?,?)';

			if ($stmt = $mysql_db->prepare($sql)) {

				// Set parmater
				$param_email = $email;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Created a password
                $param_name = trim($_POST['name']);
				$param_number = trim($_POST['number']);
				$param_country = trim($_POST['country']);
				$param_address = trim($_POST['address']);

				// Bind param variable to prepares statement
				$stmt->bind_param('sssiss', $param_email, $param_password,$param_name,$param_number,$param_country,$param_address );

				// Attempt to execute
				if ($stmt->execute()) {
					// Redirect to login page
					echo "<script>alert('Sign Up Successfully,{$param_name}');</script>";
					// echo "Will  redirect to login page";
				} else {
                    echo "<script>alert('Something went wrong. Try signing in again');</script>";
					echo "Something went wrong. Try signing in again.";
				}

				// Close statement
				$stmt->close();	
			}

			// Close connection
			$mysql_db->close();
	    }
            break;


    case 'login':
  
    // Check if email is empty
    if(empty(trim($_POST['email']))){
        $email_err = 'Please enter email.';
      } else{
        $email = trim($_POST['email']);
      }
  
      // Check if password is empty
      if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
      } else{
        $password = trim($_POST['password']);
      }
  
      // Validate credentials
      if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = 'SELECT id, email,password,name,number,country,address FROM coffee WHERE email = ?';
  
        if ($stmt = $mysql_db->prepare($sql)) {
  
          // Set parmater
          $param_email = $email;
  
          // Bind param to statement
          $stmt->bind_param('s', $param_email);
  
          // Attempt to execute
          if ($stmt->execute()) {
  
            // Store result
            $stmt->store_result();
  
            // Check if email exists. Verify user exists then verify
            if ($stmt->num_rows == 1) {
              // Bind result into variables
              $stmt->bind_result($id, $email, $hashed_password,$name,$number,$country,$address);
  
              if ($stmt->fetch()) {
                if (password_verify($password, $hashed_password)) {
  
                  // Store data in sessions
                  $_SESSION['loggedin'] = true;
                  $_SESSION['id'] = $id;
                  $_SESSION['email'] = $email;
                  $_SESSION['name'] = $name;
                  $_SESSION['number'] = $number;
                  $_SESSION['country'] = $country;
                  $_SESSION['address'] = $address;
  

                    echo "<script>alert('Logged In Successfully, {$name}');</script>";
               
                  
                } else {
                  // Display an error for passord mismatch
                  $password_err = 'Invalid password';
                  echo "<script>alert('Invalid password');</script>";
                }
              }
            } else {
              $email_err = "email does not exists.";
              echo "<script>alert('email does not exists.');</script>";
            }
          } else {
            echo "Oops! Something went wrong please try again";
          }
          // Close statement
          $stmt->close();
        }
  
        // Close connection
        $mysql_db->close();
      }
            break;
    default:
            //action not found
            break;
    }

  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotShot Cafe</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--linking animatons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- linking css -->
    <link rel="stylesheet" type="text/css" href="main.css">

</head>

<body>


    <nav>
        <div class="img-div animate__animated animate__bounce ">
            <img src="assets/logo.jpg">
        </div>
        <div class="link">
            <a href="">Home</a>
        </div class="link">
        <div class="link">
            <a href="about.html">About us</a>
        </div>
        <div class="link">
            <a href="">Gallary</a>
        </div>
        <div class="link">
            <a href="">Menu</a>
        </div>
        <div class="link">
            <a href="">Contact</a>
        </div>

        <div class="animate__animated animate__backInDown animate__slow">
            <button class="loginBtn">Login</button>
        </div>
        <div class="grow">
            <p>level 13,ELIZABETH st,</p>
            <br>
            <p>first floor,new Delhi</p>
        </div>
    </nav>

    <main>
        <div id="home">

            <!-- ********************************Aside****************************** -->
            <aside>
                <div class="welcome">
                    <p class="name animate__animated animate__backInDown animate__slow">HotShot-</p>
                    <h1 class="animate__animated animate__zoomIn animate__slow">WELCOME TO</h1>
                    <h1 class="animate__animated animate__zoomIn animate__slow">OUR CAFE</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem sequi, quo expedita
                        illum
                        voluptate corrupti nostrum voluptatum sed, dolorem maxime error magni voluptatibus iste ea
                        temporibus quam vero, beatae obcaecati neque laborum autem iusto.
                    </p>
                </div>
                <div class="timing">
                    <div>
                        <p></p> WE are open</p>
                        <p>7days a week</p>
                    </div>
                    <div>
                        <h1 class="animate__animated animate__rollIn animate__slow ">8AM-7PM</h1>
                    </div>
                </div>

            </aside>
        </div>

        <div id="about">

        </div>

    </main>



    <!-- *************************** login form ************************** -->
    <div id="login" class="animate__animated animate__fadeIn">
        <button class="closeBtn">X</button>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="hidden" name="action" value="login">

            <div class="form-group <?php (!empty($email_err))?'has_error':'';?>">
                <p class="credentials">Email ID</p>
                <input type="email" name="email" id="#loginEmail" class="form-control"
                    value="<?php echo $email ?>">
            </div>

            <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
                <p class="credentials">Password</p>
                <input type="password" name="password" id="#loginPassword" class="form-control"
                    value="<?php echo $password ?>">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-block btn-outline-primary" value="login">
            </div>
        </form>
        <p class="signup-login">Don't have an account? <a href="#">sign up</a> </p>

    </div>

    <!-- ************************* sign up form *********************** -->
    <div id="signup" class="animate__animated animate__fadeIn">
        <button class="closeBtn">X</button>
        <h2>SIGN UP</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="hidden" name="action" value="register">

            <section>
                <p> Full Name </p> <input required name='name' id='registerName' type="text">
            </section>
            <section>
                <p> Mobile Number </p> <input required name='number' id='registerNumber' type="tel"
                    pattern="[1-9]\d{9}">
            </section>
            <section>
                <p> Country </p> <input required name="country" id='registerCountry' type="text">
            </section>
            <section>
                <p> Address </p> <input required name="address" id='registerAddress' type="text">
            </section>
            <section>
                <p> Email ID </p>
                <input required type="email" name="email" id='registerEmail' class="form-control"
                    value="<?php echo $email ?>">
                <section>

                    <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
                        <section>
                            <p> Create a Password </p>
                            <input type="password" name="password" id='registerPassword' class="form-control"
                                value="<?php echo $password ?>">
                            <section>
                    </div>

                    <div class="form-group <?php (!empty($re_password_err))?'has_error':'';?>">
                        <section>
                            <p> Re-Enter Password </p>
                            <input type="password" name='re_password' id='registerRePassword' class="form-control"
                                value="<?php echo $re_password; ?>">
                        </section>
                    </div>

                    <div class="form-group">
                        <input type="submit" id='registerBtn' value="Submit">
                    </div>
        </form>







        <p class="signup-login">Already have an account? <a href="#">login</a> </p>

    </div>



    <!-- ************************** Linking JS File ************************** -->
    <script src="index.js"></script>
</body>

</html>