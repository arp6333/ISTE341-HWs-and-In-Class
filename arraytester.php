<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Array Tester</title>
	</head>
	<body>
		<?php
			echo "<h1>#1 - Standard indexed array</h1>";
			$array1 = array(55, 66, 77, 88); // or $array1 = [55, 66, 77, 88];
			$array1[] = 99; // append
			$array1[0] = 11; // change element

			for($i = 0; $i < count($array1); $i++){
				echo $array1[$i]."<br/>";
			}


			echo "<h1>#2 - Associative array value</h1>";
			$array2 = array('RIT' => "http://www.rit.edu", 'Google' => "http://www.google.com"); // can use single or double quotes
			// or $array2 = ['RIT' => "http://www.rit.edu", 'Google' => "http://www.google.com"];
			$array2["CNN"] = "http://www.cnn.com"; // append assoc
			$array2[] = 12; // append numerical
			$array2[] = 13;

			foreach($array2 as $val){ // must use foreach, cannot use for loop
				echo "$val <br/>";
			}


			echo "<h1>#3- Associative array value and key</h1>";
			foreach($array2 as $key => $val){
				echo "$key - $val <br/>";
			}


			echo "<h1>#4 - Associative array build some links</h1>";
			foreach($array2 as $key => $val){ // must use foreach, cannot use for loop
				echo "<a href = '$val'>$key</a> <br/>";
			}


			echo "<h1>#5 - Nested Asoociative Array - one at a time</h1>";
			$array3 = array(
				'colors' => array('red', 'green', 'blue', 'yellow'),
				'shapes' => array('square', 'circle', 'triangle')
			);

			foreach($array3['colors'] as $val){
				echo "$val <br/>";
			}
			foreach($array3['shapes'] as $val){
				echo "$val <br/>";
			}


			echo "<h1>#6 - Nested Asoociative Array - nested for loops</h1>";
			foreach($array3 as $val){
				foreach($val as $v){
					echo "$v <br/>";
				}
				echo "<hr/>";
			}

			foreach($array3 as $key => $val){
				echo "<h2>$key</h2>";
				foreach($val as $v){
					echo "$v <br/>";
				}
				echo "<hr/>";
			}
		?>
	</body>
</html>
