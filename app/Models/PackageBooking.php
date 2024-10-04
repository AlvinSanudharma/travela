<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'package_tour_id',
        'user_id',
        'quantity',
        'total_amount',
        'insurance',
        'tax',
        'sub_total',
        'start_date',
        'end_date',
        'is_paid',
    ];

    protected function casts() {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function tour() {
        return $this->belongsTo(PackageTour::class);
    }

    public function customer() {
        return $this->belongsTo(User::class);
    }

    public function bank() {
        return $this->belongsTo(PackageBank::class);
    }
}
