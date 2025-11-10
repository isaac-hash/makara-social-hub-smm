<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1760352921/logo_famnk2.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            /* background-image: url('<?=BASE?>assets/images/auth.png'); */
            background: #0D0BD1;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: linear-gradient(135deg, #ffffff4b, #0D0BD1); */
            opacity: 0.85;
            z-index: 1;
        }
        
        .signup-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .signup-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
        }
        
        .logo-container {
            width: 70px;
            height: 70px;
            /* background: #0D0BD1; */
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .signup-title {
            color: #333;
            font-size: 1.1rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
        }
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 0.25rem;
            transition: color 0.2s;
            z-index: 10;
        }
        
        .password-toggle:hover {
            color: #0D0BD1;
        }
        
        .form-control {
            padding: 0.7rem 1rem 0.7rem 2.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95rem;
        }
        
        .form-control.with-toggle {
            padding-right: 2.5rem;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
            border-color: #0D0BD1;
        }
        
        .form-check {
            font-size: 0.85rem;
            color: #666;
        }
        
        .form-check-input:checked {
            background-color: #0D0BD1;
            border-color: #0D0BD1;
        }
        
        .form-check a {
            color: #0D0BD1;
            text-decoration: none;
        }
        
        .form-check a:hover {
            text-decoration: underline;
        }
        
        .btn-signup {
            /* background: linear-gradient(135deg, #0D0BD1, #ff9933); */
            background: #0D0BD1;
            border: none;
            color: white;
            padding: 0.85rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            width: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
            color: white;
        }
        
        .signin-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }
        
        .signin-link a {
            color: #0D0BD1;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signin-link a:hover {
            text-decoration: underline;
        }
        
        .row-compact {
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        
        .row-compact > [class*='col-'] {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        :root{
            --makara-blue: #0D0BD1;
            --makara-blue-overlay: rgba(13, 11, 209, 0.1);
            --makara-orange: #FF9933;
             --makara-blue-light: rgba(13, 11, 209, 0.1);
            --makara-orange-light: rgba(255, 153, 51, 0.1);
        }

         .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--makara-blue) 0%, #1a18e0 100%);
            color: white;
            padding: 2rem;
            border: none;
            position: relative;
        }

        .modal-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(135deg, var(--makara-blue) 0%, #1a18e0 100%);
            clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%);
        }

        .modal-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 3rem 2rem 2rem;
            text-align: center;
        }

        .welcome-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--makara-blue) 0%, var(--makara-orange) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .welcome-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(13, 11, 209, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(13, 11, 209, 0);
            }
        }

        .modal-body p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .modal-body p:last-of-type {
            font-weight: 600;
            color: #333;
        }

        .feature-list {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: var(--makara-blue-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            background: var(--makara-blue);
            transform: translateY(-5px);
        }

        .feature-icon svg {
            width: 24px;
            height: 24px;
            fill: var(--makara-blue);
            transition: fill 0.3s ease;
        }

        .feature-item:hover .feature-icon svg {
            fill: white;
        }

        .feature-text {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .modal-footer {
            border: none;
            padding: 1.5rem 2rem 2rem;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--makara-blue) 0%, var(--makara-orange) 100%);
            border: none;
            padding: 0.75rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 11, 209, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 11, 209, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .demo-trigger {
            margin: 2rem;
        }
    </style>

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <div class="signup-container">
        <div class="signup-card">
            <div class="logo-container">
                <img src="<?=BASE?>assets/images/makara_IMG_1670.PNG" alt="Logo" style="max-width: 110px; max-height: 110px;">

            </div>
            
            <h2 class="signup-title">Create Account To Access Your Personal Dashboard</h2>
            
            <form class="actionForm" action="<?=cn("auth/ajax_sign_up")?>" data-redirect="<?=cn('statistics')?>" method="POST">
                <div class="row row-compact">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <span class="input-icon">👤</span>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <span class="input-icon">👤</span>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">✉</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">👤</span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" class="form-control with-toggle" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            👁️
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" class="form-control with-toggle" id="confirm_password" name="re_password" placeholder="Confirm Password" required>
                        <button type="button" class="password-toggle" id="toggleConfirmPassword">
                            👁️
                        </button>
                    </div>
                </div>

                <?php
                  $location = get_location_info_by_ip(get_client_ip());
                  $user_timezone = $location->timezone;
                  if ($user_timezone == "" || $user_timezone == 'Unknow') {
                    // $user_timezone = get_option("default_timezone", 'UTC');
                    $user_timezone = 'Africa/Lagos';
                  }
                ?>
                <input type="hidden" name="timezone" value="<?= $user_timezone ?>">

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="<?=cn('terms')?>">Terms of Service</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-signup">
                    ✓ Create Account
                </button>
                
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
            </form>

            <div class="signin-link">
                Already have an account? <a href="<?=cn("auth/login")?>">Sign In</a>
            </div>
        </div>
    </div>

    <!-- Welcome Modal -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="welcomeModalLabel">Welcome to Makara Social Hub</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="welcome-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V7.48l7-3.5v8.01z"/>
                        </svg>
                    </div>
                    <p>We're excited to have you on board! Get ready to take your social media management to the next level.</p>
                    
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                </svg>
                            </div>
                            <span class="feature-text">Multi-Platform</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"/>
                                </svg>
                            </div>
                            <span class="feature-text">Easy to Use</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>
                                </svg>
                            </div>
                            <span class="feature-text">Analytics</span>
                        </div>
                    </div>

                    <p>Sign up now to unlock powerful features and grow your audience.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Let's Get Started! 🚀</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
    // Force AJAX requests to be recognized by CodeIgniter
    $.ajaxSetup({
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });

    $(document).ready(function(){
        $('#welcomeModal').modal('show');
        // Password toggle functionality
        $("#togglePassword").on("click", function(){
            const passwordField = $("#password");
            const toggleButton = $(this);
            
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                toggleButton.text("🙈");
            } else {
                passwordField.attr("type", "password");
                toggleButton.text("👁️");
            }
        });

        // Confirm password toggle functionality
        $("#toggleConfirmPassword").on("click", function(){
            const confirmPasswordField = $("#confirm_password");
            const toggleButton = $(this);
            
            if (confirmPasswordField.attr("type") === "password") {
                confirmPasswordField.attr("type", "text");
                toggleButton.text("🙈");
            } else {
                confirmPasswordField.attr("type", "password");
                toggleButton.text("👁️");
            }
        });

        // Form submission
        $(".actionForm").on("submit", function(e){
            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr("action");
            var redirectUrl = form.data("redirect");

            $.ajax({
                url: actionUrl,
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function(response){
                    if(response.status === "success"){
                        window.location.href = redirectUrl;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr){
                    console.error(xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });
    });
    </script>

    <script>
      $(document).ready(function(){
        var is_notification_popup = "<?=get_option('enable_notification_popup', 0)?>"
        setTimeout(function(){
            if (is_notification_popup == 1) {
              $("#notification").modal('show');
            }else{
              $("#notification").modal('hide');
            }
        },500);
     });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>