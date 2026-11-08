<?php

namespace App\Http\Controllers;

class PortfolioController extends Controller
{
    public function home()
    {
        return view('portfolio.home');
    }

    public function experience()
    {
        return view('portfolio.experience');
    }

    public function projects()
    {
        return view('portfolio.projects');
    }
}
