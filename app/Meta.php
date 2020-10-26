<?php

namespace App;

use App\Scopes\StatusScopes\ActiveScope;
use App\Scopes\StatusScopes\DeletedScope;
use Arcanedev\Localization\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property array|string|null theme_id
 * @property array|string|null cat_id
 * @property array|string|null direction_id
 */
class Meta extends Model
{
    use HasTranslations;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
        static::addGlobalScope(new ActiveScope);
    }
    protected $primaryKey = 'id';
    protected $table = 'meta';



    public function MainImage()
    {
        return $this->hasOne('App\Files','route_id','id')->where('route_name','Meta')->orderBy('id','asc');
    }

    public function getTranslatableAttributes()
    {
        return ['title','descr'];
    }
}
