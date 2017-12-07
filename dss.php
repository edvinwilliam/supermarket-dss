<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Supermarket Inventory Procurement Prediction</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                   <b>Supermarket Inventory Procurement Prediction [SIPP]</b><small> - A DSS/ES by Idham, Rezha, and Edvin</small>
                </a>
            </div>
            <div class="col-md-1 col-md-offset-3">
              <button id="es" class="btn btn-primary" style="margin-top: 7px">Expert System</button>
              <!-- Change page to Expert System Page -->
              <script type="text/javascript">
                document.getElementById("es").onclick = function () {
                location.href = "/dss/es.php";
                };
              </script>
            </div>
        </div>
    </nav>



    <br><br>
    <div class="col-xs-6 col-centered panel panel-default">
        <h3>Recent Summary</h3>
        <button id="sum" class="btn btn-primary" style="margin-top: 7px">Summary</button>
          <!-- Change page to Expert System Page -->
            <script type="text/javascript">
              document.getElementById("sum").onclick = function () {
              location.href = "/dss/summary.php";
              };
            </script>
    </div>

    <!-- Linear Regression Model -->
    <div class="col-xs-6 col-centered panel panel-default">
        <h3>Prediksi Jumlah Stok Barang</h3>
      
        <form method="post" action="linearresult.php" name="linearRegression">
            <div class="form-group">
              <label for="exampleInputFile">Model yang akan dipakai</label>
              <select class="form-control" name="model1">
              <option>SVM</option>
              <option>ANN</option>
              <option>Linear Regression</option>
              <option>Logistic Regression</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Prediksi yang diberikan pengguna</label>
              <select class="form-control">
              <option>Kurang dari 100</option>
              <option>Antara 100 dan 200</option>
              <option>Antara 200 dan 300</option>
              <option>Lebih dari 300</option>
              </select>
            </div>
            
            <button id="linearRegButton" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Logistic Regression Model -->
    <div class="col-xs-6 col-centered panel panel-default">
        <h3>Prediksi Tren Stok Barang</h3>

        <form method="post" action="logresult.php" name="logisticRegression">
            <div class="form-group">
              <label for="exampleInputFile">Model yang akan dipakai</label>
              <select class="form-control" class="model2">
              <option>SVM</option>
              <option>ANN</option>
              <option>Linear Regression</option>
              <option>Logistic Regression</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Prediksi yang diberikan pengguna</label>
              <select class="form-control">
              <option>Naik</option>
              <option>Tetap</option>
              <option>Turun</option>
              </select>
            </div>
            <button id="logisticRegButton" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</body>

</html>
