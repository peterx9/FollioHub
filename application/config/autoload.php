<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'email', 'session', 'form_validation', 'pagination', 'rbac', 'recaptcha', 'functions', 'user_agent','mailer');

$autoload['drivers'] = array();


$autoload['helper'] = array('url', 'file', 'security', 'data', 'functions', 'common','email');


$autoload['config'] = array();


$autoload['language'] = array();


$autoload['model'] = array('admin/setting_model' => 'setting_model', 'common_model');
