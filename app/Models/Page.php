<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    //Convertir [[Title]] a un enllaç a la pàgina corresponent.
    public function renderedBody(): string
    {
        $withLinks = preg_replace_callback('/\[\[(.*?)\]\]/', function ($m) {
            $title = trim($m[1]); //neteja espais que puguin colarse
            $slug = Str::slug($title); //guarda el nom indicat
            //Si la pagina exsteix, redirigeix a la pàgina, si no, redirigeix a la pàgina de creació.
            $url = Page::where('slug', $slug)->exists() ? route('pages.show', $slug) : route('pages.create', ['title' => $title]);
            return "[{title}]($url)";
        }, $this->body);
        return Str::markdown($withLinks, ['html_input' => 'strip', 'allow_unsafe_links' => false]); //Evita html/JS malición
    }
}