<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->middleware('auth')->except(['welcome']);
        $this->postService = $postService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect('/post');
    }

    public function welcome()
    {
        $posts = $this->postService->getAllPosts();
        return view('welcome',['posts'=>$posts]);
    }

}
