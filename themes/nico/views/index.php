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
    
    <style>
        /* Critical rendering fixes */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
            margin: 0;
            padding: 0;
        }
    </style>

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top" style="
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 98, 255, 0.1);
    ">
        <div class="container" style="overflow: hidden; height: 50px; ">
            <a class="navbar-brand" href="#" style="
                background: linear-gradient(90deg, #0D0BD1, #FF9933);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            ">
                <!-- <img src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="Makara Logo" class="navbar-logo" style="height: 40px;"> -->
                <!-- <img src="<?=get_option('website_logo', BASE."assets/images/makara_IMG_1660.png")?>" alt="Makara Logo" class="navbar-logo" style="height: 90px;"> -->
                <img src="assets/images/makara_IMG_1659.JPG" alt="Makara Logo" class="navbar-logo" style="height: 120px; width: 140px;">
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
                        <a class="nav-link px-3" href="#" style="
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
                       <a class="nav-link px-3" href="#services" style=" color: #4F30A2; font-weight: 500; position: relative; transition: color 0.3s ease; " onmouseover="this.style.color='#0D0BD1'" onmouseout="this.style.color='#4F30A2'">Services</a>

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
                        <a class="nav-link px-3" href="#contact" style="
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

    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="hero-section position-relative" style="
        background: linear-gradient(150deg,
           rgba(13, 11, 209, 1) 0%,
           rgba(13, 11, 209, 0.95) 25%,
           rgba(13, 11, 209, 0.9) 50%,
           rgba(13, 11, 209, 0.8) 75%,
           rgba(13, 11, 209, 0.7) 100%
           );
        min-height: 100vh;
        overflow: hidden;
        position: relative;
    ">
        <!-- Mesh gradient overlay for depth -->
        <div style="
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0.4;
            mix-blend-mode: overlay;
        "></div>
        <!-- Animated gradient lines -->
        <div style="
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.03) 10px,
                rgba(255, 255, 255, 0.03) 20px
            );
            animation: gradient-move 20s linear infinite;
        "></div>
        <style>
            @keyframes gradient-move {
                0% { background-position: 0 0; }
                100% { background-position: 50px 50px; }
            }
        </style>
        <div class="container position-relative" >
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 py-5">
                    <div class="hero-content-wrapper mt-5">
                        <h1 class="keen-hero-title display-3 fw-bold mb-4" style="
                            background: linear-gradient(to right, #fff, #e0e0e0);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
                        ">
                            <span class="d-block"># Accelerate</span>
                            <span class="d-block"># Your Social</span>
                            <span class="d-block"># Growth</span>
                        </h1>
                        <p class="keen-subtitle lead mb-4" style="color: rgba(255, 255, 255, 0.9); font-size: 1.25rem;">
                            Premium social media solutions for brands that want to stand out. 
                            <span style="color: rgba(255, 255, 255, 0.7);">Grow, engage, and convert with Makara.</span>
                        </p>
                        <a href="<?=cn('auth/signup')?>" class="btn px-5 py-3 mb-4 rounded-pill shadow-lg hover-lift" style="
                            background: rgba(255, 255, 255, 0.15);
                            backdrop-filter: blur(5px);
                            border: 1px solid rgba(255, 255, 255, 0.3);
                            color: white;
                            font-weight: 500;
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'" 
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'">
                            Start Growing Today
                        </a>
                        <div class="keen-hero-social-proof d-flex align-items-center p-3 rounded-3" style="
                            background: rgba(255, 255, 255, 0.1);
                            backdrop-filter: blur(10px);
                            border: 1px solid rgba(255, 255, 255, 0.2);
                            max-width: 300px;
                        ">
                            <div class="keen-stars me-3">
                                <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                                <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                                <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                                <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                                <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                            </div>
                            <p class="mb-0 small fw-medium" style="color: rgba(255, 255, 255, 0.9);">
                                Rated 4.8/5 from over 1,000+ reviews
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block position-relative">
                    <div class="hero-image-wrapper" style="
                        position: relative;
                        width: 100%;
                        height: 100%;
                        min-height: 500px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        <img src="assets/images/makara_IMG_0436.png" 
                             alt="Social Media Growth Illustration" 
                             class="img-fluid rounded-4 shadow-lg" 
                             style="
                                max-width: 90%;
                                height: 30rem;
                                animation: float 3s ease-in-out infinite;
                                filter: drop-shadow(0 10px 20px rgba(0,98,255,0.2));
                             "
                        >
                    </div>
                    <style>
                        @keyframes float {
                            0% { transform: translateY(0px); }
                            50% { transform: translateY(-20px); }
                            100% { transform: translateY(0px); }
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="keen-stat">
                        <div class="keen-stat-number">50K+</div>
                        <div class="keen-stat-label">Active Users</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="keen-stat">
                        <div class="keen-stat-number">1M+</div>
                        <div class="keen-stat-label">Orders</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="keen-stat">
                        <div class="keen-stat-number">99%</div>
                        <div class="keen-stat-label">Success Rate</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="keen-stat">
                        <div class="keen-stat-number">24/7</div>
                        <div class="keen-stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Who We Are Section -->
        <!-- Who We Are Section -->
    <!-- About Us Section -->
    <section class="section-padding position-relative overflow-hidden" style="
        background: linear-gradient(135deg,
            rgba(0, 42, 255, 0.05) 0%,
            rgba(0, 98, 255, 0.1) 50%,
            rgba(64, 224, 208, 0.15) 100%
        );
    ">
        <div class="section-shape">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#0066ff" opacity="0.1" d="M45.3,-59.1C58.9,-49.3,70.3,-35.3,74.8,-19.2C79.3,-3.1,76.9,15.1,69.1,30.5C61.3,45.9,48.1,58.4,32.4,65.9C16.7,73.4,-1.5,75.8,-19.9,71.8C-38.3,67.8,-56.9,57.4,-67.1,41.7C-77.3,26,-79,5,-73.3,-12.7C-67.6,-30.4,-54.4,-44.8,-40.1,-54.7C-25.8,-64.5,-10.4,-69.8,3.9,-74.6C18.2,-79.4,31.7,-68.9,45.3,-59.1Z" transform="translate(100 100)" />
            </svg>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="who-we-are-content pe-lg-5">
                        <h2 class="section-title text-dark fw-bold mb-4">Who We Are</h2>
                        <p class="lead text-dark mb-4">Makara Social Hub is your go-to digital growth and marketing hub, helping individuals and businesses boost visibility, grow engagement, and build a powerful online presence.</p>
                        <div class="vision-mission mb-5">
                            <div class="vision-card p-4 rounded-4 shadow-sm mb-4" style="
                                background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(236, 246, 255, 0.9));
                                border: 1px solid rgba(0, 98, 255, 0.1);
                                backdrop-filter: blur(10px);
                            ">
                                <h3 class="h4 mb-3" style="
                                    background: linear-gradient(90deg, #0D0BD1, #00C6FF);
                                -webkit-background-clip: text;
                                    background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    font-weight: bold;
                                ">Our Vision</h3>
                                <p class="mb-0">To become the world's leading one-stop digital powerhouse, empowering businesses, influencers, and creators with innovative tools for growth.</p>
                            </div>
                            <div class="mission-card p-4 rounded-4 shadow-sm" style="
                                background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(236, 246, 255, 0.9));
                                border: 1px solid rgba(0, 98, 255, 0.1);
                                backdrop-filter: blur(10px);
                            ">
                                <h3 class="h4 mb-3" style="
                                    background: linear-gradient(90deg, #0D0BD1, #00C6FF);
                                -webkit-background-clip: text;
                                    background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    font-weight: bold;
                                ">Our Mission</h3>
                                <p class="mb-0">To help individuals and businesses showcase their value by giving their platforms the boost they need to gain visibility and recognition both locally and globally.</p>
                            </div>
                        </div>
                        <div class="work-culture mt-4 py-4">
                            <h3 class="h4 text-dark mb-4">Our Values</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="value-card bg-white p-3 rounded-3 shadow-sm">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon-box me-3" style="width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: rgba(13, 110, 253, 0.1);">
                                            <i class="fa-solid fa-seedling" style="color: #0D0BD1;"></i>
                                            </div>
                                            <h4 class="h6 mb-0">Empowerment & Growth</h4>
                                        </div>
                                        <p class="small mb-0 text-muted">Supporting continuous learning and innovation</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="value-card bg-white p-3 rounded-3 shadow-sm">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon-box me-3" style="width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: rgba(13, 110, 253, 0.1);">
                                            <i class="fas fa-shield-alt" style="color: #FF9933;"></i>
                                            </div>
                                            <h4 class="h6 mb-0">Transparency & Trust</h4>
                                        </div>
                                        <p class="small mb-0 text-muted">Built on honesty and clear communication</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="who-we-are-image position-relative mt-5 mt-lg-0">
                        <img src="https://img.freepik.com/free-vector/social-tree-concept-illustration_114360-4898.jpg" alt="About Us" class="img-fluid floating-animation">
                        <div class="experience-badge bg-white shadow">
                            <span class="h2 mb-0 text-primary fw-bold">24/7</span>
                            <span class="text-dark">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Services Section -->
    <section class="section-padding" style="
        background: linear-gradient(135deg,
            rgba(64, 224, 208, 0.15) 0%,
            rgba(0, 98, 255, 0.1) 50%,
            rgba(0, 42, 255, 0.05) 100%
        );
    ">
        <div class="container p-5">
            <div class="text-center mb-5">
                <h2 class="section-title mb-3" style="
                    background: linear-gradient(90deg, #0D0BD1, #4058e0ff);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: bold;
                ">Our Core Services</h2>
                <p class="lead" style="color: #0D0BD1;">Premium digital solutions for your growth and success</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(236, 246, 255, 0.9));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px; 
                            height: 60px; 
                            border-radius: 15px; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            background: linear-gradient(135deg, #0D0BD1, #40E0D0);
                        ">
                            <i class="fas fa-users" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3">Social Media Growth</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Instagram, Facebook, TikTok Growth</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>YouTube, Twitter, LinkedIn Services</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Engagement & Interaction Boost</li>
                            <li><i class="fas fa-check text-primary me-2"></i>WhatsApp Status & Channel Growth</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(236, 246, 255, 0.9));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px; 
                            height: 60px; 
                            border-radius: 15px; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            background: linear-gradient(135deg, #7B1FA2, #20C997);
                            box-shadow: 0 4px 15px rgba(123, 31, 162, 0.2);
                        ">
                            <i class="fas fa-bullhorn" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #7B1FA2, #20C997);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Advertising & Promotion</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Targeted Social Media Ads</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>SEO-Optimized Campaigns</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>App Store Promotion</li>
                            <li><i class="fas fa-check text-primary me-2"></i>Brand Visibility Enhancement</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(236, 246, 255, 0.9));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px; 
                            height: 60px; 
                            border-radius: 15px; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            background: linear-gradient(135deg, #20C997, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <i class="fas fa-music" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #20C997, #0D0BD1);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Music & Streaming</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Spotify & Apple Music Growth</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Audiomack & SoundCloud Promotion</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>YouTube Music Marketing</li>
                            <li><i class="fas fa-check text-primary me-2"></i>Boomplay Streams & Engagement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section-padding position-relative overflow-hidden p-5" style="
        background: linear-gradient(135deg,
            rgba(0, 42, 255, 0.08) 0%,
            rgba(123, 31, 162, 0.06) 25%,
            rgba(32, 201, 151, 0.07) 50%,
            rgba(255, 128, 0, 0.05) 75%,
            rgba(0, 98, 255, 0.08) 100%
        );
    ">
        <div class="section-shape right">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#0D0BD1;stop-opacity:0.3" />
                        <stop offset="50%" style="stop-color:#7B1FA2;stop-opacity:0.3" />
                        <stop offset="100%" style="stop-color:#20C997;stop-opacity:0.3" />
                    </linearGradient>
                </defs>
                <path fill="url(#gradient)" opacity="0.15" d="M42.7,-62.9C50.9,-53.7,50.1,-35.7,53.1,-20.1C56.1,-4.4,62.9,8.9,61.4,22.7C59.8,36.5,49.9,50.9,36.9,57.6C23.9,64.3,7.7,63.3,-7.4,59.9C-22.5,56.4,-36.4,50.5,-47.8,40.6C-59.2,30.7,-68,16.9,-70.2,1.3C-72.3,-14.4,-67.7,-31.9,-57.1,-43.6C-46.5,-55.3,-29.9,-61.3,-13.3,-63.1C3.2,-64.9,19.8,-62.5,32.7,-63.3C45.7,-64.1,55,-72.1,42.7,-62.9Z" transform="translate(100 100)" />
            </svg>
        </div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold mb-3" style="
                    background: linear-gradient(90deg, #0D0BD1, #7B1FA2, #20C997);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-size: 2.5rem;
                    color: #0D0BD1;
                ">Why Choose Makara Social Hub?</h2>
                <p class="lead" style="
                    background: linear-gradient(90deg, #0D0BD1, #7B1FA2);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: 500;
                ">We're more than just a service provider - we're your growth partner</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #0D0BD1, #7B1FA2);
                            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.2);
                        ">
                            <i class="fas fa-tools" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1, #7B1FA2);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">One-Stop Digital Growth Hub</h3>
                        <p class="mb-0" style="color: #2c3e50">Complete suite of digital services, from social media engagement to business registration, all under one roof.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #20C997, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <i class="fas fa-globe" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #20C997, #0D0BD1);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Global Trust & Reliability</h3>
                        <p class="mb-0" style="color: #2c3e50">Trusted by businesses and creators worldwide, delivering high-quality engagement and visibility.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #7B1FA2, #20C997);
                            box-shadow: 0 4px 15px rgba(123, 31, 162, 0.2);
                        ">
                            <i class="fas fa-robot" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #7B1FA2, #20C997);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Smart Automation</h3>
                        <p class="mb-0" style="color: #2c3e50">Cutting-edge automation combined with a personal touch for authentic engagement and growth.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #20C997, #FF8000);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <i class="fas fa-headset" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #20C997, #FF8000);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">24/7 Support</h3>
                        <p class="mb-0" style="color: #2c3e50">Round-the-clock customer support with complete transparency and regular updates.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #FF8000, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(255, 128, 0, 0.2);
                        ">
                            <i class="fas fa-code" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #FF8000, #0D0BD1);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Reseller API Solutions</h3>
                        <p class="mb-0" style="color: #2c3e50">Seamless API integration for resellers with white-label solutions and automated processing.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #0D0BD1, #20C997);
                            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.2);
                        ">
                            <i class="fas fa-graduation-cap" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1, #20C997);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Education & Community</h3>
                        <p class="mb-0" style="color: #2c3e50">Access to educational resources, industry insights, and a supportive community for growth.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section-padding position-relative" style="
        background: linear-gradient(135deg,
            rgba(0, 42, 255, 0.05) 0%,
            rgba(123, 31, 162, 0.05) 50%,
            rgba(32, 201, 151, 0.05) 100%
        );
    ">
        <div class="section-shape right">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="processGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#0D0BD1;stop-opacity:0.3" />
                        <stop offset="50%" style="stop-color:#7B1FA2;stop-opacity:0.3" />
                        <stop offset="100%" style="stop-color:#20C997;stop-opacity:0.3" />
                    </linearGradient>
                </defs>
                <path fill="url(#processGradient)" opacity="0.15" d="M42.7,-62.9C50.9,-53.7,50.1,-35.7,53.1,-20.1C56.1,-4.4,62.9,8.9,61.4,22.7C59.8,36.5,49.9,50.9,36.9,57.6C23.9,64.3,7.7,63.3,-7.4,59.9C-22.5,56.4,-36.4,50.5,-47.8,40.6C-59.2,30.7,-68,16.9,-70.2,1.3C-72.3,-14.4,-67.7,-31.9,-57.1,-43.6C-46.5,-55.3,-29.9,-61.3,-13.3,-63.1C3.2,-64.9,19.8,-62.5,32.7,-63.3C45.7,-64.1,55,-72.1,42.7,-62.9Z" transform="translate(100 100)" />
            </svg>
        </div>
        <div class="container p-5">
            <div class="text-center mb-5">
                <h2 class="section-title mb-3" style="
                    background: linear-gradient(90deg, #0D0BD1, #7B1FA2, #20C997);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: bold;
                    font-size: 2.5rem;
                ">How It Works</h2>
                <p class="lead" style="
                    background: linear-gradient(90deg, #0D0BD1, #7B1FA2);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: 500;
                ">Get started with Makara Social Hub in four simple steps</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="process-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #0D0BD1, #7B1FA2);
                            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">01</span>
                            <i class="fa-solid fa-user-plus" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #0D0BD1, #7B1FA2);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Sign Up</h4>
                        <p class="process-text" style="color: #2c3e50">Create your account in less than 2 minutes</p>
                        <div class="process-arrow">
                            <i class="fa-solid fa-arrow-right" style="color: #0D0BD1"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="process-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #7B1FA2, #20C997);
                            box-shadow: 0 4px 15px rgba(123, 31, 162, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">02</span>
                            <i class="fa-solid fa-wallet" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #7B1FA2, #20C997);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Add Funds</h4>
                        <p class="process-text" style="color: #2c3e50">Choose from our secure payment methods</p>
                        <div class="process-arrow">
                            <i class="fa-solid fa-long-arrow-alt-right" style="color: #7B1FA2"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="process-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #20C997, #FF8000);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">03</span>
                            <i class="fas fa-tasks" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #20C997, #FF8000);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Select Service</h4>
                        <p class="process-text" style="color: #2c3e50">Pick the perfect package for your needs</p>
                        <div class="process-arrow">
                            <i class="fas fa-long-arrow-alt-right" style="color: #20C997"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="process-card p-4 rounded-4 shadow-sm h-100" style="
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 246, 255, 0.95));
                        border: 1px solid rgba(0, 98, 255, 0.1);
                        backdrop-filter: blur(10px);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 20px rgba(0,98,255,0.1)'" 
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                        <div class="icon-box mb-4" style="
                            width: 60px;
                            height: 60px;
                            border-radius: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #FF8000, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(255, 128, 0, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">04</span>
                            <i class="fa-solid fa-chart-line" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #FF8000, #0D0BD1);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Watch Growth</h4>
                        <p class="process-text" style="color: #2c3e50">See your social media presence expand</p>
                    </div>
                </div>
            </div>
        </div>
    </section>    <!-- FAQs Section -->
    <section class="faq-section py-7" style="
        background: linear-gradient(135deg,
            rgba(0, 42, 255, 0.03) 0%,
            rgba(41, 25, 205, 0.05) 25%,
            rgba(82, 50, 155, 0.07) 50%,
            rgba(123, 75, 105, 0.05) 75%,
            rgba(164, 100, 55, 0.03) 100%
        );
    ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title fw-bold mb-3 p-5" style="
                        background: linear-gradient(90deg, #0033FF, #6B46C1, #4F30A2);
                        -webkit-background-clip: text;
                        background-clip: text;
                        -webkit-text-fill-color: transparent;
                        font-size: 2.5rem;
                    ">Frequently Asked Questions</h2>
                    <p class="lead mb-5" style="color: #4F30A2;">Find quick answers to common questions about our services</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion custom-accordion" id="accordionExample" style="--bs-accordion-active-bg: #EEF2FF; --bs-accordion-btn-focus-border-color: #4F30A2; --bs-accordion-active-color: #4F30A2;">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What are SMM panels?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="color: whitesmoke;">
                                    An SMM panel is an online shop that you can visit to purchase SMM services at great prices. We provide a user-friendly platform to help you grow your social media presence effectively.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What SMM services can I find?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="color: whitesmoke;">
                                    We offer a comprehensive range of SMM services including:
                                    <ul class="mt-2 mb-0">
                                        <li>Social media likes and followers</li>
                                        <li>Video views and engagement</li>
                                        <li>Comments and shares</li>
                                        <li>Custom social media packages</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Are SMM services safe?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="color: whitesmoke;">
                                    Yes, our services are completely safe! We use organic methods that comply with social media platform guidelines. Your account security is our top priority, and we guarantee that your accounts won't face any risks.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How does a mass order work?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="color: whitesmoke;">
                                    Our mass order feature allows you to place multiple orders simultaneously. Simply upload a list of links and select your desired services for each. This saves time and streamlines your social media growth strategy.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    What does drip-feed mean?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="color: whitesmoke;">
                                    Drip-feed is our smart delivery system that gradually distributes your order over time. For example, instead of getting 2000 likes at once, you can receive 200 likes daily for 10 days. This creates a more natural growth pattern and improves engagement authenticity.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
        <!-- Testimonials Section -->
    <section class="testimonials-section py-5" style="
        background: linear-gradient(135deg,
            rgba(0, 51, 255, 0.05) 0%,
            rgba(107, 70, 193, 0.08) 50%,
            rgba(79, 48, 162, 0.05) 100%
        );
    ">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold" style="
                    background: linear-gradient(90deg, #0033FF, #6B46C1, #4F30A2);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-size: 2.5rem;
                ">What Our Clients Say</h2>
                <p class="lead" style="color: #4F30A2;">Real stories from our satisfied customers</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text lead mb-4" style="color:  #0D0BD1;">Makara Social Hub is the real deal! I've used many platforms before, but none delivered results as fast as they did. My engagement improved almost instantly, and their customer service is always available to assist. Highly recommended!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/100?img=3" alt="Author" class="rounded-circle me-3" width="60">
                                        <div>
                                            <div class="testimonial-author-name text-secondary fw-bold">PRECIOUS O.</div>
                                            <div class="testimonial-author-role text-muted">Content Creator</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text lead mb-4" style="color:  #0D0BD1;">I used to struggle with reaching the right audience, but Makara Social Hub changed everything. They are honest, reliable, and always deliver on time. No delays, no excuses just results!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/100?img=4" alt="Author" class="rounded-circle me-3" width="60">
                                        <div>
                                            <div class="testimonial-author-name text-secondary fw-bold">Tima K.</div>
                                            <div class="testimonial-author-role text-muted">Fashion Entrepreneur</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text lead mb-4" style="color:  #0D0BD1;">As an artist, I need real and organic engagement, not fake numbers. Makara Social Hub delivered exactly what they promised. No scams, no shady practices, just quality promotion. If you're serious about your music, they are the right choice!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/100?img=5" alt="Author" class="rounded-circle me-3" width="60">
                                        <div>
                                            <div class="testimonial-author-name text-secondary fw-bold">Bayo A.</div>
                                            <div class="testimonial-author-role text-muted">Afrobeats Artist</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text lead mb-4" style="color:  #0D0BD1;">I've tried several social media promotion services before, and most of them either delay or don't respond when you have issues. But Makara Social Hub is different their customer support is top-notch, and they always deliver on time!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/100?img=6" alt="Author" class="rounded-circle me-3" width="60">
                                        <div>
                                            <div class="testimonial-author-name text-secondary fw-bold">Blessing C.</div>
                                            <div class="testimonial-author-role text-muted">Online Vendor</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text lead mb-4" style="color:  #0D0BD1;">One thing I love about Makara Social Hub is their honesty. They don't just promise results; they actually deliver. Their team is also very professional and responsive. They helped my startup gain visibility, and I couldn't be happier!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/100?img=7" alt="Author" class="rounded-circle me-3" width="60">
                                        <div>
                                            <div class="testimonial-author-name text-secondary fw-bold">Emeka P.</div>
                                            <div class="testimonial-author-role text-muted">Fintech Founder</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text lead mb-4" style="color:  #0D0BD1;">Registering my business with CAC was so smooth with Makara Social Hub! They handled everything professionally, and I didn't have to worry about unnecessary delays. Their service is fast, reliable, and completely stress-free!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/100?img=8" alt="Author" class="rounded-circle me-3" width="60">
                                        <div>
                                            <div class="testimonial-author-name text-secondary fw-bold">Enobong A.</div>
                                            <div class="testimonial-author-role text-muted">Business Owner</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <div class="carousel-indicators position-relative mt-4">
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active bg-primary" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" class="bg-primary" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" class="bg-primary" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="3" class="bg-primary" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="4" class="bg-primary" aria-label="Slide 5"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="5" class="bg-primary" aria-label="Slide 6"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-7 position-relative overflow-hidden" style="
        background: linear-gradient(135deg,
            rgba(0, 51, 255, 0.1) 0%,
            rgba(107, 70, 193, 0.15) 50%,
            rgba(79, 48, 162, 0.1) 100%
        );
    ">
        <div class="section-shape">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="ctaGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#0033FF;stop-opacity:0.2" />
                        <stop offset="50%" style="stop-color:#6B46C1;stop-opacity:0.2" />
                        <stop offset="100%" style="stop-color:#4F30A2;stop-opacity:0.2" />
                    </linearGradient>
                </defs>
                <path fill="url(#ctaGradient)" d="M42.7,-62.9C50.9,-53.7,50.1,-35.7,53.1,-20.1C56.1,-4.4,62.9,8.9,61.4,22.7C59.8,36.5,49.9,50.9,36.9,57.6C23.9,64.3,7.7,63.3,-7.4,59.9C-22.5,56.4,-36.4,50.5,-47.8,40.6C-59.2,30.7,-68,16.9,-70.2,1.3C-72.3,-14.4,-67.7,-31.9,-57.1,-43.6C-46.5,-55.3,-29.9,-61.3,-13.3,-63.1C3.2,-64.9,19.8,-62.5,32.7,-63.3C45.7,-64.1,55,-72.1,42.7,-62.9Z" transform="translate(100 100)" />
            </svg>
        </div>
        <div class="container text-center position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="keen-section-title display-4 fw-bold mb-4" style="
                        background: linear-gradient(90deg, #0033FF, #6B46C1, #4F30A2);
                        -webkit-background-clip: text;
                        background-clip: text;
                        -webkit-text-fill-color: transparent;
                    ">Ready to Dominate <span style="color: #0033FF; -webkit-text-fill-color: #0033FF;">Social Media</span>?</h2>
                    <p class="keen-subtitle lead mb-5" style="color: #4F30A2;">Join thousands of successful brands who trust Makara for their social media growth</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="<?=cn('auth/signup')?>" class="btn btn-keen-primary btn-lg px-5 py-3 rounded-pill shadow-lg hover-lift">
                            Get Started Now
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div class="mt-4 pt-2 mb-4">
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-shield-alt me-2"></i>No Credit Card Required
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0" style="color: #0D0BD1;">
                    <div style="height: 120px; overflow: hidden;">

                        <img src="assets/images/makara_IMG_1663.PNG" alt="Makara Logo" style="height: 300px; width: 300px; margin-top: -100px;" class="footer-logo mb-4">
                    </div>
                    <p class="mb-4">Premium social media growth solutions for brands that want to stand out and succeed in the digital world.</p>
                    <div class="footer-social">
                        <a href="#" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: #0D0BD1; text-decoration: none;"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">About Us</a></li>
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">Features</a></li>
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">Pricing</a></li>
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">Help Center</a></li>
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">FAQ</a></li>
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">Contact Us</a></li>
                        <li><a href="#" style="text-decoration: none; color: #0D0BD1;">API Docs</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h4>Newsletter</h4>
                    <p class="mb-4">Subscribe to get the latest news and updates.</p>
                    <form class="footer-subscribe">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-keen-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="mt-5 mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?=date('Y')?> Makara Social Hub. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/f94c035ae6.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/navbar-scroll.js"></script>
    
    <!-- Initialize Font Awesome -->
    <script>
        // Ensure Font Awesome is loaded
        window.onload = function() {
            if (typeof FontAwesome !== 'undefined') {
                FontAwesome.dom.watch();
            }
        };
    </script>
</body>





</html>