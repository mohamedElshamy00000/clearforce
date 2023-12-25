<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Frontend\HomeController;


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

Route::get("sitemap.xml" , function () {
    return \Illuminate\Support\Facades\Redirect::to('sitemap.xml');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' =>['SetAppLang']],function(){
    
    Route::get('/',            [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
    Route::get('/home',        [App\Http\Controllers\Frontend\HomeController::class, 'index']);
    Route::get('/about',       [App\Http\Controllers\Frontend\HomeController::class, 'about'])->name('about');
    Route::get('/howItWork', [App\Http\Controllers\Frontend\HomeController::class, 'how_it_work'])->name('how.it.work');
    Route::get('/blog',        [App\Http\Controllers\Frontend\HomeController::class, 'blog'])->name('blog');
    Route::get('/blog/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'blog_single'])->name('blog.single');
    Route::get('/contact',     [App\Http\Controllers\Frontend\HomeController::class, 'contact'])->name('contact.us');
    Route::post('/contactStore',     [App\Http\Controllers\Frontend\HomeController::class, 'contactStore'])->name('contact.store');
    Route::get('/privacy',     [App\Http\Controllers\Frontend\HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms',     [App\Http\Controllers\Frontend\HomeController::class, 'terms'])->name('terms');

    // dashboard's routes
    Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','verified']], function(){

        // admin
        Route::group(['middleware' => ['role:admin']], function() {

            Route::get('/', [App\Http\Controllers\Backend\IndexController::class, 'index'])->name('admin.index');
            Route::get('/contact-us', [App\Http\Controllers\Backend\IndexController::class, 'contacts'])->name('admin.contact.us');
            Route::get('/getContacts', [App\Http\Controllers\Backend\IndexController::class, 'getContacts'])->name('admin.getContacts');
            
            // users
            Route::get('/admin/users/clients',  [App\Http\Controllers\Backend\UsersController::class, 'clients'])->name('admin.clients');
            Route::get('/getClientData',        [App\Http\Controllers\Backend\UsersController::class, 'getClientData'])->name('getClientData');
            Route::get('/admin/users/agents',   [App\Http\Controllers\Backend\UsersController::class, 'agents'])->name('admin.agents');
            Route::get('/getAgentsData',        [App\Http\Controllers\Backend\UsersController::class, 'getAgentsData'])->name('getAgentsData');

            Route::get('/admin/users/verifications',            [App\Http\Controllers\Backend\UsersController::class, 'verificationCenter'])->name('admin.users.verificationcenter');
            Route::get('/admin/users/getVerifications',         [App\Http\Controllers\Backend\UsersController::class, 'getVerifications'])->name('admin.users.getVerifications');
            Route::get('/admin/users/acceptVerification/{id}',  [App\Http\Controllers\Backend\UsersController::class, 'verificationsAccept'])->name('admin.users.verificationsAccept');
            Route::get('/admin/users/rejecttVerification/{id}', [App\Http\Controllers\Backend\UsersController::class, 'verificationsReject'])->name('admin.users.verificationsReject');

            Route::get('/admin/users/details/{id}', [App\Http\Controllers\Backend\UsersController::class, 'userDetails'])->name('admin.users.details');
            Route::get('/admin/users/getClientProjects/{id}',   [App\Http\Controllers\Backend\UsersController::class, 'getClientProjects'])->name('admin.getClientProjects');
            Route::get('/admin/users/getAgentProposals/{id}',   [App\Http\Controllers\Backend\UsersController::class, 'getAgentProposals'])->name('admin.getAgentProposals');
            Route::post('/admin/users/update/{id}',   [App\Http\Controllers\Backend\UsersController::class, 'userUpdate'])->name('admin.users.update');

            // projects
            Route::get('/getProjectsData',         [App\Http\Controllers\Backend\ProjectsController::class, 'getProjectsData'])->name('getProjectsData');
            Route::get('/projectgetInvoicesData',  [App\Http\Controllers\Backend\ProjectsController::class, 'projectgetInvoicesData'])->name('project.getInvoicesData');
            Route::post('/projectAddProposal/{id}',      [App\Http\Controllers\Backend\ProjectsController::class, 'projectAddProposal'])->name('admin.project.addProposal');
            Route::get('/projectAcceptAgentProposal/{id}',      [App\Http\Controllers\Backend\ProjectsController::class, 'AcceptAgentProposal'])->name('admin.project.accept.agent.proposal');
            Route::post('/projectEditProposal/{id}',      [App\Http\Controllers\Backend\ProjectsController::class, 'projectEditProposal'])->name('admin.project.editProposal');

            // Route::get('/getAgents',               [App\Http\Controllers\Backend\ProjectsController::class, 'getAgents'])->name('getAgents');
            Route::post('/projectInviteAgent',      [App\Http\Controllers\Backend\ProjectsController::class, 'projectInviteAgent'])->name('admin.project.invite.agent');
            Route::get('/admin/getTProjectInvoices/{project}', [App\Http\Controllers\Backend\ProjectsController::class, 'getTProjectInvoices'])->name('admin.getTProjectInvoices');

            // mony tranactions 
            Route::get('/transactions',      [App\Http\Controllers\Backend\UsersController::class, 'transactionHistory'])->name('admin.users.transaction.history');
            Route::get('/getTransactions',   [App\Http\Controllers\Backend\UsersController::class, 'getTransactions'])->name('getTransactions');
            Route::post('/editTransaction/{id}',  [App\Http\Controllers\Backend\UsersController::class, 'editTransaction'])->name('admin.edit.transaction');

            // pay
            Route::get('/payout/history',    [App\Http\Controllers\Backend\UsersController::class, 'withdrawHistory'])->name('admin.agent.payout.history');
            Route::get('/getTPayoutHistory',   [App\Http\Controllers\Backend\UsersController::class, 'getTPayoutHistory'])->name('getTPayoutHistory');
            Route::get('/payout/requests',    [App\Http\Controllers\Backend\UsersController::class, 'withdrawRequests'])->name('admin.agent.payout.requests');
            Route::get('/getTPayoutRequests',   [App\Http\Controllers\Backend\UsersController::class, 'getTPayoutRequests'])->name('getTPayoutRequests');
            
            Route::get('/WalletCharging/{user}',   [App\Http\Controllers\Backend\UsersController::class, 'clientWalletCharging'])->name('admin.wallet.charging');

            Route::get('/payoutshow/{id}',   [App\Http\Controllers\Backend\UsersController::class, 'payoutShow'])->name('admin.debit.payout.show');
            Route::get('/payoutApprove/{id}',   [App\Http\Controllers\Backend\UsersController::class, 'payoutApprove'])->name('admin.debit.payout.approve');

            // categorys
            Route::prefix('project')->group(function () {

                Route::get('/all',      [App\Http\Controllers\Backend\ProjectsController::class, 'index'])->name('admin.projects');
                Route::get('single/{uuid}',   [App\Http\Controllers\Backend\ProjectsController::class, 'projectSingle'])->name('admin.project.single');

                Route::get('/productFileType',         [App\Http\Controllers\Backend\CategoryController::class, 'productFileType'])->name('admin.product.fileType');
                Route::get('/getProductFileTypes',     [App\Http\Controllers\Backend\CategoryController::class, 'getProductFileTypes'])->name('getProductFileTypes');
                Route::post('/productFileTypeStore',   [App\Http\Controllers\Backend\CategoryController::class, 'productFileTypeStore'])->name('product.file.type.store');
                Route::post('/productFileTypeUpdate',  [App\Http\Controllers\Backend\CategoryController::class, 'productfileTypeUpdate'])->name('product.file.type.update');
        
                Route::get('/shippingWays',        [App\Http\Controllers\Backend\CategoryController::class, 'shippingWays'])->name('admin.shipping.way');
                Route::get('/getshippingWay',      [App\Http\Controllers\Backend\CategoryController::class, 'getshippingWay'])->name('getshippingWay');
                Route::post('/hippingWayStore',    [App\Http\Controllers\Backend\CategoryController::class, 'shippingWayStore'])->name('shipping.way.store');
                Route::post('/hippingWayUpdate',   [App\Http\Controllers\Backend\CategoryController::class, 'shippingWayUpdate'])->name('shipping.way.update');
        
                Route::get('/shippingWayPort',     [App\Http\Controllers\Backend\CategoryController::class, 'shippingWayPort'])->name('admin.shipping.way.port');
                Route::get('/getPorts',            [App\Http\Controllers\Backend\CategoryController::class, 'getPorts'])->name('admin.getPorts');
                Route::post('/portStore',          [App\Http\Controllers\Backend\CategoryController::class, 'portStore'])->name('port.store');
                Route::post('/portUpdate',         [App\Http\Controllers\Backend\CategoryController::class, 'portUpdate'])->name('port.update');
                Route::post('/portExcelFileStore', [App\Http\Controllers\Backend\CategoryController::class, 'portExcelFileStore'])->name('ports.store.excel.file');

                Route::get('/HScode',        [App\Http\Controllers\Backend\HScodeController::class, 'HScode'])->name('admin.HScode');
                Route::get('/getHScode',             [App\Http\Controllers\Backend\HScodeController::class, 'getHScode'])->name('getHScode');
                Route::post('/HscodeExcelFileStore', [App\Http\Controllers\Backend\HScodeController::class, 'HscodeExcelFileStore'])->name('Hscode.store.excel.file');
                Route::post('/HScodeUpdate',         [App\Http\Controllers\Backend\HScodeController::class, 'HscodeUpdate'])->name('Hscode.update');

                Route::get('/country',           [App\Http\Controllers\Backend\CountryController::class, 'countries'])->name('admin.countries');
                Route::get('/getcountrys',             [App\Http\Controllers\Backend\CountryController::class, 'getCountrys'])->name('get.country');
                Route::post('/countryExcelFileStore',  [App\Http\Controllers\Backend\CountryController::class, 'countryExcelFileStore'])->name('countrys.store.excel.file');
                Route::post('/countryUpdate',          [App\Http\Controllers\Backend\CountryController::class, 'countrysUpdate'])->name('countrys.update');

                Route::get('/millstone',         [App\Http\Controllers\Backend\CategoryController::class, 'millstones'])->name('admin.millstones');
                Route::get('/getMillstones',           [App\Http\Controllers\Backend\CategoryController::class, 'getmillstones'])->name('getmillstones');
                Route::post('/millstonesStore',        [App\Http\Controllers\Backend\CategoryController::class, 'millstonesStore'])->name('millstone.store');
                Route::post('/millstonesUpdate',       [App\Http\Controllers\Backend\CategoryController::class, 'millstonesUpdate'])->name('millstone.update');

                // project invoices
                Route::get('/approveFromInvoiceFile/{invoice}',  [App\Http\Controllers\Backend\ProjectsController::class, 'approveFromInvoiceFile'])->name('admin.projectInvoice.accept');
                Route::get('/confirmFromInvoiceFile/{invoice}',  [App\Http\Controllers\Backend\ProjectsController::class, 'confirmFromInvoiceFile'])->name('admin.projectInvoice.confirm');
                Route::get('/confirmCreditFromInvoiceFile/{project}',  [App\Http\Controllers\Backend\ProjectsController::class, 'confirmCreditFromInvoiceFile'])->name('admin.credit.projectInvoice.confirm');
                
            });
            
            // test payout
            // Route::post('/debit/payout/{order}',     [App\Http\Controllers\Backend\MoyasarController::class, 'payout'])->name('admin.debit.payout');

            // support
            Route::prefix('support')->group(function () {
                Route::get('/all',        [App\Http\Controllers\Backend\SupportController::class, 'index'])->name('admin.support');
                Route::get('single/{id}', [App\Http\Controllers\Backend\SupportController::class, 'ticketSingle'])->name('admin.ticket.single');
                Route::get('/editPriority/{id}/{priority}',  [App\Http\Controllers\Backend\SupportController::class, 'ticketEditPriority'])->name('admin.ticket.edit.priority');
                Route::get('getTickets',  [App\Http\Controllers\Backend\SupportController::class, 'getTickets'])->name('admin.getTickets');
                Route::post('sendMessage/{ticket}', [App\Http\Controllers\Backend\SupportController::class, 'sendMessage'])->name('admin.supportticket.send.message');
                
            });

            // blog
            Route::prefix('blog')->group(function () {
                Route::get('/all',         [App\Http\Controllers\Backend\BlogController::class, 'index'])->name('admin.articles');
                Route::get('single/{id}',  [App\Http\Controllers\Backend\BlogController::class, 'articleSingle'])->name('admin.article.single');
                Route::get('getArticles',  [App\Http\Controllers\Backend\BlogController::class, 'getArticles'])->name('admin.getArticles');
                Route::get('add/article',  [App\Http\Controllers\Backend\BlogController::class, 'AddArticles'])->name('admin.add.articles');
                Route::post('store/article', [App\Http\Controllers\Backend\BlogController::class, 'storeArticles'])->name('admin.article.store');
                Route::post('update/article/{slug}', [App\Http\Controllers\Backend\BlogController::class, 'updateArticles'])->name('admin.article.update');
            });

            // settings
            Route::prefix('setting')->group(function () {
                // main website settings
                Route::get('/main-settings',  [App\Http\Controllers\Backend\SettingController::class, 'index'])->name('admin.main.setting');
                Route::post('/main-settings-update',  [App\Http\Controllers\Backend\SettingController::class, 'update'])->name('admin.main.setting.update');

                // taxs
                Route::get('/taxts',         [App\Http\Controllers\Backend\TaxController::class, 'index'])->name('admin.taxs');
                Route::get('/gettaxts',      [App\Http\Controllers\Backend\TaxController::class, 'getTaxTypes'])->name('get.taxs');
                Route::post('/taxtsUpdate',  [App\Http\Controllers\Backend\TaxController::class, 'TaxUpdate'])->name('tax.update');
                Route::post('/taxtsStore',   [App\Http\Controllers\Backend\TaxController::class, 'TaxCreate'])->name('tax.store');

                Route::get('/Terms-Privacy',  [App\Http\Controllers\Backend\PrivacyTermsController::class, 'TermsPrivacyUpdate'])->name('admin.privacy.terms');
                Route::post('/privacyUpdate', [App\Http\Controllers\Backend\PrivacyTermsController::class, 'privacyUpdate'])->name('admin.setting.privacy.update');
                Route::post('/termsUpdate',   [App\Http\Controllers\Backend\PrivacyTermsController::class, 'termsUpdate'])->name('admin.setting.terms.update');

                // Q&A
                Route::prefix('QA')->group(function () {

                    Route::get('questions',  [App\Http\Controllers\Backend\QuestionsController::class, 'questions'])->name('admin.questions');
                    Route::get('categorys',  [App\Http\Controllers\Backend\QuestionsController::class, 'categorys'])->name('admin.questions.categorys');
                    Route::get('/getQAcategorys', [App\Http\Controllers\Backend\QuestionsController::class, 'getQAcategorys'])->name('get.QAcategorys');
                    Route::post('/QAcategorysStore',   [App\Http\Controllers\Backend\QuestionsController::class, 'QAcategorysStore'])->name('QAcategorys.store');
                    Route::post('/QAcategorysUpdate',  [App\Http\Controllers\Backend\QuestionsController::class, 'QAcategorysUpdate'])->name('QAcategorys.update');

                    Route::get('/getQAquestions', [App\Http\Controllers\Backend\QuestionsController::class, 'getQAquestions'])->name('get.QAquestions');
                    Route::post('/QAquestionsStore',   [App\Http\Controllers\Backend\QuestionsController::class, 'QAquestionsStore'])->name('QAquestions.store');
                    Route::get('/QAquestionsUpdate/{id}',  [App\Http\Controllers\Backend\QuestionsController::class, 'QAquestionsUpdate'])->name('QAquestions.update');
                    Route::post('/QAquestionsChange/{id}',  [App\Http\Controllers\Backend\QuestionsController::class, 'QAquestionsChange'])->name('QAquestions.change');

                });
            });


            
        });

        // supervisor
        Route::group(['middleware' => ['role:supervisor']], function() {

        });

        // agent
        Route::group(['middleware' => ['role:agent']], function() {

            Route::get('/agent',         [App\Http\Controllers\Backend\Agent\IndexController::class, 'index'])->name('agent.index');
            Route::get('/agent/expolore-projects', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'expoloreProjects'])->name('agent.expolore.projects');
            Route::get('/agent/myProposals', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'myProposals'])->name('agent.my.proposals');
            Route::get('agentgetProposalsData',  [App\Http\Controllers\Backend\Agent\ProjectController::class, 'agentgetProposalsData'])->name('agentgetProposalsData');
            Route::get('/agent/getSinglePoject/{id}', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'agentExpoloreSingleProjectData'])->name('agentExpoloreSingleProjectData');
            Route::get('/agent/SingleProject/{uuid}', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'singleProjects'])->name('agent.single.projects');
            Route::post('/agentprojectAddProposal/{id}',      [App\Http\Controllers\Backend\Agent\ProjectController::class, 'agentprojectAddProposal'])->name('agent.project.addProposal');
            Route::get('/AgentgetPorts',       [App\Http\Controllers\Backend\Agent\ProjectController::class, 'getPorts'])->name('agent.getPorts');
            Route::post('/agentExploreSearch', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'exploreSearch'])->name('agent.explore.search');
            Route::post('/sendCompleteRequest/{uuid}',  [App\Http\Controllers\Backend\Agent\ProjectController::class, 'sendCompleteRequest'])->name('agent.request.endproject');
            Route::post('/editCompleteRequest/{uuid}',  [App\Http\Controllers\Backend\Agent\ProjectController::class, 'editCompleteRequest'])->name('agent.edit.request.endproject');
            Route::get('/getEndRequest/{uuid}',  [App\Http\Controllers\Backend\Agent\ProjectController::class, 'getEndRequest'])->name('agent.getEndRequest');
            
            // Verification-center
            Route::get('/Verification-center', [App\Http\Controllers\Backend\Agent\VerificationController::class, 'index'])->name('agent.verification');
            Route::post('/Verification-center-store', [App\Http\Controllers\Backend\Agent\VerificationController::class, 'storeVerificationFiles'])->name('agent.verification.store');

            // Millstones
            Route::get('/agent/addMillstone/{millId}/{projectId}', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'addNewMillstone'])->name('agent.add.NewMillstone');
            Route::post('/agent/addCustomMillstone/{projectId}',    [App\Http\Controllers\Backend\Agent\ProjectController::class, 'addNewCustomMillstone'])->name('agent.add.CustomMillstone');

            Route::post('/agent/addCustomInvoice/{projectId}',    [App\Http\Controllers\Backend\Agent\ProjectController::class, 'addNewCustomInvoice'])->name('agent.add.CustomInvoice');
            Route::get('/agent/getTProjectInvoices/{project}', [App\Http\Controllers\Backend\Agent\ProjectController::class, 'getTProjectInvoices'])->name('agent.getTProjectInvoices');
            Route::post('/agent/uploadProofFile/{invoiceID}',    [App\Http\Controllers\Backend\Agent\ProjectController::class, 'uploadProofFile'])->name('agent.upload.ProofFile');
            
            Route::get('/agent/withdraw/history', [App\Http\Controllers\Backend\Agent\IndexController::class, 'withdrawHistory'])->name('agent.withdraw.history');
            Route::get('/agent/getTPayoutRequests', [App\Http\Controllers\Backend\Agent\IndexController::class, 'getTPayoutHistory'])->name('agent.getTPayoutHistory');
            Route::get('/agent/getTAgentInviets', [App\Http\Controllers\Backend\Agent\IndexController::class, 'getTAgentInviets'])->name('agent.getTAgentInviets');
            // help center
            Route::get('/agent/helpcenter', [App\Http\Controllers\Backend\Agent\IndexController::class, 'helpcenter'])->name('agent.helpcenter');

            // payout
            Route::post('/agent/payoutUserDataStore',    [App\Http\Controllers\Backend\Agent\IndexController::class, 'payoutUserDataStore'])->name('agent.add.payout.user.data');
            // Withdraw Request
            Route::post('/agent/withdrawRequest',    [App\Http\Controllers\Backend\Agent\IndexController::class, 'sendWithdrawrequest'])->name('agent.withdraw.request');
            
        });

        // client
        Route::group(['middleware' => ['role:client']], function() {

            Route::get('/client',         [App\Http\Controllers\Backend\Client\IndexController::class, 'index'])->name('client.index');
            Route::get('/create project', [App\Http\Controllers\Backend\Client\ProjectController::class, 'create_project'])->name('client.project.create');
            Route::get('getGoodsTypes',   [App\Http\Controllers\Backend\Client\ProjectController::class, 'getGoodsTypes'])->name('GoodsTypes.search');
            Route::post('/getHsCodes',    [App\Http\Controllers\Backend\Client\ProjectController::class, 'getHsCodes'])->name('getHsCodes');
            Route::get('/clientgetPorts', [App\Http\Controllers\Backend\Client\ProjectController::class, 'getPorts'])->name('client.getPorts');
            
            // company
            Route::get('/company/{id}',      [App\Http\Controllers\Backend\Client\CompanyController::class, 'index'])->name('client.company');
            Route::post('/company/newuser',  [App\Http\Controllers\Backend\Client\CompanyController::class, 'createUser'])->name('client.company.create.user');
            Route::post('/company/edit/{id}', [App\Http\Controllers\Backend\Client\CompanyController::class, 'companyEdit'])->name('client.company.update');
            
            // Route::post('/company/edituser', [App\Http\Controllers\Backend\Client\CompanyController::class, 'editUser'])->name('client.company.edit.user');
            // Route::post('/company/updateuser', [App\Http\Controllers\Backend\Client\CompanyController::class, 'updateUser'])->name('client.company.update.user');
            Route::get('/company/storage/{id}',   [App\Http\Controllers\Backend\Client\CompanyController::class, 'storage'])->name('client.storage');
            Route::get('/company/storage/create_delivary_order/{project}',   [App\Http\Controllers\Backend\Client\CompanyController::class, 'createDeliveryOrder'])->name('client.storage.create.deliveryOrder');
            Route::post('/company/storage/store_delivary_order',   [App\Http\Controllers\Backend\Client\CompanyController::class, 'storeDeliveryOrder'])->name('client.storage.store.deliveryOrder');
            Route::get('/company/storage/clientGetDeliveryOrder/{company}',   [App\Http\Controllers\Backend\Client\CompanyController::class, 'GetDeliveryOrder'])->name('client.storage.GetDeliveryOrder');
            Route::get('/company/storage/view_delivary_order/{id}',   [App\Http\Controllers\Backend\Client\CompanyController::class, 'viewDeliveryOrder'])->name('client.storage.view.deliveryOrder');

            // test api (AI Engine)
            Route::get('/filesEngine',       [App\Http\Controllers\Backend\Client\FileEngineController::class, 'filesEngine'])->name('client.filesEngine');
            Route::post('/filesEngineStore', [App\Http\Controllers\Backend\Client\FileEngineController::class, 'getDataFromFiles'])->name('client.filesEngine.store');

            // store project
            Route::post('/projectStore',  [App\Http\Controllers\Backend\Client\ProjectController::class, 'projectStore'])->name('client.project.store');
            Route::get('/projects',       [App\Http\Controllers\Backend\Client\ProjectController::class, 'allProjects'])->name('client.all.projects');
            Route::get('/project/{uuid}', [App\Http\Controllers\Backend\Client\ProjectController::class, 'singleProject'])->name('single.project');
            Route::get('/MyTransactions', [App\Http\Controllers\Backend\Client\IndexController::class, 'myTransactions'])->name('client.payment.myTransactions');
            Route::get('/getMyTransactions', [App\Http\Controllers\Backend\Client\IndexController::class, 'getMyTransactions'])->name('client.payment.getMyTransactions');
            Route::get('/payment/invoices',  [App\Http\Controllers\Backend\Client\IndexController::class, 'paymentInvoices'])->name('client.payment.invoices');
            Route::get('/clientGetInvoices', [App\Http\Controllers\Backend\Client\IndexController::class, 'clientGetInvoices'])->name('clientGetInvoices');
            Route::get('/client/getTProjectInvoices/{project}', [App\Http\Controllers\Backend\Client\ProjectController::class, 'getTProjectInvoices'])->name('client.getTProjectInvoices');
            Route::post('/client/clientConfirmInvoicePayment/{invoice}', [App\Http\Controllers\Backend\Client\ProjectController::class, 'clientConfirmInvoicePayment'])->name('client.confirm.invoice.payment');

            
            Route::get('/client/confirmEndProject/{id}',   [App\Http\Controllers\Backend\Client\ProjectController::class, 'confirmEndProject'])->name('client.confirm.enf.eroject');
            Route::get('/client/invoice/show/{id}',   [App\Http\Controllers\Backend\Client\ProjectController::class, 'invoiceShow'])->name('client.payment.show');

            // help center
            Route::get('/user/helpcenter',  [App\Http\Controllers\Backend\IndexController::class, 'helpcenter'])->name('user.helpcenter');
            Route::get('/user/getSupportTickets',  [App\Http\Controllers\Backend\Client\SupportController::class, 'getSupportTickets'])->name('client.getSupport.tickets');
            Route::get('/user/supportTicketSingle/{id}',  [App\Http\Controllers\Backend\Client\SupportController::class, 'supportTicketSingle'])->name('client.ticket.single');
            Route::post('/user/sendMessage/{ticket}', [App\Http\Controllers\Backend\Client\SupportController::class, 'sendMessage'])->name('client.supportticket.send.message');

            
            Route::get('/user/showMessages/{id}',  [App\Http\Controllers\Backend\Client\SupportController::class, 'getMessages'])->name('clinet.showMessages');

            //create ticket from project single page
            Route::post('/user/helpcenter/{id}', [App\Http\Controllers\Backend\Client\SupportController::class, 'createSupportTicket'])->name('client.create.support.ticket');
            
            // Project Main Invoices & payment
            Route::get('/project/invoice/{id}',  [App\Http\Controllers\Backend\Client\ProjectController::class, 'singleProjectInvoice'])->name('clinet.single.invoice');
            Route::get('/project/invoice/download/{id}',  [App\Http\Controllers\Backend\Client\IndexController::class, 'ProjectInvoiceDownload'])->name('clinet.downlaod.invoice');
            Route::post('/project/invoice/send/{uuid}',  [App\Http\Controllers\Backend\Client\IndexController::class, 'sendInvoiceToMail'])->name('client.send.invoice');
            
        }); 
        // Route::get('/index',     [App\Http\Controllers\Backend\IndexController::class, 'index'])->name('admin.index');
        // Route::get('/settings',  [App\Http\Controllers\Backend\SettingController::class, 'index'])->name('property.setting');

        // download file routes
        Route::get('/file-upload/download/{file}', [App\Http\Controllers\Backend\IndexController::class, 'download'])->name('file.download');
        Route::get('/file-download/download/{file}', [App\Http\Controllers\Backend\Agent\IndexController::class, 'download'])->name('agent.file.download');
        Route::get('/invoice-download/download/{path}/{file}', [App\Http\Controllers\Backend\IndexController::class, 'downloadFile'])->name('files.download');

        // payment
        Route::get('/credit/checkout/{order}',   [App\Http\Controllers\Backend\MoyasarController::class, 'checkout'])->name('credit.checkout');
        Route::post('/credit/pay/{order}',       [App\Http\Controllers\Backend\MoyasarController::class, 'payAPI'])->name('credit.payapi');
        Route::get('/credit/callback',           [App\Http\Controllers\Backend\MoyasarController::class, 'processedCallback'])->name('credit.paymeny.callback');
        Route::get('/payment/success/{invoice}', [App\Http\Controllers\Backend\MoyasarController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/payment/error/{invoice}',   [App\Http\Controllers\Backend\MoyasarController::class, 'failed'])->name('payment.error');
        
        // user settings
        Route::get('/user/setting/info', [App\Http\Controllers\Backend\UserSettingsController::class, 'userSettingInfo'])->name('user.userSettingInfo');
        Route::post('/user/update/{user}',      [App\Http\Controllers\Backend\UserSettingsController::class, 'userUpdateInfo'])->name('user.update.info');

    });

    Route::get('locale/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });
});



