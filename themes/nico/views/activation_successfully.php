<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?> - <?=lang("congratulations_your_registration_is_now_complete")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1765204995/blue_logo_christmas_fve0g0.png">

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
            background:  #0D0BD1;
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
            opacity: 0.85;
            z-index: 1;
        }
        
        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
        }
        
        .logo-container {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .login-title {
            color: #333;
            font-size: 1.1rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .login-card-description {
            color: #666;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .btn-login {
            background:  #0D0BD1;
            border: none;
            color: white;
            padding: 0.85rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            width: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
            display: block;
            text-decoration: none;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 11, 209, 0.4);
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <a href="#"><img src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="Logo" style="max-width: 110px; max-height: 110px;"></a>
            </div>
            
            <h2 class="login-title"><?=lang("congratulations_your_registration_is_now_complete")?></h2>
            <p class="login-card-description"><?=lang('congratulations_desc')?></p>
            
            <div class="form-group">
                <a class="btn btn-login" href="<?=cn('auth/login')?>">
                    🚀 <?=lang("get_start_now")?>
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

