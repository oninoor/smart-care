<!DOCTYPE html>
<html lang="en">

<head>

  <?= $title_meta ?>

  <!-- DataTables -->
  <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

  <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

  <?= $this->include('partials/menu') ?>

  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <?php

  use App\Models\HospitalModel;

  $hospitalModel        = new HospitalModel();
  ?>
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <?= $page_title ?>

        <div class="row">
          <div class="col-xl-6 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
              <!-- card body -->
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-6">
                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Requests Sent</span>
                    <h4 class="mb-3">
                      <span class="counter-value" data-target="<?= $total_request_sent ?>">0</span>
                    </h4>
                  </div>

                  <div class="col-6">
                    <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                  </div>
                </div>
                <div class="text-nowrap">
                  <?php $difference =  $total_request_sent - $total_request_sent_last_week ?>
                  <span class="badge bg-soft-success <?= $difference < 0 ? 'text-danger' : 'text-success' ?>"><?= $difference < 0 ? '' : '+' ?><?= $difference ?></span>
                  <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
              </div><!-- end card body -->
            </div><!-- end card -->
          </div><!-- end col -->

          <div class="col-xl-6 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
              <!-- card body -->
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-6">
                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Requests Accepted</span>
                    <h4 class="mb-3">
                      <span class="counter-value" data-target="<?= $total_request_accepted ?>">0</span>
                    </h4>
                  </div>
                  <div class="col-6">
                    <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                  </div>
                </div>
                <div class="text-nowrap">
                  <?php $difference2 =  $total_request_accepted - $total_request_accepted_last_week ?>
                  <span class="badge bg-soft-success <?= $difference2 < 0 ? 'text-danger' : 'text-success' ?>"><?= $difference2 < 0 ? '' : '+' ?><?= $difference2 ?></span>
                  <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
              </div><!-- end card body -->
            </div><!-- end card -->
          </div><!-- end col-->
        </div><!-- end row-->

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">History</h4>
                <div class="flex-shrink-0">
                  <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab">
                        All
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#transactions-req-sent-tab" role="tab">
                        Request Sent
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#transactions-req-accept-tab" role="tab">
                        Request Accepted
                      </a>
                    </li>
                  </ul>
                  <!-- end nav tabs -->
                </div>
              </div><!-- end card header -->

              <div class="card-body px-0">
                <div class="tab-content">
                  <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                    <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                      <table class="table align-middle table-nowrap table-borderless">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Requesting Hospital</th>
                            <th>Provider Hospital</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;

                          foreach ($api_all as $row) :
                          ?>
                            <tr>
                              <td>
                                <div>
                                  <h5 class="font-size-14 text-muted mb-0"><?= $i++ ?></h5>
                                </div>
                              </td>

                              <td>
                                <div>
                                  <?php $hospital_req = $hospitalModel->where('id_hospital', $row['id_hospital_req'])->first() ?>
                                  <h5 class="font-size-14 mb-1"><?= $hospital_req ? $hospital_req->name : 'Data not Found' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['created_at'] ?></p>
                                </div>
                              </td>

                              <td>
                                <div class="text-start">
                                  <?php $hospital_destination = $hospitalModel->where('id_hospital', $row['id_hospital_destination'])->first() ?>
                                  <h5 class="font-size-14 mb-0"><?= $hospital_destination ? $hospital_destination->name : 'Data not Found' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['url'] ?></p>
                                </div>
                              </td>

                              <td>
                                <div class="text-start">
                                  <h5 class="font-size-14 <?= $row['status'] == 0 ? 'text-danger' : 'text-success' ?> mb-0"><?= $row['status'] == 0 ? 'Error' : 'Success' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['description'] ?></p>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- end tab pane -->
                  <div class="tab-pane" id="transactions-req-sent-tab" role="tabpanel">
                    <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                      <table class="table align-middle table-nowrap table-borderless">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th></th>
                            <th>Requesting Hospital</th>
                            <th>Provider Hospital</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;

                          foreach ($api_sent as $row) :
                          ?>
                            <tr>
                              <td>
                                <div>
                                  <h5 class="font-size-14 text-muted mb-0"><?= $i++ ?></h5>
                                </div>
                              </td>

                              <td style="width: 50px;">
                                <div class="font-size-22 <?= $row['status'] == 0 ? 'text-danger' : 'text-success' ?>">
                                  <i class="bx <?= $row['status'] == 0 ? 'bx-x-circle' : 'bx-down-arrow-circle' ?> d-block"></i>
                                </div>
                              </td>

                              <td>
                                <div>
                                  <?php $hospital_req = $hospitalModel->where('id_hospital', $row['id_hospital_req'])->first() ?>
                                  <h5 class="font-size-14 mb-1"><?= $hospital_req ? $hospital_req->name : 'Data not Found' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['created_at'] ?></p>
                                </div>
                              </td>

                              <td>
                                <div class="text-start">
                                  <?php $hospital_destination = $hospitalModel->where('id_hospital', $row['id_hospital_destination'])->first() ?>
                                  <h5 class="font-size-14 mb-0"><?= $hospital_destination ? $hospital_destination->name : 'Data not Found' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['url'] ?></p>
                                </div>
                              </td>

                              <td>
                                <div class="text-start">
                                  <h5 class="font-size-14 <?= $row['status'] == 0 ? 'text-danger' : 'text-success' ?> mb-0"><?= $row['status'] == 0 ? 'Error' : 'Success' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['description'] ?></p>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- end tab pane -->
                  <div class="tab-pane" id="transactions-req-accept-tab" role="tabpanel">
                    <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                      <table class="table align-middle table-nowrap table-borderless">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th></th>
                            <th>Requesting Hospital</th>
                            <th>Provider Hospital</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;

                          foreach ($api_accept as $row) :
                          ?>
                            <tr>
                              <td>
                                <div>
                                  <h5 class="font-size-14 text-muted mb-0"><?= $i++ ?></h5>
                                </div>
                              </td>

                              <td style="width: 50px;">
                                <div class="font-size-22 <?= $row['status'] == 0 ? 'text-danger' : 'text-success' ?>">
                                  <i class="bx <?= $row['status'] == 0 ? 'bx-x-circle' : 'bx-up-arrow-circle' ?> d-block"></i>
                                </div>
                              </td>

                              <td>
                                <div>
                                  <?php $hospital_req = $hospitalModel->where('id_hospital', $row['id_hospital_req'])->first() ?>
                                  <h5 class="font-size-14 mb-1"><?= $hospital_req ? $hospital_req->name : 'Data not Found' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['created_at'] ?></p>
                                </div>
                              </td>

                              <td>
                                <div class="text-start">
                                  <?php $hospital_destination = $hospitalModel->where('id_hospital', $row['id_hospital_destination'])->first() ?>
                                  <h5 class="font-size-14 mb-0"><?= $hospital_destination ? $hospital_destination->name : 'Data not Found' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['url'] ?></p>
                                </div>
                              </td>

                              <td>
                                <div class="text-start">
                                  <h5 class="font-size-14 <?= $row['status'] == 0 ? 'text-danger' : 'text-success' ?> mb-0"><?= $row['status'] == 0 ? 'Error' : 'Success' ?></h5>
                                  <p class="text-muted mb-0 font-size-12"><?= $row['description'] ?></p>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- end tab pane -->
                </div>
                <!-- end tab content -->
              </div>
              <!-- end card body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
        </div> <!-- end row -->
      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?= $this->include('partials/footer') ?>
  </div>
  <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Responsive examples -->
<script src="<?= base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- apexcharts -->
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<script src="<?= base_url() ?>/assets/js/pages/dashboard-index-init.js"></script>

<script>
  function getChartColorsArray(chartId) {
    var colors = $(chartId).attr('data-colors');
    var colors = JSON.parse(colors);
    return colors.map(function(value) {
      var newValue = value.replace(' ', '');
      if (newValue.indexOf('--') != -1) {
        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
        if (color) return color;
      } else {
        return newValue;
      }
    })
  }

  //  MINI CHART

  // mini-1
  var minichart1Colors = getChartColorsArray("#mini-chart1");
  var options = {
    series: [{
      data: [<?= $request_sent[0] ?>]
    }],
    chart: {
      type: 'line',
      height: 50,
      sparkline: {
        enabled: true
      }
    },
    colors: minichart1Colors,
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    tooltip: {
      fixed: {
        enabled: false
      },
      x: {
        show: false
      },
      y: {
        title: {
          formatter: function(seriesName) {
            return ''
          }
        }
      },
      marker: {
        show: false
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#mini-chart1"), options);
  chart.render();

  // mini-2
  var minichart2Colors = getChartColorsArray("#mini-chart2");
  var options = {
    series: [{
      data: [<?= $request_accepted[0] ?>]
    }],
    chart: {
      type: 'line',
      height: 50,
      sparkline: {
        enabled: true
      }
    },
    colors: minichart2Colors,
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    tooltip: {
      fixed: {
        enabled: false
      },
      x: {
        show: false
      },
      y: {
        title: {
          formatter: function(seriesName) {
            return ''
          }
        }
      },
      marker: {
        show: false
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#mini-chart2"), options);
  chart.render();
</script>

<!-- App js -->
<script src="<?= base_url() ?>/assets/js/app.js"></script>
</body>

</html>