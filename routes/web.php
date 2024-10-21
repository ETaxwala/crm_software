<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerWorkTimeline;
use App\Http\Controllers\FEController;
use App\Http\Controllers\FMController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OEController;
use App\Http\Controllers\OMController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SEController;
use App\Http\Controllers\SMController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\HiringController;
use App\Http\Controllers\OperationAssistant;


use App\Http\Controllers\SuperAdmin;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// basic routes start
Route::get('/', [BasicController::class, 'index'])->name('index');


// registration services
Route::get('/Partnership_Firm_Registration', [BasicController::class, 'partnershipFirm'])->name('Partnership Firm Registration');
Route::get('/One_Person_Company', [BasicController::class, 'onePerson'])->name('One Person Company');
Route::get('/Private_LTD_Company', [BasicController::class, 'privateLimited'])->name('Private LTD Company');
Route::get('/Limited_Liability_Partnership_LLP', [BasicController::class, 'LLP'])->name('Limited Liability Partnership (LLP)');
Route::get('/Section_8_Company_NGO', [BasicController::class, 'section8'])->name('Section 8 Company NGO');
Route::get('/Producer_Company', [BasicController::class, 'producerCompany'])->name('Producer Company');
Route::get('/Nidhi_Company_Registration', [BasicController::class, 'nidhiCompany'])->name('Nidhi Company Registration');
Route::get('/Public_LTD_Company', [BasicController::class, 'publicLimited'])->name('Public LTD Company');
Route::get('/Microfinance_Company_Section_8', [BasicController::class, 'microfinanceSection8'])->name('Microfinance Company (Section 8)');
Route::get('/Indian_Subsidiary_Company', [BasicController::class, 'indianSubidiary'])->name('Indian Subsidiary Company');
Route::get('/Microfinance_Company_NBFC_RBI_Registered', [BasicController::class, 'microfinanceNBFC'])->name('Microfinance Company NBFC (RBI Registered)');

// Business Consultancy
Route::get('/shop_act_registration', [BasicController::class, 'shopAct'])->name('Shop Act Registration');
Route::get('/msme_registration', [BasicController::class, 'MSME'])->name('MSME Registration');
Route::get('/gst_registration', [BasicController::class, 'GST'])->name('GST Registration');
Route::get('/fssai_registration', [BasicController::class, 'FSSAI'])->name('FSSAI Registration');
Route::get('/import_export_code', [BasicController::class, 'importExportCode'])->name('Import Export Code');
Route::get('/epfo_esic_registration', [BasicController::class, 'EPFOESIC'])->name('EPFO ESIC Registration');
Route::get('/80G_12A_registration', [BasicController::class, 'G8012A'])->name('80G 12A Registration');
Route::get('/professional_tax_registration', [BasicController::class, 'professionalTax'])->name('Professional Tax Registration');
Route::get('/tan_registration', [BasicController::class, 'TAN'])->name('TAN Registration');
Route::get('/DSC', [BasicController::class, 'DSC'])->name('Digital Signature');
Route::get('/PASARA_license', [BasicController::class, 'PASARA'])->name('PASARA License');
Route::get('/niti_ayog_darpan', [BasicController::class, 'NitiAyogDarpan'])->name('Niti Ayog Darpan');
Route::get('/trade_license', [BasicController::class, 'TradeLicense'])->name('Trade License');
// basic routes end






Route::get('/hiring', function () {
    return view('hiring');
});
Route::post('/add-hiring', [HiringController::class, 'AddHiring'])->name('add-hiring');


// Route::get('/', function () {
//     return view('under_maintenance');
// });
Route::get('/InquiryForm', function () {
    $services = DB::table('services')->get();
    return view('inquiry_form', compact('services'));
});


Route::get('/JoinLiveWebinar', function () {
    return view('partner_form');
});

Route::post('/add-inquiry', [LeadController::class, 'AddInquiryLead'])->name('add-inquiry');
Route::post('/partner-inquiry', [LeadController::class, 'AddPartnerWebinarLead'])->name('partner-inquiry');



Route::get('/appointment', function () {
    return view('appointment');
});
Route::post('appointment/booking', [OrderController::class, 'bookAppointment'])->name('book.appointment');
Route::post('appointment/payment/page', [OrderController::class, 'AppointmentPaymentPage'])->name('pay.appointment');
Route::post('appointment/payment/Now', [OrderController::class, 'AppointmentPaymentNow'])->name('appointment.pay.now');


Route::get('/user_login', function () {
    return view('Admin.login');
})->name('user-login');

Route::post('/admin-login', [AdminController::class, 'AdminLogin'])->name('admin-login');


// Delta@007
Route::get('/create-payment-link', [OrderController::class, 'createPaymentLink']);
Route::post('/razorpay/webhook', [WebhookController::class, 'handleWebhook']);


// partners inquire forms
Route::get('/InquiryForm', function () {
    $services = DB::table('services')->get();
    return view('inquiry_form', compact('services'));
});










Route::group(['middleware' => ['AdminLogin', 'log.user.activity']], function () {


    Route::get('/admin-logout', [AdminController::class, 'AdminLogout'])->name('admin-logout');

    // super admin routes
    Route::get('/super-admin-dashboard', [SuperAdmin::class, 'Dashboard'])->name('super-admin-dashboard');
    Route::get('/super-admin-manage-admin', [SuperAdmin::class, 'ManageAdmin'])->name('super-admin-manage-admin');
    Route::get('/super-admin-manage-manager', [SuperAdmin::class, 'ManageManager'])->name('super-admin-manage-manager');
    Route::get('/super-admin-manage-employee', [SuperAdmin::class, 'ManageEmployee'])->name('super-admin-manage-employee');
    Route::post('/add-admin', [SuperAdmin::class, 'AddNewAdmin'])->name('add-admin');
    Route::post('/update-admin', [SuperAdmin::class, 'UpdateAdmin'])->name('update-admin');
    Route::get('/Get-SA-Admin-Details', [SuperAdmin::class, 'AdminDetail'])->name('Get-SA-Admin-Details');
    Route::get('/Delete-SA-Admin', [SuperAdmin::class, 'DeleteAdmin'])->name('Delete-SA-Admin');

    // admin/company routes
    Route::get('/admin-dashboard', [Admin::class, 'Dashboard'])->name('admin-dashboard');
    Route::get('/admin-manage-manager', [Admin::class, 'ManageManager'])->name('admin-manage-manager');
    Route::get('/admin-manage-employee', [Admin::class, 'ManageEmployee'])->name('admin-manage-employee');
    Route::post('/add-admin-manager', [Admin::class, 'AddAdminManager'])->name('add-admin-manager');
    Route::post('/update-admin-manager', [Admin::class, 'UpdateManager'])->name('update-admin-manager');
    Route::get('/Get-A-Manager-Details', [Admin::class, 'ManagerDetail'])->name('Get-A-Manager-Details');
    Route::get('/Delete-A-Manager', [Admin::class, 'DeleteManager'])->name('Delete-A-Manager');
    Route::get('/admin-manage-service', [Admin::class, 'ManageService'])->name('admin-manage-service');
    Route::post('/add-company-service', [Admin::class, 'AddService'])->name('add-company-service');
    Route::get('/Get-Service-Details', [Admin::class, 'ServiceDetail'])->name('Get-Service-Details');
    Route::post('/update-company-service', [Admin::class, 'UpdateService'])->name('update-company-service');
    Route::get('/Delete-Company-Service', [Admin::class, 'DeleteService'])->name('Delete-Company-Service');

    Route::get('/admin-manage-category', [Admin::class, 'ManageCategory'])->name('admin-manage-category');
    Route::post('/add-company-category', [Admin::class, 'AddCategory'])->name('add-company-category');
    Route::get('/Get-Category-Details', [Admin::class, 'CategoryDetail'])->name('Get-Category-Details');
    Route::post('/update-company-category', [Admin::class, 'UpdateCategory'])->name('update-company-category');
    Route::get('/Delete-Company-Category', [Admin::class, 'DeleteCategory'])->name('Delete-Company-Category');

    Route::get('/Get-Service-Documents', [Admin::class, 'ServiceDocsDetails'])->name('Get-Service-Documents');
    Route::post('/add-service-docs', [Admin::class, 'AddServiceDocs'])->name('add-service-docs');

    Route::get('/admin-manage-packages', [Admin::class, 'ManagePackages'])->name('admin-manage-packages');
    Route::post('/add-combo-package', [Admin::class, 'AddPackage'])->name('add-combo-package');
    Route::get('/get-package-details', [Admin::class, 'PackageDetail'])->name('get-package-details');
    Route::post('/update-combo-package', [Admin::class, 'UpdatePackage'])->name('update-combo-package');
    Route::get('/delete-combo-package', [Admin::class, 'DeletePackage'])->name('delete-combo-package');

    Route::get('/admin-manage-partners', [Admin::class, 'ManagePartners'])->name('admin-manage-partners');
    Route::post('/create-partner-form-link', [Admin::class, 'CreateFormLink'])->name('create-partner-form-link');
    Route::get('/manage-resumes', [HiringController::class, 'ManageResume'])->name('manage-resumes');
    Route::get('/user-activity', [Admin::class, 'UserActivity'])->name('user-activity');
    Route::get('/user-activity-overall', [Admin::class, 'UserActivityOverall'])->name('user-activity-overall');
    Route::get('/sales-manager-followup-lead-filter', [LeadController::class, 'TodaysFollowupLeadFilter'])->name('sales-manager-followup-lead-filter');
    Route::get('/get-overall-user-activity', [Admin::class, 'GetOverallActivity'])->name('get-overall-user-activity');

    Route::post('/add-manual-appointment', [Admin::class, 'AddAppointment'])->name('add-manual-appointment');
    Route::post('/update-manual-appointment', [Admin::class, 'UpdateAppointment'])->name('update-manual-appointment');
    Route::get('/delete-manual-appointment', [Admin::class, 'DeleteAppointment'])->name('delete-manual-appointment');

    Route::get('/get-all-appointment', [Admin::class, 'GetAllAppointment'])->name('get-all-appointment');
    Route::get('/Get-Appointment-Details', [Admin::class, 'GetAppointmentDetails'])->name('Get-Appointment-Details');

    // managers routes

    // sales manager routes
    Route::get('/sales-manager-dashboard', [SMController::class, 'Dashboard'])->name('sales-manager-dashboard');
    Route::get('/sales-manage-employee', [SMController::class, 'ManageEmployee'])->name('sales-manage-employee');
    Route::post('/add-sales-employee', [SMController::class, 'AddSalesEmployee'])->name('add-sales-employee');
    Route::post('/update-sales-employee', [SMController::class, 'UpdateSalesEmployee'])->name('update-sales-employee');
    Route::get('/Get-Sales-Employee-Details', [SMController::class, 'SalesEmployeeDetail'])->name('Get-Sales-Employee-Details');
    Route::get('/Delete-Sales-Employee', [SMController::class, 'DeleteSalesEmployee'])->name('Delete-Sales-Employee');
    Route::get('/sales-manage-customers', [SMController::class, 'ManageCustomers'])->name('sales-manage-customers');
    Route::get('/Get-Customer-Payment-Details', [SMController::class, 'PaymentDetails'])->name('Get-Customer-Payment-Details');
    Route::post('/approve-customer', [SMController::class, 'ApproveCustomer'])->name('approve-customer');
    Route::get('/sm-single-customer/{service_id}', [SMController::class, 'SingleCustomer'])->name('sm-single-customer');

    Route::get('/Get-SM-Emp-Chat-Details', [SMController::class, 'GetClientChatting'])->name('Get-SM-Emp-Chat-Details');
    Route::get('/Get-SM-Customer-Work-Timeline', [SMController::class, 'CustWorkTimeline'])->name('Get-SM-Customer-Work-Timeline');
    Route::post('/sm-customer-chatting', [SMController::class, 'CustomerChat'])->name('sm-customer-chatting');
    Route::get('/Get-SM-Customer-Documents', [SMController::class, 'GetDocuments'])->name('Get-SM-Customer-Documents');
    Route::post('/upload-sm-customer-documents', [SMController::class, 'UploadDocs'])->name('upload-sm-customer-documents');
    Route::post('/sm-customer-support-ticket', [SMController::class, 'CustomerSupportTicket'])->name('sm-customer-support-ticket');
    Route::get('/sales-manage-partners', [SMController::class, 'ManagePartners'])->name('sales-manage-partners');


    // sales leads routes
    Route::get('/sales-manage-leads', [LeadController::class, 'ManageLeads'])->name('sales-manage-leads');
    Route::post('/add-sales-lead', [LeadController::class, 'AddSalesLead'])->name('add-sales-lead');
    Route::get('/Get-Sales-Lead-Details', [LeadController::class, 'SalesLeadDetail'])->name('Get-Sales-Lead-Details');

        Route::get('/Get-Sales-Others-Lead', [LeadController::class, 'SalesOthersLead'])->name('Get-Sales-Others-Lead');
         Route::post('/add-lead-other-services', [LeadController::class, 'AddOtherLeads'])->name('add-lead-other-services');

    Route::get('/Delete-Sales-Lead', [LeadController::class, 'DeleteSalesLead'])->name('Delete-Sales-Lead');
    Route::post('/Update-Sales-Lead', [LeadController::class, 'UpdateSalesLead'])->name('Update-Sales-Lead');
    Route::get('/assign-sales-lead-to', [LeadController::class, 'AssignSalesLeadTo'])->name('assign-sales-lead-to');
    Route::get('/sales-manage-leads-filter', [LeadController::class, 'SalesLeadFilter'])->name('sales-manage-leads-filter');
    Route::get('/sales-manage-leads-details', [LeadController::class, 'SalesLeadWithDetails'])->name('sales-manage-leads-details');

    Route::post('/update-sales-emp-lead-details', [LeadController::class, 'UpdateSalesEmpLead'])->name('update-sales-emp-lead-details');
    Route::get('/get-emp-lead-count-details', [LeadController::class, 'GetEmpLeadCount'])->name('get-emp-lead-count-details');
    Route::post('/update-lead-status-details', [LeadController::class, 'UpdateLeadStatus'])->name('update-lead-status-details');
    Route::post('/add-lead-followup-details', [LeadController::class, 'AddLeadFollowup'])->name('add-lead-followup-details');
    Route::get('/Get-Lead-Remarks-details', [LeadController::class, 'GetLeadRemarks'])->name('Get-Lead-Remarks-details');
    Route::get('/get-emp-followup-calls-details', [LeadController::class, 'GetFollowupCalls'])->name('get-emp-followup-calls-details');
    Route::get('/sales-emp-lead-filter-details', [LeadController::class, 'EmpLeadFilter'])->name('sales-emp-lead-filter-details');
    Route::get('/sales-manage-customer-inqury', [LeadController::class, 'CustomerInquiry'])->name('sales-manage-customer-inqury');
    Route::post('/sm-add-bulk-leads', [LeadController::class, 'addBulkLeads'])->name('sm-add-bulk-leads');
    Route::get('/sales-manager-followup-lead-filter', [LeadController::class, 'TodaysFollowupLeadFilter'])->name('sales-manager-followup-lead-filter');






    // operation manager routes
    Route::get('/operation-manager-dashboard', [OMController::class, 'Dashboard'])->name('operation-manager-dashboard');
    Route::get('/operation-manage-employee', [OMController::class, 'ManageEmployee'])->name('operation-manage-employee');
    Route::post('/add-operation-employee', [OMController::class, 'AddOperationEmployee'])->name('add-operation-employee');
    Route::post('/update-operation-employee', [OMController::class, 'UpdateOperationEmployee'])->name('update-operation-employee');
    Route::get('/Get-Operation-Employee-Details', [OMController::class, 'OperationEmployeeDetail'])->name('Get-Operation-Employee-Details');
    Route::get('/Delete-Operation-Employee', [OMController::class, 'DeleteOperationEmployee'])->name('Delete-Operation-Employee');
    Route::get('/operation-manage-customer', [OMController::class, 'ManageCustomer'])->name('operation-manage-customer');
    Route::post('/add-cust-work-effort', [OMController::class, 'AddWorkEffort'])->name('add-cust-work-effort');
    Route::get('/Get-Customer-Work-Details', [OMController::class, 'CustWorkTimeline'])->name('Get-Customer-Work-Details');
    Route::post('/add-customer-tasks', [OMController::class, 'AddCustTask'])->name('add-customer-tasks');
    Route::get('/Get-Customer-Tasks', [OMController::class, 'GetCustTasks'])->name('Get-Customer-Tasks');
    Route::get('/Delete-Customer-Task', [OMController::class, 'DeleteCustomerTask'])->name('Delete-Customer-Task');
    Route::post('/assign-cust-task-to', [OMController::class, 'AssignTaskTo'])->name('assign-cust-task-to');
    Route::get('/get-customer-tasks-list', [OMController::class, 'GetCustomerTaskList'])->name('get-customer-tasks-list');
    Route::get('/Get-Customer-Service-Price', [OMController::class, 'GetCustomerServicePrice'])->name('Get-Customer-Service-Price');
    Route::get('/Get-Customer-Chat-Details-Manager', [OMController::class, 'GetClientChatting'])->name('Get-Customer-Chat-Details-Manager');
    Route::post('/customer-chatting-from-manager', [OMController::class, 'ChatToClient'])->name('customer-chatting-from-manager');
    Route::get('/Get-Service-Price', [OMController::class, 'GetServicePrice'])->name('Get-Service-Price');
    Route::post('/om-add-offline-customer', [OMController::class, 'AddOfflineCustomer'])->name('om-add-offline-customer');
    Route::post('/add-bulk-offline-customer', [OMController::class, 'AddBulkOfflineCustomer'])->name('add-bulk-offline-customer');
    Route::get('/api/fetch-services', [OMController::class, 'FetchServices']);
    Route::get('/get-customer-support-tickets', [OMController::class, 'GetCustomerSupportTickets'])->name('get-customer-support-tickets');
    Route::post('/change-ticket-status', [OMController::class, 'changeTicketStatus'])->name('change-ticket-status');
    Route::get('/Get-Cust-Total-Status-Count-OM', [OMController::class, 'GetCustomerStatusCount'])->name('Get-Cust-Total-Status-Count-OM');
    Route::get('/om-customer-filter', [OMController::class, 'GetCustomerFilter'])->name('om-customer-filter');
    Route::get('/operation-manage-tasks', [OMController::class, 'showtasks'])->name('operation-manage-tasks');
    Route::get('/operation-manager-manage-all-tasks', [OMController::class, 'GetAllTasks'])->name('operation-manager-manage-all-tasks');
    Route::get('/OM-Get-Customer-Tasks-Details', [OMController::class, 'GetCustomerTaskDetails'])->name('OM-Get-Customer-Tasks-Details');
    Route::get('/operation-manager-manage-filter-tasks', [OMController::class, 'GetTasksFilter'])->name('operation-manager-manage-filter-tasks');
    Route::post('/generate-new-coupon', [OMController::class, 'GenerateCoupon'])->name('generate-new-coupon');
    Route::get('/get-all-coupons', [OMController::class, 'GetAllCoupons'])->name('get-all-coupons');
    Route::get('/apply-coupon-code', [OMController::class, 'ApplyCouponCode'])->name('apply-coupon-code');
    Route::get('/check-coupon-code', [OMController::class, 'checkCoupon'])->name('check-coupon-code');
    Route::post('/om-update-emi', [OMController::class, 'OMUpdateEMI'])->name('om-update-emi');
    Route::get('/customer-details-list', [Admin::class, 'CustomerList'])->name('customer-details-list');
    Route::get('/om-delete-task', [OMController::class, 'deleteTask'])->name('om-delete-task');
    Route::get('/om-delete-customer', [OMController::class, 'deleteCustomer'])->name('om-delete-customer');


Route::group(['prefix' => 'operation/assistant'], function () {
        Route::get('/dashboard', [OperationAssistant::class, 'index'])->name('assistant_manager');
        Route::get('/manage-employee', [OperationAssistant::class, 'ManageEmployee'])->name('manage-employee');
        Route::post('/add-operation-employee', [OperationAssistant::class, 'AddOperationEmployee'])->name('add-operation-employee');
        Route::post('/update-operation-employee', [OperationAssistant::class, 'UpdateOperationEmployee'])->name('update-operation-employee');
        Route::get('/Get-Operation-Employee-Details', [OperationAssistant::class, 'OperationEmployeeDetail'])->name('Get-Operation-Employee-Details');
        Route::get('/Delete-Operation-Employee', [OperationAssistant::class, 'DeleteOperationEmployee'])->name('Delete-Operation-Employee');
        Route::get('/operation-manage-customer', [OperationAssistant::class, 'ManageCustomer'])->name('manage-customer');
        Route::post('/add-cust-work-effort', [OperationAssistant::class, 'AddWorkEffort'])->name('add-cust-work-effort');
        Route::get('/Get-Customer-Work-Details', [OperationAssistant::class, 'CustWorkTimeline'])->name('Get-Customer-Work-Details');
        Route::post('/add-customer-tasks', [OperationAssistant::class, 'AddCustTask'])->name('add-customer-tasks');
        Route::get('/Get-Customer-Tasks', [OperationAssistant::class, 'GetCustTasks'])->name('Get-Customer-Tasks');
        Route::get('/Delete-Customer-Task', [OperationAssistant::class, 'DeleteCustomerTask'])->name('Delete-Customer-Task');
        Route::post('/assign-cust-task-to', [OperationAssistant::class, 'AssignTaskTo'])->name('assign-cust-task-to');
        Route::get('/get-customer-tasks-list', [OperationAssistant::class, 'GetCustomerTaskList'])->name('get-customer-tasks-list');
        Route::get('/Get-Customer-Service-Price', [OperationAssistant::class, 'GetCustomerServicePrice'])->name('Get-Customer-Service-Price');
        Route::get('/Get-Customer-Chat-Details-Manager', [OperationAssistant::class, 'GetClientChatting'])->name('Get-Customer-Chat-Details-Manager');
        Route::post('/customer-chatting-from-manager', [OperationAssistant::class, 'ChatToClient'])->name('customer-chatting-from-manager');
        Route::get('/Get-Service-Price', [OperationAssistant::class, 'GetServicePrice'])->name('Get-Service-Price');
        Route::post('/add-offline-customer', [OperationAssistant::class, 'AddOfflineCustomer'])->name('add-offline-customer');
        Route::post('/add-bulk-offline-customer', [OperationAssistant::class, 'AddBulkOfflineCustomer'])->name('add-bulk-offline-customer');
        Route::get('/api/fetch-services', [OperationAssistant::class, 'FetchServices']);
        Route::get('/get-customer-support-tickets', [OperationAssistant::class, 'GetCustomerSupportTickets'])->name('get-customer-support-tickets');
        Route::post('/change-ticket-status', [OperationAssistant::class, 'changeTicketStatus'])->name('change-ticket-status');
        Route::get('/Get-Cust-Total-Status-Count-OM', [OperationAssistant::class, 'GetCustomerStatusCount'])->name('Get-Cust-Total-Status-Count-OM');
        Route::get('/om-customer-filter', [OperationAssistant::class, 'GetCustomerFilter'])->name('om-customer-filter');
        Route::get('/manage-tasks', [OperationAssistant::class, 'showtasks'])->name('manage-tasks');
        Route::get('/operation-manage-all-tasks', [OperationAssistant::class, 'GetAllTasks'])->name('operation-manage-all-tasks');
        Route::get('/Get-Customer-Tasks-Details', [OperationAssistant::class, 'GetCustomerTaskDetails'])->name('Get-Customer-Tasks-Details');
        Route::get('/operation-manage-filter-tasks', [OperationAssistant::class, 'GetTasksFilter'])->name('operation-manage-filter-tasks');
        Route::post('/generate-new-coupon', [OperationAssistant::class, 'GenerateCoupon'])->name('generate-new-coupon');
        Route::get('/get-all-coupons2', [OperationAssistant::class, 'GetAllCoupons'])->name('get-all-coupons2');
        Route::get('/apply-coupon-code', [OperationAssistant::class, 'ApplyCouponCode'])->name('apply-coupon-code');
        Route::get('/check-coupon-code', [OperationAssistant::class, 'checkCoupon'])->name('check-coupon-code');
        Route::post('/om-update-emi', [OperationAssistant::class, 'OMUpdateEMI'])->name('om-update-emi');
        Route::get('/oa-customer-details-list', [Admin::class, 'OACustomerList'])->name('oa-customer-details-list');
    });


    // franchise manager routes
    Route::get('/franchise-manager-dashboard', [FMController::class, 'Dashboard'])->name('franchise-manager-dashboard');
    Route::get('/franchise-manage-employee', [FMController::class, 'ManageEmployee'])->name('franchise-manage-employee');
    Route::post('/add-franchise-employee', [FMController::class, 'AddFranchiseEmployee'])->name('add-franchise-employee');
    Route::post('/update-franchise-employee', [FMController::class, 'UpdateFranchiseEmployee'])->name('update-franchise-employee');
    Route::get('/Get-Franchise-Employee-Details', [FMController::class, 'FranchiseEmployeeDetail'])->name('Get-Franchise-Employee-Details');
    Route::get('/Delete-Franchise-Employee', [FMController::class, 'DeleteFranchiseEmployee'])->name('Delete-Franchise-Employee');
    Route::get('/franchise-client-list', [FMController::class, 'FranchiseClientList'])->name('franchise-client-list');
    Route::get('/franchise-manage-traning-videos', [FMController::class, 'TraningVideos'])->name('franchise-manage-traning-videos');
    Route::get('/get-today-followup-calls', [FMController::class, 'GetFollowupCallsCount'])->name('get-today-followup-calls');
    Route::get('/get-client-followup-calls', [FMController::class, 'GetFollowupCallsDetails'])->name('get-client-followup-calls');
    Route::get('/get-client-lead-count', [FMController::class, 'GetEmpLeadCount'])->name('get-client-lead-count');
    Route::get('/franchise-client-lead-filter', [FMController::class, 'EmpLeadFilter'])->name('franchise-client-lead-filter');
    Route::get('/partner-wise-lead-filter', [FMController::class, 'PartnerWiseFilter'])->name('partner-wise-lead-filter');





    // sales employee routes
    Route::get('/sales-employee-dashboard', [SEController::class, 'Dashboard'])->name('sales-employee-dashboard');
    Route::get('/sales-employee-manage-leads', [SEController::class, 'ManageLead'])->name('sales-employee-manage-leads');
    Route::post('/add-sales-emp-lead', [SEController::class, 'AddSalesEmpLead'])->name('add-sales-emp-lead');
    Route::post('/update-sales-emp-lead', [SEController::class, 'UpdateSalesEmpLead'])->name('update-sales-emp-lead');
    Route::get('/get-emp-lead-count', [SEController::class, 'GetEmpLeadCount'])->name('get-emp-lead-count');
    Route::post('/update-lead-status', [SEController::class, 'UpdateLeadStatus'])->name('update-lead-status');
    Route::post('/add-lead-followup', [SEController::class, 'AddLeadFollowup'])->name('add-lead-followup');
    Route::get('/Get-Lead-Remarks', [SEController::class, 'GetLeadRemarks'])->name('Get-Lead-Remarks');
    Route::get('/get-emp-followup-calls', [SEController::class, 'GetFollowupCalls'])->name('get-emp-followup-calls');
    Route::get('/sales-emp-lead-filter', [SEController::class, 'EmpLeadFilter'])->name('sales-emp-lead-filter');
    Route::get('/sales-emp-followup-lead-filter', [SEController::class, 'EmpFollowupLeadFilter'])->name('sales-emp-followup-lead-filter');
    Route::post('/se-add-offline-customer', [SEController::class, 'AddOfflineCustomer'])->name('se-add-offline-customer');




    // operation employee routes
    Route::get('/operation-emp-dashboard', [OEController::class, 'Dashboard'])->name('operation-emp-dashboard');
    Route::get('/operation-emp-manage-task', [OEController::class, 'ManageTask'])->name('operation-emp-manage-task');
    Route::get('/operation-emp-manage-docs', [OEController::class, 'ManageDocs'])->name('operation-emp-manage-docs');
    Route::get('/message-to-client', [OEController::class, 'MessageToClient'])->name('message-to-client');
    Route::get('/Get-Customer-Chat-Details', [OEController::class, 'GetClientChatting'])->name('Get-Customer-Chat-Details');
    Route::post('/customer-chatting-from-operation', [OEController::class, 'CCFTOP'])->name('customer-chatting-from-operation');
    Route::post('/customer-chatting-from-operation2', [OEController::class, 'CCFTOP2'])->name('customer-chatting-from-operation2');
    Route::get('/file-download/{chat_id}', [OEController::class, 'fileDownload'])->name('file-download');

    Route::get('/send-whatsapp-message', [OEController::class, 'sendWhatsAppMessage'])->name('send-whp');
    Route::get('/Get-Client-Info', [OEController::class, 'GetClientInfo'])->name('Get-Client-Info');
    Route::post('/Update-Client-Info', [OEController::class, 'UpdateClientInfo'])->name('Update-Client-Info');
    Route::get('/Get-Client-Documents', [OEController::class, 'GetDocuments'])->name('Get-Client-Documents');
    Route::post('/upload-employee-document', [OEController::class, 'UploadEmployeeDocs'])->name('upload-employee-document');
    Route::get('/Get-TotalTask-Count', [OEController::class, 'GetTotalTaskCount'])->name('Get-TotalTask-Count');

    Route::post('/add-cust-work-effort-emp', [OEController::class, 'AddWorkEffort'])->name('add-cust-work-effort-emp');
    Route::get('/Get-Emp-Total-Status-Count', [OEController::class, 'GetTaskCounts'])->name('Get-Emp-Total-Status-Count');
    Route::get('/operation-employee-task-filter', [OEController::class, 'TaskFilter'])->name('operation-employee-task-filter');


    // franchise employee/partners routes

    Route::get('/franchise-employee-dashboard', [FEController::class, 'Dashboard'])->name('franchise-employee-dashboard');
    Route::get('/franchise-employee-manage-clients', [FEController::class, 'ManageClient'])->name('franchise-employee-manage-clients');
    Route::get('/partner-traning-section', [FEController::class, 'PartnerTraningSection'])->name('partner-traning-section');
    Route::get('/franchise-emp-lead-filter', [FEController::class, 'EmpLeadFilter'])->name('franchise-emp-lead-filter');

    Route::post('/add-f-emp-lead', [FEController::class, 'AddFClient'])->name('add-f-emp-lead');
    Route::post('/update-f-emp-lead', [FEController::class, 'UpdateFClient'])->name('update-f-emp-lead');
    Route::get('/get-f-lead-count', [FEController::class, 'GetEmpLeadCount'])->name('get-f-lead-count');
    Route::post('/update-f-lead-status', [FEController::class, 'UpdateLeadStatus'])->name('update-f-lead-status');
    Route::post('/add-f-lead-followup', [FEController::class, 'AddLeadFollowup'])->name('add-f-lead-followup');
    Route::get('/Get-F-Lead-Remarks', [FEController::class, 'GetLeadRemarks'])->name('Get-F-Lead-Remarks');
    Route::get('/get-f-emp-followup-calls', [FEController::class, 'GetFollowupCalls'])->name('get-f-emp-followup-calls');

    Route::get('/franchise-partner-all-services', [FEController::class, 'FAllServices'])->name('franchise-partner-all-services');
    Route::get('/franchise-partner-customer-orders', [FEController::class, 'FCustomerOrders'])->name('franchise-partner-customer-orders');
    Route::get('/franchise-partner-customer-inquries', [FEController::class, 'FCustomersInquries'])->name('franchise-partner-customer-inquries');
    Route::get('/Get-Lead-Information', [FEController::class, 'getLeadInfo'])->name('Get-Lead-Information');
    Route::post('/franchise-add-offline-customer', [FEController::class, 'AddOfflineCustomer'])->name('franchise-add-offline-customer');
    Route::post('/franchise-add-offline-customerCO', [FEController::class, 'AddOfflineCustomerCO'])->name('franchise-add-offline-customerCO');
    Route::get('/Get-Franchise-Service-Price', [FEController::class, 'GetPriceTotal'])->name('Get-Franchise-Service-Price');
    Route::get('/franchise-customer-filter', [FEController::class, 'CustomerFilter'])->name('franchise-customer-filter');
    Route::get('/franchise-single-service/{service_id}', [FEController::class, 'SingleService'])->name('franchise-single-service');

    Route::get('/Get-Franchise-Emp-Chat-Details', [FEController::class, 'GetClientChatting'])->name('Get-Franchise-Emp-Chat-Details');
    Route::get('/Get-Franchise-Customer-Work-Timeline', [FEController::class, 'CustWorkTimeline'])->name('Get-Franchise-Customer-Work-Timeline');
    Route::post('/franchise-customer-chatting', [FEController::class, 'CustomerChat'])->name('franchise-customer-chatting');
    Route::get('/Get-Franchise-Customer-Documents', [FEController::class, 'GetDocuments'])->name('Get-Franchise-Customer-Documents');
    Route::post('/upload-franchise-customer-documents', [FEController::class, 'UploadDocs'])->name('upload-franchise-customer-documents');
    Route::post('/franchise-customer-support-ticket', [FEController::class, 'CustomerSupportTicket'])->name('franchise-customer-support-ticket');


    Route::get('/get-franchise-partner-data', [FEController::class, 'getData'])->name('get-franchise-partner-data');
    Route::get('/Get-Cust-Total-Status-Count-Partner', [FEController::class, 'GetCustomerStatusCount'])->name('Get-Cust-Total-Status-Count-Partner');
    Route::get('/get-customer-support-tickets-partner', [FEController::class, 'GetCustomerSupportTickets'])->name('get-customer-support-tickets-partner');
    Route::post('/fe-update-emi', [FEController::class, 'FEUpdateEMI'])->name('fe-update-emi');
    Route::post('/fe-add-bulk-leads', [FEController::class, 'addBulkLeads'])->name('fe-add-bulk-leads');



    Route::get('partner-payment', [OrderController::class, 'partnerindex'])->name('partner-payment');

    //SUBMIT PAYMENT FORM ROUTE
    Route::post('partner-pay-now', [OrderController::class, 'partnersubmitPaymentForm'])->name('partner-pay-now');


    //CALLBACK ROUTE
    Route::post('partner-sub-payment-page', [OrderController::class, 'partnersubPayment'])->name('partner-Payment.Sub');
    Route::any('partner-confirm-payment', [OrderController::class, 'partnerconfirmPayment'])->name('partner-confirm');
    Route::post('partner-initiatePayment', [OrderController::class, 'partnerinitiatePayment'])->name('partner-initiatePayment');
    Route::post('partner-rx-pay', [OrderController::class, 'partnerRXPay'])->name('partner-rx-pay');

    // quotations
    Route::resource('quotation', QuotationController::class);
    Route::get('/findPrice', [QuotationController::class, 'findPrice'])->name('findPrice');
    Route::get('/create-quotation/{id}', [QuotationController::class, 'CreateQuotation'])->name('create-quotation');
    Route::get('/view-quotation/{id}', [QuotationController::class, 'ViewQuotation'])->name('view-quotation');
});

// customer routes
Route::get('test-payment-form', function () {
    return view('customer.payment-copy');
});

Route::get('customer-login-form', function () {
    $services = DB::table('services')->get();
    return view('customer.signup_form', compact('services'));
})->name('customer.login');
Route::post('/customer-login', [CustomerLoginController::class, 'CustomerLogin'])->name('customer-login');
Route::post('/customer-signup', [CustomerLoginController::class, 'CustomerSignup'])->name('customer-signup');
Route::get('/check-customer-email', [CustomerLoginController::class, 'checkCustomerEmail'])->name('check-customer-email');


Route::get('/cust-apply-coupon-code', [CustomerLoginController::class, 'ApplyCouponCode'])->name('cust-apply-coupon-code');


Route::group(['middleware' => 'CustomerMiddleware'], function () {
    Route::get('/customer-dashboard', [CustomerLoginController::class, 'CustomerDashboard'])->name('customer-dashboard');
    Route::get('/customer-messages', [CustomerLoginController::class, 'CustomerMessages'])->name('customer-messages');
    Route::get('/customer-logout', [CustomerLoginController::class, 'CustomerLogout'])->name('customer-logout');
    Route::get('/customer-all-services', [CustomerLoginController::class, 'CustomerAllServices'])->name('customer-all-services');
    Route::get('/customer-my-services', [CustomerLoginController::class, 'CustomerMyServices'])->name('customer-my-services');
    Route::get('/Get-All-Services', [CustomerLoginController::class, 'GetAllServices'])->name('Get-All-Services');
    Route::get('/get-package-info', [CustomerLoginController::class, 'PackageInfo'])->name('get-package-info');
    Route::post('/customer-inquiry-form', [CustomerLoginController::class, 'CustomerInquiry'])->name('customer-inquiry-form');
    Route::post('/customer-support-ticket', [CustomerLoginController::class, 'CustomerSupportTicket'])->name('customer-support-ticket');

    Route::post('/upload-customer-documents', [CustomerLoginController::class, 'UploadDocs'])->name('upload-customer-documents');
    Route::get('/single-service/{service_id}', [CustomerLoginController::class, 'SingleService'])->name('Single-Service');
    Route::get('/Get-Customer-Documents', [CustomerLoginController::class, 'GetDocuments'])->name('Get-Customer-Documents');

    Route::get('/Get-Emp-Chat-Details', [CustomerLoginController::class, 'GetClientChatting'])->name('Get-Emp-Chat-Details');
    Route::get('/Get-Customer-Work-Timeline', [CustomerLoginController::class, 'CustWorkTimeline'])->name('Get-Customer-Work-Timeline');
    Route::post('/customer-chatting', [CustomerLoginController::class, 'CustomerChat'])->name('customer-chatting');
    Route::get('/Get-Cust-Total-Status-Count', [CustomerLoginController::class, 'GetCustomerStatusCount'])->name('Get-Cust-Total-Status-Count');
    Route::get('/get-customer-own-support-tickets', [CustomerLoginController::class, 'GetCustomerOwnTickets'])->name('get-customer-own-support-tickets');





    // cart routes
    Route::get('/Get-Item-Count', [CartController::class, 'GetItemCount'])->name('Get-Item-Count');
    Route::get('/Delete-Cart-Item', [CartController::class, 'DeleteCartItem'])->name('Delete-Cart-Item');
    Route::post('/add-item-to-cart', [CartController::class, 'AddToCart'])->name('add-item-to-cart');
    Route::get('/Get-Item-Total', [CartController::class, 'GetTotal'])->name('Get-Item-Total');

    // order routes
    Route::post('/buy-free-service', [OrderController::class, 'BuyFree'])->name('buy-free-service');


    //PAYMENT FORM
    Route::get('payment', [OrderController::class, 'index'])->name('payment');

    //SUBMIT PAYMENT FORM ROUTE
    Route::post('pay-now', [OrderController::class, 'submitPaymentForm'])->name('pay-now');


    //CALLBACK ROUTE
    Route::post('sub-payment-page', [OrderController::class, 'subPayment'])->name('Payment.Sub');
    Route::any('confirm-payment', [OrderController::class, 'confirmPayment'])->name('confirm');
    Route::post('initiatePayment', [OrderController::class, 'initiatePayment'])->name('initiatePayment');
    Route::post('rx-pay', [OrderController::class, 'RXPay'])->name('rx-pay');
});

Route::post('/add-num', [OrderController::class, 'AddNum']);

Route::get('/price-plan', function () {
    return view('welcome');
});
Route::get('/order', function () {
    return view('order');
});



require __DIR__ . '/auth.php';
