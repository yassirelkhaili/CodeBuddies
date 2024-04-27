<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreForumRequest;
use App\Http\Requests\UpdateForumRequest;
use App\Interfaces\ForumRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class ForumController extends Controller
{
    protected ForumRepositoryInterface $forumRepository;
    public function __construct(ForumRepositoryInterface $forumRepository)
    {
        $this->forumRepository = $forumRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $results = $this->forumRepository->getAll();
        return view('forums', ["forums" => $results]);
    }

    public function search(Request $request): View | String
    {
        $searchInput = $request->input('query');
        $results = isset($searchInput) ? $this->forumRepository->search($searchInput) : $this->forumRepository->getAll();
        $viewTemplate = $request->ajax() ? "layouts.forums" : "forums";
        return view($viewTemplate, ["forums" => $results])->render();
    }

    public function fetchForum(int $forumId)
    {
        try {
            $forumDescription = $this->forumRepository->getById($forumId)->description;
            $forumTitle = $this->forumRepository->getById($forumId)->name;
            $forumAvatar = $this->forumRepository->getById($forumId)->avatar;
            return response()->json(["title" => $forumTitle, "content" => $forumDescription, "avatar" => $forumAvatar]);
        } catch (ModelNotFoundException $error) {
            return response()->json("The requested response could not be found. ErrorCode: $error");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreForumRequest $request)
    {
        $description = $request->input("description");
        $title = $request->input('name');
        $avatar = $request->input('avatar');
        $this->forumRepository->create(["name" => $title, "description" => $description, "avatar" => $avatar]);
        $forums = $this->forumRepository->getAll();
        $viewTemplate = $request->ajax() ? "layouts.forums" : "forums";
        return view($viewTemplate, ["forums" => $forums])->render();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View | RedirectResponse
    {
        try {
            $result = $this->forumRepository->getById($id);
            $threads = $result->threads()->orderBy('created_at', 'desc')->paginate(9);
            return view("forum-index")->with(["forum" => $result, "threads" => $threads]);
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'The requested forum could not be found. ErrorCode: ' . $error);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumRequest $request, int $forumId)
    {
        $description = $request->input("description");
        $title = $request->input('name');
        $avatar = $request->input('avatar');
        $this->forumRepository->update($forumId, ["name" => $title, "description" => $description, "avatar" => $avatar]);
        $forums = $this->forumRepository->getAll();
        $viewTemplate = $request->ajax() ? "layouts.forums" : "forums";
        return view($viewTemplate, ["forums" => $forums])->render();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $forumId)
    {
        $this->forumRepository->delete($forumId);
        $forums = $this->forumRepository->getAll();
        $viewTemplate = $request->ajax() ? "layouts.forums" : "forums";
        return view($viewTemplate, ["forums" => $forums])->render();
    }
}
