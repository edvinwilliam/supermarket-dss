<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Supermarket Inventory Procurement Prediction</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- Run LinReg program  -->
    <?php
		spl_autoload_register(function ($class_name) {
		    include $class_name . '.php';
		});

		$reg = new Regression();

		// $reg->displayVar(); echo '<br>';

		$reg->loadCSV('data/testfile.csv', [1], [9, 10, 11, 12]);

		$mx = new Matrix($reg->getX());
		$my = new Matrix($reg->getY());

		$reg->compute($mx, $my);

		$carr = $reg->getCoefficients();
		$lrRes = $reg->predict();
	?>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                   <b>Supermarket Inventory Procurement Prediction [SIPP]</b><small> - A DSS/ES by Idham, Rezha, and Edvin</small>
                </a>
            </div>
            <div class="col-md-1 col-md-offset-2">
              <button id="dss" class="btn btn-primary" style="margin-top: 7px">Decision Support System</button>
              <!-- Change page to DSS System Page -->
              <script type="text/javascript">
                document.getElementById("dss").onclick = function () {
                location.href = "dss.php";
                };
              </script>
            </div>
        </div>
    </nav>

    <br><br>

    <div class="col-xs-6 col-centered panel panel-default">
         <h3>Linear Regression Result</h3>
         <br>

         <div class="alert alert-info" role="alert">The prediction is <b><?php echo $lrRes; ?></b></div>

    </div>
    
     
</body>

</html>
