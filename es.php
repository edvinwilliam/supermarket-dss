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
            <div class="col-md-1 col-md-offset-2">
              <button id="dss" class="btn btn-primary" style="margin-top: 7px">Decision Support System</button>
              <!-- Change page to DSS System Page -->
              <script type="text/javascript">
                document.getElementById("dss").onclick = function () {
                location.href = "/dss/dss.php";
                };
              </script>
            </div>
        </div>
    </nav>

    <br><br>
    <div class="col-xs-6 col-centered panel panel-default">
        <h3>Fill in the Expert System Query</h3>
        <form method="post" action="esresult.php" name="expertSystem">
            <div class="form-group">
              <label for="month">Month</label>
              <select class="form-control" name="selectMonth">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
              </select>
            </div>

            <div class="form-group">
              <label for="category">Product Category</label>
              <select class="form-control" name="selectCat">
                <option>AlatTulis</option>
                <option>Baju</option>
                <option>AlatMasak</option>
                <option>Elektronik</option>
              </select>
            </div>

            <button id="esButton" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
     
</body>

</html>