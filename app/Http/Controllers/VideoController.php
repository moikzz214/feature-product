<?php

namespace App\Http\Controllers;


use App\Media_file;
use App\Jobs\OptimizeVideo;
use Illuminate\Http\Request;

use FFMpeg\Format\Video\X264;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\VideoFilters;
use App\Http\Requests\StoreVideoRequest;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoController extends Controller
{
    public function store(StoreVideoRequest $request)
    {
        $userId = auth()->id();
        $itemImages = array();

        // Upload to temp disk
        $video = Media_file::create([
            'user'          => auth()->id(),
            'file_type'     => 'video',
            'title'         => $request->title,
            'original_name' => $request->video->getClientOriginalName(),
            'disk'          => 'temp_uploads',
            'path'          => $request->video->store('/', 'temp_uploads'),
        ]);

        // Optimize Video and Extract Frames
        // $this->dispatch(new OptimizeVideo($video));

        // Generate a thumbnail
        FFMpeg::fromDisk($video->disk)
        ->open($video->path)
        ->getFrameFromSeconds(1)
        ->export()
        ->toDisk('uploads')
        ->save("/user-{$userId}/{$request->product}/{$video->title}_{$video->id}_thumbnail.jpeg");

        // Get frames
        $mediaOpener = FFMpeg::fromDisk($video->disk)->open($video->path);
        $mediaDuration = $mediaOpener->getDurationInSeconds();
        foreach (range(0, $mediaDuration, 1) as $key => $seconds) {

            // Prepare array of images to be save in Media_files table
            Media_file::create([
                'user'          => auth()->id(),
                'file_type'     => 'image',
                'title'         => "{$video->title}_{$video->id}_{$key}",
                'original_name' => $video->title,
                'disk'          => 'uploads',
                'path'          => "{$video->title}_{$video->id}_{$key}.jpeg",
            ]);

            // Extract Frames
            $mediaOpener = $mediaOpener->getFrameFromSeconds($seconds)
                ->export()
                ->toDisk('uploads')
                ->save("/user-{$userId}/{$request->product}/{$video->title}_{$video->id}_{$key}.jpeg");
        }

        // Save frames to Media_files table as image
        // dd($request);
        // Media_file::create([
        //     'user'          => $itemImages['user'],
        //     'file_type'     => $itemImages['file_type'],
        //     'title'         => $itemImages['title'],
        //     'original_name' => $itemImages['original_name'],
        //     'disk'          => $itemImages['disk'],
        //     'path'          => $itemImages['path'],
        // ]);

        // Save frames to Items Table
        // Item::create([
        //     'item_type' => 'exterior',
        //     'product' => $request->product,
        //     'file'     => $video->t
        // ]);

        // Clean Temp Folder
        FFMpeg::cleanupTemporaryFiles();

        // return response
        return response()->json([
            'id' => $video->id,
            'video' => $request
        ], 201);
    }
}
