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
            $file->extractZip($file->id, $file->pdf_file);
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
}
