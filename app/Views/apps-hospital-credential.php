<!doctype html>
<html lang="en">

<head>

  <?= $title_meta ?>

  <?= $this->include('partials/head-css') ?>

  <!-- alertifyjs Css -->
  <link href="<?= base_url('assets/libs/alertifyjs/build/css/alertify.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- alertifyjs default themes  Css -->
  <link href="<?= base_url('assets/libs/alertifyjs/build/css/themes/default.min.css') ?>" rel="stylesheet" type="text/css" />

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

  <?= $this->include('partials/menu') ?>

  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <?= $page_title ?>
        <!-- end page title -->

        <div class="row">
          <div class="col-xl-9">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <h4 class="card-title">Hospital Credential</h4>
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCredentialsModal"><i class="bx bxs-pencil"></i></button>
                </div>
                <p class="card-title-desc">Smart Care will use these credentials to access your medical resume API. Make sure the credentials you entered is correct.
                </p>
              </div>
              <!-- end card header -->

              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ? old('email') : $hospital->email ?>" readonly>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ? old('username') : $hospital->username ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="text" class="form-control" id="password" name="password" value="<?= $hospital->password ?>" readonly>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="client_id" class="form-label">Client ID</label>
                      <input type="text" class="form-control" id="client_id" name="client_id" value="<?= $hospital->client_id ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="client_secret" class="form-label">Client Secret</label>
                      <input type="text" class="form-control" id="client_secret" name="client_secret" value="<?= $hospital->client_secret ?>" readonly>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="grant_type" class="form-label">Grant Type</label>
                      <input type="text" class="form-control" id="grant_type" name="grant_type" value="<?= $hospital->grant_type ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="base_url" class="form-label">Base URL</label>
                      <input type="text" class="form-control" id="base_url" name="base_url" value="<?= $hospital->base_url ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="medical_resume_uri" class="form-label">Medical Resume URI</label>
                      <input type="text" class="form-control" id="medical_resume_uri" name="medical_resume_uri" value="<?= $hospital->medical_resume_uri ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="medical_resume_detail_uri" class="form-label">Medical Resume Detail URI</label>
                      <input type="text" class="form-control" id="medical_resume_detail_uri" name="medical_resume_detail_uri" value="<?= $hospital->medical_resume_detail_uri ?>" readonly>
                    </div>
                  </div>
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


    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editCredentialsModal" tabindex="-1" aria-labelledby="editCredentialsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCredentialsModalLabel">Edit Credentials</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('app/process-edit-hospital-credential') ?>" method="POST">
              <?php csrf_field() ?>
              <!-- Hiddem Input -->
              <input type="hidden" name="id" name="id" value="<?= $hospital->id ?>">

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ? old('email') : $hospital->email ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('email'); ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username') ? old('username') : $hospital->username ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('username'); ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" value="<?= old('password') ? old('password') : $hospital->password ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('password'); ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="client_id" class="form-label">Client ID</label>
                    <input type="text" class="form-control <?= ($validation->hasError('client_id')) ? 'is-invalid' : '' ?>" id="client_id" name="client_id" value="<?= old('client_id') ? old('client_id') : $hospital->client_id ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('client_id'); ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="client_secret" class="form-label">Client Secret</label>
                    <input type="text" class="form-control <?= ($validation->hasError('client_secret')) ? 'is-invalid' : '' ?>" id="client_secret" name="client_secret" value="<?= old('client_secret') ? old('client_secret') : $hospital->client_secret ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('client_secret'); ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="grant_type" class="form-label">Grant Type</label>
                    <input type="text" class="form-control <?= ($validation->hasError('grant_type')) ? 'is-invalid' : '' ?>" id="grant_type" name="grant_type" value="<?= old('grant_type') ? old('grant_type') : $hospital->grant_type ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('grant_type'); ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="base_url" class="form-label">Base URL</label>
                    <input type="text" class="form-control <?= ($validation->hasError('base_url')) ? 'is-invalid' : '' ?>" id="base_url" name="base_url" value="<?= old('base_url') ? old('base_url') : $hospital->base_url ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('base_url'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="medical_resume_uri" class="form-label">Medical Resume URI</label>
                    <input type="text" class="form-control <?= ($validation->hasError('medical_resume_uri')) ? 'is-invalid' : '' ?>" id="medical_resume_uri" name="medical_resume_uri" value="<?= old('medical_resume_uri') ? old('medical_resume_uri') : $hospital->medical_resume_uri ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('medical_resume_uri'); ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="medical_resume_detail_uri" class="form-label">Medical Resume Detail URI</label>
                    <input type="text" class="form-control <?= ($validation->hasError('medical_resume_detail_uri')) ? 'is-invalid' : '' ?>" id="medical_resume_detail_uri" name="medical_resume_detail_uri" value="<?= old('medical_resume_detail_uri') ? old('medical_resume_detail_uri') : $hospital->medical_resume_detail_uri ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('medical_resume_detail_uri'); ?>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
          <!-- end form -->
        </div>
      </div>
    </div>


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

<!-- Notify -->
<script src="<?= base_url('assets/libs/alertifyjs/build/alertify.min.js') ?>"></script>

<!-- Notify Init -->
<script src="<?= base_url('assets/js/pages/notification-init.js') ?>"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>


</body>

</html>