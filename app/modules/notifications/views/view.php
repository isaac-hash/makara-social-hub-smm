<style>
  body {
    background-color: #f5f5f5;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  }
  
  .notification-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 1rem;
  }
  
  .page-header {
    background-color: #1abc9c;
    color: white;
    padding: 1rem;
    margin: -1rem -1rem 1rem -1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .page-header h1 {
    font-size: 1.25rem;
    margin: 0;
    font-weight: 500;
  }
  
  .page-header .header-icons {
    display: flex;
    gap: 1rem;
  }
  
  .page-header .header-icons i {
    font-size: 1.25rem;
    cursor: pointer;
  }
  
  .notification-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
    overflow: hidden;
  }
  
  .notification-header {
    padding: 1rem;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }
  
  .notification-badge {
    background-color: #ff4757;
    color: white;
    font-size: 0.65rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    text-transform: uppercase;
    display: inline-block;
    margin-bottom: 0.5rem;
  }
  
  .notification-date {
    font-size: 0.875rem;
    color: #999;
    margin-bottom: 0.5rem;
  }
  
  .notification-subject {
    font-size: 1.125rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
  }
  
  .notification-body {
    padding: 1rem;
    color: #4a4a4a;
    line-height: 1.6;
  }
  
  .share-icon {
    color: #bbb;
    cursor: pointer;
    font-size: 1.25rem;
  }
  
  .notification-meta {
    padding: 1rem;
    background-color: #fafafa;
    border-top: 1px solid #f0f0f0;
    font-size: 0.875rem;
  }
  
  .meta-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
  }
  
  .meta-label {
    color: #999;
    font-weight: 500;
  }
  
  .meta-value {
    color: #2c3e50;
    font-weight: 500;
  }
  
  /* Desktop - with sidebar offset */
  @media (min-width: 992px) {
    .notification-container {
      margin-left: 9rem;
      margin-top: 9rem;
      max-width: 800px;
    }
  }
  
  /* Tablet Screens (768px to 991px) */
  @media (min-width: 768px) and (max-width: 991px) {
    .notification-container {
      margin-left: 5rem;
      margin-top: 7rem;
    }
  }
  
  /* Mobile Screens (below 768px) */
  @media (max-width: 767px) {
    .notification-container {
      padding: 0;
      margin: 0;
    }
    
    .page-header {
      margin: 0;
      border-radius: 0;
    }
    
    .notification-card {
      border-radius: 0;
      margin-bottom: 0.5rem;
    }
  }
</style>

<?php 
    $item_created = show_item_datetime($item['created'], 'long');
    $item_status = show_item_status($controller_name, $item['id'], $item['status'], '');
?>

<div class="notification-container">
    <div class="page-header">
        <h1>What's new on product</h1>
        <div class="header-icons">
            <i class="fe fe-search"></i>
            <i class="fe fe-x"></i>
        </div>
    </div>
    
    <div class="notification-card">
        <div class="notification-header">
            <div>
                <span class="notification-badge">NEW</span>
                <div class="notification-date"><?php echo $item_created; ?></div>
                <h2 class="notification-subject"><?php echo esc($item['subject']); ?></h2>
            </div>
            <i class="fe fe-share-2 share-icon"></i>
        </div>
        
        <div class="notification-body">
            <?php echo nl2br(esc($item['description'])); ?>
        </div>
        
        <div class="notification-meta">
            <div class="meta-row">
                <span class="meta-label"><?=lang("Status")?></span>
                <span class="meta-value"><?php echo $item_status; ?></span>
            </div>
            <div class="meta-row">
                <span class="meta-label"><?=lang("Name")?></span>
                <span class="meta-value"><?php echo esc($item['first_name'] . ' ' . $item['last_name']); ?></span>
            </div>
            <div class="meta-row">
                <span class="meta-label"><?=lang("Email")?></span>
                <span class="meta-value"><?php echo esc($item['email']); ?></span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Notification #</span>
                <span class="meta-value"><?php echo $item['id']; ?></span>
            </div>
        </div>
    </div>
</div>