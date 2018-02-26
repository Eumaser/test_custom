
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
     <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    body.modal-open .datepicker {
        z-index: 1200 !important;
    }
    table.transaction-detail{
        font-size:13px;
    }
    table.transaction-detail tr th{
        background-color:#054e98;
        color:white;
    }
    table.transaction-detail.table>tbody>tr>td{
        padding:2px;
    }
    .table-no-width{
        width:5%;
    }
    .text-align-right{
        text-align:right;
    }
    .text-align-center{
        text-align:center;
    }
    .control-label-text{
        padding-top: 7px;
        margin-bottom: 0;
        text-align: left;
        font-weight: 500;
    }
    label.error {
        margin: 5px 0px 0px 0px;
        color: red ;
        font-style: italic
    }
    input.error,textarea.error,select.error{
        border: 1px solid red !important;
    }

    /* Alert Boxes
=================================================================== */
.alert {
	font-family: Arial, sans-serif;
	font-size: 12px;
	line-height: 18px;
	margin-bottom: 15px;
	position: relative;
	padding: 14px 40px 14px 18px;
	-webkit-box-shadow:  0px 1px 1px 0px rgba(180, 180, 180, 0.1);
	box-shadow:  0px 1px 1px 0px rgba(180, 180, 180, 0.1);
	-webkit-border-radius: 0px;
	border-radius: 0px;
}

.alert.alert-success {
	background-color: #edf6e5 !important;
	color: #7a9659 !important;
	border: 1px solid #9fc76f !important;
}

.alert.alert-error {
	background-color: #fdeaea !important;
	color: #ca6f74 !important;
	border: 1px solid #f27b81 !important;
}

.alert {
	background-color: #fffee1 !important;
	color: #daac50 !important;
	border: 1px solid #f5c056 !important;
}

.alert.alert-info {
	background-color: #e9f8ff !important;
	color: #5d9fa9 !important;
	border: 1px solid #75c7d3 !important;
}
.modal-wide .modal-dialog {
  width: 80%; /* or whatever you wish */
}
input[type="checkbox"]{

    width:30px;
    height:30px;
    background:white;
    border-radius:5px;
    border:2px solid #555;
  cursor: pointer;




}
input[type='checkbox']:checked {
    background: #abd;
}

.reveal {
    display: inline-block;
    white-space: nowrap;
    background-color: #EDEDED;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
    background-image: -webkit-linear-gradient(top, #eee, #ccc);
    background-image: -moz-linear-gradient(top, #eee, #ccc);
    background-image: -ms-linear-gradient(top, #eee, #ccc);
    background-image: -o-linear-gradient(top, #eee, #ccc);
    background-image: url('linear-gradient(top,%20#eee, #ccc');
    border: 1px solid #777;
    margin: 0.25em;
    text-decoration: none;
    color: #333;
    text-shadow: 0 1px 0 rgba(255,255,255,.8);
    -moz-border-radius: .1em;
    -webkit-border-radius: .1em;
    border-radius: .1em;
    -moz-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
    -webkit-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
    box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3); font-style:normal; font-variant:normal; font-weight:bold; line-height:2em; font-size:1em; font-family:Arial, Helvetica; padding-left:0.5em; padding-right:0.5em; padding-top:0; padding-bottom:0
}

.ordl-order-price{
    padding-right:10px;
    font-size:15px;
}
.invl-invoice-price{
    padding-right:10px;
    font-size:15px;
}
</style>
