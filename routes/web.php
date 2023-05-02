<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\StockCategory;

use App\DrugType;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    // $drug = [
    //     [
    //         'name' => 'Analgesics',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Advil',
    //                 'generic_name' => 'Advil',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Protate',
    //                 'generic_name' => 'Protate',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antacids',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Gaviscon',
    //                 'generic_name' => 'Gaviscon',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Milk of Magnesium',
    //                 'generic_name' => 'Milk of Magnesium',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antionxiety Drugs',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Prozac',
    //                 'generic_name' => 'Prozac',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Lexapro',
    //                 'generic_name' => 'Lexapro',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antiarrhythmics',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Rythmol',
    //                 'generic_name' => 'Rythmol',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Temocarid',
    //                 'generic_name' => 'Temocarid',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],

    //     [
    //         'name' => 'Antibacterial',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Flagyl',
    //                 'generic_name' => 'Flagyl',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Cipro',
    //                 'generic_name' => 'Cipro',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antibiotics',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Augmentin',
    //                 'generic_name' => 'Augmentin',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Levaquin',
    //                 'generic_name' => 'Levaquin',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Anticoagulants',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Xarelto',
    //                 'generic_name' => 'Xarelto',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Pradaxa',
    //                 'generic_name' => 'Pradaxa',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antidepressants',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Dusulepin',
    //                 'generic_name' => 'Dusulepin',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Escitalopram',
    //                 'generic_name' => 'Escitalopram',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antidiarrheals',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Loperamide',
    //                 'generic_name' => 'Loperamide',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Kaopectate',
    //                 'generic_name' => 'Kaopectate',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antiemetics',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Dexamethasone',
    //                 'generic_name' => 'Dexamethasone',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Dulasetron',
    //                 'generic_name' => 'Dulasetron',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antifungal',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Nystatin',
    //                 'generic_name' => 'Nystatin',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Amphothericin',
    //                 'generic_name' => 'Amphothericin',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antihistamines',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Astelin',
    //                 'generic_name' => 'Astelin',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Claritin',
    //                 'generic_name' => 'Claritin',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antihypertensive',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Norvase',
    //                 'generic_name' => 'Norvase',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Sular',
    //                 'generic_name' => 'Sular',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Corticosteroid',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Celeston',
    //                 'generic_name' => 'Celeston',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Decadron',
    //                 'generic_name' => 'Decadron',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Antiviral',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Peramivir',
    //                 'generic_name' => 'Peramivir',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Normir',
    //                 'generic_name' => 'Normir',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Lexative',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Sodium picosulphate',
    //                 'generic_name' => 'Sodium picosulphate',
    //                 'price' => 10
    //             ],
    //         ]
    //     ],
    //     [
    //         'name' => 'Sedatives',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Midazolam',
    //                 'generic_name' => 'Midazolam',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Pentobarbital',
    //                 'generic_name' => 'Pentobarbital',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Tranquilizers',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Xanax',
    //                 'generic_name' => 'Xanax',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Valcum',
    //                 'generic_name' => 'Valcum',
    //                 'price' => 10
    //             ]
    //         ]
    //     ],
    //     [
    //         'name' => 'Hypoglycemic',
    //         'drugs' => [
    //             [
    //                 'trade_name' => 'Sulfonylureas',
    //                 'generic_name' => 'Sulfonylureas',
    //                 'price' => 10
    //             ],
    //             [
    //                 'trade_name' => 'Biguanides',
    //                 'generic_name' => 'Biguanides',
    //                 'price' => 10
    //             ]
    //         ]
    //     ]

    // ];
    // foreach($drug as $key => $item){
    //     $drug_type = DrugType::create(['name'=>$item['name']]);
    //     foreach ($item['drugs'] as $key1 => $value) {
    //         $drug_type->drugs()->create($value);
    //     }
    // }

    $user = Role::findByName('Doctor');
    $user->givePermissionTo(['edit prescription','view all prescriptions','delete prescription']);
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'HomeController@lang');

//genarte card
Route::get('generatecard/{id}', 'PatientController@generatecard')->name('generatecard')->middleware(['role:Admin|Patient']);
Route::get('allappointment', 'PatientController@allappointments')->name('allappointments')->middleware(['role:Patient|Doctor|Admin']);


//Patients
Route::get('/patient/create', 'PatientController@create')->name('patient.create')->middleware(['role_or_permission:Admin|add patient']);
Route::post('/patient/create', 'PatientController@store')->name('patient.store');

Route::get('/patient/all', 'PatientController@all')->name('patient.all')->middleware(['role_or_permission:Admin|view all patients']);

Route::get('/patient/view/{id}', 'PatientController@view')->where('id', '[0-9]+')->name('patient.view')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/patient/edit/{id}', 'PatientController@edit')->where('id', '[0-9]+')->name('patient.edit')->middleware(['role_or_permission:Admin|edit patient']);
Route::post('/patient/edit', 'PatientController@store_edit')->name('patient.store_edit');

Route::get('/patient/delete/{id}', 'PatientController@destroy')->where('id', '[0-9]+')->name('patient.destroy')->middleware(['role_or_permission:Admin|delete patient']);

Route::post('/patient/search', 'PatientController@search')->name('patient.search');

//Documents
Route::get('/document/all', 'DocumentController@all')->name('document.all')->middleware(['role_or_permission:Admin|edit patient']);
Route::post('/document/create', 'DocumentController@store')->name('document.store')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/document/delete/{id}', 'DocumentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit patient']);

//Documents
Route::post('/history/create', 'HistoryController@store')->name('history.store')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/history/delete/{id}', 'HistoryController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit patient']);

//Appointments
Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create')->middleware(['role_or_permission:Admin|create appointment']);
Route::post('/appointment/create', 'AppointmentController@store')->name('appointment.store');
Route::get('/appointment/all', 'AppointmentController@all')->name('appointment.all')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/calendar', 'AppointmentController@calendar')->name('appointment.calendar')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/pending', 'AppointmentController@pending')->name('appointment.pending')->middleware(['role_or_permission:Admin|view all appointments']);
Route::post('/appointment/checkslots', 'AppointmentController@checkslots');
Route::get('/appointment/delete/{id}', 'AppointmentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete appointment']);
Route::post('/appointment/edit', 'AppointmentController@store_edit')->name('appointment.store_edit')->middleware(['role_or_permission:Admin|edit appointment']);

//Drugs
Route::get('/drug/create', 'DrugController@create')->name('drug.create')->middleware(['role_or_permission:Admin|create drug']);
Route::post('/drug/getdrug', 'DrugController@getdrug')->name('getdrug');
Route::post('/drug/create', 'DrugController@store')->name('drug.store');
Route::get('/drug/edit/{id}', 'DrugController@edit')->where('id', '[0-9]+')->name('drug.edit')->middleware(['role_or_permission:Admin|edit drug']);
Route::post('/drug/edit', 'DrugController@store_edit')->name('drug.store_edit');
Route::get('/drug/all', 'DrugController@all')->name('drug.all')->middleware(['role_or_permission:Admin|view all drugs']);
Route::get('/drug/delete/{id}', 'DrugController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete drug']);


//Tests
Route::get('/test/create', 'TestController@create')->name('test.create')->middleware(['role_or_permission:Admin|create diagnostic test']);
Route::post('/test/create', 'TestController@store')->name('test.store');
Route::get('/test/edit/{id}', 'TestController@edit')->name('test.edit')->middleware(['role_or_permission:Admin|edit diagnostic test']);
Route::post('/test/edit', 'TestController@store_edit')->name('test.store_edit');
Route::get('/test/all', 'TestController@all')->name('test.all')->middleware(['role_or_permission:Admin|view all diagnostic tests']);
Route::get('/test/delete/{id}', 'TestController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete diagnostic test']);

//Prescriptions
Route::get('/prescription/create', 'PrescriptionController@create')->name('prescription.create')->middleware(['role_or_permission:Admin|create prescription']);
Route::get('/prescription/generatebill/{id}', 'PrescriptionController@pdf')->name('generatebill')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/prescription/create', 'PrescriptionController@store')->name('prescription.store');
Route::get('/prescription/all', 'PrescriptionController@all')->name('prescription.all')->middleware(['role_or_permission:Admin|view all prescriptions']);
Route::get('/prescription/view/{id}', 'PrescriptionController@view')->where('id', '[0-9]+')->name('prescription.view')->middleware(['role_or_permission:Admin|view prescription']);
Route::get('/prescription/pdf/{id}', 'PrescriptionController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print prescription']);
Route::get('/prescription/delete/{id}', 'PrescriptionController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);
Route::get('/prescription/user/{id}', 'PrescriptionController@view_for_user')->where('id', '[0-9]+')->name('prescription.view_for_user')->middleware(['role_or_permission:Admin|view patient']);
Route::post('/deleteprescriptiondrug', 'PrescriptionController@deleteprescriptiondrug')->name('deleteprescriptiondrug')->middleware(['role_or_permission:Admin|Pharmist|edit prescription']);

Route::get('/prescription/edit/{id}', 'PrescriptionController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/prescription/update', 'PrescriptionController@update')->name('prescription.update');

//Doctor
Route::resource('doctor', 'DoctorController');
Route::resource('request-furniture', 'FurnitureRequestController');
Route::post('request-furniture/changestatus', 'FurnitureRequestController@changestautsrequest')->name('changestautsrequest');
Route::post('approved-prescription', 'PrescriptionController@issuepre')->name('issuepre');

Route::resource('stock', 'StockController');
Route::resource('stock-category', 'StockCategoryController');
Route::resource('schedule', 'ScheduleController');

Route::get('/allappoinment', 'DoctorController@appointment_all')->name('doctor.appointment_all');


//Billing
Route::get('/billing/create', 'BillingController@create')->name('billing.create')->middleware(['role_or_permission:Admin|create invoice']);
Route::post('/billing/create', 'BillingController@store')->name('billing.store');
Route::get('/billing/all', 'BillingController@all')->name('billing.all')->middleware(['role_or_permission:Admin|view all invoices']);
Route::get('/billing/view/{id}', 'BillingController@view')->where('id', '[0-9]+')->name('billing.view')->middleware(['role_or_permission:Admin|view invoice']);
Route::get('/billing/pdf/{id}', 'BillingController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print invoice']);
Route::get('/billing/delete/{id}', 'BillingController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete invoice']);
Route::get('/billing/edit/{id}', 'BillingController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit invoice']);
Route::post('/billing/update', 'BillingController@update')->name('billing.update');

//Settings
/* doctor Settings */
Route::get('/settings/doctor_settings', 'SettingController@doctor_settings')->name('doctor_settings.edit');
Route::post('/settings/doctor_settings', 'SettingController@doctor_settings_store')->name('doctor_settings.store');
/* Prescription Settings */
Route::get('/settings/prescription_settings', 'SettingController@prescription_settings')->name('prescription_settings.edit');
Route::post('/settings/prescription_settings', 'SettingController@prescription_settings_store')->name('prescription_settings.store');

/* SMS Settings */
Route::get('/settings/sms_settings', 'SettingController@sms_settings')->name('sms_settings.edit');
Route::post('/settings/sms_settings', 'SettingController@sms_settings_store')->name('sms_settings.store');

/* Users */
Route::get('/users/all', 'UsersController@all')->name('user.all');
Route::get('/users/create', 'UsersController@create')->name('user.create');
Route::post('/users/create', 'UsersController@store')->name('user.store');
Route::get('/users/edit/{id}', 'UsersController@edit')->where('id', '[0-9]+')->name('user.edit');
Route::get('/users/edit', 'UsersController@edit_profile')->name('user.edit_profile');
Route::post('/users/edit', 'UsersController@store_edit')->name('user.store_edit');
/* Roles */
Route::get('/roles/all', 'RolesController@all_roles')->name('roles.all')->middleware(['role_or_permission:Admin']);
Route::get('/role/create', 'RolesController@create')->name('role.create')->middleware(['role_or_permission:Admin']);
Route::post('/role/create', 'RolesController@store')->name('role.store');
Route::get('/role/edit/{id}', 'RolesController@edit_role')->where('id', '[0-9]+')->name('role.edit_role')->middleware(['role_or_permission:Admin']);
Route::post('/role/edit', 'RolesController@store_edit_role')->name('role.store_edit_role');
Route::get('/role/delete/{id}', 'RolesController@destroy')->where('id', '[0-9]+')->name('role.destroy')->middleware(['role_or_permission:Admin']);
