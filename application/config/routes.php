<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';


// setting route for job page
$route['jobs'] = 'jobs/index';
$route['jobs/(:num)'] = 'jobs/index/$1';

// setting route for job detail page
$route['jobs/(:num)/(:any)'] = 'jobs/job_detail/$1/$2';

// setting route for companies
$route['company/(:any)'] = 'company/detail/$1';

// setting route for jobs by category, industry & location
$route['jobs-by-category'] = 'jobs/jobs_by_category';
$route['jobs-by-industry'] = 'jobs/jobs_by_industry';
$route['jobs-by-location'] = 'jobs/jobs_by_location';


$route['employers/dashboard'] = 'employers/account/dashboard';

// seting for contact us page
$route['contact'] = 'home/contact';

$route['p/(:any)'] = 'home/any/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
