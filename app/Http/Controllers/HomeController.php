<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\NewsRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $news;
    public function __construct( NewsRepositoryInterface $news)
    {
        $this->middleware('auth');
        //$this->middleware('auth.admin.user');
        $this->news = $news;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sNews = $this->news->All();
        return view('home')
        ->with('news', $sNews);
    }

  
}
