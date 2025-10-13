<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesProfilePictures
{
    /**
     * Upload and store a profile picture.
     */
    public function uploadProfilePicture(UploadedFile $file, ?string $oldFileName = null): string
    {
        // Delete old profile picture if exists
        if ($oldFileName) {
            $this->deleteProfilePicture($oldFileName);
        }

        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $filename = 'profile_' . time() . '_' . Str::random(10) . '.' . $extension;

        // Store the file
        $file->storeAs('public/profile-pictures', $filename);

        return $filename;
    }

    /**
     * Delete a profile picture file.
     */
    public function deleteProfilePicture(string $filename): bool
    {
        return Storage::delete('public/profile-pictures/' . $filename);
    }

    /**
     * Validate profile picture upload.
     */
    public function validateProfilePicture(): array
    {
        return [
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // 2MB max
                'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            ]
        ];
    }

    /**
     * Get validation messages for profile picture.
     */
    public function getProfilePictureValidationMessages(): array
    {
        return [
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Gambar harus berformat: jpeg, png, jpg, atau gif.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
            'profile_picture.dimensions' => 'Dimensi gambar minimal 100x100px dan maksimal 1000x1000px.',
        ];
    }
}
