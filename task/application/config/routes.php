<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['api/post/get/questions'] = 'api/questions';
$route['api/post/get/polls'] = 'api/polls';
$route['api/post/get/forums'] = 'api/forums';
$route['api/post/get/users'] = 'api/users';
$route['api/post/get/comments/(:num)'] = 'api/comments_by_id/$1';
$route['api/post/get/comments'] = 'api/comments';
$route['api/post/get/articles/(:num)'] = 'api/articles_by_id/$1';
$route['api/post/get/articles'] = 'api/articles';
$route['forum'] = 'forums/forum';
$route['ask-a-question/(:num)'] = 'questions/ques/$1';
$route['ask-a-question'] = 'questions/view';
$route['users/question'] = 'questions/answer';
$route['users/poll/create'] = 'polls/create';
$route['users/poll/(:num)'] = 'polls/polling/$1';
$route['users/poll'] = 'polls/poll';
$route['articles/index'] = 'articles/index/1';
$route['articles/create'] = 'articles/create';
$route['articles/update'] = 'articles/update';
$route['articles/search'] = 'articles/search';
$route['articles/(:any)'] = 'articles/view/$1';
$route['articles'] = 'articles/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
