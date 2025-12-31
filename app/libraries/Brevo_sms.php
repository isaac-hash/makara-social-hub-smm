<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Brevo SMS Library
 * Handles Brevo Transactional SMS API calls
 */
class Brevo_sms
{
    private $api_key;
    private $base_url = 'https://api.brevo.com/v3';
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->api_key = get_option('brevo_api_key', '');
    }

    /**
     * Set API key (useful for testing or override)
     */
    public function set_api_key($key)
    {
        $this->api_key = $key;
    }

    /**
     * Send SMS message
     */
    public function send($recipient, $content, $sender = 'MyShop', $webUrl = '', $type = 'transactional')
    {
        if (empty($this->api_key)) {
            return ['status' => 'error', 'message' => 'Brevo API key not configured'];
        }

        $data = [
            'sender' => substr($sender, 0, 11),
            'recipient' => $recipient,
            'content' => $content,
            'type' => $type,
            'unicodeEnabled' => true
        ];

        if (!empty($webUrl)) {
            $data['webUrl'] = $webUrl;
        }

        $response = $this->make_request('POST', '/transactionalSMS/send', $data);
        
        if (isset($response['messageId'])) {
            return [
                'status' => 'success',
                'message' => 'SMS sent successfully',
                'messageId' => $response['messageId']
            ];
        }

        return [
            'status' => 'error',
            'message' => $response['message'] ?? 'Failed to send SMS',
            'data' => $response
        ];
    }

    /**
     * Get aggregated SMS statistics over a period
     */
    public function get_aggregated_report($days = 30, $startDate = '', $endDate = '')
    {
        if (empty($this->api_key)) {
            return ['status' => 'error', 'message' => 'Brevo API key not configured'];
        }

        $params = [];
        if (!empty($days)) {
            $params['days'] = $days;
        } else {
            if (!empty($startDate)) $params['startDate'] = $startDate;
            if (!empty($endDate)) $params['endDate'] = $endDate;
        }

        $response = $this->make_request('GET', '/transactionalSMS/statistics/aggregatedReport', $params);
        
        if (isset($response['requests']) || isset($response['range'])) {
            return ['status' => 'success', 'data' => $response];
        }

        return ['status' => 'error', 'message' => $response['message'] ?? 'Failed to fetch report', 'data' => $response];
    }

    /**
     * Get SMS statistics aggregated per day
     */
    public function get_daily_reports($startDate = '', $endDate = '', $sort = 'desc')
    {
        if (empty($this->api_key)) {
            return ['status' => 'error', 'message' => 'Brevo API key not configured'];
        }

        $params = ['sort' => $sort];
        if (!empty($startDate)) $params['startDate'] = $startDate;
        if (!empty($endDate)) $params['endDate'] = $endDate;

        $response = $this->make_request('GET', '/transactionalSMS/statistics/reports', $params);
        
        if (isset($response['reports'])) {
            return ['status' => 'success', 'data' => $response['reports']];
        }

        return ['status' => 'error', 'message' => $response['message'] ?? 'Failed to fetch reports', 'data' => $response];
    }

    /**
     * Get individual SMS events (unaggregated)
     */
    public function get_events($limit = 50, $offset = 0, $startDate = '', $endDate = '')
    {
        if (empty($this->api_key)) {
            return ['status' => 'error', 'message' => 'Brevo API key not configured'];
        }

        $params = [
            'limit' => min($limit, 100),
            'offset' => $offset,
            'sort' => 'desc'
        ];
        if (!empty($startDate)) $params['startDate'] = $startDate;
        if (!empty($endDate)) $params['endDate'] = $endDate;

        $response = $this->make_request('GET', '/transactionalSMS/statistics/events', $params);
        
        if (isset($response['events'])) {
            return ['status' => 'success', 'data' => $response['events']];
        }

        return ['status' => 'error', 'message' => $response['message'] ?? 'Failed to fetch events', 'data' => $response];
    }

    /**
     * Make HTTP request to Brevo API
     */
    private function make_request($method, $endpoint, $data = [])
    {
        $url = $this->base_url . $endpoint;

        $headers = [
            'accept: application/json',
            'api-key: ' . $this->api_key,
            'content-type: application/json'
        ];

        $ch = curl_init();

        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['status' => 'error', 'message' => 'cURL Error: ' . $error];
        }

        $decoded = json_decode($response, true);
        
        if ($httpCode >= 400) {
            return [
                'status' => 'error',
                'message' => $decoded['message'] ?? 'API request failed',
                'code' => $decoded['code'] ?? $httpCode
            ];
        }

        return $decoded ?? [];
    }
}
