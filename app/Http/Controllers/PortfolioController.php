<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'owner' => config('portfolio.owner'),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'owner' => config('portfolio.owner'),
        ]);
    }

    public function projects(): View
    {
        return view('pages.projects', [
            'projects' => config('portfolio.projects'),
        ]);
    }

    public function certificates(): View
    {
        $certificates = collect(config('portfolio.certificates'))
            ->sortByDesc('year')
            ->values()
            ->all();

        return view('pages.certificates', [
            'certificates' => $certificates,
        ]);
    }
}
