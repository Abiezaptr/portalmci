<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['view-report/(:any)'] = 'fixed/view_report/$1';
$route['view-article/(:any)'] = 'fixed/view_article/$1';
$route['read-article/(:any)'] = 'fixed/view_pdf_article/$1';
$route['comments/(:any)'] = 'fixed/comment/$1';
$route['contact-us'] = 'contact/index';
$route['digital-insight'] = 'digital/index';
$route['global'] = 'globals/index';
$route['form-discussion/(:any)'] = 'forum/detail/$1';

$route['callback'] = 'login/handleCallback';

// rute for admin content
$route['dashboard'] = 'admin/dashboard/index';
$route['role-admin'] = 'admin/role/index';
$route['threads-category'] = 'admin/forum/forum_category';
$route['insert-categories'] = 'admin/forum/insert_category';
$route['update-categories/(:num)'] = 'admin/forum/update_category/$1';
$route['delete-categories/(:num)'] = 'admin/forum/delete_category/$1';
