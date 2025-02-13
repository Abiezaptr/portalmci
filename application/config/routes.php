<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
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

// rute global
$route['global-report'] = 'admin/globals/index';
$route['add/global-report'] = 'admin/globals/add';
$route['insert/global-report'] = 'admin/globals/submit';
$route['update/global-report/(:num)'] = 'admin/globals/edit/$1';
$route['edit/global-report/(:num)'] = 'admin/globals/update/$1';
$route['delete/global-report/(:num)'] = 'admin/globals/delete/$1';

$route['global-article'] = 'admin/globals/article';
$route['insert/global-article'] = 'admin/globals/submit_article';
$route['update/global-article/(:num)'] = 'admin/globals/update_articles/$1';
$route['delete/global-article/(:num)'] = 'admin/globals/delete_article/$1';

$route['global-videos'] = 'admin/globals/videos';
$route['insert/global-videos'] = 'admin/globals/insert_videos';
$route['update/global-videos/(:num)'] = 'admin/globals/update_videos/$1';
$route['delete/global-videos/(:num)'] = 'admin/globals/delete_videos/$1';

// rute manage user
$route['manage-user'] = 'admin/user/index';
$route['admin/export-data'] = 'admin/user/export_excel';
$route['add-user'] = 'admin/user/insert';
$route['update-user/(:num)'] = 'admin/user/update/$1';
$route['delete-user/(:num)'] = 'admin/user/delete/$1';


// rute event calendar
$route['event'] = 'admin/event/index';
$route['add-event'] = 'admin/event/insert';
$route['update-event/(:num)'] = 'admin/event/update/$1';
$route['delete-event/(:num)'] = 'admin/event/delete/$1';

// rute forgot password
$route['reset-password'] = 'login/forgot_password';

// rute event user
$route['events-calendar'] = 'events/index';

// Rute untuk log tracking
$route['log-history'] = 'login/login_history';

// Rute untuk ai-assistant
$route['assistant'] = 'chat/index';
$route['chatbot'] = 'chat/chatbot';

// Rute untuk users management
$route['user-management'] = 'users/index';
$route['add-permission'] = 'users/view_add_permission';
$route['process-permission'] = 'users/process_add_permission';
