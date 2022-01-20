<!DOCTYPE html>
<?php
	include "config.php";
?>
<html>
<head>
<title>Register</title>
	<link rel="stylesheet/less" href="less/register.less">
	<script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
</head>
<body>
	<?php
		$pwUnmatch = false;
		$cities = $conn->query("select * from cities");
		if(isset($_POST['submit']))
		{
			if($_POST["password1"] != $_POST["password2"])
			{
				$pwUnmatch = true;
			}
			else {
				$fname = htmlentities($_POST["fname"]);
				$lname = htmlentities($_POST["lname"]);
				$username = htmlentities($_POST["username"]);
				$dob = $_POST["dob"];
				$address = htmlentities($_POST["address"]);
				$city = $_POST["city"];
				$gender = htmlentities($_POST["gender"]);
				$password = hash('sha512', $_POST["password1"]);

				$sql = "INSERT into customers(first_name, last_name, username, password,
				gender, date_of_birth, address, city_id)
				values(
					'{$fname}',
					'{$lname}',
					'{$username}',
					'{$password}',
					'{$gender}',
					'{$dob}',
					'{$address}',
					'{$city}'
				);";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));

				header("Location: login.php");
			}
		}
	?>
<div class="wrapper">
    <div class="title">
      Customer Registration
    </div>
    <form class="form" action="<?php $_PHP_SELF ?>" method="post">
       <div class="inputfield">
          <label>First Name</label>
          <input type="text" class="input" name="fname" value="" required>
       </div>
        <div class="inputfield">
          <label>Last Name</label>
          <input type="text" class="input" name="lname" value="" required>
       </div>
        <div class="inputfield">
          <label>Username</label>
          <input type="text" class="input" name="username" value="" required>
       </div>
       <div class="inputfield">
          <label>Password</label>
          <input type="password" class="input" name="password1" required>
       </div>
      <div class="inputfield">
          <label>Confirm Password</label>
          <input type="password" class="input" name="password2" prequired>
       </div>
			<?php
			 if($pwUnmatch)
				 echo "<p style='color: red;font-size: 11px; margin: -10px 0 20px 135px'>Password does not match</p>";
			?>
        <div class="inputfield">
          <label>Gender</label>
          <div class="custom_select" required>
            <select name="gender">
              <option value="" disabled selected>Select</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
       </div>
      <div class="inputfield">
          <label>Data of Birth</label>
          <input type="date" class="input" name="dob" value=""required>
       </div>
			 <div class="inputfield">
				 <label>City</label>
				 <div class="custom_select" required>
					 <select name="city">
						 <option value="" disabled selected>Select</option>
						 <?php
						 	foreach($cities as $city)
							{
								echo '<option value="'. $city['city_id'] .'">'.$city['city_name'].'</option>';
 					 		}
						 ?>
						 </select>
				 </div>
			</div>
      <div class="inputfield">
          <label>Address</label>
          <textarea class="textarea" name="address" value="" required>
          </textarea>
       </div>
      <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" required>
            <span class="checkmark"></span>
          </label>
          <p>Agreed to terms and conditions</p>
       </div>
      <div class="inputfield">
        <input type="submit" value="Register" name="submit" class="btn">
      </div>
    </form>
</div>
</body>
</html>
