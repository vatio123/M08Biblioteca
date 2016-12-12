<?php
require_once "functions/menu.php";
head();
menu();
echo '<h2>List of books</h2>';

$servername = "localhost";
$bookname = "root";
$password = "alumne";
$database = "Biblioteca";
# Example (PDO)
# Select Data With PDO (+ Prepared Statements)
# The following example uses prepared statements.
# We use PDO beacuse its portability
# We use prepared statements, because its enhaced security
# we use FETCH_ASSOC, theoretically faster because are basic types
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
	?>

	<a href="view/addForm.php">New</a>
	<table border="1">
		<thead>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Gender</th>
			<th>Year</th>
			<!--<th></th>-->
		</thead>

		<?php foreach ($books as $key => $book) { ?>
			<tr>
				<td><?=$book['isbn']?></td>
				<td><?=$book['title']?></td>
				<td><?=$book['author']?></td>
				<td><?=$book['gender']?></td>
				<td><?=$book['year']?></td>
				<!--<td><a href="view/deleteForm.php?id=<?=$book['isbn']?>">delete</a>
					| <a href="view/editForm.php?id=<?=$book['isbn']?>">edit</a></td>
				</tr>-->
				<?php } ?>
			</table>
			<?php
			// Close connection
			$db = null;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		footer();
		?>
