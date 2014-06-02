<?
$contacts= $_POST;
$headings= ['name', 'address', 'city', 'state', 'zip', 'phone'];

$handle = fopen('contacts.csv', 'w');
$errormessage = "";

// ($contacts as $contact) {
	fputcsv($handle, $contacts);
// }

fclose($handle);


?>
<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>TODO List</title>
	</head>
	<body>	
	<?
	    var_dump($_POST);
    ?>


<h3>Address Book</h3>
	<dl>
	<? foreach ($contacts as $key => $value): ?>
		<? if(empty($value)): ?>
		<?php echo "$key " . "  incomplete"; ?><br>
		<?php else : ?>
		<?php echo "$key $value" ?>
<!-- 			<li><?= htmlspecialchars(strip_tags($username)) ?></li>
		
			<li><?= htmlspecialchars(strip_tags($address)) ?></li>	
		
			<li><?= htmlspecialchars(strip_tags($city)) ?></li>
	
			<li><?= htmlspecialchars(strip_tags($state)) ?></li>
		
			<li><?= htmlspecialchars(strip_tags($zip)) ?></li>
		
			<li><?= htmlspecialchars(strip_tags($phone)) ?></li> -->				
		<? endif; ?>
	<? endforeach; ?>	
	</dl>		

	<h3>Contact Information</h3>

	<form method="POST" action="/address_book.php">
			<p>
				<label for="Username">Username</label>
				<input id="Username" name="Username" type="text" autofocus = "autofocus"><br></input>
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