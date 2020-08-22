<html>
	<head>
		<title>E-Factor e-learning</title>
		<link rel="icon" type="image/png" href="images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			body
			{
				background-image:url('images/background.jpg');
				background-size:100% 100%;
				background-repeat:no-repeat;
			}
			.login-box
			{
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				height:520px;
				width:440px;
				box-shadow:0 0 20px -5px #212F3D;
				border-radius:1%;
				padding-top:9vh;
				box-sizing:border-box;
			}
			.login-background
			{
				opacity:0.2;
				height:520px;
				width:440px;
				border-radius:1%;
				position:fixed;
				top:0;
			}
			.profile-icon
			{
				height:25%;
				margin:auto;
				display:block;
				opacity:0.5;
			}
			form
			{
				margin-top:8.7vh;
			}
			input[type=text]
			{
				border:1px solid black;
				padding:2%;
				margin:auto;
				display:block;
				border-radius:2%;
				width:65%;
				background-color:transparent;
				position:relative;
				outline:none;
			}
			#password
			{
				padding:3%;
				width:100%;
				background-color:transparent;
				border:none;
				position:relative;
				outline:none;
			}
			.password-box
			{
				border:1px solid black;
				width:65%;
				margin:auto;
				display:block;
				border-radius:2%;
				position:relative;
			}
			input[type=submit]
			{
				border:1px solid #3498DB ;
				padding:2%;
				margin:auto;
				display:block;
				border-radius:2%;
				width:65%;
				font-weight:bold;
				color:white;
				background-color:#3498DB ;
				cursor:pointer;
				position:relative;
				top:8vh;
			}
			input[type=submit]:hover
			{
				background-color:#2E86C1;
				transition:0.3s;
			}
			::placeholder
			{
				color:#424949 ;
			}
			.eyes
			{
				height:23px;
				position:absolute;
				top:4px;
				left:90%;
				cursor:pointer;
				z-index:2;
			}
			#eyes-close
			{
				display:none;
			}
			.Register
			{
				position:relative;
				font-family:arial;
				font-size:15px;
				margin:70px 0 0 194px;
				
			}
		</style>
	</head>
	<body>
		<div class="login-box">
				<img src="images/white.jpg" class="login-background">
				<img class="profile-icon" src="images/profile.png">
				<form method="post">
					<input type="text" placeholder="Username" id="username" name="username"><br>
					<div class="password-box">
					<img src="images/eyeopen.png" class="eyes" id="eyes-open" onclick="Eye()">
					<img src="images/eyeclose.png" class="eyes" id="eyes-close" onclick="Eye()">
					<input type="password" placeholder="Password" id="password" name="password">
					</div>
					<input type="submit" value="LOGIN" id="login" name="login">
					<div class="Register">
						<a href="register.php" style="color:black;">Register</a>
					</div>
				</form>
		</div>
		<script>
		function Eye() 
		{
			var x = document.getElementById("password");
			if (x.type === "password") 
			{
				x.type = "text";
				document.getElementById("eyes-close").style.display="block";
				document.getElementById("eyes-open").style.display="none";	
			} 
			else 
			{
				x.type = "password";
				document.getElementById("eyes-open").style.display="block";
				document.getElementById("eyes-close").style.display="none";
			}
		}
		</script>
		<?php
			if(isset($_POST["login"]) && !empty($_POST["username"]) )
			{	
				$servername = "localhost";
				$username = "Daniel Davidraj";
				$password = "password";
				$dbname = "daniel davidraj";
				// Create connection
				$conn = mysqli_connect($servername,$username,$password,$dbname);
				// Check connection
				if (!$conn) 
				{
					die("Connection failed: " . mysqli_connect_error());
				}
				if(strcmp("teacher",$_POST["username"])==0 && strcmp("123",$_POST["password"])==0)
				{
					session_start();
					$_SESSION['name']="teacher";
					header("Location:teacher.php");
				}
				else
				{	
					$sql="SELECT `Name`,`Password`,`approved` FROM `accounts`";
					$result=mysqli_query($conn,$sql);
					$rowsnum=mysqli_num_rows($result);
					$i=0;
					if ($rowsnum > 0) 
					{
						while($row = mysqli_fetch_assoc($result)) 
						{
							if($row["Name"]==$_POST["username"] && $row["Password"]==$_POST["password"])
							{
								session_start();
								$_SESSION['name']=$row["Name"];
								$_SESSION['approved']=$row["approved"];
								header("Location:student.php");
							}
							$i++;
						}
					}
					if($i==$rowsnum)
					{
						echo "<script>alert('Please check your username or password');</script>";
					}
				}
				mysqli_close($conn);
			}
		?>
	</body>
</html>