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
          <div class="col-xl-12">
            <div class="card-body">
              <form class="user" action="" method="GET">
                <!-- card content -->
                <div class="tab-content">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="id_hospital" class="form-label">ID Hospital</label>
                        <input class="form-control" type="text" placeholder="00981254" id="id_hospital" name="id_hospital" autocomplete="off" value="<?= $id_hospital ? $id_hospital : '' ?>" autofocus>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" placeholder="RS Sudono Madiun" id="name" name="name" autocomplete="off" value="<?= $name ? $name : '' ?>">
                      </div>

                    </div>
                  </div>
                </div>
                <!-- end tab content -->
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary w-lg mx-2">Cari</button>
                  <a type="button" href="<?= base_url('admin/show-hospital') ?>" class="btn btn-light w-lg">Clear</a>
                </div>
              </form>
            </div>
            <!-- end card body -->
          </div>
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Credential</h4>
              </div>
              <!-- end card header -->

              <div class="card-body">
                <div class="pb-3">
                  <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Hospital</th>
                        <th>Name</th>
                        <th>Province</th>
                        <th>Type</th>
                        <th>Class</th>
                        <th>Ownership</th>
                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      <?php $i = 1;
                      foreach ($hospitals as $row) : ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $row->id_hospital ?></td>
                          <td><?= $row->name ?></td>
                          <td><?= $row->province ?></td>
                          <td><?= $row->type ?></td>
                          <td><?= $row->class ?></td>
                          <td><?= $row->ownership ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <form action="<?= base_url('admin/delete-hospital/') ?>" method="POST" id="delete-hospital-<?= $row->id ?>">
                                  <?php csrf_field() ?>
                                  <input type="hidden" name="id" id="id" value="<?= $row->id ?>">
                                  <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">
                                  <li><button class="dropdown-item" type="submit" id="delete-user" data-id="<?= $row->id ?>">Hapus</button></li>
                                </form>
                                <li><a class="dropdown-item" href="<?= base_url('admin/edit-hospital/' . $row->id) ?>">Edit</a></li>
                                <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showCredential<?= $row->id ?>">Credentials</button></li>
                              </ul>
                            </div>
                          </td>
                        </tr>

                        <!-- Credential Modal -->
                        <div class="modal fade" id="showCredential<?= $row->id ?>" tabindex="-1" aria-labelledby="showCredentialLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="showCredentialLabel"><?= $row->name ?> Credentials</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col-12">
                                    <div class="mb-3">
                                      <label for="email" class="form-label">Email</label>
                                      <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('email') ? old('email') : $row->email ?>" name="email" id="email" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- end col -->

                                  <div class="col-12">
                                    <div class="mb-3">
                                      <label for="password" class="form-label">password</label>
                                      <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('password') ? old('password') : $row->password ?>" name="password" id="password" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- end col -->

                                  <div class="col-12">
                                    <div class="mb-3">
                                      <label for="client_id" class="form-label">Client ID</label>
                                      <input class="form-control <?= ($validation->hasError('client_id')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('client_id') ? old('client_id') : $row->client_id ?>" name="client_id" id="client_id" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('client_id'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- end col -->

                                  <div class="col-12">
                                    <div class="mb-3">
                                      <label for="client_secret" class="form-label">Client Secret</label>
                                      <input class="form-control <?= ($validation->hasError('client_secret')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('client_secret') ? old('client_secret') : $row->client_secret ?>" name="client_secret" id="client_secret" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('client_secret'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- end col -->

                                  <div class="col-12">
                                    <div class="mb-3">
                                      <label for="grant_type" class="form-label">Grant Type</label>
                                      <input class="form-control <?= ($validation->hasError('grant_type')) ? 'is-invalid' : '' ?>" type="text" value="<?= old('grant_type') ? old('grant_type') : $row->grant_type ?>" name="grant_type" id="grant_type" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('grant_type'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- end col -->

                                </div>
                                <!-- end row -->
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                              <!-- end form -->
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
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

<!-- Required datatable js -->
<script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Responsive examples -->
<script src="<?= base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- Notify -->
<script src="<?= base_url('assets/libs/alertifyjs/build/alertify.min.js') ?>"></script>

<!-- Notify Init -->
<script src="<?= base_url('assets/js/pages/notification-init.js') ?>"></script>

<script src="<?= base_url('assets/js/app.js') ?>"></script>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/pages/hospital-index-init.js') ?>"></script>

</body>

</html>