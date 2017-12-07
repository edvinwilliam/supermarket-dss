<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Supermarket Inventory Procurement Prediction</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- Run ES program  -->
    <?php 
      spl_autoload_register(function ($class_name) {
          include $class_name . '.php';
      });

      if(isset($_POST['selectMonth'])) {   
            $monthStr = $_POST['selectMonth'];

            if ($monthStr == "January") {
                $theMonth = 1;
            }
            if ($monthStr == "February") {
                $theMonth = 2;
            }
            if ($monthStr == "March") {
                $theMonth = 3;
            }
            if ($monthStr == "April") {
                $theMonth = 4;
            }
            if ($monthStr == "May") {
                $theMonth = 5;
            }
            if ($monthStr == "June") {
                $theMonth = 6;
            }
            if ($monthStr == "July") {
                $theMonth = 7;
            }
            if ($monthStr == "August") {
                $theMonth = 8;
            }
            if ($monthStr == "September") {
                $theMonth = 9;
            }
            if ($monthStr == "October") {
                $theMonth = 10;
            }
            if ($monthStr == "November") {
                $theMonth = 11;
            }
            if ($monthStr == "December") {
                $theMonth = 12;
            }
        }

        if(isset($_POST['selectCat'])) {   
            $catStr = $_POST['selectCat'];

            if ($catStr == "Baju") {
                $theCategory = 1;
            }
            if ($catStr == "AlatMasak") {
                $theCategory = 2;
            }
            if ($catStr == "Elektronik") {
                $theCategory = 3;
            }
            if ($catStr == "AlatTulis") {
                $theCategory = 4;
            }

        }


        $ES = new ExpertSystem(); 
        $res = $ES->determine($theMonth, $theCategory, 4, 5, 1);

        if ($res == 1) {
          $resStr = "Pengadaan dianjurkan untuk turun";
        } else {
          $resStr = "Pengadaan dianjurkan untuk naik";
        }

        $var_str = var_export($resStr, true);
        $var = "<?php\n\n\$resStr = $var_str;\n\n?>";
        file_put_contents('resStr.php', $var);
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
         <h3>Expert System Result</h3>
         <br>

         <div class="alert alert-info" role="alert">Kesimpulan yang didapatkan adalah <b><?php echo $resStr; ?></b></div>

    </div>
    
     
</body>

</html>


