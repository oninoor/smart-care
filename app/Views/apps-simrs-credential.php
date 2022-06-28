<!doctype html>
<html lang="en">

<head>

  <?= $title_meta ?>

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
                  <h4 class="card-title">SIMRS Credential</h4>
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit SIMR Credentials"><i class="bx bxs-pencil"></i></button>
                </div>
                <p class="card-title-desc">Smart Care will use these credentials to access your medical resume API. Make sure the credentials you entered is correct.
                </p>
              </div>
              <!-- end card header -->

              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="mb-3">
                      <label for="Hospital" class="form-label">Hospital</label>
                      <input type="text" class="form-control" id="Hospital" name="Hospital" value="<?= '(' . $hospital->id_hospital . ')' . ' - ' . $hospital->name . ' - ' . $hospital->province ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?= $user->username ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>" readonly>
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


    <?= $this->include('partials/footer') ?>
  </div>
  <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>