<?php

if(empty($_GET['movie']))
{
	header('Location:index.php');

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
<table class= "table table-striped">
	<h2>You searched for: <?php echo $keyword ?></h2>
	<thead>
      <tr>
         <th>Name</th>
         <th>Genre</th>
         <th>Format</th>
         <th>Rating</th>
      </tr>
   </thead>
   <tbody>
	<?php foreach($movies as $movie) : ?>
	<div>
		<tr>
		<td><?php echo $movie->title ?></td>
		<td><?php echo $movie->genre_name ?></td>
		<td><?php echo $movie->format_name ?></td>
		<td><a href="ratings.php?rating=<?php echo $movie->rating_name ?>"> <?php echo $movie->rating_name ?> </a></td>
		</tr>
	</div>

	<?php endforeach; ?>
</tbody>
</table>

<?php if (empty($movies)){
	echo "<h3> Sorry could not find anything!</h3>";
}
?>
