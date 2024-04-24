<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Forum;

class mainController extends Controller
{   
    public function indexHome(): View
    {
        $topThreePopularForums = Forum::with([
            'threads.posts.responses'
        ])
        ->get()
        ->each(function ($forum) {
            $forum->total_activity = $forum->threads->reduce(function ($carry, $thread) {
                $postCount = $thread->posts->count();
                $responseCount = $thread->posts->reduce(function ($carry, $post) {
                    return $carry + $post->responses->count();
                }, 0);
                return $carry + $postCount + $responseCount;
            }, 0);
        })
        ->sortByDesc('total_activity')
        ->take(3);
    
        return view('home', ['topThreePopularForums' => $topThreePopularForums]);
    }    
}
