<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $event->load('category');
        return view('event-detail', compact('event'));
    }

    public function checkout(Event $event)
    {
        $event->load('category');
        return view('checkout', compact('event'));
    }

    public function ticket()
    {
        return view('ticket');
    }
}
