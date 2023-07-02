<?php


namespace App\Http\Controllers\Lead;


use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('lead.create');
    }
}
