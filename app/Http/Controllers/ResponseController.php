<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkAsAnswerRequest;
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
        return view($viewTemplate, ["post" => $post, "responses" => $responses])->render();
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
            $post = $this->postRepository->getById($postId);
            $this->responseRepository->delete($responseId);
            $responses = $this->responseRepository->getResponsesByPost($postId);
            $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
            return view($viewTemplate, ["responses" => $responses, 'post' => $post])->render();
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

    public function upvote(Request $request, string $responseId)
    {
        try {
            $user = auth()->user();
            $response = $this->responseRepository->getById(intval($responseId));
            $existingVote = $response->votes()->where('user_id', $user->id)->where('votable_type', get_class($response))->first();
            if ($existingVote) {
                if ($existingVote->vote_type === "up") {
                    $existingVote->delete();
                    $this->responseRepository->update(intval($responseId), ["votes" => $response->votes - 1]);
                } else {
                    $existingVote->update(["vote_type" => "up"]);
                    $this->responseRepository->update(intval($responseId), ["votes" => $response->votes + 2]);
                }
            } else {
                $response->votes()->create([
                    'user_id' => $user->id,
                    'vote_type' => 'up',
                    'votable_type' => get_class($response),
                    'votable_id' => intval($responseId)
                ]);
                $this->responseRepository->update(intval($responseId), ["votes" => $response->votes + 1]);
            }
            $responses = $this->responseRepository->getResponsesByPost($response->post->id);
            $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
            return view($viewTemplate, ["responses" => $responses])->render();
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'Could not return find response. ErrorCode: ' . $error->getMessage());
        }
    }

    public function downvote(Request $request, int $responseId)
    {
        try {
            $user = auth()->user();
            $response = $this->responseRepository->getById($responseId);
            $existingVote = $response->votes()
                ->where('user_id', $user->id)
                ->where('votable_type', get_class($response))
                ->first();

            if ($existingVote) {
                if ($existingVote->vote_type === "down") {
                    $existingVote->delete();
                    $this->responseRepository->update($responseId, ["votes" => $response->votes + 1]);
                } else {
                    $existingVote->update(["vote_type" => "down"]);
                    $this->responseRepository->update($responseId, ["votes" => $response->votes - 2]);
                }
            } else {
                $response->votes()->create([
                    'user_id' => $user->id,
                    'vote_type' => 'down',
                    'votable_type' => get_class($response),
                    'votable_id' => $responseId
                ]);
                $this->responseRepository->update($responseId, ["votes" => $response->votes - 1]);
            }
            $responses = $this->responseRepository->getResponsesByPost($response->post->id);
            $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
            return view($viewTemplate, ["responses" => $responses])->render();
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'Could not find the response. ErrorCode: ' . $error->getMessage());
        }
    }
}