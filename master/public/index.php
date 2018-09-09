<html>
 	<head>
  		<title>Url Shortner</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!--Style Sheet-->
		<link rel="stylesheet" href="css/style.css">
		<meta charset='UTF-8'>
		<meta name="urlshortner" content="Free URL Shortner">
		<link rel="shortcut icon" type="image/x-icon" href="" />
 	</head>
 	<body>
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-lg-4 col-md-4 hidden-sm hidden-xs"></div>
 				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
 					<form action="submit.php" method="post">
						<label for="url">Enter URL (http://example.com):</label>
					   	<input type="text" name="url" id="url">
					   	<input type="submit" value="Shorten">
		  			</form>
 				</div>
 				<div class="col-lg-4 col-md-4 hidden-sm hidden-xs"></div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
 				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
 					<?php
						echo "<div style='border: solid 1px black; text-align: center'>";
						echo "<div>Most Searched URL</div>";

						class TableRows extends RecursiveIteratorIterator { 
						    function __construct($it) { 
						        parent::__construct($it, self::LEAVES_ONLY); 
						    }

						    function current() {
						        return "<div style='border: 1px solid black;'>" . parent::current(). "</div>";
						    }

						    function beginChildren() { 
						        echo "<tr>"; 
						    } 

						    function endChildren() { 
						        echo "</tr>" . "\n";
						    } 
						} 

						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "test";

						try {
						    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						    $stmt = $conn->prepare("SELECT long_url FROM short_url ORDER BY counter DESC"); 
						    $stmt->execute();

						    // set the resulting array to associative
						    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

						    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
						        echo $v;
						    }
						}
						catch(PDOException $e) {
						    echo "Error: " . $e->getMessage();
						}
						$conn = null;
						echo "</div>";
					?>
 				</div>
 				<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
			</div>
		</div>
 	</body>
</html>
