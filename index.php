<?php
	require_once "functions/menu.php";
	head();
?>
		<div id="divTitle" >BIBLIOTECA PROVENÇANA</div>
		<form method="post" action="">
			<label>Username:</label></br>
			<input type="text" name="username" required /></br>
			<label>Password:</label></br>
			<input type="password" name="password" required /></br>
			<input type="submit" name="send" value="Login"/>
		</form>
		<?php
		session_start();
			if(isset($_POST["send"])){
				if(($_POST["username"]!=""&&$_POST["password"]!="")){
					$username = $_POST["username"];
					$password = $_POST["password"];
					if(false==is_readable("txt/user.txt")){
						echo "ERROR, Database not exist.";
					}
					else{
						$arxiu = fopen("txt/user.txt", "r");
						while(!feof($arxiu)){
							$linia = fgets($arxiu);
							$porciones = explode(";", $linia);
							if(strcmp($porciones[0], $username)==0){//==exactamente igual, === sale
								if(strcmp($porciones[1], $password)==0){
									$_SESSION['cont'] = $porciones[2];
									fclose($arxiu);
									header('location: Biblioteca.php');
								}
							}
						}//END While
						echo "Username or password incorrect";
						fclose($arxiu);
					}
				}
			}
		footer();
		?>
