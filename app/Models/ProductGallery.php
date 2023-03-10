<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'products_id', 'url', 'is_featured'
    ];

    
    public function getUrlAttribute($url)
    {
        return "http://10.162.1.11:8000" . Storage::url($url);

        // RETURN GALLERY URL LOCAL
        // return config('app.url') . Storage::url($url);

        // UNTUK GALLERY DI SERVER
        // return  Storage::url($url);
    }
}
