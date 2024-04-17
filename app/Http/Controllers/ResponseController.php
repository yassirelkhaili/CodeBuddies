<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ResponseRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResponseController extends Controller
{
    protected ResponseRepositoryInterface $responseRepository;
    protected PostRepositoryInterface $postRepository;
    public function __construct(ResponseRepositoryInterface $responseRepository, PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->responseRepository = $responseRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResponseRequest $request)
    {
        $reply = $request->input('reply');
        $postId = $request->input('post_id');
        $this->responseRepository->create([
            "content" => $reply,
            "user_id" => auth()->user()->id,
            "post_id" => $postId
        ]);
        $post = $this->postRepository->getById($postId);
        $responses = $this->responseRepository->getResponsesByPost($postId);
        $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
        return view($viewTemplate, ["post" => $post,"responses" => $responses])->render();
     }

    /**
     * Display the specified resource.
     */
    public function show(Response $Response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $Response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResponseRequest $request, Response $Response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $responseId)
{
    try {
    $response = $this->responseRepository->getById($responseId);
    $response->delete();
    $responses = $this->responseRepository->getResponsesByPost($response->id);
    $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
    return view($viewTemplate, ["responses" => $responses])->render();
    } catch (ModelNotFoundException $error) {
        return redirect()->back()->with('status', 'The requested response could not be found. ErrorCode: ' . $error);
    }
}
}