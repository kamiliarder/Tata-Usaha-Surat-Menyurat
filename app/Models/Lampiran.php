<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'tb_lampiran';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'id_lampiran';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_pesan',
        'nama_file',
        'path_file',
    ];

    /**
     * Get the message that owns this attachment.
     */
    public function pesan()
    {
        return $this->belongsTo(Pesan::class, 'id_pesan', 'id_pesan');
    }

    /**
     * Get the full URL for the file.
     */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path_file);
    }

    /**
     * Get the file extension.
     */
    public function getExtensionAttribute(): string
    {
        return pathinfo($this->nama_file, PATHINFO_EXTENSION);
    }

    /**
     * Check if file is an image.
     */
    public function isImage(): bool
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        return in_array(strtolower($this->extension), $imageExtensions);
    }

    /**
     * Check if file is a document.
     */
    public function isDocument(): bool
    {
        $docExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
        return in_array(strtolower($this->extension), $docExtensions);
    }

    /**
     * Get human readable file size.
     */
    public function getFileSizeAttribute(): string
    {
        if (file_exists(storage_path('app/public/' . $this->path_file))) {
            $bytes = filesize(storage_path('app/public/' . $this->path_file));
            $units = ['B', 'KB', 'MB', 'GB'];

            for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }

            return round($bytes, 2) . ' ' . $units[$i];
        }

        return 'Unknown';
    }
}
