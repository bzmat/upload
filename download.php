<?php 

if (isset($_GET['id'])) {
	
	$id = intval($_GET['id']);

	if ($id <= 0) {
		die('Nieprawidłowe ID');

	}else{

		$db = new mysqli('localhost', 'root', '', 'products');
		$query = "SELECT type, name, size, data FROM files WHERE id = {$id}";

		$result = $db->query($query);

		if ($result) {
			
			if ($result->num_rows == 1) {
				
				$row = $result->fetch_object();

				header("Content-Type" . $row->type);
				header("Content-Lenght" . $row->size);
				header("Content-Disposition: attachment; filname=" . $row->name);

				echo $row->data;
			}else{
				echo "Brak pliku z takim ID";
			}
		}else{
			echo "Błąd zapytania";
		}

		$db->close();
	}
}
 ?>