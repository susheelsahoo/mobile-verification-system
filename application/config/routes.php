<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user';
$route['home'] = 'user/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ---------------API Calling-------------------
$route['getMiniCases'] = 'API/Api/getMiniCases';
$route['getUserLogin'] = 'API/Api/getUserLogin';
$route['insertTokenid'] = 'API/Api/insertTokenid';

$route['getMiniCasesType'] = 'API/Api/getMiniCasesType';
$route['insertMiniCases'] = 'API/Api/insertMiniCases';
$route['getMiniCaseLists'] = 'API/Api/getMiniCaseLists';

$route['getCases'] = 'API/Api/getCases';
$route['getCasesLists'] = 'API/Api/getCasesLists';
$route['insertCasesDetails'] = 'API/Api/insertCasesDetails';

$route['insertrvMainCases'] = 'API/Api/insertrvMainCases';
$route['insertBvMainCases'] = 'API/Api/insertBvMainCases';
$route['miniCaseBankType'] = 'API/Api/miniCaseBankType';
$route['mainBankCaseType'] = 'API/Api/mainBankCaseType';
$route['getUploadFileCount'] = 'API/Api/getUploadFileCount';
$route['caseCount'] = 'API/Api/caseCount';

// insert quick case api
$route['insertrvQuickCases'] = 'API/Api/insertrvQuickCases';
$route['insertBvQuickCases'] = 'API/Api/insertBvQuickCases';
// Send Tat notification 30 min before
$route['sendTatNotificationAlert'] = 'API/Api/sendTatNotificationAlert';
$route['sendQuickTatNotificationAlert'] = 'API/Api/sendQuickTatNotificationAlert';

$route['getMainCaseNotification'] = 'API/Api/getMainCaseNotification';
$route['getQuickCaseNotification'] = 'API/Api/getQuickCaseNotification';


$route['insertQuickCaseNotification'] = 'API/Api/insertQuickCaseNotification';
$route['insertMainCaseNotification'] = 'API/Api/insertMainCaseNotification';




$route['getCasesNew'] = 'API/Api/getCasesNew';

