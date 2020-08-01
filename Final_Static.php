<?php
	include 'statistics.php';
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="./final_static.css">
	<link rel="stylesheet" type="text/css" href="./logo_slider.css">

	<script type="text/javascript">
		// Load the Visualization API and the piechart package.
    	google.charts.load('current', {'packages':['corechart']});

    	// Set a callback to run when the Google Visualization API is loaded.
    	google.charts.setOnLoadCallback(drawChart1);
    	google.charts.setOnLoadCallback(drawChart2);
    	google.charts.setOnLoadCallback(drawChart3);

    	function drawChart1() {
		      var jsonData = $.ajax({
		          url: "ChartData.php",
		          method: "POST",
		          data: {chartid: 1},
		          dataType: "json",
		          async: false
		          }).responseText;
		          
			      // Create our data table out of JSON data loaded from server.
			      var data = new google.visualization.DataTable();
			      data.addColumn('string', 'Year');
	 			  data.addColumn('number', 'Package');

	 			  var dataPoints = JSON.parse(jsonData);
	 			  for (var i = 0; i <= dataPoints.length - 1; i++) {
	 			  	dataPoints[i][0] = dataPoints[i][0].toString();
	 			  	// console.log(dataPoints[i]);
	 			  }	
				data.addRows(dataPoints);
				console.log(data);

		      // Instantiate and draw our chart, passing in some options.
		      var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));
		      chart.draw(data, {title:'Year vs Avg. Package',width: 400, height: 240});
    	}

    	function drawChart2() {
		      var jsonData = $.ajax({
		          url: "ChartData.php",
		          method: "POST",
		          data: {chartid: 2},
		          dataType: "json",
		          async: false
		          }).responseText;
		          
			      // Create our data table out of JSON data loaded from server.
			      var data = new google.visualization.DataTable();
			      data.addColumn('string', 'Year');
	 			  data.addColumn('number', 'Placed students');
	 			  var dataArray = [];
	 			  var dataPoints = JSON.parse(jsonData);
	 			  for (var i = 0; i <= dataPoints.length - 1; i++) {
	 			  	dataPoints[i][0] = dataPoints[i][0].toString();
	 			  	// console.log(dataPoints[i]);
	 			  }
				data.addRows(dataPoints);
				console.log(data);

		      // Instantiate and draw our chart, passing in some options.
		      var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
		      chart.draw(data, {title:'Year vs Students Placed', width: 400, height: 240});
    	}

    	function drawChart3() {
		      var jsonData = $.ajax({
		          url: "ChartData.php",
		          method: "POST",
		          data: {chartid: 3},
		          dataType: "json",
		          async: false
		          }).responseText;
		          
			      // Create our data table out of JSON data loaded from server.
			      var data = new google.visualization.DataTable();
			      data.addColumn('string', 'Year');
	 			  data.addColumn('number', 'Company visited');

	 			  var dataPoints = JSON.parse(jsonData);
	 			  for (var i = 0; i <= dataPoints.length - 1; i++) {
	 			  	dataPoints[i][0] = dataPoints[i][0].toString();
	 			  	// console.log(dataPoints[i]);
	 			  }

				data.addRows(dataPoints);
				// console.log(data);

		      // Instantiate and draw our chart, passing in some options.
		      var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
		      chart.draw(data, {title:'Year vs Company Visited'});
    	}

		</script>

	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

	<h2 class="text-center bg-dark text-light pb-2">Placement</h2>
	<!-- Corousel Sections (Info) -->
	<section class="placement_corousel_section">

		<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3500" div-pause="hover">
  			<ol class="carousel-indicators">
    			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  			</ol>
  			
  			<div class="carousel-inner">
     			<?php
					$dbHost     = 'localhost';
        			$dbUsername = 'root';
        			$dbPassword = '';
        			$dbName     = 'placement';
										
						//Create connection and select DB
					$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
					
						//Check connection
					if($db->connect_error){
			   			die("Connection failed: " . $db->connect_error);
					}
				
						//Get image data from database
					$result = $db->query("SELECT id FROM tbl_images order by id DESC");
	
					$count=0;
					While($imgData = $result->fetch_assoc()){
						if($count == 0) {
							$count +=1;
							echo "<div class='carousel-item active'> <img data-u='image' src='display.php?id=". $imgData['id'] . "' 													class='d-block' width='100%'   height='475px'></div>"; 
						} 
						elseif ($count!=0) {
							echo "<div class='carousel-item'> <img data-u='image' src='display.php?id=". $imgData['id'] . "' class='d-block' width='100%'  height='475px'></div>"; 
							$count+=1;				 
						}       

					}
				?>
  			</div>
  			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    			<span class="sr-only">Previous</span>
  			</a>
  			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
  			  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  			  <span class="sr-only">Next</span>
  			</a>
		</div>

	</section>



    <!-- mine -->
    <section class="placemnt_highlights_section">
    	<div class="container container_highlights">
    		<h1 class=" card-title text-center">Placement Highlights</h1>
    		<div class="connect_flex manage_height">
    				
						<div class="card-body text-center highlights_content" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val"><?php echo average_package($conn) ?> LPA</h2>
					    	<p class="card-text" id="HGLT_desc">Average Package</p>
					    </div>
						<div class="card-body text-center highlights_content" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val"><?php echo highest_package($conn) ?> LPA</h2>
					    	<p class="card-text" id="HGLT_desc">Highest Package</p>
					    </div>
						<div class="card-body text-center highlights_content" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val"><?php echo company_visited($conn) ?>+</h2>
					    	<p class="card-text" id="HGLT_desc">Companies Visiting</p>
					    </div>
						<div class="card-body text-center highlights_content" id="HGLT">
							<h2 class="card-title text-center" id="HGLT_Val"><?php echo offer_number($conn) ?>+</h2>
					    	<p class="card-text" id="HGLT_desc">Offers</p>
					    </div>
    			
    		</div>
    	</div>
    </section>


    <!-- Chart Section -->
    <section class="chart_section">
    	<h1 class=" card-title text-center">Statistics</h1>
		<div class="row">
			<div class="column">
				<div align="center">
					<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>	 -->
					<div id="chart_div1"></div><br>
					<div id="chart_div2"></div><br>
					<div id="chart_div3"></div>
				</div>
			</div>
		</div>
    </section>



    <!-- Logo Slider -->
    <section class="placement_logo_slider_section">
    	<div class="container">
    		<h1 class="card-title text-center" style="color: black;">Our Recruiters</h1>
    		<div class="customer-logos" slider>
				<?php
        			$dirname = "./images/";
        			$images = scandir($dirname);
        			shuffle($images);
        			$ignore = Array(".", "..");
        			foreach($images as $curimg){
            			if(!in_array($curimg, $ignore)) {
            	    		echo "<div class='slide'><img src='".$dirname.$curimg."'><img src='img.php?src=".$dirname.$curimg."&w=300&zc=1' alt='' ></div>";
            			}
        			}                 
    			?>

    		</div>

		</div>
	</section>








    <!-- mine  contact-->
    <section class="placemnt_connect_section">
    	<div class="container container_connect">
    		<h1 class="text-center">Connect Us</h1>
    		<div class=" connect_flex">
    				
    					<div class="card-body text-center border_right" id="TPO_Personal_Details">
							<h2 class="card-title text-center" id="TPO_Title">Placement Head</h2>
					    	<p class="card-text" id="TPO_Name">
					    		<i class="fa fa-user-o"></i>
					    		<?php echo $tpo_connect['name'] ;	?>
					    	</p>
					    	<p class="card-text" id="TPO_Phone">
					    		<i class="fa fa-phone"></i>
					    		<?php 
					    			echo "<a href='tel:'.'".$tpo_connect['phone']."'> ".$tpo_connect['phone']."</a>";
					    		?>
					    	</p>
					    	<p class="card-text" id="TPO_Email">
					    		<i class="fa fa-envelope"></i>
					    		<?php 
					    			echo "<a href='mailto:'.'".$tpo_connect['email']."'> ".$tpo_connect['email']."</a>";
					    		?>
					    	</p>
					    </div>


					    

					    <div class="card-body text-center" id="TPO_Office_Details">
							<h2 class="card-title text-center">IT Dept. Office</h2>
					    	<p class="card-text">
					    		<i class="fa fa-address-book-o"></i>
					    		<?php echo $tpo_connect['addr'] ;	?> 
					    	</p>
					    	<p class="card-text">
					    		<i class="fa fa-phone"></i>
					    		<?php 
					    			echo "<a href='tel:'.'".$tpo_connect['office_no']."'> ".$tpo_connect['office_no']."</a>";
					    		?> 
					    	</p>
					    	<p class="card-text" id="TPO_Email">
					    		<i class="fa fa-envelope"></i>
					    		<a href="mailto:dmce$gmail.com"> dmce@gmail.com </a>
					    	</p>
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

	<!-- JS for logo slider -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.customer-logos').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 1000,
				arrows: false,
				dots: false,
					pauseOnHover: false,
					responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 3
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 2
					}
				}]
			});
		});
	</script>

</body>
</html>