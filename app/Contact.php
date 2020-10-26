<?php

namespace App;

use Arcanedev\Localization\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property array|string|null theme_id
 * @property array|string|null cat_id
 * @property array|string|null direction_id
 */
class Contact extends Model
{
    use HasTranslations;
    protected $primaryKey = 'id';
    protected $table = 'contact';

    public function image()
    {
        return $this->hasMany('App\Files','route_id','id');
    }

    public function MainImage()
    {
        return $this->hasOne('App\Files','route_id','id')->where('route_name','Contact')->orderBy('id','asc');
    }

    public function getTranslatableAttributes()
    {
        return ['address'];
    }
}
