<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable =[
        'category_id',
        'name',
        'city',
        'slug',
        'images',
        'number_of_rooms',
        'number_of_bedrooms',
        'number_of_bathrooms',
        'price_per_month',
        'description',
        'cctv_available',
        'borehore_avalable',
        'parking_available',
        'internet_connection',
        'solar_system',
        'swimming_pool',
    ];

    protected $casts = [
        'images' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
