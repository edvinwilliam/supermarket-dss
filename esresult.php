<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Supermarket Inventory Procurement Prediction</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    //Run ES program 
    <?php 
        $ES = new ExpertSystem(); 

        // Bagian yang nantinya echo result
        $resultES = $ES->getResult();
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
                location.href = "/dss/dss.php";
                };
              </script>
            </div>
        </div>
    </nav>

    <br><br>

    <div class="col-xs-6 col-centered panel panel-default">
         <h3>Expert System Result</h3>
         <br>

         <div class="alert alert-info" role="alert">The conclusion is <b><?php echo $resultES; ?></b></div>

    </div>
    
     
</body>

</html>


