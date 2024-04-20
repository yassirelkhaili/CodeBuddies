<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkAsAnswerRequest;
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
     * Show the form for creating a new resource.
     */
    public function mark(MarkAsAnswerRequest $request, int $replyId)
{
    $postId = $request->input('post_id');
    if (!$this->responseRepository::isAnswerMarked($postId)) {
        $this->responseRepository->update($replyId, ["answer" => 1]);
    }
    $responses = $this->responseRepository->getResponsesByPost($postId);
    $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
    return view($viewTemplate, ["responses" => $responses])->render();
}

public function unmark(MarkAsAnswerRequest $request, int $replyId)
{
    $postId = $request->input('post_id');
    $this->responseRepository->update($replyId, ["answer" => 0]);
    $responses = $this->responseRepository->getResponsesByPost($postId);
    $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
    return view($viewTemplate, ["responses" => $responses])->render();
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
    public function show(int $responseId)
    {
        try {
            $responseContent = $this->responseRepository->getById($responseId)->content;
            return response()->json($responseContent);
            } catch (ModelNotFoundException $error) {
                return response()->json("The requested response could not be found. ErrorCode: $error");
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResponseRequest $request, int $replyId)
    {
        $postId = $request->input('post_id');
        $reply = $request->input('reply');
        $this->responseRepository->update($replyId, ["content" => $reply, "post_id" => $postId]);
        $responses = $this->responseRepository->getResponsesByPost($postId);
        $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
        return view($viewTemplate, ["responses" => $responses])->render();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $responseId)
{
    try {
    $postId = $this->responseRepository->getById($responseId)->post->id;
    $this->responseRepository->delete($responseId);
    $responses = $this->responseRepository->getResponsesByPost($postId);
    $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
    return view($viewTemplate, ["responses" => $responses])->render();
    } catch (ModelNotFoundException $error) {
        return redirect()->back()->with('status', 'The requested response could not be found. ErrorCode: ' . $error);
    }
}

public function count(int $postId)
{
    try {
    $responseCount = $this->responseRepository->getResponsesByPost($postId)->count();
    return response()->json($responseCount);
    } catch (ModelNotFoundException $error) {
        return redirect()->back()->with('status', 'Could not return response count. ErrorCode: ' . $error);
    }
}
}