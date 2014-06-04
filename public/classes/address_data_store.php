<?php
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
}

?>