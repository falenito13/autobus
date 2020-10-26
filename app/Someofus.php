<?php

namespace App;

use App\Scopes\StatusScopes\ActiveScope;
use App\Scopes\StatusScopes\DeletedScope;
use Arcanedev\Localization\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Someofus extends Model
{
    use HasTranslations;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
        static::addGlobalScope(new ActiveScope);
    }
    protected $primaryKey = 'id';
    protected $table = 'someofus';

    public function MainImage()
    {
        return $this->hasOne('App\Files', 'route_id', 'id')->where('route_name', 'someofus')->orderBy('id', 'asc');
    }

    public function getTranslatableAttributes()
    {
        return ['title','descr'];
    }
}
