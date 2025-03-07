<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlterController extends Controller
{
    /********keep this function for future use*********/

    // public function index()
    // {
    //     // DB::statement("Actual alter statement");

    //     return response()->json(['message' => 'Table altered successfully!']);
    // }

    /********Use this only when developing your application later comment it out*********/

    public function index($query)
    {
            // dd($query);
        DB::statement($query);
         // DB::statement("ALTER TABLE aihut_enquiries CHANGE is_active status INT(1) NOT NULL DEFAULT 0");
        return response()->json(['message' => 'Table altered successfully!']);
    }
}
