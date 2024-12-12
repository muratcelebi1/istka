<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Comments extends Model
{
    use SoftDeletes;
    protected $fillable = ['book_id', 'comment'];

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }
    protected static function boot(){
    {
        parent::boot();
        static::creating(function ($comment) {
            $comment->uuid = (string) Str::uuid(); 
        });
    }

}
}