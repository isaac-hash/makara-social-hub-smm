<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Dashboard' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0D0BD1;
            --primary-orange: #FF9933;
            --white: #fff;
            --light-gray: #f8f9fa;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;
            --sidebar-width: 160px;
            --header-height: 70px;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--light-gray);
            color: var(--text-dark);
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: var(--white);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-decoration: none;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-icon {
            position: relative;
            color: var(--text-muted);
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .header-icon:hover {
            color: var(--primary-blue);
        }

        .header-icon a {
            color: inherit;
            text-decoration: none;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--primary-orange);
            color: var(--white);
            font-size: 0.7rem;
            padding: 2px 5px;
            border-radius: 10px;
            font-weight: 600;
        }

        .notification-badge.change_color {
            background: #ff4444;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .user-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-orange));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
        }

        .user-dropdown {
            position: absolute;
            top: 60px;
            right: 0;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .user-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid var(--light-gray);
        }

        .dropdown-user-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .dropdown-user-email {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .dropdown-menu {
            list-style: none;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: background 0.2s;
        }

        .dropdown-item:hover {
            background: var(--light-gray);
        }

        .dropdown-item i {
            width: 18px;
            color: var(--text-muted);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--light-gray);
            margin: 0.5rem 0;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background: var(--white);
            box-shadow: var(--shadow);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 999;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
        }

        .menu-item {
            margin: 0.25rem 0;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1.5rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu-link:hover {
            background: var(--light-gray);
            border-left-color: var(--primary-orange);
        }

        .menu-link.active {
            background: linear-gradient(90deg, rgba(13, 11, 209, 0.1), transparent);
            border-left-color: var(--primary-blue);
            color: var(--primary-blue);
            font-weight: 600;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
        }

        /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .overlay.active {
            display: block;
        }

        /* Main Content Area */
        .main-content-wrapper {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            /* padding: 2rem; */
            min-height: calc(100vh - var(--header-height));
            transition: margin-left 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content-wrapper {
                margin-left: 0;
            }
        }
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .header {
                padding: 0 1rem;
            }

            .header-right {
                gap: 0.75rem;
            }

            .header-icon {
                font-size: 1.1rem;
            }

            .user-profile span {
                display: none;
            }

            .logo img {
                max-height: 35px !important;
            }

            .user-dropdown {
                right: -10px;
                min-width: 180px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 0 0.75rem;
            }

            .header-right {
                gap: 0.5rem;
            }

            .header-icon {
                font-size: 1rem;
            }

            .logo img {
                max-height: 30px !important;
            }

            .sidebar {
                width: 80vw;
                max-width: 280px;
            }

            .menu-link {
                padding: 0.75rem 1rem;
                font-size: 0.95rem;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .notification-badge {
                font-size: 0.65rem;
                padding: 1px 4px;
            }
        }
    </style>
</head>
<body>
    <?php
      $balance = current_logged_user()->balance;
      if (empty($balance) || $balance == 0) {
        $balance = 0.00;
      } else {
        $balance = currency_format($balance);
      }
      $current_balance = get_option('currency_symbol',"$") . $balance;
      $nav_item_user_title = sprintf('%s! <span class="text-uppercase">%s</span>', lang('Hi'), current_logged_user()->first_name);
    ?>

    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a href="<?php echo cn(); ?>" class="logo">
                <img src="<?php echo get_option('website_logo', BASE.'assets/images/logo.png'); ?>" alt="Website Logo" style="max-height: 40px;">
            </a>
        </div>
        <div class="header-right">
            <?php
              if (session('sid') && session('uid')) {
            ?>
            <div class="header-icon">
                <a class="ajaxViewUser" href="<?=cn("back-to-admin")?>" data-toggle="tooltip" data-placement="bottom" title="<?=lang('Back_to_Admin')?>">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
            <?php }?>

            <div class="header-icon">
                <a href="#customize" data-toggle="modal" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('Theme_Customizer'); ?>">
                    <i class="fas fa-sliders-h"></i>
                </a>
            </div>

            <?php
              if (get_option("enable_news_announcement") &&  get_option('news_announcement_button_position', "header") == 'header') {
            ?>
            <div class="header-icon">
                <a class="ajaxModal" href="<?=cn("news-annoucement")?>" data-toggle="tooltip" data-placement="bottom" title="<?=lang("news__announcement")?>">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge <?=(isset($_COOKIE["news_annoucement"]) && $_COOKIE["news_annoucement"] == "clicked") ? "" : "change_color"?>"></span>
                </a>
            </div>
            <?php }?>

            <?php
              $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $this->load->model('model');
              $items_languages = $this->model->fetch('id, ids, country_code, code, is_default', LANGUAGE_LIST, ['status' => 1]);
              $lang_current = get_lang_code_defaut();
            ?>
            <div class="header-icon dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="flag-icon flag-icon-<?php echo strtolower($lang_current->country_code); ?>"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <?php 
                      foreach ($items_languages as $key => $item) {
                    ?>
                    <a class="dropdown-item ajaxChangeLanguageSecond" href="javascript:void(0)" data-url="<?php echo cn('set-language'); ?>" data-redirect="<?php echo strip_tags($redirect); ?>" data-ids="<?php echo strip_tags($item->ids); ?>"><i class="flag-icon flag-icon-<?php echo strtolower($item->country_code); ?>"></i> <?php echo language_codes($item->code); ?>
                    </a>
                    <?php }?>
                </div>
            </div>

            <div class="user-profile" onclick="toggleUserDropdown(event)">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <span><?= $nav_item_user_title; ?></span>
                <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-user-name"><?= current_logged_user()->first_name ?> <?= current_logged_user()->last_name ?></div>
                        <div class="dropdown-user-email"><?= current_logged_user()->email ?></div>
                    </div>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo cn('profile'); ?>" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span><?php echo lang('Profile'); ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo cn('auth/logout'); ?>" class="dropdown-item" style="color: var(--primary-orange);">
                                <i class="fas fa-sign-out-alt"></i>
                                <span><?php echo lang('Logout'); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="?page=dashboard" class="menu-link active">
                    <i class="fas fa-home menu-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="?page=analytics" class="menu-link">
                    <i class="fas fa-chart-bar menu-icon"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="?page=users" class="menu-link">
                    <i class="fas fa-users menu-icon"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="?page=products" class="menu-link">
                    <i class="fas fa-box menu-icon"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="?page=orders" class="menu-link">
                    <i class="fas fa-shopping-cart menu-icon"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="?page=reports" class="menu-link">
                    <i class="fas fa-file-alt menu-icon"></i>
                    <span>Reports</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="?page=settings" class="menu-link">
                    <i class="fas fa-cog menu-icon"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo cn('auth/logout'); ?>" class="menu-link">
                    <i class="fas fa-sign-out-alt menu-icon"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Prevent body scroll when sidebar is open on mobile
            if (sidebar.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        function toggleUserDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userProfile = document.querySelector('.user-profile');
            
            if (dropdown && !userProfile.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Update active menu item based on current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = new URLSearchParams(window.location.search).get('page') || 'dashboard';
            document.querySelectorAll('.menu-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(currentPage)) {
                    link.classList.add('active');
                }
            });

            // Close sidebar when menu item is clicked on mobile
            if (window.innerWidth <= 768) {
                document.querySelectorAll('.menu-link').forEach(link => {
                    link.addEventListener('click', function() {
                        toggleSidebar();
                    });
                });
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('overlay');
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>
</html>