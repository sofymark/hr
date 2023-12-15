<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait BulkActions
{
    /**
     * Bulk action
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function bulkAction(Request $request, Model $model)
    {
        if($request->get('_bulkMethod') && $request->get('selected') && count($request->get('selected')))
        {
            $method = 'bulk' . ucfirst(strtolower($request->get('_bulkMethod')));

            if( method_exists( $this, $method ) )
            {
                $this->$method( $model, $request->get('selected') );
            }
        }
    }


    /**
     * Toggle Status
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkToggleStatus(Model $model, $ids)
    {
        $current = $model->whereIn('id', $ids)->first();
        $current->update(array('active' => $current->active ? 0 : 1) );
    }

    /**
     * Bulk Delete
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkDelete(Model $model, array $ids)
    {
        $model->whereIn('id', $ids)->delete();
    }

    /**
     * Bulk Activate
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkActivate(Model $model, array $ids)
    {
        $model->whereIn('id', $ids)->update(array('active' => 1));
    }

    /**
     * Bulk Deactivate
     *
     * @param Model $model
     * @param array $ids
     */
    protected function bulkDeactivate(Model $model, array $ids)
    {
        $model->whereIn('id', $ids)->update(array('active' => 0));
    }

}