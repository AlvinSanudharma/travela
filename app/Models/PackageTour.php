<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageTour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'location',
        'about',
        'price',
        'days',
        'category_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    function bookings() {
        return $this->hasMany(PackageBooking::class);
    }

    public function package_photos() {
        return $this->hasMany(PackagePhoto::class);
    }
}
