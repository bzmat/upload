<?php 
/* walidacja pliku i zapis do konkretnego katalogu

$validExt = array('txt', 'xml');
$ext = end(explode('.', $_FILES['file']['name']));
if (($_FILES['file']['type'] == 'text/plain') || ($_FILES['file']['type'] == 'text/xml') && ($_FILES['file']['size'] < 1000) && in_array($ext, $validExt)) {
	if ($_FILES['file']['error']) {
		echo "Błąd";
	}else{
		echo ("Nazwa: " . $_FILES['file']['name']."<br>");
		echo ("Typ: " . $_FILES['file']['type']. "<br>");
		echo ("Rozmiar: " . $_FILES['file']['size']. "<br>");
		echo ("Katalog: " . $_FILES['file']['tmp_name']. "<br>");

		if (file_exists($_FILES['file']['name'])) {
			echo "Plik".$_FILES['file']['name'] ."już istnieje";
		}else{
			move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
		}
	}

}else{
	echo 'nieprawidłowy plik';
}*/

/*zapis pliku do bazy danych*/
if (isset($_FILES['file'])) {

	$db = new mysqli('localhost', 'root','','products');

	$name = $db->real_escape_string($_FILES['file']['name']);
	$type = $db->real_escape_string($_FILES['file']['type']);
	$size = intval($_FILES['file']['size']);
	$data = $db->real_escape_string(file_get_contents($_FILES['file']['tmp_name']));

	/*zapytanie do bazy*/

	$query = "INSERT INTO files (name, type, size, data, created) VALUES ('{$name}', '{$type}', '{$size}', '{$data}', NOW())";

	$result = $db->query($query);

	if ($result) {
		echo "Plik została zapisany";
	}else{
		echo $db->error;
	}

	$db->close();

}

	