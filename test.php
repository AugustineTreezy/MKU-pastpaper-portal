<?php
// $pizza  = "What is master page as used in desktop publishing";
// $pieces = explode(" ", $pizza);
// $size=sizeof($pieces);

// for ($i=0; $i < $size; $i++) { 
// 	$value=$i+1;	
// 	echo "Value $value= $pieces[$i]<br>";
// 	if (strlen($pieces[$i])<4) {
// 		echo "Value $value should not be considered<br>";
// 	}
// }


// $the_string = "Differentiate between compiler and assembler";
// $the_word  = "differennce";

// // Output — The word "ben" exists in given string.
// if (stripos($the_string, $the_word) !== false || stripos($the_string, "differentiate") !== false) {
//   echo 'The word "'.$the_word.'" exists in given string.<br>';
// }

// echo implode("%','%",$pieces)

$array = ["they has mystring in it", "some", "other", "elements"];
if (stripos(json_encode($array),'ring') !== false) {
echo "found mystring";
}

 ?>