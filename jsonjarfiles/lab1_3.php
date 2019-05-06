<html>
    <body>
        <?php
            // Ellie Parobek lab1-3
            echo "<h2>Question 3</h2>";
            $array = [87, 75, 93, 95];
            $avg = 0;
            unset($array[1]);
            foreach($array as $val){
				$avg += $val;
			}
            $avg = $avg / count($array);

            echo "Average test score is $avg.";
        ?>
    <body>
<html>