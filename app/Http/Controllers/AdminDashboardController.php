<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
{
    return view('admin.dashboard', [
        'users_count' => User::count(),
        'posts_count' => Post::count(),
        'comments_count' => Comment::count(),
        'latest_users' => User::latest()->take(5)->get(),
        'users' => User::paginate(10),
        'email' => User::pluck('email'),
    ]);
}
}
