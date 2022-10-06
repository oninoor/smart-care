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
                <form action="<?= base_url('admin/process/add-user') ?>" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">
                        <input type="hidden" name="groups" id="groups" value="8">
                        <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('username') ?>" name="username" id="username" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('username'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-6">
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" type="email" value="<?= old('email') ?>" name="email" id="email" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('email'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input class="form-control <?= ($validation->hasError('firstname')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('firstname') ?>" name="firstname" id="firstname" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('firstname'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-6">
                      <div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input class="form-control <?= ($validation->hasError('lastname')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('lastname') ?>" name="lastname" id="lastname" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('lastname'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" type="password" name="password" id="password" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('password'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-6">
                      <div class="mb-3">
                        <label for="pass_confirm" class="form-label">Confirm Password</label>
                        <input class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid' : '' ?>" type="password" name="pass_confirm" id="pass_confirm" autocomplete="off">
                        <div class="invalid-feedback">
                          <?= $validation->getError('pass_confirm'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="groups">Role</label>
                        <select class="form-select <?= ($validation->hasError('groups')) ? 'is-invalid' : '' ?>" id="groups" name="groups">
                          <option value="">Pilih Role</option>
                          <?php foreach ($groups as $row) : ?>
                            <option <?= (old('groups') == $row['id']) ? 'selected' : '' ?> value="<?= $row['id'] ?>"><?= $row['description'] ?></option>
                          <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                          <?= $validation->getError('groups'); ?>
                        </div>
                      </div>
                    </div>
                    <!-- end col -->

                    <div class="col-6">
                      <div class="mb-3">
                        <label for="user_image" id="user_image_label" class="form-label">Profile Photo</label>
                        <input class="form-control" type="file" id="user_image" name="user_image" onchange="previewImgLab()">
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class=" col-12">
                      <div class="d-flex justify-content-center mb-4">
                        <img src="<?= base_url("assets/images/users/default.svg")  ?>" class="img-thumbnail img-preview" style="max-height: 170px;">
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->
              </div>

              <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Add User</button>
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

<!-- Custom JS -->
<script src="<?= base_url('assets/js/pages/admin-add-user-init.js') ?>"></script>

</body>

</html>