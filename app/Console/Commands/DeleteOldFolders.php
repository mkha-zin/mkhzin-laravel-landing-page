<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteOldFolders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-folders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete folders older than one week along with their contents';

    /**
     * Execute the console command.
     *
     * @return void
     */


    public function handle(): void
    {
        logger("Deleting old folders...");
        // Define the directory where folders are stored
        $directory = public_path('offersfiles/zips'); // Modify this path as needed

        // Get all directories inside the given folder
        // Loop through the directories and delete the old ones
        foreach (File::directories($directory) as $dir) {
            $creationDate = Carbon::createFromTimestamp(File::lastModified($dir));

            // Check if the directory is older than 1 week
            if ($creationDate->lt(Carbon::now()->subSecond(5))) {
                // Delete the directory and its contents
                File::deleteDirectory($dir);
                $this->info("Deleted folder: $dir");
            }
        }
    }
}
