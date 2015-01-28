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


?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Results</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

   
   

    
 </head>

<h4><a href= "index.php"> Go back to search page </a></h4>
<table class="table">
	<h2>Movies with <?php echo $like ?> ratings: </h2>
	<thead>
		<tr>
			<th>Name</th>
		</tr>
	</thead>

	<?php foreach($movies as $movie) : ?>
		<div>
			<tr>
			<td><?php echo $movie->title ?></td>
			</tr>
		</div>

	<?php endforeach; ?>
</tbody>
</table>






