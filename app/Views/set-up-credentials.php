<!doctype html>
<html lang="en">

<head>

  <?= $title_meta ?>

  <!-- twitter-bootstrap-wizard css -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/libs/twitter-bootstrap-wizard/prettify.css">

  <!-- choices css -->
  <link href="<?= base_url('assets/libs/choices.js/public/assets/styles/choices.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- alertifyjs Css -->
  <link href="<?= base_url('assets/libs/alertifyjs/build/css/alertify.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- alertifyjs default themes  Css -->
  <link href="<?= base_url('assets/libs/alertifyjs/build/css/themes/default.min.css') ?>" rel="stylesheet" type="text/css" />

  <?= $this->include('partials/head-css') ?>

  <style>
    body {
      background-color: #5156BE;
    }

    .page-title {
      color: white;
    }

    .breadcrumb-item a {
      color: white !important;
    }

    .breadcrumb-item {
      color: white !important;
    }

    .breadcrumb-item ::before {
      color: white !important;
    }
  </style>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">



  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <div class="m-5 mt-0">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <?= $page_title ?>
        <!-- end page title -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card shadow-lg">
              <div class="card-header">
                <h4 class="card-title mb-0">Initial Set Up</h4>
              </div>
              <div class="card-body">
                <div id="basic-pills-wizard" class="twitter-bs-wizard">

                  <div class="tab-content twitter-bs-wizard-tab-content">
                    <div class="tab-pane active" id="credentials">
                      <div class="text-center mb-4">
                        <h5>Your Credentials for Smart Care</h5>
                        <p class="card-title-desc">Use these credentials to connect your SIMRS to Smart Care to start using the medical resume data exchange service</p>
                      </div>

                      <form action="<?= base_url('set-up/process-credential') ?>" method="POST">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="mb-3">
                              <label for="Hospital" class="form-label">Hospital</label>
                              <input type="text" class="form-control <?= ($validation->hasError('Hospital')) ? 'is-invalid' : '' ?>" id="Hospital" name="Hospital" value="<?= '(' . $hospital->id_hospital . ')' . ' - ' . $hospital->name . ' - ' . $hospital->province ?>" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('Hospital'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="username" class="form-label">Username</label>
                              <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= $user->username ?>" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $user->email ?>" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" value="Your password for this account" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="client_id" class="form-label">Client ID</label>
                              <input type="text" class="form-control <?= ($validation->hasError('client_id')) ? 'is-invalid' : '' ?>" id="client_id" name="client_id" value="<?= $oauth_client->client_id ?>" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('client_id'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="client_secret" class="form-label">Client Secret</label>
                              <input type="text" class="form-control <?= ($validation->hasError('client_secret')) ? 'is-invalid' : '' ?>" id="client_secret" name="client_secret" value="<?= $oauth_client->client_secret ?>" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('client_secret'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="grant_type" class="form-label">Grant Type</label>
                              <input type="text" class="form-control <?= ($validation->hasError('grant_type')) ? 'is-invalid' : '' ?>" id="grant_type" name="grant_type" value="<?= $oauth_client->grant_types ?>" readonly>
                              <div class="invalid-feedback">
                                <?= $validation->getError('grant_type'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-success w-md">Finish</button>
                        </div>
                      </form>
                    </div>
                    <!-- tab pane -->
                  </div>
                  <!-- end tab content -->
                </div>
              </div>
              <!-- end card body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

      </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
  </div>
  <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Notification -->
<?php if (session()->getFlashdata('pesan')) : ?>
  <div id="pesan" data-pesan="<?= session()->getFlashdata('pesan') ?>"></div>
<?php endif; ?>


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- choices js -->
<script src="<?= base_url('assets/libs/choices.js/public/assets/scripts/choices.min.js') ?>"></script>

<!-- twitter-bootstrap-wizard js -->
<script src="<?= base_url() ?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- Notify -->
<script src="<?= base_url('assets/libs/alertifyjs/build/alertify.min.js') ?>"></script>

<!-- Notify Init -->
<script src="<?= base_url('assets/js/pages/notification-init.js') ?>"></script>

<!-- js init -->

<script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>