<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=get_option('website_favicon', BASE."assets/images/favicon.ico")?>"

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo BASE; ?>themes/nico/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>assets/css/new_style.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/nico/assets/css/sections.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/nico/assets/css/utilities.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo BASE; ?>assets/css/contact.css" rel="stylesheet">
    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
    <style>
/* ✅ Tweak navbar for mid-size screens (1024px - 1399px) */
@media (min-width: 1024px) and (max-width: 1399px) {
  .navbar .navbar-brand img {
    width: 150px !important; /* smaller logo */
    height: auto;
  }

  .navbar-nav .nav-link {
    padding-left: 0.75rem !important;
    padding-right: 0.75rem !important;
    font-size: 0.95rem !important; /* slightly smaller text */
  }

  .navbar-buttons .btn {
    padding: 0.45rem 1rem !important;
    font-size: 0.9rem !important;
  }

  .navbar .container {
    max-width: 100% !important;
    padding-left: 1rem;
    padding-right: 1rem;
  }

  /* Optional: Reduce gap between nav links and buttons */
  .navbar-buttons {
    margin-left: 0.5rem;
  }
}

/* ✅ Optional: Trigger mobile menu (offcanvas) earlier at 1200px */
@media (max-width: 1200px) {
  .navbar-collapse {
    display: none !important;
  }
  .navbar-toggler {
    display: block !important;
  }
}
</style>

</head>
<body>


<!-- Header -->
<!-- ✅ Header -->
<nav class="navbar navbar-expand-lg fixed-top" style="
    background: white;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 98, 255, 0.1);
    overflow: hidden;
">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand" href="<?=cn('')?>">
      <img src="assets/images/makara_IMG_1670.PNG" alt="Makara Logo" class="navbar-logo" style="height: 45px; width: 190px;" />
    </a>

    <!-- ✅ Bootstrap 5 Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Toggle navigation" style="
        border: none;
        padding: 0.5rem;
        color: #0D0BD1;
    ">
      <i class="fa-solid fa-bars"></i>
    </button>

    <!-- ✅ Desktop Nav -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link px-3" href="<?=cn('')?>" style="color:#0D0BD1;font-weight:500;">Home</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="<?=cn('about-services')?>" style="color:#4F30A2;font-weight:500;transition:color .3s;" onmouseover="this.style.color='#0D0BD1'" onmouseout="this.style.color='#4F30A2'">Services</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="<?=cn('cac')?>" style="color:#4F30A2;font-weight:500;transition:color .3s;" onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">CAC</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="<?=cn('api-page')?>" style="color:#4F30A2;font-weight:500;transition:color .3s;" onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">API</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="#features" style="color:#4F30A2;font-weight:500;transition:color .3s;" onmouseover="this.style.color='#0D0BD1'" onmouseout="this.style.color='#4F30A2'">Features</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="#pricing" style="color:#4F30A2;font-weight:500;transition:color .3s;" onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">Pricing</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="<?=cn('home/contact')?>" style="color:#4F30A2;font-weight:500;transition:color .3s;" onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">Contact</a></li>
      </ul>

      <div class="navbar-buttons d-flex align-items-center">
        <a href="<?=cn('auth/login')?>" class="btn me-3 px-4 rounded-pill fw-medium" style="color:#0D0BD1;background-color:white;outline:1px solid #0D0BD1;">Login</a>
        <a href="<?=cn('auth/signup')?>" class="btn px-4 rounded-pill fw-medium shadow-sm hover-lift" style="color:white;background-color:#0D0BD1;">Sign Up</a>
      </div>
    </div>
  </div>
</nav>

<!-- ✅ Offcanvas (Mobile Menu) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="<?=cn('')?>">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="<?=cn('about-services')?>">Services</a></li>
      <li class="nav-item"><a class="nav-link" href="<?=cn('cac')?>">CAC</a></li>
      <li class="nav-item"><a class="nav-link" href="<?=cn('api-page')?>">API</a></li>
      <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
      <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
      <li class="nav-item"><a class="nav-link" href="<?=cn('home/contact')?>">Contact</a></li>
    </ul>
    <div class="mt-4">
      <a href="<?=cn('auth/login')?>" class="btn w-100 mb-2 rounded-pill" style="color:#0D0BD1;background-color:white;outline:1px solid #0D0BD1;">Login</a>
      <a href="<?=cn('auth/signup')?>" class="btn w-100 rounded-pill" style="color:white;background-color:#0D0BD1;">Sign Up</a>
    </div>
  </div>
</div>