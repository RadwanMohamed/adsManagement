<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    const FREE = 'free';
    const PAID = 'paid';

    /**
     * @var string[]
     */
    protected $dates = ['start_date'];

    /**
     * @var string[]
     */
    protected $fillable =['title', 'description', 'advertiser', 'start_date', 'type', 'category_id'];

    /**
     * get all available allowed types
     * @return string[]
     */
    public static function getAvailableTypes(): array
    {
        return  [
          self::PAID,
          self::FREE
        ];
    }

    /**
     * define relation between ads and category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * define relation between ads and tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(){
        return $this->belongsToMany(Tag::class,'ads_tags');
    }
}
