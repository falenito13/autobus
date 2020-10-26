<?php

namespace App;

use App\Scopes\StatusScopes\ActiveScope;
use App\Scopes\StatusScopes\DeletedScope;
use Illuminate\Database\Eloquent\Model;

class TourPriceRelations extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
        static::addGlobalScope(new ActiveScope);
    }
    protected $primaryKey = 'id';
    protected $table = 'tour_price_relations';
}
