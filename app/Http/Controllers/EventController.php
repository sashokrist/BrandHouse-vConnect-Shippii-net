<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::latest()->first();
        //dd($event);
        return view('event.index', compact('event'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {

    }

    public function show()
    {

    }
}
