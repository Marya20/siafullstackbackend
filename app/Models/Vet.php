<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'pet',
        'gender',
        'breed',
        'vaccine',
        'date'
        
        
    ];

    public function container() {
        return $this->belongsTo('App\Models\Vet', 'name', 'id');
    }
}
