<?php

namespace App\Jobs;

use App\Video;
// use Carbon\Carbon;
// use FFMpeg;
// use FFMpeg\Coordinate\Dimension;
// use FFMpeg\Format\Video\X264;
// use FFMpeg\Filters\Video\VideoFilters;

// use FFMpeg\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use FFMpeg\Filters\Video\VideoFilters;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OptimizeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->video->path);
        // Optimize video
        // FFMpeg::fromDisk($this->video->disk)
        //     ->open($this->video->path)
        //     ->addFilter(function (VideoFilters $filters) {
        //         $filters->resize(new \FFMpeg\Coordinate\Dimension(1280, 720));
        //     })
        //     ->export()
        //     ->toDisk('optimized_videos')
        //     ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
        //     ->save($this->video->path);

        // Get frames
        $mediaOpener = FFMpeg::fromDisk($this->video->disk)->open($this->video->path);

        $mediaDuration = $mediaOpener->getDurationInSeconds();
        foreach (range(0, $mediaDuration, 1) as $key => $seconds) {
            $mediaOpener = $mediaOpener->getFrameFromSeconds($seconds)
                ->export()
                ->onProgress(function ($percentage, $remaining, $rate) {
                    echo "{$remaining} seconds left at rate: {$rate}";
                })
                ->toDisk('360_images')
                ->save("{$this->video->title}_{$this->video->id}_{$key}.jpeg");
        }
        // Get 1 frame
        // FFMpeg::fromDisk($this->video->disk)
        //     ->open($this->video->path)
        //     ->getFrameFromSeconds(1)
        //     ->export()
        //     ->toDisk('360_images')
        //     ->save('FrameAt10sec.png');
    }
}
