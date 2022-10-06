<!doctype html>
<html lang="en">

<head>

   <meta charset="utf-8" />
   <title>Register | Smartcare</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
   <meta content="Themesbrand" name="author" />

   <!-- App favicon -->
   <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico">

   <!-- alertifyjs Css -->
   <link href="<?= base_url('assets/libs/alertifyjs/build/css/alertify.min.css') ?>" rel="stylesheet" type="text/css" />

   <!-- alertifyjs default themes  Css -->
   <link href="<?= base_url('assets/libs/alertifyjs/build/css/themes/default.min.css') ?>" rel="stylesheet" type="text/css" />

   <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
   <div class="container-fluid p-0">
      <div class="row g-0">
         <div class="col-xxl-6 col-lg-6 col-md-6">
            <div class="auth-full-page-content d-flex p-sm-5 p-4">
               <div class="w-100">
                  <div class="d-flex flex-column h-100">
                     <div class="mb-4 mb-md-5 text-center">
                        <a href="/" class="d-block auth-logo">
                           <img src="assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Smartcare</span>
                        </a>
                     </div>
                     <div class="auth-content my-auto">
                        <div class="text-center">
                           <h5 class="mb-0">Register Account</h5>
                           <p class="text-muted mt-2 mb-5">Daftar ke Smartcare.</p>
                        </div>

                        <form action="<?= base_url('register') ?>" class="user" method="POST">
                           <!-- Hidden Input -->
                           <input type="hidden" name="redirect" id="redirect" value="<?= current_url() ?>">

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Enter email" required>
                                    <div class="invalid-feedback">
                                       <?= $validation->getError('email'); ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Enter username" required>
                                    <div class="invalid-feedback">
                                       <?= $validation->getError('username'); ?>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('firstname')) ? 'is-invalid' : '' ?>" id="firstname" name="firstname" placeholder="Enter firstname" required>
                                    <div class="invalid-feedback">
                                       <?= $validation->getError('firstname'); ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('lastname')) ? 'is-invalid' : '' ?>" id="lastname" name="lastname" placeholder="Enter lastname" required>
                                    <div class="invalid-feedback">
                                       <?= $validation->getError('lastname'); ?>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter password" required>
                                    <div class="invalid-feedback">
                                       <?= $validation->getError('password'); ?>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="mb-4">
                              <p class="mb-0">By registering you agree to the Minia <a href="#" class="text-primary">Terms of Use</a></p>
                           </div>
                           <div class="mb-3">
                              <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register</button>
                           </div>
                        </form>

                        <div class="mt-5 text-center">
                           <p class="text-muted mb-0">Already have an account ? <a href="<?= base_url('login') ?>" class="text-primary fw-semibold"> Login </a> </p>
                        </div>

                     </div>
                     <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>
                              document.write(new Date().getFullYear())
                           </script> Smartcare</p>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end auth full page content -->
         </div>
         <!-- end col -->
         <div class="col-xxl-6 col-lg-6 col-md-6">
            <div class="auth-bg pt-md-5 p-4 d-flex">
               <div class="bg-overlay bg-primary"></div>
               <ul class="bg-bubbles">
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
               </ul>
               <!-- end bubble effect -->
               <div class="row justify-content-center align-items-center">
                  <div class="col-xl-7">
                     <div class="p-0 p-sm-4 px-xl-0">
                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                           <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                              <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                           </div>
                           <!-- end carouselIndicators -->
                           <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <div class="testi-contain text-white">
                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                    <h4 class="mt-4 fw-medium lh-base text-white">“I feel confident
                                       imposing change
                                       on myself. It's a lot more progressing fun than looking back.
                                       That's why
                                       I ultricies enim
                                       at malesuada nibh diam on tortor neaded to throw curve balls.”
                                    </h4>
                                    <div class="mt-4 pt-3 pb-5">
                                       <div class="d-flex align-items-start">
                                          <div class="flex-shrink-0">
                                             <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                          </div>
                                          <div class="flex-grow-1 ms-3 mb-4">
                                             <h5 class="font-size-18 text-white">Richard Drews
                                             </h5>
                                             <p class="mb-0 text-white-50">Web Designer</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="carousel-item">
                                 <div class="testi-contain text-white">
                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                    <h4 class="mt-4 fw-medium lh-base text-white">“Our task must be to
                                       free ourselves by widening our circle of compassion to embrace
                                       all living
                                       creatures and
                                       the whole of quis consectetur nunc sit amet semper justo. nature
                                       and its beauty.”</h4>
                                    <div class="mt-4 pt-3 pb-5">
                                       <div class="d-flex align-items-start">
                                          <div class="flex-shrink-0">
                                             <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                          </div>
                                          <div class="flex-grow-1 ms-3 mb-4">
                                             <h5 class="font-size-18 text-white">Rosanna French
                                             </h5>
                                             <p class="mb-0 text-white-50">Web Developer</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="carousel-item">
                                 <div class="testi-contain text-white">
                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                    <h4 class="mt-4 fw-medium lh-base text-white">“I've learned that
                                       people will forget what you said, people will forget what you
                                       did,
                                       but people will never forget
                                       how donec in efficitur lectus, nec lobortis metus you made them
                                       feel.”</h4>
                                    <div class="mt-4 pt-3 pb-5">
                                       <div class="d-flex align-items-start">
                                          <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                          <div class="flex-1 ms-3 mb-4">
                                             <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                             <p class="mb-0 text-white-50">Manager
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end carousel-inner -->
                        </div>
                        <!-- end review carousel -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
   </div>
   <!-- end container fluid -->
</div>






<!-- Notification -->
<?php if (session()->getFlashdata('pesan')) : ?>
   <div id="pesan" data-pesan="<?= session()->getFlashdata('pesan') ?>"></div>
<?php endif; ?>


<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- validation init -->
<script src="<?= base_url() ?>/assets/js/pages/validation.init.js"></script>

<!-- Notify -->
<script src="<?= base_url('assets/libs/alertifyjs/build/alertify.min.js') ?>"></script>

<!-- Notify Init -->
<script src="<?= base_url('assets/js/pages/notification-init.js') ?>"></script>

</body>

</html>