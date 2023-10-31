<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected static function booted()
    {
        // this is how to make a async function to do a global scope
/*        static::addGlobalScope('store',function (Builder $builder){
            $user = Auth::user();
            if ($user->store_id)
                $builder->where('store_id','=',$user->store_id);
        });*/
        // and this how to make it as a class
        static::addGlobalScope('store',new StoreScope());

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
