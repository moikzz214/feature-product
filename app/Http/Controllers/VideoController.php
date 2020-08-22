<?php

namespace App\Http\Controllers;

use App\Video;

use App\Jobs\OptimizeVideo;
use Illuminate\Http\Request;
use App\Jobs\ConvertVideoForStreaming;
use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForDownloading;

class VideoController extends Controller
{
    public function store(StoreVideoRequest $request)
    {
        $video = Video::create([
            'disk'          => 'videos_disk', // should be a temp disk
            'original_name' => $request->video->getClientOriginalName(),
            'path'          => $request->video->store('/', 'videos_disk'),
            'title'         => $request->title
        ]);

        $this->dispatch(new OptimizeVideo($video));
        // $this->dispatch(new ConvertVideoForStreaming($video));

        return response()->json([
            'id' => $video->id,
            'video' => $request
        ], 201);
    }
}
