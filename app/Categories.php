<?php

namespace App;

use App\Scopes\StatusScopes\DeletedScope;
use Arcanedev\Localization\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed sort_order
 * @property array|string|null parent_id
 * @property int cat_id
 */
class Categories extends Model
{
    use HasTranslations;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DeletedScope);
    }
    public function children(){
        return $this->hasMany( 'App\Categories', 'parent_id', 'cat_id' )
            ->where('status_id','=', 1)
            ->where('parent_id','!=', 0)
            ->orderBy('parent_id')
            ->orderBy('sort_order','asc');
    }
    public function getTranslatableAttributes()
    {
        return ['title'];
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', 1);
    }

    protected $primaryKey = 'cat_id';
    protected $table = 'categories';
    protected $fillable = ['sort_order','title'];
}
