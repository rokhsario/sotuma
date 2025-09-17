<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Media;
use App\Models\PostImage;

class PurgeMediaPosts extends Command
{
    protected $signature = 'posts:purge-media {--force : Run without confirmation prompt}';

    protected $description = 'Delete all media posts and associated media/image files and records';

    public function handle(): int
    {
        if (!$this->option('force') && !$this->confirm('This will delete ALL posts and their media/images. Continue?')) {
            $this->warn('Operation cancelled.');
            return self::SUCCESS;
        }

        $this->info('Starting purge of all media posts...');

        $totalPosts = Post::count();
        $this->info("Found {$totalPosts} post(s).");

        $deletedMediaFiles = 0;
        $deletedImageFiles = 0;
        $deletedPhotos = 0;
        $deletedMediaRecords = 0;
        $deletedImageRecords = 0;

        Post::with(['media', 'images'])->chunkById(200, function ($posts) use (&$deletedMediaFiles, &$deletedImageFiles, &$deletedMediaRecords, &$deletedImageRecords, &$deletedPhotos) {
            foreach ($posts as $post) {
                // Delete files from Media model
                foreach ($post->media as $media) {
                    $fullPath = public_path($media->file_path);
                    if ($media->file_path && file_exists($fullPath)) {
                        @unlink($fullPath);
                        $deletedMediaFiles++;
                    }
                    $media->delete();
                    $deletedMediaRecords++;
                }

                // Delete files from PostImage model
                foreach ($post->images as $image) {
                    $fullPath = public_path($image->image);
                    if ($image->image && file_exists($fullPath)) {
                        @unlink($fullPath);
                        $deletedImageFiles++;
                    }
                    $image->delete();
                    $deletedImageRecords++;
                }

                // Delete legacy main photo if present and not already deleted above
                if ($post->photo) {
                    $photoPath = public_path($post->photo);
                    if (file_exists($photoPath)) {
                        @unlink($photoPath);
                        $deletedPhotos++;
                    }
                }

                // Finally delete the post
                $post->delete();
            }
        });

        $this->info("Deleted media records: {$deletedMediaRecords}, files: {$deletedMediaFiles}");
        $this->info("Deleted image records: {$deletedImageRecords}, files: {$deletedImageFiles}");
        $this->info("Deleted legacy main photos: {$deletedPhotos}");

        $this->info('Purge completed.');
        return self::SUCCESS;
    }
}
