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
				$cname = htmlentities($_POST["cname"]);
				$username = htmlentities($_POST["username"]);
				$phone = htmlentities($_POST["phone"]);
				$location = htmlentities($_POST["location"]);
				$city = $_POST["city"];
				$password = hash('sha512', $_POST["password1"]);

				$sql = "INSERT into sellers(company_name, s_username, s_password,
				s_phone_number, shop_location, city_id)
				values(
					'{$cname}',
					'{$username}',
					'{$password}',
					'{$phone}',
					'{$location}',
					'{$city}'
				);";
				mysqli_query($conn, $sql) or die(mysqli_error($conn));

				header("Location: login.php");
			}
		}
	?>
<div class="wrapper">
    <div class="title">
      Seller Registration
    </div>
    <form class="form" action="<?php $_PHP_SELF ?>" method="post">
       <div class="inputfield">
          <label>Company Name</label>
          <input type="text" class="input" name="cname" required>
       </div>
        <div class="inputfield">
          <label>Username</label>
          <input type="text" class="input" name="username" required>
       </div>
       <div class="inputfield">
          <label>Password</label>
          <input type="password" class="input" name="password1" required>
       </div>
      <div class="inputfield">
          <label>Confirm Password</label>
          <input type="password" class="input" name="password2" required>
       </div>
			<?php
			 if($pwUnmatch)
				 echo "<p style='color: red;font-size: 11px; margin: -10px 0 20px 135px'>Password does not match</p>";
			?>
      <div class="inputfield">
          <label>Phone Number</label>
          <input type="tel" class="input" pattern="[0-9]{11}" name="phone" required>
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
          <label>Shop Location</label>
          <textarea class="textarea" name="location" required></textarea>
       </div>
      <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" required>
            <span class="checkmark"></span>
          </label>
          <p>Agreed to terms and conditions</p>
       </div>
      <div class="inputfield">
        <input type="submit" value="Register" class="btn" name="submit">
      </div>
    </form>
</div>
</body>
</html>
