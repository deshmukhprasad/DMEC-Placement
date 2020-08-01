<?php 
function highest_package($conn)
{
	$statement = $conn->query("SELECT ROUND(MAX(package), 2) from offer WHERE year(offer_date) >= year(now()) - 3");
	if($statement){
		$result = $statement->fetch_all();
		foreach($result as $row)
		{
			return $row[0];
		}
	}
	else
	{
		echo $conn->error;
	}
}

function average_package($conn)
{
	$statement = $conn->query("SELECT ROUND(AVG(package), 2) from offer WHERE year(offer_date) >= year(now()) - 3");
	if($statement){
		$result = $statement->fetch_all();
		foreach($result as $row)
		{
			return $row[0];
		}
	}
	else
	{
		echo $conn->error;
	}
}

function company_visited($conn)
{
	$statement = $conn->query("SELECT COUNT(DISTINCT comp) from offer  WHERE year(offer_date) >= year(now()) - 3");
	if($statement){
		$result = $statement->fetch_all();
		foreach($result as $row)
		{
			return $row[0];
		}
	}
	else
	{
		echo $conn->error;
	}
}

function offer_number($conn)
{
	$statement = $conn->query("SELECT COUNT(DISTINCT oid) from offer WHERE year(offer_date) >= year(now()) - 3");
	if($statement){
		$result = $statement->fetch_all();
		foreach($result as $row)
		{
			return $row[0];
		}
	}
	else
	{
		echo $conn->error;
	}
}
 ?>