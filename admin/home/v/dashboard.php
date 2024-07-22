

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!--<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>-->
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i-->
                        <!--        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Today Earnings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.<?php echo $today_earning; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Earnings of <?php echo date('F'); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-info">Rs.<?php echo $month_earning; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                             <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings of <?php echo date('Y'); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.<?php echo $year_earning; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                             <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                             Processing Order (<?php echo $order_processing_percentage; ?>%)</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                        <div class="h5 ms-3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $order_processing; ?></div>
                                                    </div>
                                                <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: <?php echo $order_processing_percentage; ?>%" aria-valuenow="<?php echo $order_processing_percentage; ?>" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            <i class="bi bi-hourglass-bottom fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order Dispatched (<?php echo $order_dispatched_percentage;?>%)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 ms-3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $order_dispatched; ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $order_dispatched_percentage;?>%" aria-valuenow="<?php echo $order_dispatched_percentage; ?>" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Order Delivered (<?php echo $order_delivered_percentage; ?>%)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 ms-3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $order_delivered; ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: <?php echo $order_delivered_percentage; ?>%" aria-valuenow="<?php echo $order_delivered_percentage; ?>" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-7 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Total Selling Overview <small class="text-success"> Monthly (In Quantity) </small> </h6>
                                    <!--<div class="dropdown no-arrow">-->
                                    <!--    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"-->
                                    <!--        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                    <!--        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>-->
                                    <!--    </a>-->
                                    <!--    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"-->
                                    <!--        aria-labelledby="dropdownMenuLink">-->
                                    <!--        <div class="dropdown-header">Dropdown Header:</div>-->
                                    <!--        <a class="dropdown-item" href="#">Action</a>-->
                                    <!--        <a class="dropdown-item" href="#">Another action</a>-->
                                    <!--        <div class="dropdown-divider"></div>-->
                                    <!--        <a class="dropdown-item" href="#">Something else here</a>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                                <!-- Card Body -->

                                <!-- chart-area body part -->
                                <!-- chart-area body part -->
                                <div class="card-body">
                                    <div class="chart-area mt-3 mb-3">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                                <!-- chart-area body part -->
                                <!-- chart-area body part -->
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-5 col-lg-5">
                            <div class="card shadow mb-2">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <!--<div class="dropdown no-arrow">-->
                                    <!--    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"-->
                                    <!--        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                    <!--        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>-->
                                    <!--    </a>-->
                                    <!--    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"-->
                                    <!--        aria-labelledby="dropdownMenuLink">-->
                                    <!--        <div class="dropdown-header">Dropdown Header:</div>-->
                                    <!--        <a class="dropdown-item" href="#">Action</a>-->
                                    <!--        <a class="dropdown-item" href="#">Another action</a>-->
                                    <!--        <div class="dropdown-divider"></div>-->
                                    <!--        <a class="dropdown-item" href="#">Something else here</a>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie">
                                        <canvas id="myCharts"></canvas>
                                    </div>
                                    <!-- <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- End of Main Content -->


<!-- chart-area script -->
<!-- chart-area script -->
<script>
var xValues = [0,"January","February","March","April","May","june","July"];
var yValues = [0,50,18,29,21,30,49,60];
//  echo json_encode($month_names, JSON_NUMERIC_CHECK);
//  echo json_encode($monthly_sales_value, JSON_NUMERIC_CHECK);

new Chart("myChart", {
  type: "line",
  data: {
    labels: <?php echo json_encode($month_names, JSON_NUMERIC_CHECK); ?>,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: <?php echo json_encode($monthly_sales_value, JSON_NUMERIC_CHECK); ?>
    }]
  },
  options: {
    legend: {display: false},
    scales: {
    //   yAxes: [{ticks: {min: 5, max:100}}],
      yAxes: [{ticks: {min: 0}}],
    }
  }
});
</script>
<!-- chart-area script -->
<!-- chart-area script -->

<!-- pie chart script-->
<!-- pie chart script-->
<script>
var xValues = ["Kathmandu", "Pokhara", "Dharan", "Gorkha", "Butwal"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myCharts", {
  type: "pie",
  data: {
    labels: <?php echo json_encode($district,JSON_NUMERIC_CHECK) ?>,
    datasets: [{
      backgroundColor: barColors,
      data: <?php echo json_encode($deliveryCount,JSON_NUMERIC_CHECK) ?>
    }]
  },
  options: {
    title: {
      display: true,
      text: "Our big Market"
    }
  }
});
</script>
<!-- pie chart script-->
<!-- pie chart script-->





            
