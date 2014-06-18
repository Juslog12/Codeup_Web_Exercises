<?
require_once('classes/address_data_store.php');
$address_book = [];
$errorMessage = '';
$filename = 'contacts.csv';
$ads = new AddressDataStore("contacts.csv");
//$ads->filename = 'contacts.csv';
$addressBook = $ads->readAddressBook();

if (isset($_GET['removeIndex'])) 
{
    $index = $_GET['removeIndex'];
    unset($addressBook[$index]);
    $addressBook = array_values($addressBook);
}

if(count($_FILES) > 0 && $_FILES['file1']['error'] == 0) 
{
    var_dump($_FILES);
    if($_FILES['file1']['type'] == 'text/csv') 
    {
        $upload_dir = '/vagrant/sites/codeup.dev/public/';
        $filename = basename($_FILES['file1']['name']);
        $saved_filename = $upload_dir . $filename; 
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
        $newBooks = new AddressDataStore($saved_filename);
        $uploadBooks = $newBooks->readAddressBook();
        $addressBook = array_merge($addressBook, $uploadBooks);
    }   
}

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
    
    }
    else
    {
        $errorMessage = "Validation failed. Please complete all fields.";
    }
}
$ads->writeAddressBook($addressBook);
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
                        <th>Remove</th>
                    </tr>

                <? foreach ($addressBook as $index => $row) : ?> 

                    <tr>
                        <? foreach ($row as $column): ?>        
                        <td><?= $column;?></td>
                        <? endforeach; ?>
                        <td><?= "<a href=\"address_book.php?removeIndex={$index}\">Remove Item </a>"?></td> :   
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
    </form>
    
    <h3>Upload File</h3>

    <form method="POST" enctype="multipart/form-data">
        <p>
            <label for="file1">File to upload: </label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" value="Upload">
        </p>
    </form>
</body>
</html>