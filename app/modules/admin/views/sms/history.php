<?php
  $class_element = app_config('template')['form']['class_element'];
?>

<div class="page-header">
  <h1 class="page-title">
    <i class="fe fe-bar-chart-2" aria-hidden="true"></i> <?php echo lang("SMS History"); ?>
  </h1>
</div>

<?php if (!$api_configured): ?>
  <div class="alert alert-warning">
    <i class="fe fe-alert-triangle"></i> <strong>API Key Not Configured!</strong>
    <p class="mb-0 mt-2">Please add your Brevo API key in Settings > Other.</p>
  </div>
<?php endif; ?>

<?php if (!empty($aggregated)): ?>
<div class="row mb-4">
  <div class="col-6 col-lg-3">
    <div class="card">
      <div class="card-body text-center">
        <div class="text-muted mb-1">Total Requests</div>
        <h3 class="mb-0 text-primary"><?=$aggregated['requests'] ?? 0?></h3>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card">
      <div class="card-body text-center">
        <div class="text-muted mb-1">Delivered</div>
        <h3 class="mb-0 text-success"><?=$aggregated['delivered'] ?? 0?></h3>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card">
      <div class="card-body text-center">
        <div class="text-muted mb-1">Bounces</div>
        <h3 class="mb-0 text-warning"><?=($aggregated['hardBounces'] ?? 0) + ($aggregated['softBounces'] ?? 0)?></h3>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card">
      <div class="card-body text-center">
        <div class="text-muted mb-1">Blocked</div>
        <h3 class="mb-0 text-danger"><?=$aggregated['blocked'] ?? 0?></h3>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="card mb-4">
  <div class="card-body">
    <form method="GET" class="row align-items-end">
      <div class="col-auto">
        <label class="form-label">Show last</label>
        <select name="days" class="<?=$class_element?>" onchange="this.form.submit()">
          <option value="7" <?=$days == 7 ? 'selected' : ''?>>7 days</option>
          <option value="30" <?=$days == 30 ? 'selected' : ''?>>30 days</option>
          <option value="90" <?=$days == 90 ? 'selected' : ''?>>90 days</option>
        </select>
      </div>
      <div class="col-auto">
        <a href="<?=admin_url('sms')?>" class="btn btn-primary"><i class="fe fe-send"></i> Send New SMS</a>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title"><i class="fe fe-list"></i> Recent SMS Events</h3>
  </div>
  <div class="card-body">
    <?php if (empty($events)): ?>
      <div class="text-center py-5 text-muted">
        <i class="fe fe-inbox" style="font-size: 48px;"></i>
        <p class="mt-3">No SMS events found</p>
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover table-vcenter">
          <thead>
            <tr>
              <th>Phone Number</th>
              <th>Event</th>
              <th>Date</th>
              <th>Message ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($events as $event): ?>
              <tr>
                <td><?=htmlspecialchars($event['phoneNumber'] ?? '-')?></td>
                <td>
                  <?php
                    $eventType = $event['event'] ?? 'unknown';
                    $badgeClass = 'bg-secondary';
                    if ($eventType === 'delivered') $badgeClass = 'bg-success';
                    elseif ($eventType === 'sent') $badgeClass = 'bg-info';
                    elseif (in_array($eventType, ['bounced', 'blocked', 'error'])) $badgeClass = 'bg-danger';
                  ?>
                  <span class="badge <?=$badgeClass?>"><?=ucfirst($eventType)?></span>
                </td>
                <td><?=isset($event['date']) ? date('Y-m-d H:i', strtotime($event['date'])) : '-'?></td>
                <td><small><?=htmlspecialchars($event['messageId'] ?? '-')?></small></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>
