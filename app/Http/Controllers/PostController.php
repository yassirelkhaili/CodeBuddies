<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletePostRequest;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    protected PostRepositoryInterface $postRepository;
    protected ThreadRepositoryInterface $threadRepository;
    public function __construct(PostRepositoryInterface $postRepository, ThreadRepositoryInterface $threadRepository)
    {
        $this->postRepository = $postRepository;
        $this->threadRepository = $threadRepository;
    }

    public function filter(Request $request, int $threadId): View | String
    {
        $filterInput = $request->input('query');
        $results = isset($filterInput)
            ? $this->postRepository->filterByThread($filterInput, $threadId)
            : $this->postRepository->getAllByThread($threadId);
        $thread = $this->threadRepository->getById($threadId);
        $viewTemplate = $request->ajax() ? "layouts.posts" : "forum-index";
        return view($viewTemplate, ["posts" => $results, 'thread' => $thread])->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $threadId = $request->input("thread_id");
        $content = $request->input("content");
        $title = $request->input("title");
        echo ($title);
        $this->postRepository->create(["thread_id" => $threadId, "content" => $content, "title" => $title, "user_id" => auth()->user()->id]);
        $posts = $this->postRepository->getAllByThread($threadId);
        $thread = $this->threadRepository->getById($threadId);
        $viewTemplate = $request->ajax() ? "layouts.posts" : "thread";
        return view($viewTemplate, ["posts" => $posts, "thread" => $thread])->render();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $result = $this->postRepository->getById($id);
            $responses = $result->responses()->orderBy('votes', 'desc')->orderBy('created_at', 'desc')->paginate(9);
            return view("post")->with(["post" => $result, "responses" => $responses]);
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'The requested post could not be found. ErrorCode: ' . $error);
        }
    }

    public function fetchPost(int $responseId)
    {
        try {
            $postContent = $this->postRepository->getById($responseId)->content;
            $postTitle = $this->postRepository->getById($responseId)->title;
            return response()->json(["title" => $postTitle, "content" => $postContent]);
        } catch (ModelNotFoundException $error) {
            return response()->json("The requested response could not be found. ErrorCode: $error");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, int $postId)
    {
        try {
            $content = $request->input("content");
            $title = $request->input("title");
            $post = $this->postRepository->getById($postId);
            $this->postRepository->update($postId, ["content" => $content, "title" => $title]);
            $posts = $this->postRepository->getAllByThread($post->thread->id);
            $thread = $this->threadRepository->getById($post->thread->id);
            $viewTemplate = $request->ajax() ? "layouts.posts" : "thread";
            return view($viewTemplate, ["posts" => $posts, "thread" => $thread])->render();
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'The requested post could not be found. ErrorCode: ' . $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $postId)
    {
        $post = $this->postRepository->getById($postId);
        if ($post->user->id === auth()->user()->id) {
            $this->postRepository->delete($postId);
            $posts = $this->postRepository->getAllByThread($post->thread->id);
            $thread = $this->threadRepository->getById($post->thread->id);
            $viewTemplate = $request->ajax() ? "layouts.posts" : "thread";
            return view($viewTemplate, ["posts" => $posts, "thread" => $thread])->render();
        } else {
            return response()->json(['status' => 'You dont have permission to delete this post'], 401);
        }
    }

    public function upvote(Request $request, $postId)
    {
        try {
            $user = auth()->user();
            $post = $this->postRepository->getById(intval($postId));
            $existingVote = $post->votes()->where('user_id', $user->id)->where('votable_type', get_class($post))->first();

            if ($existingVote) {
                if ($existingVote->vote_type === "up") {
                    $existingVote->delete();
                    $this->postRepository->update(intval($postId), ["votes" => $post->votes - 1]);
                } else {
                    $existingVote->update(["vote_type" => "up"]);
                    $this->postRepository->update(intval($postId), ["votes" => $post->votes + 2]);
                }
            } else {
                $post->votes()->create([
                    'user_id' => $user->id,
                    'vote_type' => 'up',
                    'votable_type' => get_class($post),
                    'votable_id' => intval($postId)
                ]);
                $this->postRepository->update(intval($postId), ["votes" => $post->votes + 1]);
            }
            $newPost = $this->postRepository->getById(intval($postId));
            $viewTemplate = $request->ajax() ? "layouts.votes" : "post";
            return view($viewTemplate, ["post" => $newPost])->render();
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'Could not find post. ErrorCode: ' . $error->getMessage());
        }
    }

    public function downvote(Request $request, $postId)
    {
        try {
            $user = auth()->user();
            $post = $this->postRepository->getById(intval($postId));
            $existingVote = $post->votes()
                ->where('user_id', $user->id)
                ->where('votable_type', get_class($post))
                ->first();

            if ($existingVote) {
                if ($existingVote->vote_type === "down") {
                    $existingVote->delete();
                    $this->postRepository->update(intval($postId), ["votes" => $post->votes + 1]);
                } else {
                    $existingVote->update(["vote_type" => "down"]);
                    $this->postRepository->update(intval($postId), ["votes" => $post->votes - 2]);
                }
            } else {
                $post->votes()->create([
                    'user_id' => $user->id,
                    'vote_type' => 'down',
                    'votable_type' => get_class($post),
                    'votable_id' => intval($postId)
                ]);
                $this->postRepository->update(intval($postId), ["votes" => $post->votes - 1]);
            }
            $newPost = $this->postRepository->getById(intval($postId));
            $viewTemplate = $request->ajax() ? "layouts.votes" : "post";
            return view($viewTemplate, ["post" => $newPost])->render();
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'Could not find post. ErrorCode: ' . $error->getMessage());
        }
    }
}
