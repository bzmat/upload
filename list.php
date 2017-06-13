<?php 
$db = new mysqli('localhost', 'root','','products');

$query = "SELECT id, name FROM files ORDER BY id ";

$result = $db->query($query);

if ($result) {
	
	if ($result->num_rows >0) {
		
		echo "<ul>";
		while ($row = $result->fetch_object()){
			echo "<li><a href = 'download.php?id=".$row->id."'>". $row->name . "</a></li>"	;	}

	}else{
		echo "Brak plików w bazie";
	}

}else{
	
	echo $db->error;
}

 ?>