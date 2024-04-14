<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Interfaces\ThreadRepositoryInterface;

class ThreadController extends Controller
{
    protected ThreadRepositoryInterface $threadRepository;
    public function __construct(ThreadRepositoryInterface $threadRepository) {
        $this->threadRepository = $threadRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $results = $this->threadRepository->getAll();
        return view('threads', ["threads" => $results]);
    }

    public function filter(Request $request): View | String
    {
        $filterInput = $request->input('query');
        if ($request->ajax() && isset($filterInput)) {
            $results = $this->threadRepository->filter($filterInput);
            return view("layouts.threads", ["threads" => $results])->render();
        } else {
            $results = $this->threadRepository->getAll();
            return view("layouts.threads", ["threads" => $results]);
        }
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
    public function store(StoreThreadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
