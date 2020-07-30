<?php 
	$conn = new mysqli("localhost", "root", "", "placement");

	if($_POST['chartid'] == 1){
		$result = $conn->query("SELECT year(offer_date), ROUND(AVG(package), 2) FROM offer GROUP BY year(offer_date)");

		if(!$result){
			echo $conn->error;
		}
		else{
			$row = $result->fetch_all();

		}
		$ans = json_encode($row, JSON_NUMERIC_CHECK);
		echo $ans;
	}
	
	if($_POST['chartid'] == 2){
		$result = $conn->query("SELECT year(offer_date), COUNT(pid) FROM offer GROUP BY year(offer_date)");

		if(!$result){
			echo $conn->error;
		}
		else{
			$row = $result->fetch_all();

		}
		$ans = json_encode($row, JSON_NUMERIC_CHECK);
		echo $ans;
	}

	if($_POST['chartid'] == 3){
		$result = $conn->query("SELECT year(offer_date), COUNT(comp) FROM offer GROUP BY year(offer_date)");

		if(!$result){
			echo $conn->error;
		}
		else{
			$row = $result->fetch_all();

		}
		$ans = json_encode($row, JSON_NUMERIC_CHECK);
		echo $ans;
	}


 ?>