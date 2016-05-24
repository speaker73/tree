<?php
use App\Comtree;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $comtrees = Comtree::all();
    return view('comtree', ['comtrees' => $comtrees]);
});
Route::get('/sec', function () {
    return 2;
});
Route::post('/add', function (Request $request) {
    $addCompany = new Comtree;
    $addCompany->name = $request->name;
    $addCompany->amount = $request->amount;
    $addCompany->total_amount = $request->total_amount;
    $addCompany->parent = $request->parent;
    $addCompany->save();
    return redirect()->back();
});