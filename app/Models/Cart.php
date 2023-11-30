<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    // Events
    // creating, created, updating, updated, saving, saved,
    // deleting, deleted, restoring, restored, retrieved

    // These are methods that laravel track so we can do events when create or update or anything
    public static function booted()
    {
        static::observe(CartObserver::class);
        static::addGlobalScope('cookie_id',function (Builder $builder)
        {
            $builder->where('cookie_id','=',Cart::getCookieId());
        });
    }

    // we get it from cart model repository to make a global scope and getting access to cookies
    // we can also put it into service container to access it whenever we want
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id)
        {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id',$cookie_id,30*24*60);
        }
        return $cookie_id;
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
