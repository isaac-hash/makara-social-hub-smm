<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class api_page extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }

/**
 * Index page for API page
 * 
 * This function renders the API page without any data
 * 
 * @return void
 */
    public function index()
    {
        $data = [];
        $this->template->set_layout(false);
        $this->template->build('api_page/index', $data);
    }
}