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
                  <ul class="twitter-bs-wizard-nav">
                    <li class="nav-item">
                      <a href="#seller-details" class="nav-link" data-toggle="tab">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Hospital API Access">
                          <i class="bx bx-list-ul"></i>
                        </div>
                      </a>
                    </li>
                  </ul>
                  <!-- wizard-nav -->

                  <div class="tab-content twitter-bs-wizard-tab-content">
                    <div class="tab-pane" id="seller-details">
                      <div class="text-center mb-4">
                        <h5>Your Hospital API Access</h5>
                        <p class="card-title-desc">Please provide API access to read patient medical resume data at your hospital. Provide access details by filling out the following form</p>
                        <p class="card-title-desc">Medical resume data is only used for exchange between registered hospitals and is not shared</p>
                      </div>

                      <form action="<?= base_url('set-up/process-hospital-data') ?>" method="POST">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="mb-3">
                              <label for="hospital" class="form-label">Hospital</label>
                              <select class="form-control <?= ($validation->hasError('hospital')) ? 'is-invalid' : '' ?>" name="hospital" id="hospital" data-href="<?= base_url('set-up/get-hospital') ?>">
                                <option value="">Choose your hospital</option>
                              </select>
                              <?php if ($validation->hasError('hospital')) {
                                echo '<p style="font-size:11px; color:#FD726F; margin-top:-20px;">' . $validation->getError('hospital') . '</p>';
                              } ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>">
                              <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="username" class="form-label">Username</label>
                              <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username') ?>">
                              <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" value="<?= old('password') ?>">
                              <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="client_id" class="form-label">Client ID</label>
                              <input type="text" class="form-control <?= ($validation->hasError('client_id')) ? 'is-invalid' : '' ?>" id="client_id" name="client_id" value="<?= old('client_id') ?>">
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
                              <input type="text" class="form-control <?= ($validation->hasError('client_secret')) ? 'is-invalid' : '' ?>" id="client_secret" name="client_secret" value="<?= old('client_secret') ?>">
                              <div class="invalid-feedback">
                                <?= $validation->getError('client_secret'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="grant_type" class="form-label">Grant Type</label>
                              <input type="text" class="form-control <?= ($validation->hasError('grant_type')) ? 'is-invalid' : '' ?>" id="grant_type" name="grant_type" value="<?= old('grant_type') ?>">
                              <div class="invalid-feedback">
                                <?= $validation->getError('grant_type'); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="base_url" class="form-label">Base URL</label>
                              <input type="text" class="form-control <?= ($validation->hasError('base_url')) ? 'is-invalid' : '' ?>" id="base_url" name="base_url" value="<?= old('base_url') ?>">
                              <div id="base_url" class="form-text">Ex: https://example-api.io/</div>
                              <div class="invalid-feedback">
                                <?= $validation->getError('base_url'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="medical_resume_uri" class="form-label">Medical Resume URI</label>
                              <input type="text" class="form-control <?= ($validation->hasError('medical_resume_uri')) ? 'is-invalid' : '' ?>" id="medical_resume_uri" name="medical_resume_uri" value="<?= old('medical_resume_uri') ?>">
                              <div id="medical_resume_uri" class="form-text">Ex: medical-resume</div>
                              <div class="invalid-feedback">
                                <?= $validation->getError('medical_resume_uri'); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="medical_resume_detail_uri" class="form-label">Medical Resume Detail URI</label>
                              <input type="text" class="form-control <?= ($validation->hasError('medical_resume_detail_uri')) ? 'is-invalid' : '' ?>" id="medical_resume_detail_uri" name="medical_resume_detail_uri" value="<?= old('medical_resume_detail_uri') ?>">
                              <div id="medical_resume_uri" class="form-text">Ex: medical-resume-detail</div>
                              <div class="invalid-feedback">
                                <?= $validation->getError('medical_resume_detail_uri'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-success w-md">Save</button>
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
    <!-- Modal -->
    <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-bottom-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="mb-3">
                <i class="bx bx-check-circle display-4 text-success"></i>
              </div>
              <h5>Confirm Save Changes</h5>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal" onclick="nextTab()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->
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
<script src="<?= base_url() ?>/assets/js/pages/set-up-init.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>