<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'tb_pesan';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'id_pesan';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nomor_pesan',
        'judul',
        'perihal',
        'kategori',
        'tipe',
        'tanggal_kirim',
        'pengirim',
        'id_penerima',
        'status_pesan',
        'instansi',
        'kontak_pengirim',
        'alamat_pengirim',
        'id_pesan_terkait',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'tanggal_kirim' => 'datetime',
        ];
    }

    /**
     * Get the user who receives this message.
     */
    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima', 'id_pengguna');
    }

    /**
     * Get the attachments for this message.
     */
    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'id_pesan', 'id_pesan');
    }

    /**
     * Get the related message (for threading).
     */
    public function pesanTerkait()
    {
        return $this->belongsTo(Pesan::class, 'id_pesan_terkait', 'id_pesan');
    }

    /**
     * Get messages that are replies to this message.
     */
    public function balasan()
    {
        return $this->hasMany(Pesan::class, 'id_pesan_terkait', 'id_pesan');
    }

    /**
     * Scope for incoming messages.
     */
    public function scopeMasuk($query)
    {
        return $query->where('tipe', 'masuk');
    }

    /**
     * Scope for outgoing messages.
     */
    public function scopeKeluar($query)
    {
        return $query->where('tipe', 'keluar');
    }

    /**
     * Scope for specific division.
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope for specific status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_pesan', $status);
    }

    /**
     * Check if message is incoming.
     */
    public function isMasuk(): bool
    {
        return $this->tipe === 'masuk';
    }

    /**
     * Check if message is outgoing.
     */
    public function isKeluar(): bool
    {
        return $this->tipe === 'keluar';
    }

    /**
     * Generate unique message number.
     */
    public static function generateNomorPesan(): string
    {
        $year = date('Y');
        $month = date('m');
        $latest = static::whereYear('tanggal_kirim', $year)
            ->whereMonth('tanggal_kirim', $month)
            ->count();

        return sprintf('%s/%s/%04d', $year, $month, $latest + 1);
    }
}
