<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Helper files
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packges
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

$autoload['libraries'] = array('database','form_validation','session','user_agent', 'pagination');


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('form','url','table','text','currency', 'html', 'download', 'base64', 'mailchimp', 'language', 'file', 'assets', 'demo','breadcrumb', 'spreadsheet' , 'grideview','string','directory','nationality', 'students_status','designation','students','admission','major','mou','delivery','score','print_card','schedule','batch','fees','items','report');
/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();
/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array('common', 'config', 'employees', 'error', 'items', 'login', 'module', 'locations', 'students', 'students_status','designation','admission_category','faculty', 'items', 'courses', 'majors', 'degree', 'professors', 'permission', 'room', 'academic_year', 'subjects', 'scholarship','letter_in','letter_out','mou', 'fees', 'delivery', 'iqa', 'score','schedule','school_class','batch','grade','category_products','suppliers','workshop');

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array('Appconfig','Person','Employee','Module', 'Appfile', 'Module_action','Location', 'Register', 'Additional_item_numbers', 'Student', 'students/Student_status', 'designation/Designation_model','Course','Batch','Nationality','Admission_category','Section', 'Address', 'Category', 'employees/Emp_address', 'Item', 'Supplier', 'Levels', 'Universities', 'Professor', 'Permissions', 'Rooms', 'Subject','Major_model', 'Scholarships','Letter','Letter_out_model','Mou_model', 'Fees', 'Delivery', 'Iqa_model', 'Iqa_results' ,'Score_model','Student_card_model','Schedule','School_class_model','Grades','Fees_collections','Category_products_model','Item_products', 'Student_list_views','Workshop','Short_courses','Reports_model');
/* End of file autoload.php */
/* Location: ./application/config/autoload.php */