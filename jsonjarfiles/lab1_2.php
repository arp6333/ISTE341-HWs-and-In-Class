<html>
    <body>
        <?php
            // Ellie Parobek lab1-2
            echo "<h2>Question 2</h2>";
            $array = [87, 75, 93, 95];
            $avg = 0;
            for($i = 0; $i < count($array); $i++){
				$avg += $array[$i];
			}
            $avg = $avg / count($array);

            echo "Average test score is $avg.";
        ?>
    <body>
<html>