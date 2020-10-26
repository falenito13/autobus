<?php

namespace App;

use App\Scopes\StatusScopes\ActiveScope;
use App\Scopes\StatusScopes\DeletedScope;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
        static::addGlobalScope(new ActiveScope);
    }
    protected $primaryKey = 'id';
    protected $table = 'car';
    public static function rules ($id = '') {
        return [
            'Category'  => 'required|integer',
            'Producer'     => 'required|integer',
        ];
    }

    public static function attributes ($id = '') {
        return [
            'Category'  => \Lang::get('global.Category'),
            'Producer'     => \Lang::get('global.Producer'),
        ];
    }

    public static function messages ($id = '') {
        return [

        ];
    }
    public function MainImage()
    {
        return $this->hasOne('App\Files', 'route_id', 'id')->where('route_name', 'car')->orderBy('id', 'asc');
    }
    public function Images()
    {
        return $this->hasMany('App\Files', 'route_id', 'id')->where('route_name', 'car')->orderBy('id', 'asc');
    }
    public function Producer()
    {
        return $this->hasOne('App\Producer', 'id', 'producer_id');
    }
    public function Category()
    {
        return $this->hasOne('App\Category', 'id', 'cat_id');
    }

}
