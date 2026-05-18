<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Partner;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->latest()->take(6)->get();
        $partners = Partner::all();
        $categories = Category::withCount('events')->get();
        return view('welcome', compact('events', 'partners', 'categories'));
    }
}
