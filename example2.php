<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aequor Automated Tools</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <link href="data:text/css;charset=utf-8," data-href="css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id='email_validator'>
           <div class="panel panel-default" style="width: 75%;">
              <div class="panel-heading">Validate Valid Email Through SMTP</div>
              <div class="panel-body">
              <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
              <input type="file" name="file">
              <input type="submit" name="btn_submit" value="Upload File" />
              <div style="clear:both; height:20px;"></div>

               <?php
                error_reporting(0);
                 $row = 1;
                if (($handle = fopen($_FILES['file']['tmp_name'], "r+")) !== FALSE) {
                  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                  $num = count($data);
                  $row++;
                  $data;
                   for ($c=0; $c < $num; $c++) {
                     $data = $data[$c];
                    // echo $data[$c] . "<br />\n";
                    echo $data . "<br />\n";
                   }
                 }
                 echo $row . "<br />\n";

                 fclose($handle);
                 }


                  require_once('smtp_validateEmail.class.php');
                  // the email to validate
                  //$emails = array($row);
                 // $emails = array('schambers@columbusconventions.com', 'htamarin@congressplazahotel.com', 'sandy@simsburyinn.com', 'durgesh@gmail.com', 'charles.canfield@beachboardwalk.com', 'durgesh.tripathi2@gmail.com');
                  // an optional sender
                  $sender = 'durgesh.tripathi@aequor.com';
                  // instantiate the class
                  $SMTP_Validator = new SMTP_validateEmail();
                  // turn on debugging if you want to view the SMTP transaction
                  $SMTP_Validator->debug = false;
                  // do the validation
                  $results = $SMTP_Validator->validate($emails, $sender);
                  // view results
                  echo "<table class='table table-bordered table-responsive'>\n\n";
                  foreach($results as $email=>$result) {
                  // send email?
                  echo "<tr>";
                    if ($result) {
                      echo "<td style='padding:.4em;'>$email is valid</td>";
                    } else {
                      echo "<td style='padding:.4em;'>$email is not valid</td>";
                    }
                    echo "</tr>";
                  }
                  echo "</table>";
               ?>
           </div>
        </div>


<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery.csv-0.71.js"></script>

</body>
</html>