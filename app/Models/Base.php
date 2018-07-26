<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function scopeLimitBy($query, $limit)
    {
        if (!is_array($limit))
        {
            return $query->limit($limit);
        }
        return $query->offset($limit[0])->limit($limit[1]);
    }

    public function scopeSortBy($query, $orderBys)
    {
        foreach ($orderBys as $key => $orderBy)
        {
            $query->orderBy($key, $orderBy);
        }
        return $query;
    }
}
