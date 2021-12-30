<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'description'];

    /**
     * boot function to delete all ads related with this category
     * @void
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($category){
            $category->ads()->delete();
        });
    }

    /**
     * define relation between ads and categories
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads(){
        return $this->hasMany(Ads::class);
    }
}
