<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class PetsController extends Controller
{
    /**
     * display pet list page
     */
    public function index()
    {
        $pets = DB::table('pets')
                    ->orderBy('created_at', 'desc')
                    ->paginate('25');

        return view('admin.clients.pets_all.list', compact('pets'));
    }
}
