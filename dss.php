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
        <h3>Linear Programming</h3>
      
        <form method="post" action="linearresult.php" name="linearRegression">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input type="file" id="regInputFile" name="LinearRegressionCSV">
              <p class="help-block">File must be in .csv</p>
            </div>
            <button id="linearRegButton" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="col-xs-6 col-centered panel panel-default">
        <h3>Logistic Programming</h3>

        <form method="post" action="logisticresult.php" name="logisticRegression">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input type="file" id="exampleInputFile" name="LogisticRegressionCSV">
              <p class="help-block">File must be in .csv</p>
            </div>
            <button id="logisticRegButton" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</body>

</html>
