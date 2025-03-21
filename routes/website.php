<?php

use App\Http\Controllers\Agent\Website\HomeComponent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Route::group(['prefix' => '{agent_website}', 'as' => 'website.', 'middleware' => ['checkAgentWebsite']], function () {
//     // Main route for the agent's website
//     // Route::get('/', fn () => dd("Showing Dashboard"));
//     Route::get('/', fn () => view('agent.website.home-component', [
//         'agent' => request()->agent,
//     ]))->name('agent');
// });

Route::group(['prefix' => '{agent_website}', 'as' => 'website.', 'middleware' => ['checkAgentWebsite']], function () {
    Route::get('/', [HomeComponent::class, 'index'])->name('agent');
});
