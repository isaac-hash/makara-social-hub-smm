<?php
//   $balance = current_logged_user()->balance;
//   if (empty($balance) || $balance == 0) {
//     $balance = 0.00;
//   } else {
//     $balance = currency_format($balance);
//   }
//   $current_balance = get_option('currency_symbol',"") . $balance;
//   $nav_item_user_title = sprintf('%s! <span class="text-uppercase">%s</span>', lang('Hi'), current_logged_user()->first_name);
//   $user = current_logged_user();
?>


<!-- <!DOCTYPE html>
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
            --sidebar-width: 260px;
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

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            flex-shrink: 0;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, var(--primary-blue), #4745d6);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, var(--primary-orange), #ffb366);
        }

        .stat-icon.gradient {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-orange));
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Content Section */
        .content-section {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }

        /* Responsive */
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

            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 0 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

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
    </style>
</head>
<body> -->
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a href="#" class="logo">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
        </div>
        <div class="header-right">
            <div class="header-icon">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </div>
            <div class="header-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="user-profile" onclick="toggleUserDropdown(event)">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <span><?= $user->first_name ?? 'User' ?></span>
                <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                
                <!-- User Dropdown -->
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-user-name"><?= $user->first_name ?? 'User' ?></div>
                        <div class="dropdown-user-email"><?= $user->email ?? 'user@example.com' ?></div>
                    </div>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="?page=profile" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=account-settings" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=billing" class="dropdown-item">
                                <i class="fas fa-credit-card"></i>
                                <span>Billing</span>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="?page=help" class="dropdown-item">
                                <i class="fas fa-question-circle"></i>
                                <span>Help Center</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=logout" class="dropdown-item" style="color: var(--primary-orange);">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
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
                <a href="?page=logout" class="menu-link">
                    <i class="fas fa-sign-out-alt menu-icon"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Stats Cards (if header_area data exists) -->
        <?php if (!empty($header_area)) : ?>
        <div class="stats-grid">
            <?php foreach ($header_area as $key => $item) : ?>
            <div class="stat-card">
                <div class="stat-icon <?= $item['class'] ?? 'blue' ?>">
                    <i class="<?= $item['icon'] ?>"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value"><?= $item['value'] ?></div>
                    <div class="stat-label"><?= $item['name'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Child Content Area -->
        <div class="content-section">
            <?php
            // This is where child components/pages will be included
            if (isset($content_page) && file_exists($content_page)) {
                include $content_page;
            } elseif (isset($page_content)) {
                echo $page_content;
            } else {
                echo '<h2>Welcome to Dashboard</h2>';
                echo '<p>Select a menu item to view content.</p>';
            }
            ?>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
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
        });
    </script>
<!-- </body>
</html> -->

<style>
  .search-box input.form-control{
    margin: -1px;
  }
  .search-box select.form-control{
    border-radius: 0px;
    border: 1px solid #fff;
  }
</style>
<?php
  $CI = &get_instance();
  $CI->load->model('model', 'model');
  $total_unread_tickets = $CI->model->count_results('id', TICKETS, ['user_read' => 1, 'uid' => session('uid')]);
?>

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

<div class="header top  py-4">
  <div class="container">
    <div class="d-flex">
      <a class="" href="<?=cn('statistics')?>">
        <img src="<?=get_option('website_logo_white', BASE."assets/images/logo-white.png")?>" alt="Website logo" style="max-height: 40px;">
      </a>
      <div class="d-flex order-lg-2 ml-auto my-auto search-box">
        <div class="search-box m-r-30 d-none d-lg-block">
          <?php
            if ( allowed_search_bar(segment(1)) || allowed_search_bar(segment(2)) ) {
              echo Modules::run("blocks/search_box");
            }
          ?>
        </div>
        <?php
          if (session('uid_tmp')) {
        ?>
        <div class="notifcation m-r-10">
          <a  class="ajaxViewUser" href="<?=cn("back-to-admin")?>" data-toggle="tooltip" data-placement="bottom" title="<?=lang('Back_to_Admin')?>" class="text-white ajaxBackToAdmin">
            <i class="fe fe-log-out"></i>
          </a>
        </div>
        <?php } ?>
        <?php
          if (get_option("enable_news_announcement") == 1) {
        ?>
        <div class="notifcation">
          <a href="<?=cn("news-annoucement")?>" data-toggle="tooltip" data-placement="bottom" title="<?=lang("news__announcement")?>" class="ajaxModal text-white">
            <i class="fe fe-bell"></i>
            <div class="test">
              <span class="nav-unread <?=(isset($_COOKIE["news_annoucement"]) && $_COOKIE["news_annoucement"] == "clicked") ? "" : "change_color"?>"></span>
            </div>
          </a>
        </div>
        <?php }?>
        <div class="dropdown">
          <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
            <span class="avatar" style="background-image: url(<?=BASE?>assets/images/user-avatar.png)"></span>
            <span class="ml-2 d-none d-lg-block">
              <span class="text-default text-white">
                <?= $nav_item_user_title; ?>
              </span>
              <small class="text-muted  text-white d-block mt-1 user-balance">
                <?= esc($current_balance)?>
              </small>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="<?=cn('profile')?>">
              <i class="dropdown-icon fe fe-user"></i> <?=lang("Profile")?>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?=cn("auth/logout")?>">
              <i class="dropdown-icon fe fe-log-out"></i> <?=lang("Sign_out")?>
            </a>
          </div>
        </div>
      </div>
      <a href="#" class="header-toggler text-white d-lg-none ml-3 ml-lg-0 my-auto" data-toggle="collapse" data-target="#headerMenuCollapse">
        <span class="header-toggler-icon"></span>
      </a>
    </div>
  </div>
</div>

<?php
  $header_elements = app_config('controller')['user'];
?>
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

          <li class="nav-item d-block d-lg-none mt-2">
            <button class="btn btn-primary btn-block text-while">
              <div class="fs-16">
                <i class="icon fa fa-user-circle-o"></i>
                <?= $nav_item_user_title; ?>
              </div>
              <?= esc($current_balance)?>
            </button>
          </li>

          <li class="nav-item">
            <a href="<?=cn($header_elements['statistics']['route-name']); ?>" class="nav-link <?=(segment(1) == $header_elements['statistics']['route-name'])? "active" : "" ?>"><i class="<?=$header_elements['statistics']['icon']; ?>"></i> <?=lang($header_elements['statistics']['name']); ?></a>
          </li>   

          <li class="nav-item">
            <a href="<?=cn($header_elements['new_order']['route-name']); ?>" class="nav-link <?=(segment(1) == $header_elements['new_order']['route-name'])? "active" : "" ?>"><i class="<?=$header_elements['new_order']['icon']; ?>"></i> <?=lang($header_elements['new_order']['name']); ?></a>
          </li>   

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link  <?=(in_array(segment(1), ['order', 'dripfeed', 'subscriptions']))?"active":""?>" data-toggle="dropdown"><i class="fe fe-inbox"></i><?=lang('Order')?></a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="<?=cn($header_elements['order']['route-name'])?>" class="dropdown-item "><?=lang($header_elements['order']['name']); ?></a>
              <a href="<?=cn($header_elements['dripfeed']['route-name'])?>" class="dropdown-item "><?=lang($header_elements['dripfeed']['name']); ?></a>
              <a href="<?=cn($header_elements['subscriptions']['route-name'])?>" class="dropdown-item "><?=lang($header_elements['subscriptions']['name']); ?></a>
            </div>
          </li>

          <?php if (is_table_exists(ORDERS_REFILL)): ?>
            <li class="nav-item">
              <a href="<?=cn($header_elements['refill']['route-name']); ?>" class="nav-link <?=(segment(1) == $header_elements['refill']['route-name']) ? "active":"" ?>"><i class="<?=$header_elements['refill']['icon']; ?>"></i> <?=lang($header_elements['refill']['name']); ?></a>
            </li>   
          <?php endif; ?>

          <li class="nav-item">
            <a href="<?=cn($header_elements['services']['route-name']); ?>" class="nav-link <?=(segment(1) == $header_elements['services']['route-name'])? "active" : "" ?>"><i class="<?=$header_elements['services']['icon']; ?>"></i> <?=lang($header_elements['services']['name']); ?></a>
          </li>   
          
          <?php 
            if (get_option('enable_api_tab')) {
              ?>      
            <li class="nav-item">
              <a href="<?=cn($header_elements['api']['route-name']); ?>" class="nav-link <?=(segment(2) == 'docs')?"active":""?>"><i class="<?=$header_elements['api']['icon']; ?>"></i> <?=lang($header_elements['api']['name']); ?></a>
            </li>   
          <?php }?>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link <?=(in_array(segment(1), ['tickets', 'faq'])) ? "active":""?>" data-toggle="dropdown"><i class="fa fa-comments-o"></i>
              <?=lang('Support')?> <span class="badge badge-info"><?=$total_unread_tickets?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="<?=cn($header_elements['tickets']['route-name'])?>" class="dropdown-item ">
                <?=lang($header_elements['tickets']['name']); ?>
                <span class="badge badge-info"><?=$total_unread_tickets?></span>
              </a>
              <a href="<?=$header_elements['faq']['route-name']?>" class="dropdown-item "><?=lang($header_elements['faq']['name']); ?></a>
            </div>
          </li>
          <li class="nav-item">
            <a href="<?=cn($header_elements['add_funds']['route-name']); ?>" class="nav-link <?=(segment(1) == $header_elements['add_funds']['route-name'])? "active" : "" ?>"><i class="<?=$header_elements['add_funds']['icon']; ?>"></i> <?=lang($header_elements['add_funds']['name']); ?></a>
          </li>   
          <li class="nav-item">
            <a href="<?=cn($header_elements['transactions']['route-name']); ?>" class="nav-link <?=(segment(1) == $header_elements['transactions']['route-name'])? "active" : "" ?>"><i class="<?=$header_elements['transactions']['icon']; ?>"></i> <?=lang($header_elements['transactions']['name']); ?></a>
          </li>

          <?php
            $enable_affiliate = true;
            if (!is_table_exists(AFFILIATE) || !get_option('affiliate_mode', 0)) $enable_affiliate = false;
            if (is_table_exists(AFFILIATE)) {
              $item_affiliate = $CI->model->get('status', AFFILIATE, ['uid' => session('uid')], '', '', true);
              if ($item_affiliate && !$item_affiliate['status']) {
                $enable_affiliate = false;
              }
            }
          ?>
          <?php if ($enable_affiliate): ?>
            <li class="nav-item">
              <a href="<?=cn($header_elements['affiliates']['route-name']); ?>" class="nav-link <?=(segment(2) == $header_elements['affiliates']['route-name'])?"active":""?>"><i class="<?=$header_elements['affiliates']['icon']; ?>"></i> <?=lang($header_elements['affiliates']['name']); ?></a>
            </li>   
          <?php endif; ?>
          
        </ul>
      </div>
    </div>
  </div>
</div>
