<?php

namespace App\Http\Controllers;
use App\Services\EventService;
use Illuminate\Http\Request;
use App\User;
use App\Event;
class AdminController extends Controller
{
    public function index (EventService $Event) 
    {
        $data = $Event->getIndexData();
        return view('admin' , $data);    
    }
}
