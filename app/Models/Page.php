<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stringable;

class Page extends Model
{
    protected $fillable = ['title', 'body'];

    public function getRouteKeyName(): string
    {
        //En comptes de un id, retorna la url del títol de la pàgina. 
        //Això permet que les rutes utilitzin el slug en lloc de l'id per identificar la pàgina.
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function (Page $page) {
            //Genera un slug a partir del títol de la pàgina abans de crear-la a la base de dades.
            $page->slug = Str($page->title);
        });
    }
    //Cada pagina te moles revisions, retorna la última revisió de la pàgina.
    public function revisions()
    {
        return $this->hasMany(PageRevision::class)->latest();
    }
}