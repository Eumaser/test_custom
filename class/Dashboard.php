<?php
/*
 * To change this tleaveate, choose Tools | Tleaveates
 * and open the tleaveate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Dashboard {

    public function Dashboard(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();


    }

    public function getInputForm($action){
        global $mandatory;
        include_once 'class/Empl.php';
        $e = new Empl();
        $hr_dashboard = false;
        $sales_purchase_dashboard = false;

        if($_SESSION['empl_group'] == 4){//HR
            $hr_dashboard = true;
        }else if(($_SESSION['empl_group'] == 2) || ($_SESSION['empl_group'] == 3)){//Sales OR Purchaser
            $sales_purchase_dashboard = true;
        }else{//admin
            $hr_dashboard = true;
            $sales_purchase_dashboard = true;
        }

        //Sales and Purchase Part
        if($sales_purchase_dashboard){
            //total Pending Request Form
            $dataRF['data'] = getDataCountBySql("db_order oe", " WHERE oe.order_prefix_type = 'QT' AND oe.order_status = '1' AND oe.order_id NOT IN (SELECT order_generate_from FROM db_order WHERE order_prefix_type = 'PO' AND order_status = '1' AND oe.order_id <> order_id)");
            $dataRF['color'] = "bg-aqua";
            $dataRF['icon'] = "ion-shuffle";
            $dataRF['title'] = "Pending Request Form";
            $dataRF['link'] = "";
            $pending_div_RF = $this->getDivCountData($dataRF);

            //total Pending Purchase Order
            $dataPO['data'] = getDataCountBySql("db_order oe", " WHERE oe.order_prefix_type = 'PO' AND oe.order_status = '1' AND oe.order_id NOT IN (SELECT invoice_generate_from FROM db_invoice WHERE invoice_prefix_type = 'PI' AND invoice_status = '1' )");
            $dataPO['color'] = "bg-green";
            $dataPO['icon'] = "ion-stats-bars";
            $dataPO['title'] = "Pending Purchase Order";
            $dataPO['link'] = "";
            $pending_div_PO = $this->getDivCountData($dataPO);

            //total Pending Quotation
            $dataQT['data'] = getDataCountBySql("db_order oe", " WHERE oe.order_prefix_type = 'QT' AND oe.order_status = '1' ");
            $dataQT['color'] = "bg-green";
            $dataQT['icon'] = "ion-stats-bars";
            $dataQT['title'] = "Pending Quotation";
            $dataQT['link'] = "quotation.php";
            $pending_div_QT = $this->getDivCountData($dataQT);

            //total Product
            $dataProduct['data'] = getDataCountBySql("db_product", " WHERE product_status = '1'");
            $dataProduct['color'] = "bg-yellow";
            $dataProduct['icon'] = "ion-bug";
            $dataProduct['title'] = "Total Products";
            $dataProduct['link'] = "product.php?action=createForm";
            $total_div_Product = $this->getDivCountData($dataProduct);

            //total Partner
            $dataPartner['data'] = getDataCountBySql("db_partner", " WHERE partner_status = '1'");
            $dataPartner['color'] = "bg-red";
            $dataPartner['icon'] = "ion-person-add";
            $dataPartner['title'] = "Total Partners";
            $dataPartner['link'] = "partner.php?action=createForm";
            $total_div_Partners = $this->getDivCountData($dataPartner);
        }

        //HR Part

        if($hr_dashboard){
            //total Pending Leave
            $dataLeave['data'] = getDataCountBySql("db_leave e", " WHERE e.leave_approvalstatus = 'Pending' AND e.leave_status = '1' ");
            $dataLeave['color'] = "bg-aqua";
            $dataLeave['icon'] = "ion-shuffle";
            $dataLeave['title'] = "Pending Request Leaves";
            $dataLeave['link'] = "";
            $pending_div_Leaves = $this->getDivCountData($dataLeave);
        }
    ?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hong Hang CRM Management</title>
    <?php
    include_once 'css.php';
    include_once 'js.php';
    ?>
    <script src="plugins/chartjs/Chart.min.js"></script>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
 <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->

          <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- Sales and Purchase Part  -->

            <?php if($sales_purchase_dashboard){?>
                <!-- Pending Request Form-->
                <?php //echo $pending_div_RF;?>

                <!-- Pending Purchase Order-->
                <?php //echo $pending_div_PO;?>

                <!-- Pending Quotation-->
                <?php echo $pending_div_QT;?>

                <!-- Total Products-->
                <?php echo $total_div_Product;?>

                <!-- Total Partners-->
                <?php //echo $total_div_Partners;?>
            <?php }?>

            <!-- HR Part  -->

            <?php if($hr_dashboard){?>
                <!-- Total Leaves-->
                <?php //echo $pending_div_Leaves;?>
            <?php }?>

        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- Sales and Purchase Part  -->

                <?php if($sales_purchase_dashboard){?>
                    <!-- AREA CHART -->
                    <?php // echo $this->getAreaChart();?>

                    <!-- DONUT CHART -->
                    <?php // echo $this->getDonutChart();?>
                <?php }?>

                <!-- HR Part  -->

                <?php if($hr_dashboard){?>
                    <!-- Calendar -->
                    <?php // echo $this->getCalendar();?>
                <?php }?>

            </div><!-- /.col (LEFT) -->

            <div class="col-md-6">
                <!-- Sales and Purchase Part  -->
                <?php if($sales_purchase_dashboard){?>
                    <!-- LINE CHART -->
                    <?php // echo $this->getLineChart();?>

                    <!-- BAR CHART -->
                    <?php // echo $this->getBarChart();?>
                <?php }?>

            </div><!-- /.col (RIGHT) -->
         </div><!-- /.row -->
    </section>
          <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Low Stock Table</h3>
                </div>
                <div class="box-body">
                    <table id="product_table" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT product.*,cy.category_code
                                        FROM db_product product
                                        INNER JOIN db_category cy ON cy.category_id = product.product_category
                                        WHERE product.product_id > 0
                                        AND product.product_stock < product.product_lowstock
                                        AND product_status = 1";
                                $query = mysql_query($sql);
                                $i = 1;
                                while($row = mysql_fetch_array($query)){
                              ?>
                            <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['category_code'];?></td>
                            <td><?php echo $row['product_part_no'];?></td>
                            <td><?php echo $row['product_name'];?></td>
                            <td><?php echo $row['product_desc'];?></td>
                            <td><?php echo $row['product_stock'];?></td>
                            <td class = "text-align-right">
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'product.php?action=edit&product_id=<?php echo $row['product_id'];?>'">View</button>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
                            $i++;
                          }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                              <th>No</th>
                              <th>Category</th>
                              <th>Product Code</th>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Stock</th>
                              <th></th>
                            </tr>
                          </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box box-success -->
          </section>

        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->

    <script>
      $(function () {

      });
    </script>
  </body>
</html>
        <?php

    }
    public function getHrDashboard($action){
        global $mandatory;
        include_once 'class/Empl.php';
        $e = new Empl();

        //total Pending Leave
        $total_pending_leave = getDataCountBySql("db_leave e", " WHERE e.leave_approvalstatus = 'Pending' AND e.leave_status = '1' ");

        //total Pending Purchase Order
        $total_pending_PO = getDataCountBySql("db_order oe", " WHERE oe.order_prefix_type = 'PO' AND oe.order_status = '1' AND oe.order_id NOT IN (SELECT invoice_generate_from FROM db_invoice WHERE invoice_prefix_type = 'PI' AND invoice_status = '1' )");

        //total Product
        $total_product = getDataCountBySql("db_product", " WHERE product_status = '1'");

        //total Partner
        $total_partner = getDataCountBySql("db_partner", " WHERE partner_status = '1'");
    ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anmani CRM Management</title>
    <?php
    include_once 'css.php';
    include_once 'js.php';
    ?>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
 <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->

          <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $total_pending_leave;?></h3>
                  <p>Pending Request Leave</p>
                </div>
                <div class="icon">
                  <i class="fa ion-android-friends"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $total_pending_PO;?></h3>
                  <p>Pending Purchase Order</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $total_product;?></h3>
                  <p>Total Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bug"></i>
                </div>
                <a href="product.php?action=createForm" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $total_partner;?></h3>
                  <p>Total Partners</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="partner.php?action=createForm" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
          </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $this->getCalendar();?>
            </div><!-- /.col (LEFT) -->
            <div class="col-md-6">


            </div><!-- /.col (RIGHT) -->
        </div><!-- /.row -->
    </section>
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->


  </body>
</html>
        <?php

    }
    public function getCalendar(){
    ?>
        <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="plugins/fullcalendar/fullcalendar.min.js"></script>
<script>
      $(function () {

        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          eventReceive: function(event){
  	var title = event.title;
  	var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
  	$.ajax({
    	url: 'process.php',
    	data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
    	type: 'POST',
    	dataType: 'json',
    	success: function(response){
      	event.id = response.eventid;
      	$('#calendar').fullCalendar('updateEvent',event);
    	},
    	error: function(e){
      	console.log(e.responseText);
    	}
        })
        },
          //Random default events
          events: [
            {
              title: 'All Day Event',
              start: new Date(y, m, 1),
              backgroundColor: "#f56954", //red
              borderColor: "#f56954" //red
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d - 5),
              end: new Date(y, m, d - 2),
              backgroundColor: "#f39c12", //yellow
              borderColor: "#f39c12" //yellow
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false,
              backgroundColor: "#0073b7", //Blue
              borderColor: "#0073b7" //Blue
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false,
              backgroundColor: "#00c0ef", //Info (aqua)
              borderColor: "#00c0ef" //Info (aqua)
            },
            {
              title: 'Birthday Party',
              start: new Date(y, m, d + 1, 19, 0),
              end: new Date(y, m, d + 1, 22, 30),
              allDay: false,
              backgroundColor: "#00a65a", //Success (green)
              borderColor: "#00a65a" //Success (green)
            },
            {
              title: 'Click for Google',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
            }
          ],
          editable: false,
          droppable: false, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }

          }
        });
      });
    </script>

            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Calendar</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <div id="calendar"></div>
                  </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
    <?php
    }
    public function getAreaChart(){
    ?>
    <script>
      $(function () {

        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

      });
     </script>
        <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Area Chart</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="areaChart" style="height:250px"></canvas>
                </div>
              </div><!-- /.box-body -->
        </div><!-- /.box -->

    <?php
    }
    public function getDonutChart(){
    ?>
    <script>
      $(function () {

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Chrome"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "IE"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "FireFox"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Safari"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Opera"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Navigator"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

      });
     </script>
        <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Donut Chart</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                  <canvas id="pieChart" style="height:250px"></canvas>
              </div><!-- /.box-body -->
        </div><!-- /.box -->

    <?php
    }
    public function getLineChart(){
    ?>
    <script>
      $(function () {

        var lineChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
            }
          ]
        };
        var lineChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        lineChartOptions.datasetFill = false;
        lineChart.Line(lineChartData, lineChartOptions);

      });
     </script>

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    <?php
    }
    public function getBarChart(){
    ?>
    <script>
      $(function () {

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
            }
          ]
        };
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);

      });
     </script>
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    <?php
    }
    public function getDivCountData($data){

        $html = <<<EOF

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box {$data['color']}">
                <div class="inner">
                  <h3>{$data['data']}</h3>
                  <p>{$data['title']}</p>
                </div>
                <div class="icon">
                  <i class="fa {$data['icon']}"></i>
                </div>
                <a href="{$data['link']}" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
EOF;

            return $html;
    }


}
?>
