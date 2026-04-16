<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.events');
    }

    public function transactions()
    {
        return view('admin.transactions');
    }
}
