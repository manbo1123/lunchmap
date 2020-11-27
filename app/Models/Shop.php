<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Shop extends Model
{
    use HasFactory;
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // Enumクラスの自動キャスト
    protected $enumCasts = [
        'status' => Status::class,
    ];

}
