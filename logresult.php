<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Supermarket Inventory Procurement Prediction</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- Run LR program  -->
    <?php 
        spl_autoload_register(function ($class_name) {
            include $class_name . '.php';
        });

        $log = new Logistic();

        $reg = new Regression();
        $reg->loadCSV('data/testfile.csv', [6], [2, 3, 4, 5]);

        $log_train = splicemultidimensionalarray($reg->getX(), 0); 
        $log_labels = matrixtoarray($reg->getY());

        $log->compute($log_train, $log_labels);

        try{
            $logRes = $log->predict([300, 310, 10, 6]);
        } catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            die();
        }

        function matrixtoarray($matrix){
            $array = [];
            for ($i = 0; $i < sizeof($matrix); $i++) {
                $array[$i] = $matrix[$i][0];
            }
            
            return $array;
        }

        function splicemultidimensionalarray($array, $index){
            
            for($i=0; $i<sizeof($array); $i++){
                array_splice($array[$i], 0, 1);
            }
            
            return $array;
        }

        $var_str = var_export($logRes, true);
        $var = "<?php\n\n\$logRes = $var_str;\n\n?>";
        file_put_contents('logRes.php', $var);
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
         <h3>Prediksi Tren Stok Barang</h3>
         <br>

         <div class="alert alert-info" role="alert">Tren stok barang yang diprediksi adalah <b><?php if ($logRes == 0) { echo"Tidak Naik"; } else {echo "Naik";} ?></b></div>

    </div>
    
     
</body>

</html>


