<?
$address_book = [];
$errorMessage = '';
$filename = 'contacts.csv';

class AddressDataStore 
{
	public $filename = '';
	function __construct($filename)
	{
		$this->filename = $filename;
	}
	function readAddressBook()
	{
		$addresses = [];
		$handle = fopen($this->filename, 'r');
		$addresses = [];
			while(!feof($handle)) 
			{
				$row = fgetcsv($handle);
				if(!empty($row))
				{		
				$addresses[] = $row;
				}
			}
		fclose($handle);		
		return $addresses;
	
	}
	function writeAddressBook($addresses_array)
	{
		$handle = fopen($this->filename, 'w');
			foreach ($addresses_array as $fields) 
			{
				fputcsv($handle, $fields);
			}
		fclose($handle);
	}	
	function __destruct() 
    {
        echo "Class dismissed!";
    }
}

$ads = new AddressDataStore("contacts.csv");
//$ads->filename = 'contacts.csv';

$addressBook = $ads->readAddressBook();

if (!empty($_POST))
{ 
	if(!empty($_POST['Name']) && !empty($_POST['Address']) && !empty($_POST['City']) && !empty($_POST['State']) && !empty($_POST['Zip'])&& !empty($_POST['Phone']))
	{
		$newAddress = [];
		$newAddress['Name'] = $_POST['Name'];
		$newAddress['Address'] = $_POST['Address'];
		$newAddress['City'] = $_POST['City'];
		$newAddress['State'] = $_POST['State'];
		$newAddress['Zip'] = $_POST['Zip'];
		$newAddress['Phone'] = $_POST['Phone'];

		$addressBook[] = $newAddress;
	$ads->writeAddressBook($addressBook);
	}
	else
	{
		$errorMessage = "Validation failed. Please complete all fields.";
	}
}

?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Address Book</title>
			<meta name= "description" content="">
		</head>
		<body>	
		<h3>Address Book</h3>
			<p>	
			<table border="1">
				<tr>
					<th>Name</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Phone</th>
				</tr>
			<? foreach ($addressBook as $index => $row): ?>
			<tr>
				<? foreach ($row as $column): ?>		
					<td><?= $column;?></td>
				<? endforeach; ?>
			</tr>
		<? endforeach; ?>	
		</table>
		</p>
	<form method="POST" action="address_book.php">
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