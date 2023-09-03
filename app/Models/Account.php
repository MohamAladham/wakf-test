<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\Cast\Double;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'balance', 'currency_id', 'number' ];

//    protected $casts = [ 'balance' => Double::class ];


    public static function boot()
    {
        parent::boot();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany( Transaction::class );
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo( Currency::class );
    }

    /**
     * Interact with the user's first name.
     */
    protected function number(): Attribute
    {
        return Attribute::make(
            set: function ( $value ) {
                $currency_code     = $this->currency->code;
                $last_entry_number = Account::latest()->take( 1 )->get()->toArray()[0]['number'] ?? 0;
                $last_entry_number = $last_entry_number ? explode( '-', $last_entry_number )[0] : 1000;
                $last_entry_number++;

                return $last_entry_number . '-' . $currency_code;
            },
        );
    }


}
