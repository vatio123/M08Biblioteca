<?php
$servername = "localhost";
$bookname = "root";
$password = "alumne";
$database = "Biblioteca";
require_once "functions/menu.php";
head();
menu();
echo '<h2>Delete a book</h2>';
//print all books with delete checkbox

try {
  //    echo "----- Connection -----";
  //    echo "<br/>";
  $conn = new PDO("mysql:host=$servername;dbname=$database",
  $bookname,
  $password,
  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //  echo "----- SELECT all books -----";
  $stmt = $conn->prepare("SELECT * FROM books");
  $stmt->execute();
  $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $porciones = array();
  $cont=0;
  echo '<form method="post" action="">';
  $table="<table>";
  $table.="<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Gender</th><th>Year</th><th>Delete</th></tr>";
  foreach ($books as $key => $book) {

    $porciones[0]=$book['isbn'];
    $porciones[1]=$book['title'];
    $porciones[2]=$book['author'];
    $porciones[3]=$book['gender'];
    $porciones[4]=$book['year'];


    $table.="<tr>";

    for($j=0;$j<5;$j++){
      $table.="<td>".$porciones[$j]."</td>";
    }

    $table.='<td><input type="checkbox" name="del[]" value="'.$cont.'" </td>';
    $cont++;
    $table.="</tr>";

  }//END While
  $table.="</table>";
  echo $table;
  echo '<input type="submit" name="delete" value="Delete" /></form>';

  // Close connection
  $db = null;
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;

//take results and write in a temp file
if(isset($_POST["delete"])){

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",
    $bookname,
    $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //  echo "----- SELECT all users -----";
    $stmt = $conn->prepare("SELECT * FROM books");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cont2=0;
    $deleteSelection = array();
    if(isset($_POST['del'])){
      $deleteSelection = $_POST['del'];

      print_r ($deleteSelection);

      //$linia = fgets($file2);
      //while(!feof($file2)){
      foreach ($books as $key => $book) {
        $flag=0;
        for($i=0;$i<count($deleteSelection);$i++){
          if($cont2==$deleteSelection[$i]){
            $flag=1;
          }
        }
        if($flag!=0){
          $isbn = $book['isbn'];
          $stmt = $conn->prepare("DELETE FROM books WHERE isbn=:isbn");

          $stmt->bindParam("isbn", $isbn);

          // Execute the UPDATE
          $stmt->execute();
        }
        $cont2++;
      }//END While
      header('location: delete.php');
    }
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
}
footer();
?>
