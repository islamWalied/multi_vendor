<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'slug',
        'status',
    ];

    // this is the local scope
    public function scopeActive(Builder $builder)
    {
        $builder->where('status' , '=', 'active');
    }
    //this is a way to do this
//    public function scopeFilter(Builder $builder, $filter)
//    {
//        if ($filter['name'] ?? false)
//        {
//            $builder->where('name', 'LIKE',"%{$filter['name']}%");
//        }
//        if ($filter['status'] ?? false)
//        {
//            $builder->where('status', '=',$filter['status']);
//        }
//    }

    //there is another way to do filter by when
    public function scopeFilter(Builder $builder, $filter)
    {

        $builder->when($filter['name'] ?? false,function ($builder,$value){
            $builder->where('categories.name', 'LIKE',"%{$value}%");
        });
        $builder->when($filter['status'] ?? false,function ($builder,$value){
            $builder->where('categories.status', '=', $value);
        });
    }

}
