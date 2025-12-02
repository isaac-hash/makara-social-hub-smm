<style>
  /* Desktop - with sidebar offset */
  .responsive-section-header {
    margin-top: 9rem;
    margin-left: 9rem;
  }
  
  .responsive-content-row {
    margin-left: 6rem;
  }
  
  /* Tablet Screens (768px to 991px) */
  @media (max-width: 991px) {
    .responsive-section-header {
      margin-left: 5rem;
      margin-top: 7rem;
    }
    
    .responsive-content-row {
      margin-left: 2.5rem;
      margin-right: 1rem;
    }
  }
  
  /* Mobile Screens (below 768px) */
  @media (max-width: 767px) {
    .responsive-section-header {
      margin-left: 0;
      margin-right: 0;
      margin-top: 6rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    
    .responsive-content-row {
      margin-left: 0;
      margin-right: 0;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }
    
    .responsive-content-row .card {
      margin-bottom: 1rem;
    }
  }
  
  /* Extra Small Screens (below 576px) */
  @media (max-width: 575px) {
    .responsive-section-header {
      margin-top: 6rem;
      padding-left: 0.75rem;
      padding-right: 0.75rem;
    }
    
    .responsive-section-header .page-title {
      font-size: 1.25rem;
    }
    
    .responsive-content-row {
      padding-left: 0.25rem;
      padding-right: 0.25rem;
    }
    
    .responsive-content-row .card-body {
      padding: 1rem;
    }
    
    /* Adjust search area on mobile */
    .search-area {
      margin-top: 1rem;
    }
    
    .search-area .input-group {
      width: 100%;
    }
  }
  
  /* When sidebar is collapsed or hidden */
  @media (min-width: 768px) {
    body.sidebar-collapsed .responsive-section-header,
    body.sidebar-hidden .responsive-section-header {
      margin-left: 1rem;
    }
    
    body.sidebar-collapsed .responsive-content-row,
    body.sidebar-hidden .responsive-content-row {
      margin-left: 0.5rem;
    }
  }
</style>


<?php 
    $item_created  = show_item_datetime($item['created'], 'long');
    $item_status        = show_item_status($controller_name, $item['id'], $item['status'], '');
?>
<div class="row responsive-section-header">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4" style="color: black;"><i class="fa fa-ticket"></i> Notification #<?php echo $item['id']; ?></h3>
            </div>
            <div class="card-body">
                <div class="ticket-details">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td scope="row"><?=lang("Status")?></td><td><?php echo $item_status; ?></td></tr>
                            <tr>
                                <td scope="row"><?=lang("Name")?></td><td><?php echo $item['first_name'] . ' ' .$item['last_name']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row"><?=lang("Email")?></td><td><?php echo $item['email']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row"><?=lang("Created")?></td><td><?php echo $item_created; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
        $form_url     = cn($controller_name."/store_message/");
        $redirect_url = cn($controller_name . '/') . $item['id'];
        $form_attributes = ['class' => 'card-body form actionForm m-t-20', 'data-redirect' => $redirect_url, 'method' => "POST"];
        $form_hidden = ['ids' => @$item['ids']];
    ?>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4 ticket-title" style="color: black;"><?php echo $item['subject']; ?></h3>
            </div>
            <?php 
                if ($item['status'] != 'closed') {
            ?>
                <?php echo form_open($form_url, $form_attributes, $form_hidden); ?>
                    <div class="form-group">
                        <label for="userinput8"><?=lang("Message")?></label>
                        <textarea rows="10" class="form-control" name="message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-min-width m-r-5"><?=lang("Submit")?></button>
                <?php echo form_close(); ?>
                <hr/>   
            <?php } ?>
            <div id="frame">
                <div class="content">
                    <div class="messages">
                        <ul class="p-l-0">
                            <?php
                                if ($items_ticket_message) {
                                    foreach ($items_ticket_message as $key => $item_message) {
                                        echo show_item_ticket_message_detail($controller_name, $item_message, 'user');
                                    }
                                }
                            ?>
                            <?php
                                $item['message'] = $item['description'];
                                unset($item['description']);
                                echo show_item_ticket_message_detail($controller_name, $item, 'user');
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
