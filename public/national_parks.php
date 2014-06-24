<?php

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'justin', 'Maslog12');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";


function getParks($dbc) 
{
   //return $dbc->query('SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset())->fetchAll(PDO::FETCH_ASSOC);
 	$stmt = $dbc->prepare('SELECT * FROM national_parks LIMIT :limit OFFSET :offset');
	$stmt->bindValue(':limit', 4, PDO:: PARAM_INT);
	$stmt->bindValue(':offset', getOffset(), PDO:: PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOffset()
{
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return ($page - 1) * 4; 
}
$limit = 4;
$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchcolumn();
$numPages = ceil($count/$limit);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1; 

if($_POST)
{
	var_dump($_POST);
	$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'justin', 'Maslog12');

	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$stmt = $dbc->prepare('INSERT INTO national_parks (name, description, location, date_established, area_in_acres) VALUES (:name, :description, :location, :date_established, :area_in_acres )');

	    $stmt->bindValue(':name', $_POST['park_name'], PDO::PARAM_STR);
	    $stmt->bindValue(':description',  $_POST['park_description'],  PDO::PARAM_STR);
	    $stmt->bindValue(':location',  $_POST['park_location'],  PDO::PARAM_STR);
	    $stmt->bindValue(':date_established',  $_POST['park_date_established'],  PDO::PARAM_STR);
	    $stmt->bindValue(':area_in_acres',  $_POST['park_area'],  PDO::PARAM_INT);

	    $stmt->execute();
}

?>
<style>
#main
{
	border: 1px solid black;
	background-image: url(/img/nationalpark.jpg);
}
</style>

<html>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<head>
	<title>National Parks</title>
</head>
<h2 align = "center">National Parks</h2>
<body>
	
	<table class="table table-hover" align= "center" border = black 1px solid>
		<th>Id</th>
		<th>Name</th>
		<th>Description</th>
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
				<?= $rows['description'] ?>
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

	<? if ($page >= 2) : ?>
		<button type="button" class="btn btn-default"><a href="?page=<?=$prevPage; ?>">previous</a></button>
	<? endif ?>	
	<? if($page < $numPages) : ?>
	<button type="button" class="btn btn-default"><a href="?page=<?=$nextPage; ?>">next</a></button>
<? endif ?>
<h3>New National Park</h3>
    <form method="POST" type="text/css" enctype="multipart/form-data" action="">
        <p>
            <label for="park_name">Name</label>
            <input id="park_name" name="park_name" rows="1" cols="40" type="text" autofocus = "autofocus"></textarea>
        </p>
        <p>
            <label for="park_description">Description</label>
            <input id="park_description" name="park_description" rows="1" cols="40" type="text" autofocus = "autofocus"></textarea>
        </p>
         <p>
            <label for="park_location">Location</label>
            <input id="park_location" name="park_location" rows="1" cols="40" type="text" autofocus = "autofocus"></textarea>
        </p>
         <p>
            <label for="park_date_established">Date Established</label>
            <input id="park_date_established" name="park_date_established" rows="1" cols="40" type="date" autofocus = "autofocus"></textarea>
        </p>
         <p>
            <label for="park_area">Area</label>
            <input id="park_area" name="park_area" rows="1" cols="40" type="text" autofocus = "autofocus"></textarea>
        </p>
        <p> 
            <input type="submit" value="Add">       
        </p>

    </form>
    
</body>
</html>