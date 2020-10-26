<?php

namespace App;

use App\Scopes\StatusScopes\ActiveScope;
use App\Scopes\StatusScopes\DeletedScope;
use Arcanedev\Localization\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;


class WhoWeAre extends Model
{
    use HasTranslations;


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
        static::addGlobalScope(new ActiveScope);
    }
    protected $primaryKey = 'id';
    protected $table = 'who_we_are';

    public function MainImage()
    {
        return $this->hasOne('App\Files','route_id','id')->where('route_name','who_we_are')->orderBy('id','asc');
    }
    public function getTranslatableAttributes()
    {
        return ['descr'];
    }

}
