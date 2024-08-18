<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['view-report/(:any)'] = 'fixed/view_report/$1';
$route['view-article/(:any)'] = 'fixed/view_article/$1';
$route['contact-us'] = 'contact/index';
