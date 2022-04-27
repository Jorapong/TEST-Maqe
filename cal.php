<?php
	function calDirection($rad)
	{
		$facing = "";

		if ($rad > 360|| $rad < -360) { $rad = $rad-360; return calDirection($rad); }

		if ($rad == 0 ) { $facing = "North"; }
		elseif ($rad == 90) { $facing = "East"; }
		elseif ($rad == -90) { $facing = "West"; }
		elseif ($rad == 180 || $rad == -180) { $facing = "South"; }
		elseif ($rad == 270) { $facing = "West"; }
		elseif ($rad == -270) { $facing = "East"; }
		elseif ($rad == 360 || $rad == -360) { $facing = "North"; }

		return $facing;
	}

	function calRaduisAndDistance($line)
	{
		$rad = 0;
		$X = 0;
		$Y = 0;
		$direction = "N"; // initial direction facing

		for($i=0; $i<strlen($line); $i++)
		{
			/////// Find Raduis ////////
			if ($line[$i] == "R") 		{ 	$rad += 90; 	}
			elseif ($line[$i] == "L") 	{  	$rad -= 90; 	}

			$direction = calDirection($rad); // latest current direction

			/////// Find Position //////
			if ($line[$i] == "W") {
				$distanceStr = "";	// initial distance string
				$distanceNum = 0; 	// initial distance number
				$find_str_number = 0;

				for($j = $i+1; $j < strlen($line); $j++) {

					$find_str_number = strpos("0123456789",$line[$j]);

					if(gettype($find_str_number) == "integer") {
						$distanceStr .= $line[$j];
					}
					else {
						$i = $j-1;
						break;
					}
				}
				$distanceNum = intval($distanceStr);

				///////// Start Walking ///////////
				if($direction == "North") { $Y += $distanceNum; }
				elseif($direction == "East") { $X += $distanceNum; }
				elseif($direction == "South") { $Y -= $distanceNum; }
				elseif($direction == "West") { $X -= $distanceNum; }
			}
		}
		return "X: ".$X." Y: ".$Y." Direction: ".$direction."\n";
	}
	$value=$_GET['value'];
	$resultmaqe=calRaduisAndDistance($value);

	header('Location: http://localhost/test/maqe.php?result='.$resultmaqe);
	?>