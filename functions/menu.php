<?php
function head(){
echo <<<HERE
  <html>
    <head>
      <title>Library</title>
      <meta http-equiv="content-type" content="text/html;charset=utf-8" />
      <meta name="generator" content="Geany 1.27" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
HERE;
}

function menu(){
  session_start();
	if (!isset($_SESSION['cont'])){
		header('location: index.php');
	}
	$_SESSION['cont']=trim($_SESSION['cont']);
echo <<<HERE

		<div id="divTitle" >BIBLIOTECA PROVENÇANA</div>
		<div id="divLinks">
HERE;
				if(0==strcmp($_SESSION['cont'], "admin")){
					echo '<a href="add.php">Add </a>';
					echo '<a href="delete.php">Delete</a>';
				}
echo <<<HERE
			<a href="list.php">List</a>
			<a href="search.php">Search</a>
			<a href="logout.php">Logout</a>
		</div>
HERE;
}

function inputs($x){//if $x==1 is for add function else for search function
//test if exist isert value
$required="";
if($x==1){$required="required";}
$isbn="";
if(isset($_POST['isbn'])){ $isbn = $_POST['isbn'];}
$title="";
if(isset($_POST['title'])){ $title = $_POST['title'];}
$author="";
if(isset($_POST['author'])){ $author = $_POST['author'];}
$gender="";
if(isset($_POST['gender'])){ $gender = $_POST['gender'];}
$year="";
if(isset($_POST['year'])){ $year = $_POST['year'];}
echo <<<HERE
  <form method="post" action="">
    <lable>ISBN:</lable>
    <input type="number" name="isbn" step="1" value="$isbn" $required />
    <br/><lable>Title:</lable>
    <input type="text" name="title" value="$title" $required />
    <br/><lable>Author:</lable>
    <input type="text" name="author" value="$author" $required />
    <br/><lable>Gender:</lable>
    <select name="gender" value="$gender" $required >
HERE;
        if(1<strlen($gender)){echo "<option value='$gender'>$gender</option>";}
        $file=fopen("txt/gender.txt","r");
        $linia = fgets($file);
        while(!feof($file)){
          $linia=trim($linia);
          echo '<option value="'.$linia.'">'.$linia.'</option>';
          $linia = fgets($file);
        }
        fclose($file);
        $valueSubmit="Search books";
        if($x==1){$valueSubmit="Add book";}
echo <<<HERE
    </select>
    <br/><lable>Year:</lable>
    <input type="number" name="year" step="1" value="$year" $required />
    <br/><input type="submit" name="ok" value="$valueSubmit" />
  </form>
HERE;
}

function footer(){
echo <<<HERE
  </body>
</html>
HERE;
}
?>
