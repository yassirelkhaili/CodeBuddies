<?php

namespace App\Http\Controllers;

use App\Models\Forum;
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
        echo "accessed";
        $searchInput = $request->input('query');
        $results = isset($searchInput) ? $this->forumRepository->search($searchInput) : $this->forumRepository->getAll();
        $viewTemplate = $request->ajax() ? "layouts.forums" : "forums";
        return view($viewTemplate, ["forums" => $results])->render();
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
    public function store(StoreForumRequest $request)
    {
        //
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
            echo "hello";
            return redirect()->back()->with('status', 'The requested forum could not be found. ErrorCode: ' . $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumRequest $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        //
    }
}
