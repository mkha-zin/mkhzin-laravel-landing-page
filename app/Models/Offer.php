<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ZipArchive;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'branch'
    ];

    protected static function booted()
    {
        static::saved(function ($offer) {
            // Call the extractZip method after the file is saved
            $offer->extractZip($offer->id, $offer->pdf_file);
        });

        // Trigger before update to delete related files
        static::updating(function ($offer) {
            // Call method to delete related files before updating
            $offer->deleteOldRelatedFiles();
        });

    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }


    public function extractZip($id, $pdf_file)
    {
        $zipFilePath = public_path('offersfiles/' . $pdf_file);
        $extractedDirPath = public_path('offersfiles/extrcs/' . $id);

        // Check if the ZIP file exists
        if (Storage::exists($zipFilePath)) {
            $zip = new ZipArchive();

            if ($zip->open($zipFilePath) === TRUE) {
                // Create the extraction directory if it doesn't exist
                if (!file_exists($extractedDirPath)) {
                    if (!mkdir($extractedDirPath, 0755, true) && !is_dir($extractedDirPath)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $extractedDirPath));
                    }
                }

                // Extract all files from the ZIP archive
                $zip->extractTo($extractedDirPath);
                $zip->close();

                // TODO: delete zip file

            }
        }
    }

    /**
     * Delete the old related files before updating the offer
     */
    public function deleteOldRelatedFiles()
    {
        // Get the old file's name, assuming it's a property on the model like $this->old_pdf_file
        $oldPdfFile = $this->getOriginal('pdf_file');  // This gets the old PDF file name (before update)

        // Path to the old ZIP file
        $oldZipFilePath = public_path('offersfiles/' . $oldPdfFile);

        // Path to the old extracted files
        $oldExtractedDirPath = public_path('offersfiles/extrcs/' . $this->id);

        // Check if the old ZIP file exists and delete it
        if (file_exists($oldZipFilePath)) {
            unlink($oldZipFilePath);  // Delete the old ZIP file
        }

        // Check if the old extracted directory exists and delete it
        if (is_dir($oldExtractedDirPath)) {
            // Recursively delete all files and subdirectories
            $this->deleteDirectory($oldExtractedDirPath);
        }
    }

    /**
     * Recursively delete a directory and its contents
     *
     * @param string $dirPath
     */
    private function deleteDirectory($dirPath)
    {
        if (is_dir($dirPath)) {
            $files = array_diff(scandir($dirPath), array('.', '..'));
            foreach ($files as $file) {
                $filePath = $dirPath . DIRECTORY_SEPARATOR . $file;
                if (is_dir($filePath)) {
                    $this->deleteDirectory($filePath); // Recursively delete subdirectories
                } else {
                    unlink($filePath); // Delete file
                }
            }
            rmdir($dirPath); // Remove the directory itself
        }
    }
}
