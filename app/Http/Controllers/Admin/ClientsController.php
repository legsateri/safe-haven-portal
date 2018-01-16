<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    /**
     * display client list page
     */
    public function index()
    {
        return view('admin.clients.clients_all.list');
    }

    /**
     * display add client page (form)
     */
    public function add()
    {
        return view('admin.clients.client_add.list');
    }
}
