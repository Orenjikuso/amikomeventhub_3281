<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CopyPostersCommand extends Command
{
    protected $signature = 'posters:copy';
    protected $description = 'Copy default poster images from public/assets to storage/posters';

    public function handle()
    {
        $targetDir = storage_path('app/public/posters');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
            $this->info("Created directory: {$targetDir}");
        }

        $mapping = [
            'concert.png' => 'event-1.png',
            'hackathon.png' => 'event-2.png',
            'workshop.png' => 'event-3.png',
        ];

        foreach ($mapping as $source => $target) {
            $sourcePath = public_path("assets/{$source}");
            $targetPath = "{$targetDir}/{$target}";

            if (file_exists($sourcePath)) {
                copy($sourcePath, $targetPath);
                $this->info("Copied {$source} -> posters/{$target}");
            } else {
                $this->error("Source not found: {$sourcePath}");
            }
        }

        $this->info('All poster images copied successfully!');
        return Command::SUCCESS;
    }
}
