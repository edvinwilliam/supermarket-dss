<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Supermarket Inventory Procurement Prediction</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    

    <?php
      if (file_exists('lrRes.php')) {
        include 'lrRes.php';
      } else {
        $lrRes = "- (Belum pernah memprediksi jumlah stok barang)";
      }

      if (file_exists('resStr.php')) {
        include 'resStr.php';
      } else {
        $resStr = "- (Belum pernah menggunakan Expert System)";
      }

      if (file_exists('logRes.php')) {
        include 'logRes.php';
      } else {
        $logRes = "- (Belum pernah memprediksi tren stok barang)";
      }
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

    <br>

    <div class="col-xs-6 col-centered panel panel-default">
         <h3>Linear Regression Result</h3>


         <div class="alert alert-info" role="alert">Jumlah barang akan berubah menjadi: <b><?php echo $lrRes; ?></b></div>

    </div>

    <div class="col-xs-6 col-centered panel panel-default">
         <h3>Logistic Regression Result</h3>


         <div class="alert alert-info" role="alert">Tren stok barang akan: <b><?php if ($logRes == 0) { echo"Tidak Naik"; } else {echo "Naik";} ?></div>

    </div>

    <div class="col-xs-6 col-centered panel panel-default">
         <h3>Expert System Result</h3>


         <div class="alert alert-info" role="alert">Kesimpulan yang didapatkan adalah <b><?php echo $resStr; ?></b></div>

    </div>
    
     
</body>

</html>
