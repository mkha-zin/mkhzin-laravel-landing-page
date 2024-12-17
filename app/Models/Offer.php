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
        static::saved(function ($file) {
            // Call the extractZip method after the file is saved
            $file->extractZip($file->pdf_file);
        });
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }


    public function extractZip($pdf_file)
    {
        $zipFilePath = public_path('offers/' . $pdf_file);
        $extractedDirPath = public_path('offers/extrcs/' . $this->getDirectoryName($zipFilePath));

        // Check if the ZIP file exists
        if (Storage::exists($zipFilePath)) {
            $zip = new ZipArchive();

            if ($zip->open($zipFilePath) === TRUE) {
                // Create the extraction directory if it doesn't exist
                if (!file_exists($extractedDirPath)) {
                    mkdir($extractedDirPath, 0755, true);
                }

                // Extract all files from the ZIP archive
                $zip->extractTo($extractedDirPath);
                $zip->close();

                // Optionally: You can handle file renaming here if needed
                // You can rename files inside the extracted folder if required

                // After extracting, you can optionally delete the ZIP file if no longer needed
//                Storage::delete($zipFilePath);
            }
        }
    }

    public function getDirectoryName($path): string
    {
        $pathParts = explode('/', $path);
        return $pathParts[count($pathParts) - 2];
    }
}
