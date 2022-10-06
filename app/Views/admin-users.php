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
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <?= $page_title ?>
        <!-- end page title -->

        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="mb-3">
              <h5 class="card-title">Total <span class="text-muted fw-normal ms-2">(<?= count($users) ?>)</span></h5>
            </div>
          </div>
        </div>
        <!-- end row -->

        <div class="table-responsive mb-4">
          <table class="table align-middle datatable dt-responsive table-check wrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="datatable">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Hospital</th>
                <th style="width: 80px; min-width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($users as $row) : ?>
                <tr>
                  <td>
                    <img src="<?= base_url('assets/images/users/' . $row['user_image']) ?>" alt="" class="avatar-sm rounded-circle me-2">
                  </td>
                  <td>
                    <?= $row['firstname'] . ' ' . $row['lastname'] ?>
                  </td>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['description'] ?></td>
                  <td><span class="badge <?= $row['active'] == 0 ? 'bg-danger' : 'bg-primary' ?>"><?= $row['active'] == 0 ? 'Tidak Aktif' : 'Aktif' ?></span></td>
                  <?php
                  // Ambil data permission
                  $db = \Config\Database::connect();

                  $builder = $db->table('hospitals');
                  $builder->where('id_hospital', $row['id_hospital']);
                  $hospital = $builder->get()->getRowArray();
                  ?>
                  <td><?= $row['id_hospital'] ? $hospital['name'] : '' ?></td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <form action="<?= base_url('admin/delete-user/') ?>" method="POST" id="delete-user-<?= $row['id'] ?>">
                          <?php csrf_field() ?>
                          <input type="hidden" name="id" id="id" value="<?= $row['id'] ?>">
                          <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">
                          <li><button class="dropdown-item" type="submit" id="delete-user" data-id="<?= $row['id'] ?>">Hapus</button></li>
                        </form>
                        <li><a class="dropdown-item" href="<?= base_url('admin/edit-user/' . $row['id']) ?>">Edit</a></li>
                      </ul>
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


    <!-- Modal -->
    <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewUserModalLabel">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('admin/process/add-new-user') ?>" method="POST" enctype="multipart/form-data">
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
                <div class="col-6">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" type="email" value="<?= old('email') ?>" name="email" id="email" autocomplete="off">
                    <div class="invalid-feedback">
                      <?= $validation->getError('email'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <input class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('fullname') ?>" name="fullname" id="fullname" autocomplete="off">
                    <div class="invalid-feedback">
                      <?= $validation->getError('fullname'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" type="password" value="<?= old('password') ?>" name="password" id="password" autocomplete="off">
                    <div class="invalid-feedback">
                      <?= $validation->getError('password'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="pass_confirm" class="form-label">Konfirmasi Password</label>
                    <input class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid' : '' ?>" type="password" value="<?= old('pass_confirm') ?>" name="pass_confirm" id="pass_confirm" autocomplete="off">
                    <div class="invalid-feedback">
                      <?= $validation->getError('pass_confirm'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="user_image" id="user_image_label" class="form-label">Foto Profile</label>
                    <input class="form-control" type="file" id="user_image" name="user_image" onchange="previewImgLab()">
                  </div>
                </div>

                <div class=" col-12">
                  <div class="d-flex justify-content-center mb-4">
                    <img src="<?= base_url("assets/images/users/default.svg")  ?>" class="img-thumbnail img-preview" style="max-height: 170px;">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah User</button>
          </div>
          </form>
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

<script src="<?= base_url('assets/js/pages/admin-users-init.js') ?>"></script>

</body>

</html>