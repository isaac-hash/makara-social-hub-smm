
<?php if (!empty($items)) : $i = $from; ?>
    <div class="orders-grid">
        <?php
            foreach ($items as $key => $item) :
                $i++;
                $item_payment_type  = show_item_transaction_type($item['type']);
                $created            = show_item_datetime($item['created'], 'long');
                $currency_symbol = get_option('currency_symbol', '$');
        ?>
            <div class="order-card order-card_<?php echo esc($item['id']); ?>">
                <!-- Header -->
                <div class="order-card-header">
                    <div class="order-card-header-title">
                        <span class="service-icon">💳</span>
                        <span class="service-name">Transaction ID: <?php echo esc($item['id']); ?></span>
                    </div>
                </div>

                <!-- Content -->
                <div class="order-card-content">
                    <!-- Type -->
                    <div class="order-info-row">
                        <div class="order-icon order-icon-red">📄</div>
                        <div class="order-info-content">
                            <div class="order-info-label">Payment Type</div>
                            <div style="color: var(--text-color);" class="order-info-value"><?php echo $item_payment_type; ?></div>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="order-info-row">
                        <div class="order-icon order-icon-red">📅</div>
                        <div class="order-info-content">
                            <div class="order-info-label">Date</div>
                            <div style="color: var(--text-color);" class="order-info-value"><?php echo $created; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="order-card-footer">
                    <div class="order-footer-item">
                        <span class="order-footer-number"><?php echo $currency_symbol . (double)$item['amount']; ?></span>
                        <span class="order-footer-label">Amount</span>
                    </div>
                    <div class="order-footer-item">
                        <span class="order-footer-number"><?php echo $currency_symbol . (double)$item['txn_fee']; ?></span>
                        <span class="order-footer-label">Fee</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <style>
        :root {
            --makara-blue: #0D0BD1;
            --makara-orange: #FF9933;
            --makara-border: #020c68ff;
            --makara-blue-bg: #020c6867;
        }
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
            padding: 20px;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .order-card-header {
            background: linear-gradient(135deg, #e8eaf6 0%, #c5cae9 100%);
            padding: 20px;
            border: 2px solid #5c6bc0;
            border-bottom: none;
        }

        .order-card-header-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .service-icon {
            font-size: 18px;
        }

        .service-name {
            flex: 1;
            word-break: break-word;
        }

        .order-card-content {
            padding: 24px 20px;
        }

        .order-info-row {
            display: flex;
            gap: 12px;
            margin-bottom: 18px;
            align-items: flex-start;
        }

        .order-info-row:last-child {
            margin-bottom: 0;
        }

        .order-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .order-icon-red {
            background: var(--makara-blue);
            color: #c62828;
        }

        .order-info-content {
            flex: 1;
            min-width: 0;
        }

        .order-info-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .order-info-value {
            font-size: 15px;
            color: #333;
            font-weight: 500;
            word-break: break-word;
        }

        .order-link {
            font-size: 13px;
        }

        .order-status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .order-card-footer {
            background: var(--makara-blue);
            color: white;
            padding: 16px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .order-footer-item {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .order-footer-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 40px;
            width: 1px;
            background: rgba(255, 255, 255, 0.3);
        }

        .order-footer-number {
            font-size: 15px;
            font-weight: 700;
            display: block;
            margin-bottom: 4px;
        }

        .order-footer-label {
            font-size: 11px;
            opacity: 0.9;
            text-transform: capitalize;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .orders-grid {
                grid-template-columns: 1fr;
                padding: 12px;
                gap: 16px;
            }
        }

        /* Empty state */
        .no-orders-message {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 16px;
        }
    </style>
<?php else : ?>
    <div class="no-orders-message">
        <?php echo render_tr_no_item(); ?>
    </div>
<?php endif; ?>
