<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable =[
        'name',
        'category_id',
        'description',
        'slug',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',

    ];


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
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class, // ralated model
            'product_tag', // pivot table name
            'product_id', // FK in pivot table for the current model
            'tag_id',// FK in pivot table for the related model
            'id', // PK current model
            'id', // PK related model
        );
    }
    public function scopeFilter(Builder $builder, $filter)
    {

        $builder->when($filter['name'] ?? false,function ($builder,$value){
            $builder->where('products.name', 'LIKE',"%{$value}%");
        });
        $builder->when($filter['status'] ?? false,function ($builder,$value){
            $builder->where('products.status', '=', $value);
        });
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status' , '=', 'active');
    }


    public function getImageUrlAttribute()
    {
        if (!$this->image || Str::startsWith($this->image,['C:','D:','E:','F:']))
            return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHICWZcFeQ7UuaU7N30-E4Vt1GaTYIU1DIEA&usqp=CAU.png';
        if (Str::startsWith($this->image,['http://','https://']))
            return $this->image;
        return asset('storage/' . $this->image);
    }


    public function getSalePercentAttribute()
    {
        if (!$this->compare_price)
            return 0;
        return round(100 - (100 * $this->price / $this->compare_price));
    }




}
