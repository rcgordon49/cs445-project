<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

include("dbConnect.php");

// Define $username and $password
		$email=$_POST['email'];
		$password=$_POST['password'];
		$confirm=$_POST['confirmpassword'];
		$name=$_POST['name'];
		$location=$_POST['location'];
		$age=$_POST['age'];
		$gender=$_POST['gender'];

		console.log('$email');

		$checkEmailQuery = "SELECT * FROM Users U WHERE U.email_address = '$email'";

		$checkEmailQueryResults = mysql_query($watchQuery);
		$checkEmailQueryCount = mysql_num_rows($checkEmailQueryResults);

		if($checkEmailQueryCount == 0){

			if(strcmp($password, $confirm) == 0){

						
						// To protect MySQL injection for Security purpose
						$email = stripslashes($email);
						$password = stripslashes($password);

						if(isset($_POST['name'])){
							$name=stripslashes($_POST['name']);
						}else{
							$name= "No Name";
						}
						
						if(isset($_POST['location'])){
							$location = stripslashes($_POST['location']);
						}else{
							$location = "No Location";
						}
						
						if(isset($_POST['age'])){
							$age = stripslashes($_POST['age']);
						}else{
							$age = "No Age";
						}

						if(isset($_POST['gender'])){
							$gender = stripslashes($_POST['gender']);
						}else{
							$gender = "No Gender";
						}
						
						

						$username = mysql_real_escape_string($username);
						$password = mysql_real_escape_string($password);
						$name = mysql_real_escape_string($name);
						$location = mysql_real_escape_string($location);
						$age = mysql_real_escape_string($age);
						$gender = mysql_real_escape_string($gender);

						
						// SQL query to fetch information of registerd users and finds user match.
						$insertNewUserQuery = "INSERT INTO Users(email,name,password,age,gender,location) 
													VALUES ('$email','$name','$password','$age','$gender','$location')";

						$query = mysql_query($insertNewUserQuery);

						header("location: user.php?email=$email"); // Redirecting To Other Page
					

			}else{
				$error = "Passwords don't match";
				header("Location: signup.php?error=$error");
			}
		}else{
			$error = "Email already in use";
			header("Location: signup.php?error=$error");
		}

?>