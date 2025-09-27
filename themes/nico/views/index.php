
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=get_option('website_favicon', BASE."assets/images/favicon.png")?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo BASE; ?>themes/nico/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>assets/css/new_style.css" rel="stylesheet">

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm bg-white" >
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="Makara Logo" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" style="color: black;" onmouseover="this.style.color='#00C853'" onmouseout="this.style.color='black'" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: black;" onmouseover="this.style.color='#00C853'" onmouseout="this.style.color='black'" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: black;" onmouseover="this.style.color='#00C853'" onmouseout="this.style.color='black'" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: black;" onmouseover="this.style.color='#00C853'" onmouseout="this.style.color='black'" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="navbar-buttons">
                    <a href="<?=cn('auth/login')?>" class="btn btn-link me-3">Login</a>
                    <a href="<?=cn('auth/signup')?>" class="btn btn-keen-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" style="background: url('https://environics.ca/wp-content/uploads/2024/07/feature-image-cropped.png') no-repeat center center fixed;">
        <div class="container" >
            <div class="row align-items-center">
                <div class="col-lg-6 mt-5">
                    <h1 class="keen-hero-title mb-4">
                        <span># Accelerate</span>
                        <span># Your Social</span>
                        <span># Growth</span>
                    </h1>
                    <p class="keen-subtitle mb-4">Premium social media solutions for brands that want to stand out. Grow, engage, and convert with Makara.</p>
                    <a href="<?=cn('auth/signup')?>" class="btn btn-secondary mb-4" style="border-radius: 10px">Start Growing Today</a>
                    <div class="keen-hero-social-proof d-flex align-items-center">
                        <div class="keen-stars me-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="mb-0">Rated 4.8/5 from over 1,000+ reviews</p>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <!-- <img src="https://images.sbs.com.au/dims4/default/557da45/2147483647/strip/true/crop/2850x1603+616+1417/resize/1280x720!/quality/90/?url=http%3A%2F%2Fsbs-au-brightspot.s3.amazonaws.com%2F74%2F41%2Fb5af8ce441a5a0cc425a3680ce71%2F20240221001905687010-original.jpg&imwidth=960" alt="Social Growth" class="img-fluid"> -->
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

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="keen-section-title">Why Choose Makara</h2>
                <p class="keen-subtitle">Premium features to accelerate your social media growth</p>
            </div>
            <div class="row g-4" style="color: black;">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Instant Delivery</h3>
                        <p>Get your orders fulfilled instantly with our automated system. No waiting, no delays.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Safe & Secure</h3>
                        <p>Your account safety is our priority. All activities comply with platform guidelines.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Real Growth</h3>
                        <p>High-quality engagement from real users to boost your social proof naturally.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="keen-section-title">What Our Clients Say</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">“</div>
                        <p class="testimonial-text">Makara has transformed our social media presence. Our engagement has increased by 300% in just two months!</p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/100?img=1" alt="Author Image">
                            <div>
                                <div class="testimonial-author-name">Sarah Johnson</div>
                                <div class="testimonial-author-role">Marketing Director, TechCorp</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">“</div>
                        <p class="testimonial-text">The best SMM panel I've ever used. The customer support is top-notch and the services are high-quality.</p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/100?img=2" alt="Author Image">
                            <div>
                                <div class="testimonial-author-name">John Doe</div>
                                <div class="testimonial-author-role">Freelancer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container text-center" style="border-left: 1px solid gray; border-right: 1px solid gray;">
            <h2 class="keen-section-title">Ready to Dominate Social Media?</h2>
            <p class="keen-subtitle">Join thousands of successful brands who trust Makara for their social media growth</p>
            <a href="<?=cn('auth/signup')?>" class="btn btn-secondary btn-lg">Get Started Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img src="<?=get_option('website_logo_white', BASE."assets/images/logo-white.png")?>" alt="Makara Logo" class="footer-logo mb-4">
                    <p class="mb-4">Premium social media growth solutions for brands that want to stand out and succeed in the digital world.</p>
                    <div class="footer-social">
                        <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4>Company</h4>
                    <ul class="footer-links" style="color: #00C853; text-decoration: none;">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">API Docs</a></li>
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
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/bootstrap.min.js"></script>
    <!-- Scripts -->
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/navbar-scroll.js"></script>
</body>
</html>
