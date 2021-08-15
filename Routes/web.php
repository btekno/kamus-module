<?php

/** 
 * @author Noviyanto Rahmadi <novay@btekno.id>
 * @copyright 2020 - Borneo Teknomedia
 *
 * Landing Page Routes
 */
Route::namespace('Landing')->as('kamus.')->group(function() 
{
	Route::get('/', 'IndexController@index')->name('index');
	Route::get('panduan', 'IndexController@panduan')->name('panduan');

	Route::get('search', 'IndexController@redirect')->name('redirect');
    Route::get('id/{bahasa?}/{query?}', 'IndexController@search')->name('search');
});

/** 
 * Kontribusi Routes
 */
Route::namespace('Kontribusi')->as('kamus.kontribusi.')->prefix('kontribusi')->group(function() 
{
	Route::get('/', 'IndexController@index')->name('index');
	Route::resources([
        'kontribusi' => 'KontribusiController', 
        'kontribusi.kalimat' => 'KontribusiKalimatController', 
    	'kata' => 'KataController', 
    	'kata.contoh' => 'KataContohController', 
    ]);
});

/** 
 * Officers Routes
 */
Route::namespace('Panel')->as('kamus.panel.')->prefix('panel')->group(function() 
{
	Route::get('/', 'IndexController@index')->name('index');
    Route::resources([
        'kata' => 'KataController', 
        'kalimat' => 'KalimatController', 
     
        'member' => 'Member\\IndexController', 
        'member.kata' => 'Member\\KataController', 
        'member.kalimat' => 'Member\\KalimatController', 
    ]);
});