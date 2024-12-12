<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Categories extends Model
{
    use SoftDeletes;

     protected $fillable = [ 'id', 'uuid', 'name', 'is_active', 'deleted_at', 'created_at', 'updated_at'];

    public function books(){
        return $this->hasMany(Books::class, 'category_id', 'id');
    }

     protected static function boot(){
        parent::boot();
        static::creating(function($category){
            $category->uuid = (string) Str::uuid();
            $category->slug = self::generateSlug($category->name);
        });

         static::updating(function($category){
             if($category->isDirty('name')){
                 $category->slug = self::generateSlug($category->name);
             }
         });

         static::deleting(function($category){
             $category->books()->delete();
         });
     }

     public static function generateSlug($name){
         $slug = Str::slug($name);
         $count = 1;

         while(self::where('slug', $slug)->exists()){
             $slug = Str::slug($name) . '-' . $count;
             $count++;
         }

         return $slug;
     }
}
