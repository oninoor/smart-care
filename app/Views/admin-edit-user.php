<!doctype html>
<html lang="en">

<head>

  <?= $title_meta ?>

  <?= $this->include('partials/head-css') ?>

  <!-- DataTables -->
  <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- Sweet Alert-->
  <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />

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
          <div class="col-xl-9 col-lg-8">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm order-2 order-sm-1">
                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                      <div class="flex-shrink-0">
                        <div class="avatar-xl me-3">
                          <img src="<?= base_url("assets/images/users/" . $user->user_image) ?>" style="height:85px; width: 85px; object-fit: cover;" alt="" class=" rounded-circle d-block">
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <div>
                          <h5 class="font-size-16 mb-1"><?= ucwords($user->username) ?></h5>
                          <div class="d-flex gap-2">
                            <p class="text-muted font-size-13"><?= $auth_group['description'] ?></p>
                            <p>-</p>
                            <p class="text-muted font-size-13"><?= $hospital->name ?></p>
                          </div>

                          <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?= $user->email ?></div>
                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?= $user->firstname . ' ' . $user->lastname ?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-auto order-1 order-sm-2">
                    <div class="d-flex align-items-start justify-content-end gap-2">
                      <div>
                        <div class="dropdown">
                          <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <form action="<?= base_url('admin/delete-user/' . $id) ?>" id="form-delete-user">
                              <?php csrf_field(); ?>
                              <input type="hidden" name="id" id="id" value="<?= $id ?>">
                              <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">
                              <li><button type="submit" class="dropdown-item" id="btn-delete-user">Hapus</button></li>
                            </form>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link px-3 active" data-bs-toggle="tab" href="#datadiri" role="tab">Personal Data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-3" data-bs-toggle="tab" href="#fotoprofile" role="tab">Profile Photo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-3" data-bs-toggle="tab" href="#akses" role="tab">Access</a>
                  </li>
                </ul>
              </div>
              <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
              <div class="tab-pane active" id="datadiri" role="tabpanel">
                <div class="card">
                  <div class="card-header bg-primary">
                    <h5 class="card-title mb-0 text-light">Personal Data</h5>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('admin/process-edit-user') ?>" method="POST">
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="hidden" name="id" id="id" value="<?= $id ?>">
                            <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">
                            <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" type="email" value="<?= old('email') ? old('email') : $user->email ?>" name="email" id="email" autocomplete="off">
                            <div class="invalid-feedback">
                              <?= $validation->getError('email'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('username') ? old('username') : $user->username ?>" name="username" id="username" autocomplete="off">
                            <div class="invalid-feedback">
                              <?= $validation->getError('username'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input class="form-control <?= ($validation->hasError('firstname')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('firstname') ? old('firstname') : $user->firstname ?>" name="firstname" id="firstname" autocomplete="off">
                            <div class="invalid-feedback">
                              <?= $validation->getError('firstname'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input class="form-control <?= ($validation->hasError('lastname')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('lastname') ? old('lastname') : $user->lastname ?>" name="lastname" id="lastname" autocomplete="off">
                            <div class="invalid-feedback">
                              <?= $validation->getError('lastname'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- end col -->
                        <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary w-md">Save</button>
                        </div>
                      </div>
                      <!-- end row -->
                    </form>
                  </div>
                  <!-- end card body -->
                </div>
                <!-- end card -->

              </div>
              <!-- end tab pane -->

              <div class="tab-pane" id="fotoprofile" role="tabpanel">
                <div class="card">
                  <div class="card-header bg-primary">
                    <h5 class="card-title mb-0 text-light">Profile Photo</h5>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('admin/process-edit-image-user') ?>" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <input type="hidden" name="old_user_image" id="old_user_image" value="<?= $user->user_image ?>">
                            <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">
                            <label for="user_image" id="user_image_label" class="form-label">Profile Photo</label>
                            <input class="form-control" type="file" id="user_image" name="user_image" onchange="previewImgLab()">
                          </div>
                        </div>

                        <div class=" col-12">
                          <div class="d-flex justify-content-center mb-4">
                            <img src="<?= base_url("assets/images/users/" . $user->user_image)  ?>" class="img-thumbnail img-preview" style="max-height: 170px;">
                          </div>
                          <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">Simpan</button>
                          </div>
                        </div>

                      </div>
                      <!-- end row -->
                    </form>
                  </div>
                  <!-- end card body -->
                </div>
                <!-- end card -->

              </div>
              <!-- end tab pane -->

              <div class="tab-pane" id="akses" role="tabpanel">
                <div class="card">
                  <div class="card-header bg-primary">
                    <h5 class="card-title mb-0 text-light">Access</h5>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                          <input type="checkbox" class="form-check-input" id="active" name="active" data-href="<?= base_url('admin/process-active') ?>" data-id="<?= $user->id ?>" <?= $user->active == 1 ? 'checked' : '' ?>>
                          <label class="form-check-label" for="active">Is Active?</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="mb-3">
                          <label class="form-label">Role</label>
                          <select class="form-select" name="role" id="role" data-href="<?= base_url('admin/process-role') ?>" data-id="<?= $user->id ?>">
                            <option>Select Role</option>
                            <?php foreach ($groups as $row) : ?>
                              <option value="<?= $row['id'] ?>" <?= $row['id'] == $auth_group['group_id'] ? 'selected' : '' ?>><?= $row['description'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end card body -->
                </div>
                <!-- end card -->

              </div>
              <!-- end tab pane -->

            </div>
            <!-- end tab content -->
          </div>
          <!-- end col -->

          <div class="col-xl-3 col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-3">Permission</h5>
                <div class="d-flex flex-wrap gap-2 font-size-16">
                  <?php foreach ($auth_group_permission as $row) : ?>
                    <a href="#" class="badge badge-soft-primary"><?= ucwords($row['description']) ?></a>
                  <?php endforeach; ?>
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

<!-- Custom JS -->
<script src="<?= base_url('assets/js/pages/admin-edit-user-init.js') ?>"></script>


</body>

</html>