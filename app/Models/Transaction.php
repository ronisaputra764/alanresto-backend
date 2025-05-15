<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'quantity',
        'total',
        'food_id'
    ];

    public static function generateUniqueId()
    {
        $prefix = "TRX";
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('transaction_id', $randomString)->exist());

        return $randomString;
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }
}
