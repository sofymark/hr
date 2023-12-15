<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait BulkActionsTrait
{
    /**
     * Bulk action
     *
     * @param Model $model
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function bulkAction(Model $model)
    {
        if(request()->get('_bulkMethod') && request()->get('_bulkIds'))
        {
            $method = 'bulk' . ucfirst(strtolower(request()->get('_bulkMethod')));

            if( method_exists( $this, $method ) )
            {
                $this->$method( $model, explode( ',', request()->get('_bulkIds') ) );
            }
        }
    }

    /**
     * Bulk Delete
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkDelete(Model $model, array $ids)
    {
        $model->whereIn($model->getKeyName(), $ids)->delete();
    }

    /**
     * Bulk Activate
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkActivate(Model $model, array $ids)
    {
        $model->whereIn($model->getKeyName(), $ids)->update(array('active' => 1));
    }

    /**
     * Bulk Deactivate
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkDeactivate(Model $model, array $ids)
    {
        $model->whereIn($model->getKeyName(), $ids)->update(array('active' => 0));
    }


}