<?php

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pass = 'ttrojan';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

$rating= $_GET['rating'];

$sql= "
	SELECT title, rating_name
	FROM dvds
	INNER JOIN ratings
	ON dvds.rating_id=ratings.id
	WHERE rating_name = ?
";

$statement= $pdo->prepare($sql);
$like= $rating;
$statement->bindParam(1,$like);
$statement->execute();
$movies= $statement->fetchAll(PDO::FETCH_OBJ);
$count = count($movies);
echo $count;

?>

<h3><a href= "index.php"> Back </a></h3>
<H2> Movies with similar ratings: </H2>
<?php foreach($movies as $movie) : ?>
	<div>
		<?php echo $movie->title ?>
	</div>
<?php endforeach; ?>






