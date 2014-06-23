<?php

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'justin', 'Maslog12');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";


function getParks($dbc) 
{

   return $dbc->query('SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset())->fetchAll(PDO::FETCH_ASSOC);
 
}

function getOffset()
{
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return ($page - 1) * 4; 
}

$count = $dbc->query('SELECT * FROM national_parks LIMIT 4 OFFSET 4')->fetchcolumn();
$numPages = ceil($count/4);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1; 



?>
<style>
#main
{
	border: 1px solid black;
}
</style>

<html>
<head>
	<title>National Parks</title>
</head>
<h2 align = "center">National Parks</h2>
<body>
	
	<table align= "center" border = black 1px solid>
		<th>Id</th>
		<th>Name</th>
		<th>Location</th>
		<th>Date Established</th>
		<th>Park Area</th>
		<? foreach(getParks($dbc) as $rows): ?>
		<tr>
			<td><?= $rows['id'] ?>
			</td>	
			<td>
				<?= $rows['name'] ?>
			</td>
			<td>
				<?= $rows['location'] ?>
			</td>
			<td>
				<?= $rows['date_established'] ?>
			</td>
			<td>
				<?= $rows['area_in_acres'] ?>
			</td>
		</tr>
		<? endforeach; ?>	
	</table>
	<a href="?page=<?=$prevPage; ?>">previous</a>
	<a href="?page=<?=$nextPage; ?>">next</a>

</body>
</html>