<?php

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

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::get('/djilali', 'ExpertiseController@djilali')->name('djilali');

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'ok';
});

Route::get('/sendmail', function () {
    $exitCode = Artisan::call('command:sendnew');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/prev', 'HomeController@prev')->name('prev');

//profil utilisateur
Route::get('/profil', 'UtilisateurController@profil')->name('utilisateur.profil');
Route::post('/profil/{id}', 'UtilisateurController@update_profil')->name('utilisateur.update_profil');

//gestion des routes en relations avec les utilisateurs
Route::get('/utilisateurs', 'UtilisateurController@index')->name('utilisateur.index');
Route::post('/utilisateurs', 'UtilisateurController@index_table')->name('utilisateur.table');
Route::get('/ajouter_utilisateur', 'UtilisateurController@ajout')->name('utilisateur.ajouter');
Route::post('/ajout_utilisateurs', 'UtilisateurController@store')->name('utilisateur.store');
Route::get('/modifier_utilisateur/{id}', 'UtilisateurController@edit')->name('utilisateur.modifier');

Route::post('/modifier_utilisateur/{id}', 'UtilisateurController@update')->name('utilisateur.update');

Route::post('/desactiver_utilisateur', 'UtilisateurController@desactiver')->name('utilisateur.desactiver');
Route::post('/activer_utilisateur', 'UtilisateurController@activer')->name('utilisateur.activer');

Route::get('/utilisateurs/agenceUser/{user}', 'agenceUserController@index')->where('user', '\d+')->name('user.affecteAgence');
Route::post('/utilisateurs/agenceUser/nonAffected', 'agenceUserController@AgenceNonAffecteUserDataTable')->name('user.AgenceNonAffecteDataTable');
Route::post('/utilisateurs/agenceUser/Affected', 'agenceUserController@AgenceAffecteUserDataTable')->name('user.AgenceAffecteDataTable');
Route::post('/utilisateurs/agenceUser/Affectation', 'agenceUserController@affecteAgenceUser')->name('user.affecteAgenceUser');
Route::post('/utilisateurs/agenceUser/Desaffectation', 'agenceUserController@desaffecteAgenceUser')->name('user.desaffecteAgenceUser');

Route::get('utilisateurs/roles/{user}', 'UtilisateurController@roleedit')->where('user', '\d+')->name('utilisateur.role.edit');
Route::post('utilisateurs/roles/{user}', 'UtilisateurController@roleupdate')->where('user', '\d+')->name('utilisateur.role.update');

//gestion des roles et des permissions
Route::get('/roles', 'RolesPermissionsController@roles')->name('roles');
Route::post('/roles', 'RolesPermissionsController@index_table')->name('roles_table');
Route::get('/roles/create', 'RolesPermissionsController@roleAdd')->name('role.create');
Route::post('roles/create', 'RolesPermissionsController@roleAddStore')->name('role.store');
Route::get('roles/edit/{id}', 'RolesPermissionsController@roleDetailEdit')->where('id', '\d+')->name('role.edit');
Route::post('roles/edit', 'RolesPermissionsController@roleEditStore')->name('role.update');

Route::get('/permissions', 'RolesPermissionsController@permissions')->name('permissions');
Route::post('/permissions', 'RolesPermissionsController@index_table_permissions')->name('permissions.table');

Route::get('/permissions/{utilisateur}', 'RolesPermissionsController@permissionsUtilisateur')->name('permissionsUtilisateur');

//gestion des agences
Route::get('/agences', 'AgencesController@index')->name('agence.index');
Route::get('/ajouter_agence', 'AgencesController@ajout')->name('agence.ajouter');
Route::post('/ajouter_agences', 'AgencesController@store')->name('store.agence');
Route::post('/agences/indexDataTable', 'AgencesController@indexAgenceDataTable')->name('agence.datatableAll');
Route::get('/agences/{agence}/detail', 'AgencesController@show')->where('agence', '\d+')->name('agences.show');
Route::post('/agences/usersAgence/Affected', 'agenceUserController@UserAffecteAgenceDataTable')->name('agence.UserAffecteDataTable');
Route::post('/agences/usersAgence/nonAffected', 'agenceUserController@UserNonAffecteAgenceDataTable')->name('agence.UserNonAffecteDataTable');
Route::post('/agences/expertsAgence/Affected', 'agenceExpertController@ExpertAffecteAgenceDataTable')->name('agence.ExpertAffecteDataTable');
Route::post('/agences/expertsAgence/nonAffected', 'agenceExpertController@ExpertNonAffecteAgenceDataTable')->name('agence.ExpertNonAffecteDataTable');
Route::post('/agences/experts/Affectation', 'agenceExpertController@affecteExpertsAgence')->name('agence.affecteExpertAgence');
Route::post('/agences/experts/Desaffectation', 'agenceExpertController@detachExpertsAgence')->name('agence.detachExpertAgence');
Route::post('/agences/users/Affectation', 'agenceUserController@affecteUsersAgence')->name('agence.affecteUserAgence');
Route::post('/agences/users/Desaffectation', 'agenceUserController@detachUsersAgence')->name('agence.detachUserAgence');

Route::get('/agences/Users/{agence}', 'agenceUserController@showUsersAgence')->where('agence', '\d+')->name('agences.showUsers');

Route::get('/agences/Experts/{agence}', 'agenceExpertController@showExpertsAgence')->where('agence', '\d+')->name('agences.showExperts');
Route::get('/agences/modifier/{id}', 'AgencesController@edit')->name('agence.modifier');

Route::post('/modifier_agence/{id}', 'AgencesController@update')->name('agence.update');

// Route::get('/utilisateurs/agenceUser/{user}','agenceUserController@index')->where('user','\d+')->name('user.affecteAgence');

//gestion des experts
Route::get('/expert', 'ExpertsController@index')->name('expert.index');
Route::get('/ajouter_expert', 'ExpertsController@ajout')->name('expert.ajouter');
Route::post('/experts', 'ExpertsController@index_table')->name('experts.table');

Route::get('/experts/{expert}/agences', 'agenceExpertController@index')->where('expert', '\d+')->name('experts.expertAgence');
Route::post('/experts/agences/nonAffected', 'agenceExpertController@AgenceNonAffecteExpertDataTable')->name('expert.AgenceNonAffecteDataTable');
Route::post('/experts/agences/Affected', 'agenceExpertController@AgenceAffecteExpertDataTable')->name('expert.AgenceAffecteDataTable');
Route::post('/experts/agences/Affectation', 'agenceExpertController@affecteAgenceExpert')->name('expert.affecteAgenceExpert');

//test
Route::post('/test/ajax', 'AgencesController@testAjax')->name('test.ajax');


//affectation expert agence
Route::get('/agences/{agence}/experts', 'agenceExpertController@index2')->where('agence', '\d+')->name('agences.agenceExpert');


//ODS (Ordre De Service)
Route::get('/ods/creer', 'OdsController@creer')->name('ods.creer');
Route::get('/ods/modifier', 'OdsController@modifier')->name('ods.modifier');
Route::get('/ods/annuler_supprimer', 'OdsController@annuler_supprimer')->name('ods.annuler_supprimer');

//annulation et modification de ods par asalas
Route::get('/ods/annuler/{ods}', 'OdsController@annuler_ods')->name('ods.annuler');
Route::post('/ods/modifier/{ods}', 'OdsController@modifier_ods')->name('ods.modifier_ods');

Route::post('/ods/creer', 'OdsController@experts_table')->name('odsexperts.table');
Route::post('/ods/agence', 'AgencesController@agenceTable')->name('odsexperts.agence');
Route::post('/ods/dossier', 'OdsController@dossierTable')->name('dossier.table');
Route::post('/ods/tiers', 'OdsController@tiersTable')->name('tiers.table');
Route::post('/ods/store', 'OdsController@store')->name('ods.store');
Route::post('/ods/ods', 'OdsController@odsTable')->name('ods.table');
Route::post('/ods/odspriv', 'OdsController@odsTablePriv')->name('ods.tablepriv');
Route::get('/ods/relance', 'OdsController@relance')->name('ods.relance');
Route::post('/ods/relance', 'OdsController@relanceTable')->name('ods.relance_table');
Route::post('/ods/relanceOdsTable', 'OdsController@relanceOdsTable')->name('ods.relance_table_ods');
Route::post('/ods/relanceOds', 'OdsController@relanceOds')->name('ods.relance_ods');
Route::post('/ods/recupeinfo', 'OdsController@recupeInfo')->name('ods.recupeInfo');
Route::post('/ods/odsAll', 'OdsController@odsTableAll')->name('ods.tableAll');


//RDV
Route::get('/ods/rdv', 'RdvController@creer')->name('rdv.creer');
Route::post('/ods/rdv/edit', 'RdvController@store')->name('rdv.store');

//Choc
Route::post('/expertise/choc/{choc}/info/', 'ChocController@info')->where('choc', '\d+')->name('choc.info');
Route::get('/expertise/{expertise}/choc/ajouter/{type}', 'ChocController@creer')->where('expertise', '\d+')->name('choc.creer');
Route::post('/expertise/{expertise}/choc/ajouter', 'ChocController@store')->where('expertise', '\d+')->name('choc.store');
Route::get('/expertise/choc/{choc}/edit/', 'ChocController@edit')->where('choc', '\d+')->name('choc.edit');
Route::post('/expertise/choc/{choc}/edit', 'ChocController@update')->where('choc', '\d+')->name('choc.update');
Route::get('/expertise/choc/{choc}/show/', 'ChocController@show')->where('choc', '\d+')->name('choc.show');
Route::post('/choc/{choc}/fourniturs', 'ChocController@fournituresChoc')->where('choc', '\d+')->name('fournitures_choc.getAll');
Route::post('/choc/{choc}/autrefourniturs', 'ChocController@AutrefournituresChoc')->where('choc', '\d+')->name('autre_fournitures_choc.getAll');
Route::post('/expertise/choc/{choc}/valider', 'ChocController@valider')->where('choc', '\d+')->name('choc.valider');
Route::post('/expertise/choc/{choc}/devalider', 'ChocController@devalider')->where('choc', '\d+')->name('choc.devalider');



//PIECES
Route::get('/pieces/index', 'PiecesController@index')->name('pieces.index');
Route::get('/pieces/article/{id}', 'PiecesController@article')->name('pieces.article');
Route::get('/pieces/categorie', 'PiecesController@categorie')->name('pieces.categorie');

Route::get('/pieces/categorie/edit/{id}', 'PiecesController@editCategorie')->name('pieces.categorie.edit');
Route::post('/pieces/categorie/update/{id}', 'PiecesController@update_categorie')->name('pieces.categorie.update');
Route::get('/pieces/categorie/desactiver/{id}', 'PiecesController@desactivercategorie')->name('pieces.desactiver_cat');

Route::get('/pieces/article/edit/{id}', 'PiecesController@editArticle')->name('pieces.article.edit');
Route::post('/pieces/article/update/{id}', 'PiecesController@update_article')->name('pieces.article.update');
Route::get('/pieces/article/desactiver/{id}', 'PiecesController@desactiverarticle')->name('pieces.desactiver_art');

Route::post('/pieces/article', 'PiecesController@storeArticle')->name('article.store');
Route::post('/pieces/categorie', 'PiecesController@listeTablePiece')->name('categorie.liste_table');

// Autres pièces
Route::get('/autres_piece', 'PiecesController@autres')->name('autres.piece');
Route::post('/autres_piece_table', 'PiecesController@autres_table')->name('autresp.table');


//CategoriePieces
Route::get('/categorie/optionAll', 'CategoriePiecesController@getCategoriesOption')->name('categorie.optionAll');
Route::get('/pieces/optionAll', 'CategoriePiecesController@getpiecesOption')->name('piece.optionAll');
Route::post('pieces/articles', 'PiecesController@articleTable')->name('article.table');


//Expertise
Route::get('/expertise/liste', 'ExpertiseController@liste')->name('expertise.liste');
Route::post('/expertise/liste', 'ExpertiseController@listeTable')->name('expertise.liste_table');
Route::post('/expertise/traitement', 'ExpertiseController@traitementTable')->name('expertise.traitement_table');
Route::post('/expertise/creer', 'ExpertiseController@creer')->name('expertise.creer');
Route::post('/expertise/new', 'ExpertiseController@new')->name('expertise.new');
Route::post('/expertise/store', 'ExpertiseController@store')->name('expertise.store');
Route::post('/expertise/store_other', 'ExpertiseController@storeother')->name('expertise.store_other');
Route::get('/expertise/show/{expertise}', 'ExpertiseController@show')->name('expertise.show');
Route::post('/expertise/choc', 'ExpertiseController@chocTable')->name('expertise.choc_table');
Route::post('/expertise/fourniture', 'ExpertiseController@fournitureTable')->name('expertise.fourniture_table');
Route::post('/expertise/{expertise}/valider', 'ExpertiseController@valider')->name('expertise.valider');
Route::post('/expertise/{expertise}/devalider', 'ExpertiseController@devalider')->name('expertise.devalider');
Route::get('/expertise/{expertise}/imprimmer', 'ExpertiseController@imprimmer')->name('expertise.imprimmer');
Route::post('/expertise/{expertise}/devaliderFinal', 'ExpertiseController@devaliderFinal')->name('expertise.devaliderFinal');

Route::post('/expertise/{expertise}/delete', 'ExpertiseController@destroy')->name('expertise.delete');

Route::post('/expertise/{expertise}/valider_final', 'ExpertiseController@validerfinalise')->name('expertise.valider_final');

Route::post('/expertise/creerAdditif', 'ExpertiseController@creerAdditif')->name('expertise.creerAdditif');
Route::post('/expertise/modifierAdditif', 'ExpertiseController@modifierAdditif')->name('expertise.modifierAdditif');

Route::post('/expertise/contre', 'ExpertiseController@contre')->name('expertise.contre');
Route::post('/expertise/modifierContre', 'ExpertiseController@modifierContre')->name('expertise.modifierContre');


Route::get('disneyplus', 'DisneyplusController@create')->name('disneyplus.create');
Route::post('disneyplus', 'DisneyplusController@store')->name('disneyplus.store');
Route::get('disneyplus/list', 'DisneyplusController@index')->name('disneyplus.index');
Route::get('/downloadPDF/{id}', 'DisneyplusController@downloadPDF')->name('imprimmer');

Route::get('/expertise/{expertise}/honoraire', 'ExpertiseController@honoraire')->name('expertise.honoraire');
Route::post('/expertise/honoraire', 'ExpertiseController@storeHonoraire')->name('expertise.store_honoraire');
Route::post('/expertise/{honoraire}/honoraire', 'ExpertiseController@destroyHonoraire')->name('expertise.delete_honoraire');

Route::get('/honoraire/{expertise}', 'ExpertiseController@imprimer_honoraire')->name('imprimmerHonoraire');

Route::get('/report', 'ExpertiseController@reporthonoraireods')->name('report.raporthonoraire');
Route::post('report/fetch', 'ExpertiseController@fetch')->name('report.raporthonoraire.fetch');

Route::post('pdf', 'ExpertiseController@pdfhonorairreport')->name('pdfhonorairreport');
Route::post('imprimmer', 'ExpertiseController@imprimer_pdf_honorairetotal')->name('imprimmerHonorairetotl');


// Détail Expertise
Route::get('/detail/{type}', 'ExpertiseController@detail')->name('detail');
Route::post('/detail_table', 'ExpertiseController@detail_table')->name('detail.table');

Route::get('/detail', 'ExpertiseController@detail_ods')->name('detail_ods');
Route::post('/detail_table_ods', 'ExpertiseController@detail_table_ods')->name('detail.table_ods');

// Photos
Route::get('expertiseImage/{expertise}', 'ImageController@expImage')->name('expertiseImage');
Route::post('expertiseImagePost', 'ImageController@expertiseImagePost')->name('expertiseImagePost');
Route::get('expertiseImage/download/{photo}', 'ImageController@downloadFile')->name('fileDownload');
Route::post('expertiseImageDelete/{photo}', 'ImageController@expertiseImageDelete')->name('expertiseImageDelete');
Route::post('expertiseImageDeletejs', 'ImageController@destroyImage')->name('destroyImage');

//zoom
Route::get('/buttonzoom', 'ImageController@index')->name('indexZoom');
Route::post('expertiseMeeting', 'ImageController@zoomMeeting')->name('expertiseMeeting');
//Route::post('meeting2', 'ImageController@zoomMeeting')->name('expertiseMeeting');

// Déclaration sinistre
Route::post('declaration', 'ImageController@declaration')->name('expertise.declaration');
Route::post('expertiseDeclarationPost', 'ImageController@expertiseDeclarationPost')->name('expertiseDeclarationPost');
Route::get('expertiseDeclaration/download/{declaration}', 'ImageController@downloadFileDeclaration')->name('fileDownloadDeclaration');
Route::post('expertiseDeclarationDelete/{declaration}', 'ImageController@expertiseDeclarationDelete')->name('expertiseDeclarationDelete');

// Dossier exclu
Route::post('sendExlu', 'ExpertiseController@sendExlu')->name('sendExlu');
