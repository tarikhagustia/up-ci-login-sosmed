<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $data['domainku'] = $this->config->item("base_url");
        $config['ipku'] = $this->config->item("ipku");
        $config['compku'] = $this->config->item("compku");
        $config['dateku'] = $this->config->item("dateku");
        $this->load->view('auth/login', $data);
    }
}
