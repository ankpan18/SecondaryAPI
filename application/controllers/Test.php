<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct() {
        parent::__construct();
     //    $this->load->database();
     }

     public function index() {
        // echo " Test Pages";
        $this->db->select('cat_id');
        $res=$this->db->get('Categories')->result();
        var_dump($res->cat_id);
        $this->load->view('demo.html');
     }

    }