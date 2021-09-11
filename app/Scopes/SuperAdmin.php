<?php

namespace App\Scopes;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SuperAdmin implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $auth = Helper::getAuth();
        if ($auth && $auth->name != config('app.super_admin_name')) {
            $builder->where('name', '!=', 'SuperAdmin');
        }
    }
}
