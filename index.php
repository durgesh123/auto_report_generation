
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

<nav class="navbar navbar-inverse navbar-fixed-top" style="background-image: url('images/Free_Analysis_Header.png'); background-repeat: no-repeat;height: 100px;background-size: cover;border-bottom: 2px solid red;">
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

<div class="container-fluid" style="padding-top: 50px;">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="padding-top: 50px;">
            <ul class="nav nav-sidebar">
                <li id='convert_to_excel'><a href="#">Convert Excel to CSV</a></li>
                <li id='generate_report'><a href="#">Generate Analysis Report</a></li>
                <li id='verify_email_with_domain'><a href="#">Verify Email With Domain</a></li>
                <li id='send_email_sendgrid'><a href="#">Send Mail Using SendGrid</a></li>
            </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main collapse" id='generate_csv'>
            <div class="panel panel-default" style="width: 75%;">
               <div class="panel-heading">Import Excel File To Generate CSV</div>
               <div class="panel-body">
                 <p>Coming Soon...</p>
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
                <p>Coming Soon...</p>
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


<script>
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

            var abc = $('#contents tr:not(:eq(0),:eq(1))');
            $(abc).each(function(index, doc_name){
                $('#doctors_list').show().append($('<option>', {
                    value: index,
                    text: $(doc_name).children(':first-child').text()
                }));
            });

            var row_values = $('#contents tr:not(:eq(0),:eq(1))');
            var headers = $('#contents tr:first').find('td');
            var rating_text;
            $(row_values).each(function(i, doc_info){
                $('#free_analysis').append('<div class="panel panel-default" style="margin-bottom: 10px;">' +
                '<div class="panel-heading">'+ $(doc_info).children(':first-child').text() +' Report ' +
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
                        dynamic_image_src = $(this).text().replace('.com', '').replace(/\ /g, '_');
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
                            default:
                                fixed_text = 'See how you rate on '+$(this).text().replace('.com', '')+' on a scale of 5?';
                        }
                        rating_text = $(doc_info).children(':nth-child('+ (index+1) +')').text();
                            $('#doctors_details_'+i+'').append('<div class="col-sm-4 col-md-3" style="width: 31%;float: left;position: relative;   min-height: 1px;   padding-right: 0;   padding-left: 15px;">' +
                            '<div class="thumbnail" style="display: block;padding: 4px;margin-bottom: 20px;line-height: 1.42857143;background-color: #fff;border: 1px solid #ddd; border-radius: 4px;-webkit-transition: border .2s ease-in-out;-o-transition: border .2s ease-in-out;transition: border .2s ease-in-out;height: 170px;min-height: 170px;">' +
                            '<div class="panel-heading" style="background-color: #f36e45;height: 50px;color: white;padding: 10px 15px;border-bottom: 1px solid transparent;border-top-left-radius: 3px;border-top-right-radius: 3px;">' +
                            '<div><img id="company_logo_source" src="images/'+ dynamic_image_src +'.png" alt="logo" style="margin-left: -9px;padding-right: 10px;width:15%;"/>' +
                            '<p style="margin-left: 12%;margin-top: -12%;">'+ $(this).text()+'</p>' +
                            '</div>' +
                            '</div>' +
                            '<div style="clear: both;"></div>'+
                            '<p style="color: #000000;text-align: center;">'+ fixed_text +'</p>' +
                            '<div style="clear: both;"></div>'+
                            '<p style="color: #000000;text-align: center;word-wrap: break-word;" class="review_ratings'+dynamic_image_src+'"><b>' + rating_text+'</b></p>' +
                            '</div></div>');
                    }
                });
                $('#generate_doc_pdf_'+i+'').click(function () {
                    var divContents = $('#report_main_content_'+i+'').html();
                    var printWindow = window.open('', '', 'height=1000,width=2500');
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
</script>
</body>
</html>
