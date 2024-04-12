<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Http\Requests\StoreForumRequest;
use App\Http\Requests\UpdateForumRequest;
use App\Interfaces\ForumRepositoryInterface;

class ForumController extends Controller
{
    protected ForumRepositoryInterface $forumRepository;
    public function __construct(ForumRepositoryInterface $forumRepository) {
        $this->forumRepository = $forumRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repositories = $this->forumRepository->getAll();
        return view('forums', ["forums" => $repositories]);
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
    public function show(Forum $forum)
    {
        //
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
