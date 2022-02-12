<?php
use Inphinit\Routing\Route;

Route::set('GET', '/', 'Home:index');
Route::set('GET', '/identity{:\/?:}', 'Home:identity');
Route::set('GET', '/identity/new{:\/?:}', 'Home:createidentity');
Route::set('GET', '/identity/import{:\/?:}', 'Home:importidentity');

Route::set('GET', '/dashboard{:\/?:}', 'Dashboard:messages');
Route::set('GET', '/dashboard/settings/keys{:\/?:}', 'Dashboard:keys');
Route::set('GET', '/dashboard/settings/public-info{:\/?:}', 'Dashboard:publicInfo');