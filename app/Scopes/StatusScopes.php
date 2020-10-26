<?php

namespace App\Scopes\StatusScopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DeletedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('status_id', '!=', 2);
    }
}

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('status_id', '=', 1);
    }
}

