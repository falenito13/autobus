<?php

namespace App;

use App\Scopes\StatusScopes\ActiveScope;
use App\Scopes\StatusScopes\DeletedScope;
use Illuminate\Database\Eloquent\Model;

class LocationRelations extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
        static::addGlobalScope(new ActiveScope);
    }
    protected $primaryKey = 'id';
    protected $table = 'location_relations';
    protected $fillable = ['location_from_id', 'location_to_id'];

    public static function rules ($id = '') {
        return [
            'Location_from'  => 'required|integer',
            'Location_to'     => 'required|integer',
            'return_way'     => 'integer',
            'return_x'     => 'required_if:return_way, ==, 1',
            'car.*' => 'required|min:1',
        ];
    }

    public static function attributes ($id = '') {
        return [
            'Location_from'  => \Lang::get('global.loc_from'),
            'Location_to'     => \Lang::get('global.loc_to'),
            'return_way'     => \Lang::get('global.return_way'),
            'return_x'     => \Lang::get('global.return_x'),
            'car.*'     => \Lang::get('global.tr_types'),
        ];
    }

    public static function messages ($id = '') {
        return [
            'Location_from.required'  => \Lang::get('global.loc_from_required'),
            'Location_to.required'    => \Lang::get('global.loc_to_required'),
            'return_x.required_if'     => 'გთხოვთ შეავსოთ დაბრუნების კოეფიციენტი',
            'car.*.required' => \Lang::get('global.tr_types_required'),
        ];
    }

    public function CarPricesByLocation()
    {
        return $this->hasMany('App\LocationPriceRelations', 'location_relations_id', 'id');
    }
}
