<?php
$error = false;
$msg = false;
require_once('pdo.php');
	if(isset($_POST['Fname']) || isset($_POST['Email']) || isset($_POST['DoB'])){
		if(strlen($_POST['Fname'])>1 || strlen($_POST['Email'])>1 || strlen($_POST['DoB'])){
			if(strpos($_POST['Email'],'@')>1){
				$sql = "INSERT INTO student (name, email, Dob, course)
						VALUES (:name, :email ,:Dob, :course)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					':name' => htmlentities($_POST['Fname']),
					':email' => $_POST['Email'],
					':Dob' => $_POST['DoB'],
					':course' => $_POST['course']
				));
				$error="SucessFully Signed Up";
				$msg = "<a href='login.php'>Click Here To Login In</a>";
			}
			else{
				$error = "Invalid Email";
			}
		}
		else{
			$error = "All Feilds Are Required";
		}
	}
?>



<html>
<head>
	<title>Sign UP Page</title>
	<style>
		*{
			box-sizing:border-box;
		}
		body{
			font-family:arial;
			font-size:24px;
		}
		label{
			display:inline-block;
			width:10%;
		}
		span{
			color:red;
		}
	</style>
</head>
<body>
<h1>Welcome To The Login Portal</h1>
<?php
	if($error!==false){
		echo "<span>".$error."</span>";
	}
?>
	<form method="post">	
		<label for="name">Full Name : </label>
		<input type="text" name="Fname" id="name"><br/><br/>
		<label for="email">Email : </label>
		<input type="email" name="Email" id="email"><br/><br/>
		<label for="dob">DOB : </label>
		<input type="date" name="DoB" id="dob"><br/><br/>
		<label for="crse">Course : </label>
		<select id="crse" name="course">
			<option value="php">PHP</option>
			<option value="html">HTML</option>
			<option value="css">CSS</option>
			<option value="sql">SQL</option>
		</select><br/><br/>
		<input type="submit"  id="submit">
	</form>
	<?php
		if($msg!==false){
			echo $msg;
		}
	?>
</body>
</html>