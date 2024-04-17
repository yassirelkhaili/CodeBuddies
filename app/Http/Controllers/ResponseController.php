<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Interfaces\ResponseRepositoryInterface;

class ResponseController extends Controller
{
    protected ResponseRepositoryInterface $responseRepository;
    public function __construct(ResponseRepositoryInterface $responseRepository)
    {
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
        $responses = $this->responseRepository->getResponsesByPost($postId);
        $viewTemplate = $request->ajax() ? "layouts.replies" : "post";
        return view($viewTemplate, ["responses" => $responses])->render();
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
    public function destroy(Response $Response)
    {
        //
    }
}
