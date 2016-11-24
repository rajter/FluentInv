<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Template contoler
*/
class Template extends My_Controller {

    function __construct()
     {
       parent::__construct();
     }

    public function index()
    {
        echo 'Template Controller';
    }
}
