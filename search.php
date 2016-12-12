<?php
$servername = "localhost";
$bookname = "root";
$password = "alumne";
$database = "Biblioteca";
require_once "functions/menu.php";
head();
menu();
echo '<h2>Search a book</h2>';
inputs(2);
try {
	//    echo "----- Connection -----";
	//    echo "<br/>";
	$conn = new PDO("mysql:host=$servername;dbname=$database",
	$bookname,
	$password,
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//  echo "----- SELECT all users -----";
	$stmt = $conn->prepare("SELECT * FROM books");
	$stmt->execute();
	$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$porciones = array();

			$table="<table>";
			$table.="<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Gender</th><th>Year</th></tr>";
			foreach ($books as $key => $book) {

					$porciones[0]=$book['isbn'];
					$porciones[1]=$book['title'];
					$porciones[2]=$book['author'];
					$porciones[3]=$book['gender'];
					$porciones[4]=$book['year'];

				/*print_r (explode(";",$linia));*/

				$contInputs=0;
				$contCorrects=0;
				if(isset($_POST["ok"])){
					if(1<strlen($_POST["isbn"])){
						$contInputs++;
						if(0==strcmp($_POST["isbn"], $porciones[0])){
							$contCorrects++;
						}
					}
					if(1<strlen($_POST["title"])){
						$contInputs++;
						if(0==strcmp($_POST["title"], $porciones[1])){
							$contCorrects++;
						}
					}
					if(1<strlen($_POST["author"])){
						$contInputs++;
						if(0==strcmp($_POST["author"], $porciones[2])){
							$contCorrects++;
						}
					}
					if(1<strlen($_POST["gender"])){
						$contInputs++;
						if(0==strcmp($_POST["gender"], $porciones[3])){
							$contCorrects++;
						}
					}
					if(1<strlen($_POST["year"])){
						$contInputs++;
						if(($_POST["year"] == $porciones[4])){
							$contCorrects++;
						}
					}
				}

				if($contInputs==$contCorrects){
					$table.="<tr>";
					for($j=0;$j<5;$j++){
						$table.="<td>";
						$table.=$porciones[$j];
						$table.="</td>";
					}
					$table.="</tr>";
				}


			}//END While
			$table.="</table>";
			echo $table;
			// Close connection
			$db = null;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;

	footer();
	?>
