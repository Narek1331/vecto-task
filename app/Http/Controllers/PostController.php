<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * PostController constructor.
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->middleware('auth');
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = $this->postService->getAllPosts();

        return view('post.index',['posts'=>$posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $post = $this->postService->createPost($request->only(['title','content']));

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found.'], Response::HTTP_NOT_FOUND);
        }

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $post = $this->postService->updatePost($id, $request->all());

        if (!$post) {
            return redirect()->back()->with(['error'=>'Post Not Found']);
        }

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $deleted = $this->postService->deletePost($id);

        if (!$deleted) {
            return redirect()->back()->with(['error'=>'Post Not Found']);
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return redirect()->back()->with(['error'=>'Post Not Found']);
        }

        return view('post.edit',['post'=>$post]);
    }
}
