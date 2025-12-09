<style>
  :root {
    --makara-blue: #0D0BD1;
    --makara-orange: #FF9933;
    --makara-orange-new: #c65102;
  }

  .order-success {
    margin: 20px 0;
    animation: slideInDown 0.5s ease-out;
  }

  @keyframes slideInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .order-success .alert {
    background: linear-gradient(135deg, var(--makara-blue) 0%, #1a18e6 100%);
    border: none;
    border-radius: 12px;
    color: white;
    box-shadow: 0 8px 24px rgba(13, 11, 209, 0.25);
    padding: 30px;
    position: relative;
    overflow: hidden;
  }

  .order-success .alert::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--makara-orange) 0%, var(--makara-orange-new) 100%);
  }

  .order-success .alert .close {
    color: white;
    opacity: 0.8;
    text-shadow: none;
    font-size: 28px;
    font-weight: 300;
    transition: opacity 0.3s ease;
  }

  .order-success .alert .close:hover {
    opacity: 1;
  }

  .order-success h3 {
    color: white;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .order-success h3 .fe-check {
    background: var(--makara-orange);
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    animation: checkPulse 2s ease-in-out infinite;
  }

  @keyframes checkPulse {
    0%, 100% {
      transform: scale(1);
      box-shadow: 0 0 0 0 rgba(255, 153, 51, 0.7);
    }
    50% {
      transform: scale(1.05);
      box-shadow: 0 0 0 10px rgba(255, 153, 51, 0);
    }
  }

  .order-success .p-b-20 {
    color: rgba(255, 255, 255, 0.95);
    font-size: 16px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }

  .order-success ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 12px;
  }

  .order-success ul li {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 12px 16px;
    border-radius: 8px;
    color: white;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }

  .order-success ul li:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateX(5px);
    border-color: var(--makara-orange);
  }

  .order-success ul li span {
    color: var(--makara-orange);
    font-weight: 600;
    margin-left: 8px;
  }

  .order-success small {
    font-size: 100%;
  }

  /* Tablet and below */
  @media (max-width: 1024px) {
    .order-success ul {
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
  }

  /* Mobile landscape and portrait tablets */
  @media (max-width: 768px) {
    .order-success {
      margin: 15px 0;
    }

    .order-success ul {
      grid-template-columns: 1fr;
      gap: 10px;
    }
    
    .order-success .alert {
      padding: 20px 16px;
      border-radius: 10px;
    }
    
    .order-success h3 {
      font-size: 20px;
      gap: 10px;
      flex-wrap: wrap;
    }

    .order-success h3 .fe-check {
      width: 32px;
      height: 32px;
      font-size: 18px;
    }

    .order-success .p-b-20 {
      font-size: 15px;
      margin-bottom: 20px;
      padding-bottom: 15px;
    }

    .order-success ul li {
      padding: 10px 14px;
      font-size: 13px;
    }

    /* Remove hover effects on mobile for better touch experience */
    .order-success ul li:hover {
      transform: none;
    }
  }

  /* Small phones */
  @media (max-width: 480px) {
    .order-success {
      margin: 10px 0;
    }

    .order-success .alert {
      padding: 16px 12px;
      border-radius: 8px;
      box-shadow: 0 4px 16px rgba(13, 11, 209, 0.2);
    }

    .order-success .alert::before {
      height: 3px;
    }

    .order-success h3 {
      font-size: 18px;
      gap: 8px;
      margin-bottom: 12px;
    }

    .order-success h3 .fe-check {
      width: 28px;
      height: 28px;
      font-size: 16px;
      flex-shrink: 0;
    }

    .order-success .p-b-20 {
      font-size: 14px;
      margin-bottom: 16px;
      padding-bottom: 12px;
      line-height: 1.5;
    }

    .order-success ul {
      gap: 8px;
    }

    .order-success ul li {
      padding: 10px 12px;
      font-size: 13px;
      border-radius: 6px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      word-break: break-word;
    }

    .order-success ul li span {
      margin-left: 6px;
      display: inline-block;
    }
  }

  /* Extra small phones */
  @media (max-width: 360px) {
    .order-success .alert {
      padding: 14px 10px;
    }

    .order-success h3 {
      font-size: 16px;
      gap: 6px;
    }

    .order-success h3 .fe-check {
      width: 26px;
      height: 26px;
      font-size: 14px;
    }

    .order-success .p-b-20 {
      font-size: 13px;
    }

    .order-success ul li {
      padding: 8px 10px;
      font-size: 12px;
    }
  }
</style>


<div id="order-message-area">
    <div class="order-success d-none">
        <div class="alert alert-dismissible" role="alert">
        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h3><span class="fe fe-check"></span><?php echo lang('order_received'); ?></h3>
        <div class="p-b-20"><?php echo lang('thank_you_your_order_has_been_received'); ?></div>
        <small>
            <ul>
            <li class="id"><?php echo lang('order_id'); ?>: <span>123456</span></li>
            <li class="service_name"><?php echo lang('service_name'); ?>: <span>Test</span></li>
            <li class="link"><?php echo lang('Link'); ?>: <span>link</span></li>
            <li class="quantity"><?php echo lang('Quantity'); ?>: <span>Quantity</span></li>
            <li class="username"><?php echo lang('Username'); ?>: <span>Username</span></li>
            <li class="posts"><?php echo lang('Posts'); ?>: <span>Posts</span></li>
            <li class="charge"><?php echo lang('Charge'); ?>: <span>Charge</span></li>
            <li class="balance"><?php echo lang('Balance'); ?>: <span>Balance</span></li>
            </ul>
        </small>
        </div>
    </div>
</div>