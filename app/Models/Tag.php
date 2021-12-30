<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'description'];

    /**
     * @var string[]
     */
    protected  $hidden = ['pivot'];


    /**
     * define relation between ads and tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ads()
    {
        return $this->belongsToMany(Ads::class, 'ads_tags');
    }
}
