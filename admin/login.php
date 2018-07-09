<!DOCTYPE html>
<html>
<head>
	<title>Administrator Perpustakaan BPCB JAMBI</title>

	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<p>SISTEM INFORMASI PERPUSTAKAAN AIE</p>
			
		</div>
		<div id="content">
			<div id="formlogin">
				<form action="proses_login.php" method="POST">
					<p>
						<label>Username</label>
						: <input type="text" name="usernm" size="20" placeholder="Username..." required>
					</p>
					<p>
						<label>Password</label>
						: <input type="password" name="passwrd" size="20" placeholder="Password..." required>
					</p>
					<p>
						<label>&nbsp;</label>
						&nbsp; <input type="submit" name="submit" value="Login">
					</p>

				</form>

			</div>

		</div>

	</div>


</body>
</html>