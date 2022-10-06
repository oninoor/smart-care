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
                <h4 class="card-title">Edit <?= $hospital->name ?></h4>
              </div>
              <!-- end card header -->

              <div class="card-body">
                <form action="<?= base_url('admin/process-edit-hospital') ?>" method="POST">

                  <!-- Hidden Input -->
                  <input type="hidden" name="id" id="id" value="<?= $hospital->id ?>">
                  <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="id_hospital" class="form-label">ID Hospital</label>
                        <input class="form-control <?= ($validation->hasError('id_hospital')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('id_hospital') ? old('id_hospital') : $hospital->id_hospital ?>" name="id_hospital" id="id_hospital" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('id_hospital'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('name') ? old('name') : $hospital->name ?>" name="name" id="name" autocomplete="off">
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
                        <input class="form-control <?= ($validation->hasError('province')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('province') ? old('province') : $hospital->province ?>" name="province" id="province" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('province'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input class="form-control <?= ($validation->hasError('type')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('type') ? old('type') : $hospital->type ?>" name="type" id="type" autocomplete="off">
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
                        <input class="form-control <?= ($validation->hasError('class')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('class') ? old('class') : $hospital->class ?>" name="class" id="class" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('class'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="ownership" class="form-label">Ownership</label>
                        <input class="form-control <?= ($validation->hasError('ownership')) ? 'is-invalid' : '' ?>" ownership="text" value="<?= old('ownership') ? old('ownership') : $hospital->ownership ?>" name="ownership" id="ownership" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('ownership'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('email') ? old('email') : $hospital->email ?>" name="email" id="email" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('email'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" password="text" value="<?= old('password') ? old('password') : $hospital->password ?>" name="password" id="password" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('password'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="client_id" class="form-label">Client ID</label>
                        <input class="form-control <?= ($validation->hasError('client_id')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('client_id') ? old('client_id') : $hospital->client_id ?>" name="client_id" id="client_id" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('client_id'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="client_secret" class="form-label">Client Secret</label>
                        <input class="form-control <?= ($validation->hasError('client_secret')) ? 'is-invalid' : '' ?>" client_secret="text" value="<?= old('client_secret') ? old('client_secret') : $hospital->client_secret ?>" name="client_secret" id="client_secret" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('client_secret'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="base_url" class="form-label">Base URL</label>
                        <input class="form-control <?= ($validation->hasError('base_url')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('base_url') ? old('base_url') : $hospital->base_url ?>" name="base_url" id="base_url" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('base_url'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="medical_resume_uri" class="form-label">Medical Resume URI</label>
                        <input class="form-control <?= ($validation->hasError('medical_resume_uri')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('medical_resume_uri') ? old('medical_resume_uri') : $hospital->medical_resume_uri ?>" name="medical_resume_uri" id="medical_resume_uri" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('medical_resume_uri'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="medical_resume_detail_uri" class="form-label">Medical Resume Detail URI</label>
                        <input class="form-control <?= ($validation->hasError('medical_resume_detail_uri')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('medical_resume_detail_uri') ? old('medical_resume_detail_uri') : $hospital->medical_resume_detail_uri ?>" name="medical_resume_detail_uri" id="medical_resume_detail_uri" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('medical_resume_detail_uri'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Update</button>
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