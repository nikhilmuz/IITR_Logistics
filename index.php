<?phpinclude_once ('portal/includes/autoload.php');?>    <!DOCTYPE html>    <html lang="en">    <head>        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">        <!--JQuery UI Start-->        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        <!--JQuery UI End-->        <meta charset="utf-8">        <meta name="viewport" content="width=device-width">        <title>IITR Logistics</title>    </HEAD><BODY>    <div class="page-header">        <nav class="navbar navbar-inverse navbar-fixed-top">            <div class="container-fluid">                <div class="navbar-header">                    <a class="navbar-brand" href="/"><?php echo TITLE; ?></a>                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">                        <span class="icon-bar"></span>                        <span class="icon-bar"></span>                        <span class="icon-bar"></span>                    </button>                </div>                <div class="collapse navbar-collapse navbar-right" id="Navbar">                    <ul class="nav navbar-nav">                        <li><a href="<?php echo DOMAIN.PATH; ?>/login.php">Dashboard</a></li>                    </ul>                </div>            </div>        </nav>    </div><?php$awbstatus=true;if(isset($_GET['awb'])&&$_GET['awb']!="") {    $awb = new AWB($_GET['awb']);    if(!$awb->isValid){        $awb=new AWB($awb->getAWBfromSAP($_GET['awb']));    }    $awbstatus=$awb->isValid;}?>    <script>        $("title").html("Track Shipment | <?php echo TITLE; ?>");    </script>    <style>        input[type=number]::-webkit-inner-spin-button,        input[type=number]::-webkit-outer-spin-button {            -webkit-appearance: none;            -moz-appearance: none;            appearance: none;            margin: 0;        }    </style><?phpif(isset($_GET['awb'])&&$_GET['awb']!=''&&$awbstatus){    ?>    <style>        body {            font-family: "Helvetica Neue", Helvetica, Arial;            font-size: 14px;            line-height: 20px;            font-weight: 400;            color: #3b3b3b;            -webkit-font-smoothing: antialiased;            font-smoothing: antialiased;        }        @media screen and (max-width: 580px) {            body {                font-size: 16px;                line-height: 22px;            }        }        .wrapper {            margin: 0 auto;            padding: 40px;            max-width: 800px;        }        .table {            margin: 0 0 40px 0;            width: 100%;            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);            display: table;        }        @media screen and (max-width: 580px) {            .table {                display: block;            }        }        .row {            display: table-row;            background: #f6f6f6;        }        .row:nth-of-type(odd) {            background: #e9e9e9;        }        .row.header {            font-weight: 900;            color: #ffffff;            background: #ea6153;        }        .row.green {            background: #27ae60;        }        .row.blue {            background: #2980b9;        }        @media screen and (max-width: 580px) {            .row {                padding: 14px 0 7px;                display: block;            }            .row.header {                padding: 0;                height: 6px;            }            .row.header .cell {                display: none;            }            .row .cell {                margin-bottom: 10px;            }            .row .cell:before {                margin-bottom: 3px;                content: attr(data-title);                min-width: 98px;                font-size: 10px;                line-height: 10px;                font-weight: bold;                text-transform: uppercase;                color: #969696;                display: block;            }        }        .cell {            padding: 6px 12px;            display: table-cell;        }        @media screen and (max-width: 580px) {            .cell {                padding: 2px 16px;                display: block;            }        }    </style>    <div class="table">        <div class="row header">            <div class="cell">                Shipment No.            </div>            <div class="cell">                SAP ID            </div>            <div class="cell">                Created On            </div>            <div class="cell">                Created By            </div>            <div class="cell">                Origin            </div>            <div class="cell">                Destination            </div>            <div class="cell">                Remarks            </div>            <div class="cell">                Expected Delivery            </div>            <div class="cell">                Delivered On            </div>            <div class="cell">                Delivered By            </div>            <div class="cell">                Status            </div>        </div>        <div class="row">            <div class="cell" data-title="Shipment No.">                <?php echo $awb->awb; ?>            </div>            <div class="cell" data-title="SAP ID">                <?php echo $awb->docid; ?>            </div>            <div class="cell" data-title="Created On">                <?php echo Functions::get_date_from_stamp($awb->created); ?>            </div>            <div class="cell" data-title="Created By">                <?php echo (new Users($awb->created_by))->fn; ?>            </div>            <div class="cell" data-title="Origin">                <?php echo $awb->origin; ?>            </div>            <div class="cell" data-title="Destination">                <?php echo $awb->destination; ?>            </div>            <div class="cell" data-title="Destination">                <?php echo $awb->remarks; ?>            </div>            <div class="cell" data-title="Expected Delivery">                <?php if($awb->status==0){echo Functions::get_date_from_stamp($awb->completed);} ?>            </div>            <div class="cell" data-title="Delivered On">                <?php if($awb->status==1){echo Functions::get_date_from_stamp($awb->completed);} ?>            </div>            <div class="cell" data-title="Delivered By">                <?php echo (new Users($awb->completed_by))->fn; ?>            </div>            <div class="cell" data-title="Status">                <?php if($awb->status==0) echo "In Transit"; else if($awb->status==1) echo "Delivered"; ?>            </div>        </div>    </div>    <div class="wrapper">        <div class="table">            <div class="row header <?php if($awb->status==0) echo "blue"; else if($awb->status==1) echo "green"; ?>">                <div class="cell">                    Date                </div>                <div class="cell">                    Time                </div>                <div class="cell">                    Office                </div>                <div class="cell">                    Remarks                </div>            </div>            <?php            foreach ($awb->getEvents() as $event){                if($event['privacy']!="1"){continue;}                ?>                <div class="row">                    <div class="cell" data-title="Date">                        <?php echo Functions::get_date_from_stamp($event['timestamp']);?>                    </div>                    <div class="cell" data-title="Time">                        <?php echo Functions::get_time_from_stamp($event['timestamp']);?>                    </div>                    <div class="cell" data-title="Office">                        <?php echo (new Office($event['office']))->name;?>                    </div>                    <div class="cell" data-title="Remarks">                        <?php echo $event['remarks'];?>                    </div>                </div>            <?php } ?>        </div>    </div>    <br>    <p align="center"><button onClick="window.location='/'" class="btn btn-info">Check Another</button></p>    <?php}else {    ?>    <div id="msgdiv"></div>    <div style="padding-top: 10%" class="row">        <div class="col-sm-4"></div>        <div class="col-sm-4">            <form onsubmit="if ($('#awb').val()==''){generate_message('msgdiv','info','Please Enter Shipment Number First!','msgid','','clear'); event.preventDefault();}" id="awbform" method="get">                <div class="input-group">                    <input class="form-control" name="awb" id="awb" placeholder="Shipment Number" type="text">                    <span onclick="if ($('#awb').val()==''){generate_message('msgdiv','info','Please Enter Shipment Number First!','msgid','','clear');} else document.getElementById('awbform').submit();"                          class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>                </div>            </form>        </div>    </div>    <script src="<?php echo DOMAIN . PATH; ?>/js/ajax.js"></script>    <script src="<?php echo DOMAIN . PATH; ?>/js/msg.js"></script>    <script>        if (<?php echo !$awbstatus; ?>) {            generate_message('msgdiv', 'danger', 'Incorrect Shipment Number! Try Again', 'msgid', '', 'clear');        }    </script>    <?php}?></BODY></HTML>