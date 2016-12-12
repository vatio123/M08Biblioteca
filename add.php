<?php
require_once "functions/menu.php";
head();
menu();
echo '<h2>Add a book</h2>';
inputs(1);
$servername = "localhost";
$bookname = "root";
$password = "alumne";
$database = "Biblioteca";
$book="";
$cont=0;
do{
	if(isset($_POST["ok"])){
		if(0==is_int($_POST["isbn"])&&13==strlen($_POST["isbn"])){
			$book .= $_POST["isbn"].";";
			$cont++;
		}else{echo "ISBN not valid.";}

		if(1<strlen($_POST["title"])){
			$book .= $_POST["title"].";";
			$cont++;
		}else{echo "Title required.";}

		if(1<strlen($_POST["author"])){
			$book .= $_POST["author"].";";
			$cont++;
		}else{echo "Author not valid.";}

		if(isset($_POST["gender"])){
			$book .= $_POST["gender"].";";
			$cont++;
		}else{echo "Gender required.";}

		if(0==is_int($_POST["year"]) && 4 == strlen($_POST["year"])){
			$book .= $_POST["year"].";";
			$cont++;
		}else{echo "Year not valid.";}

		if($cont==5){


			# Example (PDO)
			# Insert Data With PDO (+ Prepared Statements)
			# The following example uses prepared statements.
			# We use PDO beacuse its portability
			# We use prepared statements, because its enhaced security
			# we use FETCH_ASSOC, theoretically faster because are basic types
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$database",
				$username,
				$password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//if (isset($_POST['doAdd'])) {

				$isbn = $_POST['isbn'];
				$title = $_POST['title'];
				$author = $_POST['author'];
				$gender = $_POST['gender'];
				$year = $_POST['year'];


				$stmt = $conn->prepare("INSERT INTO books (isbn, title, author, gender, year VALUES (:isbn, :title, :author, :gender, :year)");

				$stmt->bindParam("isbn", $isbn);
				$stmt->bindParam("title", $title);
				$stmt->bindParam("author", $author);
				$stmt->bindParam("gender", $gender);
				$stmt->bindParam("year", $year);
				// Execute the INSERT
				$stmt->execute();

				echo "Book added.";
				//}

				// Close connection
				$db = null;
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
		}
	}
}while($cont==-1);
footer();
?>
