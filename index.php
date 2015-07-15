
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

<nav class="navbar navbar-inverse navbar-fixed-top" style="background-image: url('images/Free_Analysis_Header.png'); background-repeat: no-repeat;height: 145px;background-size: cover;border-bottom: 2px solid red;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<img id="company_logo_header navbar-brand" src="images/Free_Analysis_Header.png" alt="logo" style="width: 100%;">-->
            <!--<a class="navbar-brand" href="#">REPUTATION UPGRADE ADMIN</a>-->
        </div>
    </div>
</nav>

<div class="container-fluid" style="padding-top: 80px;">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="padding-top: 100px;">
            <ul class="nav nav-sidebar">
                <li id='convert_to_excel'><a href="#">Convert Excel to CSV</a></li>
                <li id='generate_report'><a href="#">Generate Analysis Report</a></li>
                <li id='verify_email_with_domain'><a href="#">Verify Email With Domain</a></li>
                <li id='send_email_sendgrid'><a href="#">Send Mail Using SendGrid</a></li>
            </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main collapse" id='generate_csv'>
            <div class="panel panel-default">
               <div class="panel-heading">Import Excel File To Generate CSV</div>
               <div class="panel-body">
                 Output Format:
                 <select name="format">
                 <option value="csv" selected> CSV</option>
                 <option value="json"> JSON</option>
                 <option value="form"> FORMULAE</option>
                 </select>
                 <div style="clear:both; height:10px;"></div>
                 <div id="drop">Drop an XLSX / XLSM / XLSB / ODS / XLS / XML file here to see sheet data</div>
                 <div style="clear:both; height:10px;"></div>
                 <p><input type="file" name="xlfile" id="xlf" /></p>
                 <textarea id="b64data" style="resize:none;">... or paste a base64-encoding here</textarea>
                 <div style="clear:both; height:10px;"></div>
                 <input type="button" id="dotext" value="Click here to process the base64 text" onclick="b64it();"/><br />
                 Advanced Demo Options: <br />
                 Use Web Workers: (when available) <input type="checkbox" name="useworker" checked><br />
                 Use Transferrables: (when available) <input type="checkbox" name="xferable" checked><br />
                 Use readAsBinaryString: (when available) <input type="checkbox" name="userabs" checked><br />
                 <pre id="out" class="collapse"></pre>
                 <br />
               </div>
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main collapse" id='report_generation_section'>
            <div class="panel panel-default" style="width: 75%;">
               <div class="panel-heading">Generate Free Analysis Report</div>
               <div class="panel-body">
                 <div id=inputs class=clearfix>
                    <input type=file id=files name=files[] multiple />
                 </div>
                 <div style="clear: both; height: 10px;"></div>
                 <output id=list class="collapse"></output>
                 <table id=contents style="width:100%; height:400px;" class="table table-bordered table-responsive collapse"></table>
                 <div style="clear: both; height: 10px;"></div>
                 <div id="free_analysis"></div>
               </div>
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main collapse" id='email_validator'>
           <div class="panel panel-default" style="width: 75%;">
              <div class="panel-heading">Validate Valid Email Through SMTP</div>
              <div class="panel-body">
                <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  <input type="file" name="csv" id="csv_input">
                  <div style="clear:both; height:20px;"></div>
                  <input type="submit" name="btn_submit" value="Upload File" id="validate_email_address" />
                  <div style="clear:both; height:20px;"></div>
                  <img src="images/Please_Wait.gif" alt="Please wait" id="please_wait" class="collapse"/>

                   <?php
                      error_reporting(0);
                      $csv = array();
                      // check there are no errors
                      if($_FILES['csv']['error'] == 0){
                          $name = $_FILES['csv']['name'];
                          $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
                          $type = $_FILES['csv']['type'];
                          $tmpName = $_FILES['csv']['tmp_name'];
                          // check the file is a csv
                          if($ext === 'csv'){
                           if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                             // necessary if a large csv file
                             set_time_limit(0);
                             $row = 0;
                             echo "<a href='#' class='export' style='float:right;'>Export Emails</a>";
                             echo "<table class='table table-bordered table-responsive' id='smtp_validator'>\n\n";
                             echo "<tr><th>Emails</th><th>Result</th></tr>";
                             while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                               require_once('smtp_validateEmail.class.php');
                               $sender = 'durgesh.tripathi@aequor.com';
                               $SMTP_Validator = new SMTP_validateEmail();
                               $SMTP_Validator->debug = false;
                               $results = $SMTP_Validator->validate($data, $sender);
                               foreach($results as $email=>$result) {
                                 if($result){
                                   echo "<tr>";
                                   echo "<td class='valid' style='padding:.4em;color:green;'>$email</td>";
                                   echo "<td class='valid' style='padding:.4em;color:green;'>Valid Email</td>";
                                   echo "</tr>";
                                 }else{
                                   echo "<tr>";
                                   echo "<td class='invalid' style='padding:.4em;color:red;'>$email</td>";
                                   echo "<td class='invalid' style='padding:.4em;color:red;'>Invalid Email</td>";
                                   echo "</tr>";
                                 }
                               }
                               // inc the row
                               $row++;
                             }
                             echo "</table>";
                             fclose($handle);
                           }
                          }
                      }
                   ?>
              </div>
           </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main collapse" id='send_mail_through_sendgrid'>
           <div class="panel panel-default" style="width: 75%;">
              <div class="panel-heading">Send Mail Through SendGrid Mail Server</div>
              <div class="panel-body">
                <p>Coming Soon...</p>
              </div>
           </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery.csv-0.71.js"></script>
<script src="js/jspdf.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>


<script src="js/shim.js"></script>
<script src="js/jszip.js"></script>
<script src="js/xlsx.js"></script>
<!-- uncomment the next line here and in xlsxworker.js for ODS support -->
<script src="js/dist/ods.js"></script>


<script>
$('#validate_email_address').click(function(){
   var upload_csv = $('#csv_input').val();
   if(upload_csv == ''){
      alert('Please Select CSV to upload.');
      return false;
   }else{
      $('#please_wait').show();
      $('#email_validator').show();
      $('#verify_email_with_domain').addClass('active')
   }

})

function exportTableToCSV($table, filename) {
    var $headers = $table.find('tr:has(th)')
        ,$rows = $table.find('tr:has(td)')

        // Temporary delimiter characters unlikely to be typed by keyboard
        // This is to avoid accidentally splitting the actual contents
        ,tmpColDelim = String.fromCharCode(11) // vertical tab character
        ,tmpRowDelim = String.fromCharCode(0) // null character

        // actual delimiter characters for CSV format
        ,colDelim = '","'
        ,rowDelim = '"\r\n"';

        // Grab text from table into CSV formatted string
        var csv = '"';
        csv += formatRows($headers.map(grabRow));
        csv += rowDelim;
        csv += formatRows($rows.map(grabRow)) + '"';

        // Data URI
        var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    $(this)
        .attr({
        'download': filename
            ,'href': csvData
            //,'target' : '_blank' //if you want it to open in a new window
    });

    //------------------------------------------------------------
    // Helper Functions
    //------------------------------------------------------------
    // Format the output so it has the appropriate delimiters
    function formatRows(rows){
        return rows.get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim);
    }
    // Grab and format a row from the table
    function grabRow(i,row){

        var $row = $(row);
        //for some reason $cols = $row.find('td') || $row.find('th') won't work...
        var $cols = $row.find('td');
        if(!$cols.length) $cols = $row.find('th');

        return $cols.map(grabCol)
                    .get().join(tmpColDelim);
    }
    // Grab and format a column from the table
    function grabCol(j,col){
        var $col = $(col),
            $text = $col.text();

        return $text.replace('"', '""'); // escape double quotes

    }
}


// This must be a hyperlink
$(".export").click(function (event) {
    // var outputFile = 'export'
    var outputFile = window.prompt("What do you want to name your output file (Note: This won't have any effect on Safari)") || 'export';
    outputFile = outputFile.replace('.csv','') + '.csv'

    // CSV
    exportTableToCSV.apply(this, [$('#smtp_validator'), outputFile]);

    // IF CSV, don't do event.preventDefault() or return false
    // We actually need this to be a typical hyperlink
});


$('#generate_report').click(function(e){
      $(this).addClass('active');
      $('#convert_to_excel, #verify_email_with_domain, #send_email_sendgrid ').removeClass('active');
      $('#generate_csv, #email_validator, #send_mail_through_sendgrid').hide();
      $('#report_generation_section').show();
      e.preventDefault();
});

$('#convert_to_excel').click(function(e){
      $(this).addClass('active');
      $('#generate_report, #verify_email_with_domain, #send_email_sendgrid ').removeClass('active');
      $('#report_generation_section, #email_validator, #send_mail_through_sendgrid').hide();
      $('#generate_csv').show();
      e.preventDefault();
});

$('#verify_email_with_domain').click(function(e){
      $(this).addClass('active');
      $('#convert_to_excel, #generate_report, #send_email_sendgrid ').removeClass('active');
      $('#report_generation_section, #generate_csv, #send_mail_through_sendgrid').hide();
      $('#email_validator').show();
      e.preventDefault();
});

$('#send_email_sendgrid').click(function(e){
      $(this).addClass('active');
      $('#convert_to_excel, #generate_report, #verify_email_with_domain ').removeClass('active');
       $('#report_generation_section, #generate_csv, #email_validator').hide();
      $('#send_mail_through_sendgrid').show();
      e.preventDefault();
});

$(document).ready(function() {
        if(isAPIAvailable()) {
            $('#files').bind('change', handleFileSelect);
        }
    });

    function isAPIAvailable() {
        // Check for the various File API support.
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            // Great success! All the File APIs are supported.
            return true;
        } else {
            // source: File API availability - http://caniuse.com/#feat=fileapi
            // source: <output> availability - http://html5doctor.com/the-output-element/
            document.writeln('The HTML5 APIs used in this form are only available in the following browsers:<br />');
            // 6.0 File API & 13.0 <output>
            document.writeln(' - Google Chrome: 13.0 or later<br />');
            // 3.6 File API & 6.0 <output>
            document.writeln(' - Mozilla Firefox: 6.0 or later<br />');
            // 10.0 File API & 10.0 <output>
            document.writeln(' - Internet Explorer: Not supported (partial support expected in 10.0)<br />');
            // ? File API & 5.1 <output>
            document.writeln(' - Safari: Not supported<br />');
            // ? File API & 9.2 <output>
            document.writeln(' - Opera: Not supported');
            return false;
        }
    }
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        var file = files[0];
        // read the file metadata
        var output = '';
        output += '<span style="font-weight:bold;">' + escape(file.name) + '</span><br />\n';
        output += ' - FileType: ' + (file.type || 'n/a') + '<br />\n';
        output += ' - FileSize: ' + file.size + ' bytes<br />\n';
        output += ' - LastModified: ' + (file.lastModifiedDate ? file.lastModifiedDate.toLocaleDateString() : 'n/a') + '<br />\n';
        // read the file contents
        printTable(file);
        // post the results
        $('#list').append(output);
    }
    function printTable(file) {
        var reader = new FileReader();
        reader.readAsText(file);
        reader.onload = function(event){
            var csv = event.target.result;
            var data = $.csv.toArrays(csv);
            var html = '';
            for(var row in data) {
                html += '<tr>\r\n';
                for(var item in data[row]) {
                    html += '<td>' + data[row][item] + '</td>\r\n';
                }
                html += '</tr>\r\n';
            }
            $('#contents').html(html);
            $('#free_analysis').show();
            var row_values = $('#contents tr:not(:eq(0),:eq(1), :eq(2))');
            var headers = $('#contents tr:eq(1)').find('td');
            var rating_text;
            $(row_values).each(function(i, doc_info){
                $('#free_analysis').append('<div class="panel panel-default" style="margin-bottom: 10px;">' +
                '<div class="panel-heading">'+ $(doc_info).children(':first-child').text() +'Report'+
                '<button class="btn btn-default" style="float: right;margin-top: -7px;" id="generate_doc_pdf_'+i+'">Generate Report in PDF</button></div>' +
                '<div class="panel-body pdf_main_background collapse" style="background-image: url(Free_Analysis_Report_Background.jpg)" id="report_main_content_'+i+'">' +
                '<div class="pdf_background" style="background-color: rgba(255, 255, 255, 0.7);top: 0;left: 0;width: 100%;height: 100%;display: table;">' +
                '<img id="company_logo_header" src="images/Free_Analysis_Header.png" alt="logo" style="width: 100%;"/>'+
                '<h1 style="clear: both;text-align: center;">'+ $(doc_info).children(':first-child').text() +'</h1>'+
                '<p style="text-align: center;padding-left: 10%;padding-right: 10%;">' +
                'Your free online reputation management report is comprehensive and easy-to-understand. It' +
                'helps you see your SERP & SEO placement, your like ability and followers on social media, your' +
                'reviews (good/bad reviews) and ratings on 3rd party online review and rating websites, listing ' +
                'on business listing websites.</p>' +
                '<div id="doctors_details_'+i+'"></div>' +
                '<div id="footer_details_'+i+'"></div>' +
                '</div></div></div');

                $('#footer_details_'+i+'').append('<img id="company_logo_footer" src="images/free_analysis_footer.png" alt="logo" style="width: 100%;"/>');
                $(headers).each(function(index, header){
                    var dynamic_image_src;
                    var fixed_text;
                    if($(header).text() != ''){
                        if($(header).text() == "Google Search Engine Page Result "){
                            dynamic_image_src = "Google_Search_Engine_Page_Result";
                        }else{
                            dynamic_image_src = $(this).text().replace('.com', '').replace(/ /g, "_");
                        }
                        switch($(this).text()) {
                            case 'Infofree':
                                fixed_text = 'See whether you have a business profile on '+$(this).text()+', your reviews and business credit rating';
                                break;
                            case 'Google Search Engine Page Result':
                                fixed_text = 'Where your official website stand on a search engine, say Google?';
                                break;
                            case 'Wikipedia page':
                                fixed_text = 'We see whether or not it exists (Y/N). If it exists, when it was last updated.';
                                break;
                            case 'Google Review':
                                fixed_text = 'It gives the exact no. of Google reviews you have & your Google review rating on a scale of 5.';
                                break;
                            case 'Facebook':
                                fixed_text = 'See your FB page likes, ratings and reviews';
                                break;
                            case 'Twitter':
                                fixed_text = 'No. of '+$(this).text()+' followers';
                                break;
                            case 'LinkedIn':
                                fixed_text = 'No. of '+$(this).text()+' page followers/ connections';
                                break;
                            case 'Google Plus':
                                fixed_text = 'See how many people follow you on '+$(this).text()+'';
                                break;
                            case 'Yellow pages':
                                fixed_text = 'It gives the exact no. of '+$(this).text()+' rating you have, on a scale of 5.';
                                break;
                            case 'Yelp':
                                fixed_text = 'See whether you are reviewed/rated here or not. If yes, what is your rating on a scale of 5 & the no. of good/bad reviews?';
                                break;
                            case 'Glassdoor':
                                fixed_text = 'See whether you are reviewed/rated here or not. If yes, what is your rating on a scale of 5 & the no. of good/bad reviews?';
                                break;
                            case 'Global Score':
                                fixed_text = 'Your website is given a score on scale of 100. It takes website design, web development & SEO parameters in consideration.';
                                break;
                            case 'Alexa Ranking':
                                fixed_text = 'It gives you a rough measure of your website’s popularity taking into account the no. of visitors and pages views.';
                                break;
                            case 'Dmoz Listning':
                                fixed_text = 'It assesses whether or not your website is listed on Dmoz open directory.';
                                break;
                            case 'Tripadvisor':
                                fixed_text = 'See your rating on worlds largest travel site';
                                break;
                            case 'Expedia':
                                fixed_text = 'See your rating and recommendations on Expedia';
                                break;
                            case 'Hotels.com':
                                fixed_text = 'See your rating on hotels.com';
                                break;
                            case 'Travelocity':
                                fixed_text = 'See your rating and recommendations on travelocity';
                                break;
                            case 'Orbitz':
                                fixed_text = 'See your rating on Orbitz, a popular travel research, planning and booking website';
                                break;
                            case 'Trivago.com':
                                fixed_text = 'See your exclusive rating by Trivago, travel meta-search engine focusing on hotels.';
                                break;
                            case 'Kayak':
                                fixed_text = 'See your rating on one of the most travel search engine';
                                break;
                            default:
                                fixed_text = 'See how you rate on '+$(this).text().replace('.com', '')+' on a scale of 5?';
                        }
                        rating_text = $(doc_info).children(':nth-child('+ (index+1) +')').text();
                            $('#doctors_details_'+i+'').append('<div class="col-sm-4 col-md-3" style="width: 30%;float: left;position: relative;   min-height: 1px;   padding-right: 0;   padding-left: 15px;">' +
                            '<div class="thumbnail" style="display: block;padding: 4px;margin-bottom: 20px;line-height: 1.42857143;background-color: #FAFAFA;border: 1px solid #ddd; border-radius: 4px;-webkit-transition: border .2s ease-in-out;-o-transition: border .2s ease-in-out;transition: border .2s ease-in-out;height: 175px;min-height: 175px;">' +
                            '<div class="panel-heading" style="background-color: #f36e45;color: white;padding: 10px 15px;border-bottom: 1px solid transparent;border-top-left-radius: 3px;border-top-right-radius: 3px;">' +
                            '<div><img id="company_logo_source" src="images/'+ dynamic_image_src +'.png" alt="logo" style="margin-left: -9px;padding-right: 10px;width:15%;"/>' +
                            '<p style="margin-left: 12%;margin-top: -12%; font-size:9px;">'+ $(this).text()+'</p>' +
                            '</div>' +
                            '</div>' +
                            '<div style="clear: both;"></div>'+
                            '<p style="color: #000000;text-align: center;">'+ fixed_text +'</p>' +
                            '<div style="clear: both;"></div>'+
                            '<p style="color: #000000;text-align: center;word-wrap: break-word;" class="review_ratings'+dynamic_image_src+'"><b>' + rating_text+'</b><br></p>' +
                            '</div></div>');
                    }
                });
                $('#generate_doc_pdf_'+i+'').click(function () {
                    var divContents = $('#report_main_content_'+i+'').html();
                    var printWindow = window.open('', '', 'height=800,width=2500');
                    printWindow.document.write('</head><body style="font-size: 10px; background-image: url(Free_Analysis_Report_Background.jpg)" >');
                    printWindow.document.write(divContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                    printWindow.document.close();
                });
            });

        };
        reader.onerror = function(){ alert('Unable to read ' + file.fileName); };
    }


    var X = XLSX;
    var XW = {
        /* worker message */
        msg: 'xlsx',
        /* worker scripts */
        rABS: 'js/xlsxworker2.js',
        norABS: 'js/xlsxworker1.js',
        noxfer: 'js/xlsxworker.js'
    };

    var rABS = typeof FileReader !== "undefined" && typeof FileReader.prototype !== "undefined" && typeof FileReader.prototype.readAsBinaryString !== "undefined";
    if(!rABS) {
        document.getElementsByName("userabs")[0].disabled = true;
        document.getElementsByName("userabs")[0].checked = false;
    }

    var use_worker = typeof Worker !== 'undefined';
    if(!use_worker) {
        document.getElementsByName("useworker")[0].disabled = true;
        document.getElementsByName("useworker")[0].checked = false;
    }

    var transferable = use_worker;
    if(!transferable) {
        document.getElementsByName("xferable")[0].disabled = true;
        document.getElementsByName("xferable")[0].checked = false;
    }

    var wtf_mode = false;

    function fixdata(data) {
        var o = "", l = 0, w = 10240;
        for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
        o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
        return o;
    }

    function ab2str(data) {
        var o = "", l = 0, w = 10240;
        for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint16Array(data.slice(l*w,l*w+w)));
        o+=String.fromCharCode.apply(null, new Uint16Array(data.slice(l*w)));
        return o;
    }

    function s2ab(s) {
        var b = new ArrayBuffer(s.length*2), v = new Uint16Array(b);
        for (var i=0; i != s.length; ++i) v[i] = s.charCodeAt(i);
        return [v, b];
    }

    function xw_noxfer(data, cb) {
        var worker = new Worker(XW.noxfer);
        worker.onmessage = function(e) {
            switch(e.data.t) {
                case 'ready': break;
                case 'e': console.error(e.data.d); break;
                case XW.msg: cb(JSON.parse(e.data.d)); break;
            }
        };
        var arr = rABS ? data : btoa(fixdata(data));
        worker.postMessage({d:arr,b:rABS});
    }

    function xw_xfer(data, cb) {
        var worker = new Worker(rABS ? XW.rABS : XW.norABS);
        worker.onmessage = function(e) {
            switch(e.data.t) {
                case 'ready': break;
                case 'e': console.error(e.data.d); break;
                default: xx=ab2str(e.data).replace(/\n/g,"\\n").replace(/\r/g,"\\r"); console.log("done"); cb(JSON.parse(xx)); break;
            }
        };
        if(rABS) {
            var val = s2ab(data);
            worker.postMessage(val[1], [val[1]]);
        } else {
            worker.postMessage(data, [data]);
        }
    }

    function xw(data, cb) {
        transferable = document.getElementsByName("xferable")[0].checked;
        if(transferable) xw_xfer(data, cb);
        else xw_noxfer(data, cb);
    }

    function get_radio_value( radioName ) {
        var radios = document.getElementsByName( radioName );
        for( var i = 0; i < radios.length; i++ ) {
            if( radios[i].checked || radios.length === 1 ) {
                return radios[i].value;
            }
        }
    }

    function to_json(workbook) {
        var result = {};
        workbook.SheetNames.forEach(function(sheetName) {
            var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            if(roa.length > 0){
                result[sheetName] = roa;
            }
        });
        return result;
    }

    function to_csv(workbook) {
        var result = [];
        workbook.SheetNames.forEach(function(sheetName) {
            var csv = X.utils.sheet_to_csv(workbook.Sheets[sheetName]);
            if(csv.length > 0){
                result.push("SHEET: " + sheetName);
                result.push("");
                result.push(csv);
            }
        });
        return result.join("\n");
    }

    function to_formulae(workbook) {
        var result = [];
        workbook.SheetNames.forEach(function(sheetName) {
            var formulae = X.utils.get_formulae(workbook.Sheets[sheetName]);
            if(formulae.length > 0){
                result.push("SHEET: " + sheetName);
                result.push("");
                result.push(formulae.join("\n"));
            }
        });
        return result.join("\n");
    }

    var tarea = document.getElementById('b64data');
    function b64it() {
        if(typeof console !== 'undefined') console.log("onload", new Date());
        var wb = X.read(tarea.value, {type: 'base64',WTF:wtf_mode});
        process_wb(wb);
    }

    function process_wb(wb) {
        var output = "";
        switch(get_radio_value("format")) {
            case "json":
                output = JSON.stringify(to_json(wb), 2, 2);
                break;
            case "form":
                output = to_formulae(wb);
                break;
            default:
                output = to_csv(wb);
        }
        $('#out').show();
        if(out.innerText === undefined) out.textContent = output;
        else out.innerText = output;
        if(typeof console !== 'undefined') console.log("output", new Date());
    }

    var drop = document.getElementById('drop');
    function handleDrop(e) {
        e.stopPropagation();
        e.preventDefault();
        rABS = document.getElementsByName("userabs")[0].checked;
        use_worker = document.getElementsByName("useworker")[0].checked;
        var files = e.dataTransfer.files;
        var f = files[0];
        {
            var reader = new FileReader();
            var name = f.name;
            reader.onload = function(e) {
                if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
                var data = e.target.result;
                if(use_worker) {
                    xw(data, process_wb);
                } else {
                    var wb;
                    if(rABS) {
                        wb = X.read(data, {type: 'binary'});
                    } else {
                        var arr = fixdata(data);
                        wb = X.read(btoa(arr), {type: 'base64'});
                    }
                    process_wb(wb);
                }
            };
            if(rABS) reader.readAsBinaryString(f);
            else reader.readAsArrayBuffer(f);
        }
    }

    function handleDragover(e) {
        e.stopPropagation();
        e.preventDefault();
        e.dataTransfer.dropEffect = 'copy';
    }

    if(drop.addEventListener) {
        drop.addEventListener('dragenter', handleDragover, false);
        drop.addEventListener('dragover', handleDragover, false);
        drop.addEventListener('drop', handleDrop, false);
    }


    var xlf = document.getElementById('xlf');
    function handleFile(e) {
        rABS = document.getElementsByName("userabs")[0].checked;
        use_worker = document.getElementsByName("useworker")[0].checked;
        var files = e.target.files;
        var f = files[0];
        {
            var reader = new FileReader();
            var name = f.name;
            reader.onload = function(e) {
                if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
                var data = e.target.result;
                if(use_worker) {
                    xw(data, process_wb);
                } else {
                    var wb;
                    if(rABS) {
                        wb = X.read(data, {type: 'binary'});
                    } else {
                        var arr = fixdata(data);
                        wb = X.read(btoa(arr), {type: 'base64'});
                    }
                    process_wb(wb);
                }
            };
            if(rABS) reader.readAsBinaryString(f);
            else reader.readAsArrayBuffer(f);
        }
    }

    if(xlf.addEventListener) xlf.addEventListener('change', handleFile, false);

</script>
</body>
</html>
