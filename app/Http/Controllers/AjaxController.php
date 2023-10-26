<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function loadsubcategories(Request $request){

        echo $request->tic;

    }
}
