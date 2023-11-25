<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->set404Override(function(){
// 	echo view('404');
// });

$routes->get('/', 'Home::index', ['filter'=>'isLogin']);

// $routes->get('/welcome', 'Home::welcome', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/login', 'Home::login');

$routes->get('/logout', 'Home::logout');

$routes->get('day-book','DayBookController::all_day_book', ['filter'=>'isLogin']);
// $routes->get('view-day-book','DayBookController::view_day_book', ['filter'=>'isLogin']);

$routes->get('suppliers','SupplierController::all_supplier', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-supplier','SupplierController::add_supplier', ['filter'=>'isLogin']);

// $routes->match(['post'], 'add-supplier/store','Home::store_supplier', ['filter'=>'isLogin']);

$routes->get('customers','CustomerController::all_customer', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-customer','CustomerController::add_customer', ['filter'=>'isLogin']);

$routes->get('categories','CategoryController::all_categories', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-category','CategoryController::add_category', ['filter'=>'isLogin']);

$routes->get('sub-categories','SubCategoryController::all_sub_categories', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-sub-category','SubCategoryController::add_sub_category', ['filter'=>'isLogin']);

$routes->get('bank-accounts','BankAccountController::all_bank_accounts', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-bank-account','BankAccountController::add_bank_account', ['filter'=>'isLogin']);

$routes->get('entries','EntryController::all_entries', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-entry','EntryController::add_entry', ['filter'=>'isLogin']);

$routes->get('bank-entries','BankEntryController::all_bank_entries', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-bank-entry','BankEntryController::add_bank_entry', ['filter'=>'isLogin']);

$routes->get('customer-entries','CustomerEntryController::all_customer_entries', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-customer-entry','CustomerEntryController::add_customer_entry', ['filter'=>'isLogin']);

$routes->get('sms-charges','SmsChargesController::all_sms_charges', ['filter'=>'isLogin']);
$routes->match(['get', 'post'], 'add-sms-charge','SmsChargesController::add_sms_charge', ['filter'=>'isLogin']);

$routes->post('/store-selected-subcategory', 'EntryController::storeSelectedSubcategory', ['filter'=>'isLogin']);

$routes->get('/get-subcategories/(:num)', 'SubCategoryController::getSubcategories/$1', ['filter'=>'isLogin']);


$routes->match(['get', 'post'],'/suppliers/(:any)/edit', 'SupplierController::edit_supplier/$1', ['filter'=>'isLogin']);
$routes->get('/suppliers/(:any)/delete', 'SupplierController::delete_supplier/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/customers/(:any)/edit', 'CustomerController::edit_customer/$1', ['filter'=>'isLogin']);
$routes->get('/customers/(:any)/delete', 'CustomerController::delete_customer/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/categories/(:any)/edit', 'CategoryController::edit_category/$1', ['filter'=>'isLogin']);
$routes->get('/categories/(:any)/delete', 'CategoryController::delete_category/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/sub-categories/(:any)/edit', 'SubCategoryController::edit_sub_category/$1', ['filter'=>'isLogin']);
$routes->get('/sub-categories/(:any)/delete', 'SubCategoryController::delete_sub_category/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/bank-accounts/(:any)/edit', 'BankAccountController::edit_bank_account/$1', ['filter'=>'isLogin']);
$routes->get('/bank-accounts/(:any)/delete', 'BankAccountController::delete_bank_account/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/entries/(:any)/edit', 'EntryController::edit_entry/$1', ['filter'=>'isLogin']);
$routes->get('/entries/(:any)/delete', 'EntryController::delete_entry/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/bank-entries/(:any)/edit', 'BankEntryController::edit_bank_entry/$1', ['filter'=>'isLogin']);
$routes->get('/bank-entries/(:any)/delete', 'BankEntryController::delete_bank_entry/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/customer-entries/(:any)/edit', 'CustomerEntryController::edit_customer_entry/$1', ['filter'=>'isLogin']);
$routes->get('/customer-entries/(:any)/delete', 'CustomerEntryController::delete_customer_entry/$1', ['filter'=>'isLogin']);

$routes->match(['get', 'post'],'/sms-charges/(:any)/edit', 'SmsChargesController::edit_sms_charge/$1', ['filter'=>'isLogin']);
$routes->get('/sms-charges/(:any)/delete', 'SmsChargesController::delete_sms_charge/$1', ['filter'=>'isLogin']);

$routes->get('day-book/(:any)/view','DayBookController::view_day_book/$1', ['filter'=>'isLogin']);

