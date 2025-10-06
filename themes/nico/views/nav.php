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
</head>
<body>


<!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top" style="
        background: white;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 98, 255, 0.1);
    ">
        <div class="container" style="overflow: hidden; height: 50px; ">
            <a class="navbar-brand" href="<?=cn('')?>">
                <!-- <img src="<?=get_option('website_logo', BASE."assets\images\makara_IMG_1670.PNG")?>" alt="Makara Logo" class="navbar-logo" style="height: 40px;"> -->
                <!-- <img src="<?=get_option('website_logo', BASE."assets\images\makara_IMG_1670.PNG")?>" alt="Makara Logo" class="navbar-logo" style="height: 90px;"> -->
                <img src="assets\images\makara_IMG_1670.PNG" alt="Makara Logo" class="navbar-logo" style="height: 45px; width: 190px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="
                border: none;
                padding: 0.5rem;
                color: #0D0BD1;
            ">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="<?=cn('')?>" style="
                            color: #0D0BD1;
                            font-weight: 500;
                            position: relative;
                        ">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link px-3" href="#services" style="
                            color: #4F30A2;
                            font-weight: 500;
                            position: relative;
                            transition: color 0.3s ease;
                        " onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">Services</a>
                    </li>
                    <li class="nav-item">
                       -->
                       <a class="nav-link px-3" href="<?=cn('about-services')?>" style=" color: #4F30A2; font-weight: 500; position: relative; transition: color 0.3s ease; " onmouseover="this.style.color='#0D0BD1'" onmouseout="this.style.color='#4F30A2'">Services</a>

                    </li>


                    <li class="nav-item">
                        <!-- <a class="nav-link px-3" href="#features" style="
                            color: #4F30A2;
                            font-weight: 500;
                            position: relative;
                            transition: color 0.3s ease;
                        " onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">Features</a>
                    </li>
                    <li class="nav-item">
                      -->
                       <a class="nav-link px-3" href="#features" style=" color: #4F30A2; font-weight: 500; position: relative; transition: color 0.3s ease; " onmouseover="this.style.color='#0D0BD1'" onmouseout="this.style.color='#4F30A2'">Features</a>
                    </li>
                    <li class="nav-item">    <a class="nav-link px-3" href="#pricing" style="
                            color: #4F30A2;
                            font-weight: 500;
                            position: relative;
                            transition: color 0.3s ease;
                        " onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="<?=cn('home/contact')?>" style="
                            color: #4F30A2;
                            font-weight: 500;
                            position: relative;
                            transition: color 0.3s ease;
                        " onmouseover="this.style.color='#0033FF'" onmouseout="this.style.color='#4F30A2'">Contact</a>
                    </li>
                </ul>
                <div class="navbar-buttons d-flex align-items-center">
                    <a href="<?=cn('auth/login')?>" class="btn me-3 px-4 rounded-pill fw-medium" style="color:  #0D0BD1; background-color: white; outline: 1px solid #0D0BD1">Login</a>
                    <a href="<?=cn('auth/signup')?>" class="btn px-4 rounded-pill fw-medium shadow-sm hover-lift" style="color:  white; background-color: #0D0BD1">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>