<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Media;
use Illuminate\Support\Facades\File;

class FixMediaPaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:fix-paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix media file paths to use direct file system instead of storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing media file paths...');
        
        $mediaRecords = Media::all();
        $fixedCount = 0;
        
        foreach ($mediaRecords as $media) {
            $oldPath = $media->file_path;
            
            // Check if the path is a storage path (starts with uploads/)
            if (strpos($oldPath, 'uploads/') === 0) {
                // Convert storage path to public path
                $newPath = 'images/blog/' . basename($oldPath);
                
                // Check if the file exists in the new location
                $newFullPath = public_path($newPath);
                if (File::exists($newFullPath)) {
                    $media->update(['file_path' => $newPath]);
                    $this->line("Fixed: {$oldPath} -> {$newPath}");
                    $fixedCount++;
                } else {
                    $this->warn("File not found: {$newFullPath}");
                }
            } elseif (strpos($oldPath, 'images/blog/') === 0) {
                $this->line("Already correct: {$oldPath}");
            } else {
                $this->warn("Unknown path format: {$oldPath}");
            }
        }
        
        $this->info("Fixed {$fixedCount} media records");
        
        return 0;
    }
}
