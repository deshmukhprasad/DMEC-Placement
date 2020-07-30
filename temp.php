<?php
 	$conn = new mysqli("localhost", "root", "", "placement");
	$result = $conn->query("SELECT image_path from slider");
	$tpo_connect = $conn->query("SELECT * from tpo_connect");
 	$tpo_connect = $tpo_connect->fetch_array(MYSQLI_ASSOC);

 	$dataPoints = array();
 	try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=placement;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('select year, offers from datapoints'); 
    $handle->execute(); 
    $result1 = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result1 as $row){
        array_push($dataPoints, array("x"=> $row->year, "y"=> $row->offers));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Final Static Placement</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./care_cancer.css">

	<script>
		window.onload = function() {
		 
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			title:{
				text: "Revenue Chart of Acme Corporation"
			},
			axisY: {
				title: "Revenue (in USD)",
				prefix: "$",
				suffix:  "k"
			},
			data: [{
				type: "bar",
				yValueFormatString: "$#,##0K",
				indexLabel: "{y}",
				indexLabelPlacement: "inside",
				indexLabelFontWeight: "bolder",
				indexLabelFontColor: "white",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		 
		}
		</script>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<section>
		<h2 class="text-center bg-dark text-light pb-2">Dynamic Bootstrap 4 Carousel Using PHP & MySQLi</h2>

		<div class="container-fluid">
			<div class="row justify-content-center mb-2">
				<div class="col-lg-10">
					<div id="demo" class="carousel slide" data-ride="carousel">

					  <!-- Indicators -->
					  <ul class="carousel-indicators">

					  	<?php
					  		$i = 0;
					  		foreach ($result as $row) {
					  			$actives = '';
					  			if($i == 0){
					  				$actives = 'active';
					  			}
					  	
					  	?>
					    <li data-target="#demo" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>

					    <?php $i++; } ?>
					  </ul>

					  <!-- The slideshow -->
					  <div class="carousel-inner">

					  	<?php
					  		$i = 0;
					  		foreach ($result as $row) {
					  			$actives = '';
					  			if($i == 0){
					  				$actives = 'active';
					  			}
					  	
					  	?>
					    <div class="carousel-item <?= $actives; ?>">
					      <img src="<?= $row['image_path'] ?>" width="100%" height="400">
					    </div>

					    <?php $i++; } ?>
					  </div>

					  <!-- Left and right controls -->
					  <a class="carousel-control-prev" href="#demo" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					  </a>
					  <a class="carousel-control-next" href="#demo" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					  </a>

					</div>

				</div>		
			</div>
		</div>
	</section>


	<!-- Placement Highlight Section -->
	<section class="placemnt_highlights" id="placemnt_highlights">
        <div class="container">
        	<div class="card">
        		<div class="card-body">
    			<h1 class="card-title text-center">Highllights</h1>
	            <div class="card-deck">
	            	<div class="card">
						<div class="card-body text-center" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val">3.5LPA</h2>
					    	<p class="card-text" id="HGLT_desc">Average Package</p>
					    </div>
					</div>
	            	<div class="card">
						<div class="card-body text-center" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val">6LPA</h2>
					    	<p class="card-text" id="HGLT_desc">Highest Package</p>
					    </div>
					</div>
					<div class="card">
						<div class="card-body text-center" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val">20+</h2>
					    	<p class="card-text" id="HGLT_desc">Companies Visiting</p>
					    </div>
					</div>
					<div class="card">
						<div class="card-body text-center" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val">50+</h2>
					    	<p class="card-text" id="HGLT_desc">Offers</p>
					    </div>
					</div>
	            </div>
	        	</div>
        	</div>
        </div>
    </section>

    <section id="chartSection">
		<div class="row">
			<div class="column">
				<div align="center" id="chartContainer"></div>
					<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>	
					
				</div>
			</div>
		</div>
    </section>


    <!-- Placement Connect Section -->
	<section class="placemnt_connect" id="placemnt_connect">
        <div class="container">
        	<div class="card">
        		<div class="card-body">
    			<h1 class="card-title text-center">Connect Us</h1>
	            <div class="card-deck">
	            	<div class="card">
						<div class="card-body text-center" id="TPO_Personal_Details">
							<h2 class="card-title text-center" id="TPO_Title">Placement Head</h2>
					    	<p class="card-text" id="TPO_Name"><?php echo $tpo_connect['name'] ;	?> </p>
					    	<p class="card-text" id="TPO_Phone"><?php echo $tpo_connect['phone'] ;	?> </p>
					    	<p class="card-text" id="TPO_Email"><?php echo $tpo_connect['email'] ;	?> </p>
					    </div>
					</div>
	            	<div class="card">
						<div class="card-body text-center" id="TPO_Office_Details">
							<h2 class="card-title text-center">IT Dept. Office</h2>
					    	<p class="card-text"><?php echo $tpo_connect['addr'] ;	?> </p>
					    	<p class="card-text"><?php echo $tpo_connect['office_no'] ;	?> </p>
					    </div>
					</div>
	            </div>
	        	</div>
        	</div>
        </div>
    </section>


	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>