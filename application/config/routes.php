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

// rute mobile
$route['mobile-article'] = 'admin/mobile/article';
$route['insert-article'] = 'admin/mobile/submit_article';
$route['update-articles/(:num)'] = 'admin/mobile/update_articles/$1';
$route['delete-article/(:num)'] = 'admin/mobile/delete_article/$1';
$route['mobile-videos'] = 'admin/mobile/videos';
$route['insert-videos'] = 'admin/mobile/insert_videos';
$route['update-videos/(:num)'] = 'admin/mobile/update_videos/$1';
$route['delete-videos/(:num)'] = 'admin/mobile/delete_videos/$1';

// rute fixed
$route['fixed-report'] = 'admin/fixed/index';
$route['add/fixed-report'] = 'admin/fixed/add';
$route['insert/fixed-report'] = 'admin/fixed/submit';
$route['update/fixed-report/(:num)'] = 'admin/fixed/edit/$1';
$route['edit/fixed-report/(:num)'] = 'admin/fixed/update/$1';
$route['delete/fixed-report/(:num)'] = 'admin/fixed/delete/$1';

$route['fixed-article'] = 'admin/fixed/article';
$route['insert/fixed-article'] = 'admin/fixed/submit_article';
$route['update/fixed-article/(:num)'] = 'admin/fixed/update_articles/$1';
$route['delete/fixed-article/(:num)'] = 'admin/fixed/delete_article/$1';

$route['fixed-videos'] = 'admin/fixed/videos';
$route['insert/fixed-videos'] = 'admin/fixed/insert_videos';
$route['update/fixed-videos/(:num)'] = 'admin/fixed/update_videos/$1';
$route['delete/fixed-videos/(:num)'] = 'admin/fixed/delete_videos/$1';

// rute digital insight
$route['digital-report'] = 'admin/digital/index';
$route['add/digital-report'] = 'admin/digital/add';
$route['insert/digital-report'] = 'admin/digital/submit';
$route['update/digital-report/(:num)'] = 'admin/digital/edit/$1';
$route['edit/digital-report/(:num)'] = 'admin/digital/update/$1';
$route['delete/digital-report/(:num)'] = 'admin/digital/delete/$1';

$route['digital-article'] = 'admin/digital/article';
$route['insert/digital-article'] = 'admin/digital/submit_article';
$route['update/digital-article/(:num)'] = 'admin/digital/update_articles/$1';
$route['delete/digital-article/(:num)'] = 'admin/digital/delete_article/$1';

$route['digital-videos'] = 'admin/digital/videos';
$route['insert/digital-videos'] = 'admin/digital/insert_videos';
$route['update/digital-videos/(:num)'] = 'admin/digital/update_videos/$1';
$route['delete/digital-videos/(:num)'] = 'admin/digital/delete_videos/$1';
