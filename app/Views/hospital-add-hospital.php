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
                <h4 class="card-title">Add New Hospital</h4>
              </div>
              <!-- end card header -->

              <div class="card-body">
                <form action="<?= base_url('admin/process-add-hospital') ?>" method="POST">

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="id_hospital" class="form-label">ID Hospital</label>
                        <input class="form-control <?= ($validation->hasError('id_hospital')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('id_hospital') ? old('id_hospital') : '' ?>" name="id_hospital" id="id_hospital" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('id_hospital'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('name') ? old('name') : '' ?>" name="name" id="name" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('name'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input class="form-control <?= ($validation->hasError('province')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('province') ? old('province') : '' ?>" name="province" id="province" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('province'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input class="form-control <?= ($validation->hasError('type')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('type') ? old('type') : '' ?>" name="type" id="type" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('type'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <input class="form-control <?= ($validation->hasError('class')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('class') ? old('class') : '' ?>" name="class" id="class" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('class'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="ownership" class="form-label">Ownership</label>
                        <input class="form-control <?= ($validation->hasError('ownership')) ? 'is-invalid' : '' ?>" ownership="text" value="<?= old('ownership') ? old('ownership') : '' ?>" name="ownership" id="ownership" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('ownership'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Add Hospital</button>
                  </div>

              </div>
              </form>
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