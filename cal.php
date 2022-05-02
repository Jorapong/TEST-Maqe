<?php

function calDirection($rad)
{
	$facing = "";

	if ($rad > 360 || $rad < -360) {
		$rad = $rad - 360;
		return calDirection($rad);
	}

	if ($rad == 0) {
		$facing = "North";
	} elseif ($rad == 90) {
		$facing = "East";
	} elseif ($rad == -90) {
		$facing = "West";
	} elseif ($rad == 180 || $rad == -180) {
		$facing = "South";
	} elseif ($rad == 270) {
		$facing = "West";
	} elseif ($rad == -270) {
		$facing = "East";
	} elseif ($rad == 360 || $rad == -360) {
		$facing = "North";
	}

	return $facing;
}

function calRaduisAndDistance($line)
{	
	$tables = array(
		array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
		array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
		array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1), array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)
	);
	$rad = 0;
	$X = 0;
	$Y = 0;
	$direction = "North"; // initial direction facing
	$tables[$X + 7][$Y + 7] = 3;
	for ($i = 0; $i < strlen($line); $i++) {
		//$table[$X+4][$Y+4]=0;
		/////// Find Raduis ////////
		if ($line[$i] == "R") {
			$rad += 90;
		} elseif ($line[$i] == "L") {
			$rad -= 90;
		}

		$direction = calDirection($rad); // latest current direction

		/////// Find Position //////
		if ($line[$i] == "W") {
			$distanceStr = "";	// initial distance string
			$distanceNum = 0; 	// initial distance number
			$find_str_number = 0;

			for ($j = $i + 1; $j < strlen($line); $j++) {

				$find_str_number = strpos("0123456789", $line[$j]);

				if (gettype($find_str_number) == "integer") {
					$distanceStr .= $line[$j];
				} else {
					$i = $j - 1;
					break;
				}
			}
			$distanceNum = intval($distanceStr);
			for ($o = 0; $o <= $distanceNum; $o++) {
				///////// Start Walking ///////////
				if ($direction == "North") {
					$Y += 1;
				} elseif ($direction == "East") {
					$X += 1;
				} elseif ($direction == "South") {
					$Y -= 1;
				} elseif ($direction == "West") {
					$X -= 1;
				}
				$tables[$X + 7][$Y + 7] = 0;
			}
		}
	}
	$tables[$X + 7][$Y + 7] = 4;
	return '{"value":"X: ' . $X . ' Y: ' . $Y . ' Direction: ' . $direction.'","table":"' . json_encode($tables) . '"}';
}
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == 'GET') {
	$value = $_GET['value'];
	echo (calRaduisAndDistance($value));
}
