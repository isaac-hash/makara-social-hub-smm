<?php 
// // Using the session library
// $user_id = $this->session->userdata('uid');

// // Or directly via the $_SESSION superglobal
// // $user_id = $_SESSION['uid'];

// if ($user_id) {
//     echo "The User ID is: " . $user_id;
// } else {
//     echo "User ID not found in session.";
// }

?>




    
    <style>
        /* Critical rendering fixes */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
            margin: 0;
            padding: 0;
        }
        .accordion {
        background-color: #f3f3f3ff;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
        border-radius: 2rem;
        }

        .active, .accordion:hover {
        background-color: #ccc; 
        }

        .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
        }

  
    </style>
    <!-- Header -->
    <?php
    require_once 'themes/nico/views/nav.php';
    ?>

   

 

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
     
    
        <?php
            // if ($user_id) {
            //     echo "The User ID is: " . $user_id;
            // } else {
            //     echo "User ID not found in session.";
            // }
        ?>
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
                            <span class="d-block">Elevate Your</span>
                              
                            <span class="d-block">Social Media</span>
                            <span class="d-block">Presence</span>
                        </h1>
                        <p class="keen-subtitle lead mb-4" style="color: rgba(255, 255, 255, 0.9); font-size: 1.25rem;">
                            Makara Social Hub is your go-to digital growth and marketing hub. Helping individuals and businesses boost visibility,  
                            <span style="color: rgba(255, 255, 255, 0.7);">grow engagement, and build a powerful online presence.</span>
                        </p>
                        <div class="flex" style="gap: 2rem; justify-content: space-between; display: flex; flex-wrap: nowrap; max-width: 300px; margin-bottom: 1.5rem;">

                            <a href="<?=cn('/auth/signup')?>" class="btn px-3 w-100 py-3 mb-4 rounded-pill shadow-lg hover-lift" style="
                                background: rgba(255, 255, 255, 0.15);
                                backdrop-filter: blur(5px);
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                color: white;
                                font-weight: 500;
                                transition: all 0.3s ease;
                            " onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'" 
                               onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'">
                                Sign Up
                            </a>
                            <a href="<?=cn('/auth/login')?>" class="btn px-3 w-100 py-3 mb-4 rounded-pill shadow-lg hover-lift" style="
                                background: rgba(255, 255, 255, 0.15);
                                backdrop-filter: blur(5px);
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                color: white;
                                font-weight: 500;
                                transition: all 0.3s ease;
                            " onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'" 
                               onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'">
                                Sign In
                            </a>
                        </div>
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
                <div class="col-lg-6  d-lg-block position-relative">
                    <div class="hero-image-wrapper" style="
                        position: relative;
                        width: 100%;
                        height: 100%;
                        min-height: 500px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                    <style>
                        .img{
                             height: 30rem;
                        }
                        @media (max-width:768px){
                           .img{
                               height: 23rem;
                           }
                        }
                    </style>
                        <img src="assets/images/makara_IMG_0436.png" 
                             alt="Social Media Growth Illustration" 
                             class="img-fluid img rounded-4 shadow-lg" 
                             style="
                                max-width: 90%;
                               
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
    

    <!-- MODAL -->
     <?php

     if (!isset($_COOKIE['popup_shown'])) {
        $show = true;

        // Set cookie for 1 day
            setcookie('popup_shown', 'yes', time() + 86400, "/");
        } else {
            $show = false;
        }

        if ($show):

     ?>
<div id="modalOverlay" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    justify-content: center;
    align-items: center;
    z-index: 9999999;
    padding: 20px;
    cursor: pointer;
">
    <div style="
        
        padding: 5px 5px;
        border-radius: 32px;
        box-shadow: 0 40px 120px rgba(0,0,0,0.7);
        max-width: 520px;
        width: 100%;
        text-align: center;
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        pointer-events: auto;
        height: 28rem;
    ">
        <img src="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1764783306/IMG_1060_kxv8mf.png" width="100%" height="100%" style="border-radius: 32px;" alt="">
        <!-- <img src="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1764681663/makara011225_vcehys.jpg" width="100%" height="100%" style="border-radius: 32px;" alt=""> -->
        
    </div>
</div>
<?php
    endif;
?>

<style>
    @keyframes popIn {
        from { transform: scale(0.3); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('modalOverlay');
        
        // Show modal
        overlay.style.display = 'flex';

        // Auto-hide after 5 seconds
        const timer = setTimeout(() => {
            overlay.style.display = 'none';
        }, 6000);

        // Click anywhere to close
        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            clearTimeout(timer);
        });
    });
</script>

    <?php

        
        $promo_data = [
            'title' => 'Promo',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id doloribus enim nulla suscipit dignissimos. Minima necessitatibus aliquam porro velit itaque.',
            'promo_image' => 'assets/images/promo-bg.jpg',
            'promo_image_alt' => 'Social Media Growth Illustration',
            // 'background_color' => 'var(--toggle-bg)',
            // 'background' => 'linear-gradient(135deg,rgba(0, 42, 255, 0.05) 0%,rgba(0, 98, 255, 0.1) 50%,rgba(64, 224, 208, 0.15) 100%);',
            $status => false,
        ];
        $promo = [
            'title' => $promo_data['title'],
            'description' => $promo_data['description'],
            'promo_image' => $promo_data['promo_image'],
            'promo_image_alt' => $promo_data['promo_image_alt'],
            // 'background_color' => $promo_data['background_color'],
            // 'background' => $promo_data['background'],
            $status => $promo_data[$status],
        ];
        // $title = $promo[$title];

        $promo_show = $promo[$status];
        if ($promo_show):
            // var_dump($promo);
     ?>
    <section class="hero-section position-relative" style="
        background: var(--toggle-bg);
        
        background-color: linear-gradient(135deg,rgba(0, 42, 255, 0.05) 0%,rgba(0, 98, 255, 0.1) 50%,rgba(64, 224, 208, 0.15) 100%);
        min-height: 100vh;

    ">
        <div class="container position-relative" >
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 py-5">
                    <div class="hero-content-wrapper">
                        
                        <p class=" mb-4" style="color: var(--text-color); font-size: 3.25rem; font-weight:bold; background: linear-gradient(to right, #202020ff, #e0e0e0);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            text-shadow: 2px 2px 4px rgba(0,0,0,0.1)">
                            <?= $promo['title'] ?>
                           
                        </p>
                        <p class="keen-subtitle lead mb-4" style="color: var(--text-color); font-size: 1.25rem;">
                            <?= $promo['description'] ?>
                           
                        </p>
                    </div>
                </div>
                <div class="col-lg-6  d-lg-block position-relative">
                    <div class="hero-image-wrapper" style="
                        position: relative;
                        width: 100%;
                        height: 100%;
                        min-height: 500px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        <img src="<?= $promo['promo_image'] ?>" 
                             alt="<?= $promo['promo_image_alt'] ?> " 
                             class="img-fluid rounded-4 shadow-lg" 
                             style="
                                max-width: 95%;
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
    <?php
     endif;
     ?> 
    <!-- Stats Section -->
    <section class="py-5 " style="background-color: var(--toggle-bg); background: linear-gradient(135deg,
            rgba(0, 42, 255, 0.05) 0%,
            rgba(0, 98, 255, 0.1) 50%,
            rgba(64, 224, 208, 0.15) 100%
        );">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="keen-stat">
                        <div style="color: var(--text-color)" class="keen-stat-number">50K+</div>
                        <div style="color: var(--text-color)" class="keen-stat-label">Active Users</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="keen-stat">
                        <div style="color: var(--text-color)" class="keen-stat-number">1M+</div>
                        <div style="color: var(--text-color)" class="keen-stat-label">Orders</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="keen-stat">
                        <div style="color: var(--text-color)" class="keen-stat-number">99%</div>
                        <div style="color: var(--text-color)" class="keen-stat-label">Success Rate</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="keen-stat">
                        <div style="color: var(--text-color)" class="keen-stat-number">24/7</div>
                        <div style="color: var(--text-color)" class="keen-stat-label">Support</div>
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
                        <h2 class="section-title  fw-bold mb-4 mt-3">Who We Are</h2>
                        <p class="lead  mb-4">Makara Social Hub is your go-to digital growth and marketing hub, helping individuals and businesses boost visibility, grow engagement, and build a powerful online presence.</p>
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
                                <p class="mb-0" style="color: #2c3e50">To become the world's leading one-stop digital powerhouse, empowering businesses, influencers, and creators with innovative tools for growth.</p>
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
                                <p class="mb-0" style="color: #2c3e50">To help individuals and businesses showcase their value by giving their platforms the boost they need to gain visibility and recognition both locally and globally.</p>
                            </div>
                        </div>
                        <div class="work-culture mt-4 py-4">
                            <h3 class="h4  mb-4">Our Values</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="value-card bg-white p-3 rounded-3 shadow-sm">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon-box me-3" style="width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: rgba(13, 110, 253, 0.1);">
                                            <i class="fa-solid fa-seedling" style="color: #0D0BD1;"></i>
                                            </div>
                                            <h4 class="h6 mb-0" style="color: #2c3e50">Empowerment & Growth</h4>
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
                                            <h4 class="h6 mb-0" style="color: #2c3e50">Transparency & Trust</h4>
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
                        <img src="assets\images\makara_IMG_0437.png" alt="About Us" class="img-fluid floating-animation">
                        <!-- <div class="experience-badge bg-white shadow">
                            <span class="h2 mb-0 text-primary fw-bold">24/7</span>
                            <span class="text-dark">Support</span>
                        </div> -->
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
                            background: linear-gradient(135deg, #0D0BD1);
                        ">
                            <i class="fas fa-users" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3"style="
                            background: #0D0BD1;                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Social Media Growth</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Instagram, Facebook, TikTok Growth</li>
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>YouTube, Twitter, LinkedIn Services</li>
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Engagement & Interaction Boost</li>
                            <li style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>WhatsApp Status & Channel Growth</li>
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
                            background: #0D0BD1;
                            box-shadow: 0 4px 15px rgba(123, 31, 162, 0.2);
                        ">
                            <i class="fas fa-bullhorn" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: #0D0BD1;                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Advertising & Promotion</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Targeted Social Media Ads</li>
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>SEO-Optimized Campaigns</li>
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>App Store Promotion</li>
                            <li style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Brand Visibility Enhancement</li>
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <i class="fas fa-music" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Music & Streaming</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Spotify & Apple Music Growth</li>
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Audiomack & SoundCloud Promotion</li>
                            <li class="mb-2" style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>YouTube Music Marketing</li>
                            <li style="color: #2c3e50"><i class="fas fa-check text-primary me-2"></i>Boomplay Streams & Engagement</li>
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
                    background: linear-gradient(90deg, #0D0BD1);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-size: 2.5rem;
                    color: #0D0BD1;
                ">Why Choose Makara Social Hub?</h2>
                <p class="lead" style="
                    background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.2);
                        ">
                            <i class="fas fa-tools" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <i class="fas fa-globe" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(123, 31, 162, 0.2);
                        ">
                            <i class="fas fa-robot" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <i class="fas fa-headset" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(255, 128, 0, 0.2);
                        ">
                            <i class="fas fa-code" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.2);
                        ">
                            <i class="fas fa-graduation-cap" style="color: white"></i>
                        </div>
                        <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Education & Community</h3>
                        <!-- <h3 class="h5 mb-3" style="
                            background: linear-gradient(90deg, #0D0BD1, #20C997);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            font-weight: bold;
                        ">Education & Community</h3> -->
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
                    background: linear-gradient(90deg, #0D0BD1);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: bold;
                    font-size: 2.5rem;
                ">How It Works</h2>
                <p class="lead" style="
                    background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">01</span>
                            <i class="fa-solid fa-user-plus" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(123, 31, 162, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">02</span>
                            <i class="fa-solid fa-wallet" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">03</span>
                            <i class="fas fa-tasks" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                            background: linear-gradient(135deg, #0D0BD1);
                            box-shadow: 0 4px 15px rgba(255, 128, 0, 0.2);
                        ">
                            <span class="process-number" style="color: white; font-weight: bold; margin-right: 5px">04</span>
                            <i class="fa-solid fa-chart-line" style="color: white"></i>
                        </div>
                        <h4 class="process-title" style="
                            background: linear-gradient(90deg, #0D0BD1);
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
                        background: linear-gradient(90deg, #0033FF);
                        -webkit-background-clip: text;
                        background-clip: text;
                        -webkit-text-fill-color: transparent;
                        font-size: 2.5rem;
                    ">Frequently Asked Questions</h2>
                    <p class="lead mb-5" style="color: #4F30A2; font-weight: 600;">Find quick answers to common questions about our services</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 mb-4 mb-lg-0 order-1 order-lg-2 ">
                    <div class="faq-image-wrapper" style="position: sticky; top: 20px; border-radius:2rem;">
                        <img src="assets/images/makara_faq2.jpg" 
                             alt="FAQ Support" 
                             class="img-fluid rounded-4 shadow-lg"
                             style="width: 100%; height: 100%; object-fit: cover; border-radius:2rem;">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 order-2 order-lg-1">
                    

<div class="accordion" id="accordionExample"
     style="">
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
                    background: linear-gradient(90deg, #0D0BD1);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-size: 2.5rem;
                ">What Our Clients Say</h2>
                <p class="lead" style="color: #0D0BD1;">Real stories from our satisfied customers</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonial-card bg-white p-4 p-lg-5 rounded-4 shadow-sm">
                                    <div class="testimonial-quote display-3 text-primary mb-3">"</div>
                                    <p class="testimonial-text mb-4" style="color:  #0D0BD1;">Makara Social Hub is the real deal! I've used many platforms before, but none delivered results as fast as they did. My engagement improved almost instantly, and their customer service is always available to assist. Highly recommended!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://media.istockphoto.com/id/1351018006/photo/smiling-male-student-sitting-in-university-classroom.jpg?s=612x612&w=0&k=20&c=G9doLib_ILUijluTSD5hstZBWqHHIcw4dBHhQcs-ON4=" alt="Author" class="rounded-circle me-3" width="60">
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
                                    <p class="testimonial-text mb-4" style="color:  #0D0BD1;">I used to struggle with reaching the right audience, but Makara Social Hub changed everything. They are honest, reliable, and always deliver on time. No delays, no excuses just results!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://media.istockphoto.com/id/2219635436/photo/professional-man-smiling-while-working-on-a-laptop-and-holding-a-smartphone.jpg?s=612x612&w=0&k=20&c=FMruqFxZIYv08Q5x98RroB_JQcmajf68A1WWBKg9gZ8=" alt="Author" class="rounded-circle me-3" width="60">
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
                                    <p class="testimonial-text mb-4" style="color:  #0D0BD1;">As an artist, I need real and organic engagement, not fake numbers. Makara Social Hub delivered exactly what they promised. No scams, no shady practices, just quality promotion. If you're serious about your music, they are the right choice!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://media.istockphoto.com/id/2218333130/photo/confident-businessman-smiling-in-a-casual-suit-and-glasses-indoors.jpg?s=612x612&w=0&k=20&c=55XTe0b4HfkJfq_yq_ksnl9xYWKRUCgmPMdwcssWOL0=" alt="Author" class="rounded-circle me-3" width="60">
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
                                    <p class="testimonial-text mb-4" style="color:  #0D0BD1;">I've tried several social media promotion services before, and most of them either delay or don't respond when you have issues. But Makara Social Hub is different their customer support is top-notch, and they always deliver on time!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://media.istockphoto.com/id/2203422382/photo/happy-young-black-woman-smiling-against-green-background.jpg?s=612x612&w=0&k=20&c=mpzra58ER5LkMChqMwUILIdGNRL8h5ytb9TSJr7Ia6I=" alt="Author" class="rounded-circle me-3" width="60">
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
                                    <p class="testimonial-text mb-4" style="color:  #0D0BD1;">One thing I love about Makara Social Hub is their honesty. They don't just promise results; they actually deliver. Their team is also very professional and responsive. They helped my startup gain visibility, and I couldn't be happier!</p>
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
                                    <p class="testimonial-text mb-4" style="color:  #0D0BD1;">Registering my business with CAC was so smooth with Makara Social Hub! They handled everything professionally, and I didn't have to worry about unnecessary delays. Their service is fast, reliable, and completely stress-free!</p>
                                    <div class="testimonial-author d-flex align-items-center">
                                        <img src="https://media.istockphoto.com/id/2135643049/photo/waist-up-shot-of-a-handsome-hispanic-latino-carefree-black-male-looking-at-the-camera-with.jpg?s=612x612&w=0&k=20&c=l505rTymOeB9yAE-F5N_aQeVJba7HmU-YFS9uzkx-DA=" alt="Author" class="rounded-circle me-3" width="60">
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
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <a href="<?=cn('auth/signup')?>" class="btn btn-keen-primary btn-lg px-5 py-3 rounded-pill shadow-lg hover-lift">
                            Get Started Now
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <!-- <div class="mt-4 pt-2 mb-4">
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-shield-alt me-2"></i>No Credit Card Required
                        </span>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
       
<script>
  // Accordion data (title, content, and optional HTML)
  const faqData = [
    {
      title: "What are SMM panels?",
      content: `An SMM panel is an online shop that you can visit to purchase SMM services at great prices. 
      We provide a user-friendly platform to help you grow your social media presence effectively.`,
      show: true
    },
    {
      title: "What SMM services can I find?",
      content: `
        We offer a comprehensive range of SMM services including:
        <ul class="mt-2 mb-0">
          <li>Social media likes and followers</li>
          <li>Video views and engagement</li>
          <li>Comments and shares</li>
          <li>Custom social media packages</li>
        </ul>
      `
    },
    {
      title: "Are SMM services safe?",
      content: `Yes, our services are completely safe! We use organic methods that comply with 
      social media platform guidelines. Your account security is our top priority, and we guarantee 
      that your accounts won't face any risks.`
    },
    {
      title: "How does a mass order work?",
      content: `Our mass order feature allows you to place multiple orders simultaneously. 
      Simply upload a list of links and select your desired services for each. 
      This saves time and streamlines your social media growth strategy.`
    },
    {
      title: "What does drip-feed mean?",
      content: `Drip-feed is our smart delivery system that gradually distributes your order over time. 
      For example, instead of getting 2000 likes at once, you can receive 200 likes daily for 10 days. 
      This creates a more natural growth pattern and improves engagement authenticity.`
    }
  ];

  const accordion = document.getElementById("accordionExample");

  // Generate Bootstrap accordion items dynamically
  faqData.forEach((item, index) => {
    const id = `collapse${index + 1}`;
    const headingId = `heading${index + 1}`;
    const isShow = item.show ? "show" : "";
    const collapsed = item.show ? "" : "collapsed";
    const expanded = item.show ? "true" : "false";

    accordion.innerHTML += `
      <div class="accordion-item" style="border-radius:2rem;">
        <h2 class="accordion-header" id="${headingId}">
          <button class="accordion-button ${collapsed}" type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#${id}"
                  aria-expanded="${expanded}"
                  aria-controls="${id}">
            ${item.title}
          </button>
        </h2>
        <div id="${id}" class="accordion-collapse collapse ${isShow}"
             aria-labelledby="${headingId}"
             data-bs-parent="#accordionExample">
          <div class="mt-2" style="color: whitesmoke; background-color: #0D0BD1; padding:1rem;">
            ${item.content}
          </div>
        </div>
      </div>
    `;
  });
</script>
    
<?php
require_once 'themes/nico/views/footer.php';

?>