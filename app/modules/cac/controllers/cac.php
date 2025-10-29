<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class cac extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];
        $this->template->set_layout('blank_page');
        $this->template->build('cac/index', $data);
    }
}
