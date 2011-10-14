<?php 
//get the contents of the file
$contents = file_get_contents('/Users/lisawilliams/private/filetest_01.txt');
if ($contents === false) {
	echo 'Sorry, there was a problem reading the file.';
	} else { 
//split the contents into an array of words
$words = explode(' ', $contents);
//extract the first four elements of the array 
$first = array_slice($words, 0, 4);
//join the first four elements and display
echo implode(' ', $first); 
}

?>