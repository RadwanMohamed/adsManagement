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
}
