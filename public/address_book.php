<?
$contacts= $_POST;
$headings= ['name', 'address', 'city', 'state', 'zip', 'phone'];

$handle = fopen('contacts.csv', 'w');
// ($contacts as $contact) {
	fputcsv($handle, $contacts);
// }

fclose($handle);

//used array_push to put the two arrays together to build the list of contacts

?>
<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Address Book</title>
	</head>
	<body>	
	


<h3>Address Book</h3>
	<table border= 1>
		<tr><th>Name</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Phone</th></tr>
	<? foreach ($contacts as $key => $value): ?>
		<? if(empty($value)): ?>
		<?php echo "<td> " . "  Empty field!</td> "; ?>
		<?php else : ?>
		<?php echo "<td> $value</td> " ?>
<!-- 			<li><?= htmlspecialchars(strip_tags($username)) ?></li>
		
			<li><?= htmlspecialchars(strip_tags($address)) ?></li>	
		
			<li><?= htmlspecialchars(strip_tags($city)) ?></li>
	
			<li><?= htmlspecialchars(strip_tags($state)) ?></li>
		
			<li><?= htmlspecialchars(strip_tags($zip)) ?></li>
		
			<li><?= htmlspecialchars(strip_tags($phone)) ?></li> -->				
		<? endif; ?>
	<? endforeach; ?>	
	</table>		

	<h3>Contact Info</h3>

	<form method="POST" action="/address_book.php">
			<p>
				<label for="Name">Name</label>
				<input id="Name" name="Name" type="text" autofocus = "autofocus"><br></input>
				
				<label for="Address">Address</label>
				<input id="Address" name="Address" type="" autofocus = "autofocus"><br></input>
				
				<label for="City">City</label>
				<input id="City" name="City" type="text" autofocus = "autofocus"><br></input>
				
				<label for="State">State</label>
				<input id="State" name="State" type="text" autofocus = "autofocus"><br></input>
				
				<label for="Zip">Zip</label>
				<input id="Zip" name="Zip" type="text" autofocus = "autofocus"><br></input>
				
				<label for="Phone">Phone</label>
				<input id="Phone" name="Phone" type="text" autofocus = "autofocus"><br></input>	
			</p>
			<p>	
				<input type="submit">		
			</p>


	</form>
</body>
</html>