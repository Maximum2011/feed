<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getPosts();
        return $posts;
    }
}
