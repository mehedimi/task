<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'date', 'content', 'is_complete'
    ];

    protected $dates = [
        'date'
    ];

    public function setIsCompleteAttribute($status)
    {
        $this->attributes['is_complete'] = $status ? 1: 0;
    }

    public function scopeComplete(Builder $builder)
    {
        $builder->where('is_complete',  1);
    }

    public function scopeInComplete(Builder $builder)
    {
        $builder->where('is_complete',  0);
    }

}
