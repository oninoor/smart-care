<!doctype html>
<html lang="en">

<head>

  <?= $title_meta ?>

  <!-- DataTables -->
  <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- Sweet Alert-->
  <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- alertifyjs Css -->
  <link href="<?= base_url('assets/libs/alertifyjs/build/css/alertify.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- alertifyjs default themes  Css -->
  <link href="<?= base_url('assets/libs/alertifyjs/build/css/themes/default.min.css') ?>" rel="stylesheet" type="text/css" />

  <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

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

        <!-- start page title -->
        <?= $page_title ?>
        <!-- end page title -->

        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="mb-3">
              <h5 class="card-title">Found <span class="text-muted fw-normal ms-2">(<?= $count ?>)</span></h5>
              <p class="card-title">Show <span class="text-muted fw-normal ms-2">(<?= count($api_accepted) ?>)</span></p>
            </div>
          </div>
        </div>
        <!-- end row -->

        <div class="table-responsive mb-4">
          <table class="table align-middle datatable dt-responsive table-check wrap" style="border-collapse: collapse; border-spacing: 8px 8px; width: 100%;" id="datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Requesting Hospital</th>
                <th scope="col">Provider Hospital</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;

              foreach ($api_accepted as $row) :
              ?>
                <?php if ($i >= 100) {
                  break;
                } ?>
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
          <!-- end table -->
        </div>
        <!-- end table responsive -->

      </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- Notification -->
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div id="pesan" data-pesan="<?= session()->getFlashdata('pesan') ?>"></div>
    <?php endif; ?>


    <?= $this->include('partials/footer') ?>
  </div>
  <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Responsive examples -->
<script src="<?= base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>

<!-- Notify -->
<script src="<?= base_url('assets/libs/alertifyjs/build/alertify.min.js') ?>"></script>

<!-- Notify Init -->
<script src="<?= base_url('assets/js/pages/notification-init.js') ?>"></script>

<script src="<?= base_url('assets/js/app.js') ?>"></script>

<script src="<?= base_url('assets/js/pages/admin-api-request-sent-init.js') ?>"></script>

</body>

</html>