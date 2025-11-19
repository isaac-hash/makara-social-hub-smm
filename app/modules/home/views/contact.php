
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --primary-blue: #0D0BD1;
            --primary-orange: #FF9933;
            --dark: #1a1a2e;
            --light-gray: #f5f7fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-gray);
            overflow-x: hidden;
        }
        
        /* Animated Background */
        .hero-section {
            position: relative;
            min-height: 60vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-blue) 0%, #0a08a0 50%, var(--dark) 100%);
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: var(--primary-orange);
            border-radius: 50%;
            top: -300px;
            right: -200px;
            opacity: 0.15;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-section::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--primary-orange);
            border-radius: 50%;
            bottom: -200px;
            left: -100px;
            opacity: 0.1;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }
        
        .hero-content h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease;
        }
        
        .hero-content p {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 300;
            animation: fadeInUp 1s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Main Container */
        .main-container {
            margin-top: -80px;
            position: relative;
            z-index: 10;
            padding-bottom: 100px;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 60px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        /* Contact Info Cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        
        .info-item {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .info-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-orange));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .info-item:hover::before {
            transform: scaleX(1);
        }
        
        .info-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(13, 11, 209, 0.2);
            border-color: var(--primary-blue);
        }
        
        .info-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, var(--primary-blue));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            transition: transform 0.3s ease;
        }
        
        .info-item:hover .info-icon {
            transform: rotate(10deg) scale(1.1);
        }
        
        .info-item h4 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .info-item p {
            color: #6c757d;
            margin: 0;
            line-height: 1.8;
        }
        
        /* Form Section */
        .form-section {
            background: white;
            padding: 50px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-orange));
            border-radius: 2px;
        }
        
        .section-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }
        
        .form-group {
            margin-bottom: 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 12px;
            font-size: 0.95rem;
            display: block;
        }
        
        .form-control, .form-select {
            border: 2px solid #e8ecef;
            border-radius: 15px;
            padding: 18px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafbfc;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(255, 153, 51, 0.1);
            background: white;
            outline: none;
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue));
            color: white;
            border: none;
            padding: 18px 50px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(13, 11, 209, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            /* background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); */
            transition: left 0.5s ease;
        }
        
        .btn-submit:hover::before {
            left: 100%;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(13, 11, 209, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(-1px);
        }
        
        /* Map Section */
        .map-section {
            margin-top: 60px;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            height: 450px;
        }
        
        .map-section iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        /* Social Links */
        .social-section {
            text-align: center;
            margin-top: 50px;
            padding: 40px;
            background: white;
            border-radius: 20px;
        }
        
        .social-section h4 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 25px;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        
        .social-link {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-link:hover {
            transform: translateY(-5px) rotate(5deg);
            box-shadow: 0 10px 25px rgba(13, 11, 209, 0.4);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .glass-card {
                padding: 30px 20px;
            }
            
            .form-section {
                padding: 30px 20px;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>

    <!-- Header -->
   <?php
    require_once 'themes/nico/views/nav.php';
    ?>
    <!-- Hero Section -->
    <div class="hero-section" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0a08a0 50%, var(--dark) 100%);">
        <div class="container">
            <div class="hero-content">
                <h1>Let's Connect</h1>
                <p>Have a question or want to work together? We'd love to hear from you. Drop us a line and we'll get back to you as soon as possible.</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="container">
            <div class="glass-card">
                <!-- Contact Info Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4>Location</h4>
                        <p>You can visit us anytime<br>Lagos, Nigeria</p>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h4>Phone</h4>
                        <p>You can reach out to us via a phone call Or WhatsApp<br>+2348120054028</p>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4>Email</h4>
                        <p>We're Open to receiving your mail at any time.<br>support@makarasocialhub.ng</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="form-section">
                    <h2 class="section-title">Send a Message</h2>
                    <p class="section-subtitle">Fill out the form below and our team will get back to you within 24 hours</p>
                    
                    <form id="contactForm">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" class="form-control" placeholder="John" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" placeholder="Doe" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" placeholder="john.doe@example.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="+234 555 000-0000">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Subject *</label>
                                    <input type="text" class="form-control" placeholder="How can we help you?" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Message *</label>
                                    <textarea class="form-control" placeholder="Tell us more about your inquiry..." required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Social Media -->
                <div class="social-section">
                    <h4>Connect With Us</h4>
                    <div class="social-links mb-3">
                        <a href="https://www.facebook.com/profile.php?id=61572953819089&mibextid=wwXIfr" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/makarasocialhub?s=21" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/makarasocialhub.ng?igsh=MXd1cWlsbjdxZjFzbw==" class="social-link"><i class="fab fa-instagram"></i></a>
                        
                    </div>
                    <div class="social-links mb-3">
                        <a href="https://www.linkedin.com/company/makarasocialhub/" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://youtube.com/@makarasocialhub?si=Sfm6A9WWLcShyrAD" class="social-link"><i class="fab fa-youtube"></i></a>
                        <a href="https://t.me/makarasocialhub" class="social-link"><i class="fab fa-telegram"></i></a>
                    </div>
                    <div class="social-links mb-3">
                        <a href="https://chat.whatsapp.com/CsXMbFKkU5d3xHZgRG5Yji?mode=wwt" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Map -->
                <!-- <div class="map-section">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1234567890" allowfullscreen="" loading="lazy"></iframe>
                </div> -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = this.querySelector('.btn-submit');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            btn.disabled = true;
            
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check me-2"></i>Message Sent!';
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    this.reset();
                    
                    alert('Thank you for reaching out! We\'ll get back to you within 24 hours.');
                }, 2000);
            }, 1500);
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-section');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    </script>
<?php
require_once 'themes/nico/views/footer.php';

?>