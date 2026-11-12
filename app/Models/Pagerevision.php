<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagerevision extends Model
{
    protected $fillable = ['body'];
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

}