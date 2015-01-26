<?php

if(!isset($_GET['movie']))
{
	header('Location: search.php');

}

$keyword = $_GET['movie'];
$host= 'itp460.usc.edu';
$dbname= 'dvd';
$username= 'student';
$password= 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$sql="
	SELECT title, genre_name, format_name, rating_name
	FROM dvds
	INNER JOIN genres
	ON dvds.genre_id= genres.id
	INNER JOIN ratings
	ON dvds.rating_id= ratings.id
	INNER JOIN formats
	ON dvds.format_id= formats.id
	WHERE title LIKE ?
";

$statement= $pdo->prepare($sql);
$like ="%".$keyword."%";
$statement->bindParam(1,$like);
$statement->execute();
$movies= $statement->fetchAll(PDO:: FETCH_OBJ);

?>



<h3>You searched for: <?php echo $keyword ?></h3>
<?php foreach($movies as $movie) : ?>
	<div>
		<?php echo $movie->title ?>
		<?php echo $movie->genre_name ?> 
		<?php echo $movie->format_name ?>
		<a href="ratings.php?rating=<?php echo $movie->rating_name ?>"> <?php echo $movie->rating_name ?> </a>


	</div>
<?php endforeach; ?>

<?php if (empty($movies)){
	echo "<h3> Sorry could not find anything!</h3>";
	echo "<a href=";
	echo "index.php";
	echo"> Go back to search page</a>";
}
?>
