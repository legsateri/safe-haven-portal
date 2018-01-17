<?php

namespace App\Http\Controllers\Advocate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    
    /**
     * associated clients list page
     */
    public function associatedList()
    {

    }

    /**
     * clients in need list page
     */
    public function inNeedList()
    {

    }

    /**
     * single client page
     */
    public function single($id, $slug)
    {

    }
    
}
