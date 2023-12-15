<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


trait SearchableTrait
{

    /**
     * Creates the filtered scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeSearched(Builder $query)
    {

        $query->addSelect($this->getTable() . '.' . '*');

        $prefix = static::getSearchPrefix();

        session()->forget($prefix . 'has_values');

        foreach ($this->getColumns() as $column => $options)
        {
            $type = strtolower($options['type']);

            switch($type)
            {
                case 'int':
                    $key = static::getSearchColumnKey($column, $prefix);
                    if(session()->has($key) && trim(session($key)) !=='')
                    {
                        $query->where($column, '=', session($key));
                        request()->session()->put($prefix . 'has_values', true);
                    }
                    else
                    {
                        session()->forget($key);
                    }
                    break;

                case 'string':
                    $key = static::getSearchColumnKey($column, $prefix);
                    if(session()->has($key) && trim(session($key)) !=='')
                    {
                        $query->where($column, 'LIKE', '%' . session($key) . '%');
                        request()->session()->put($prefix . 'has_values', true);
                    }
                    else
                    {
                        session()->forget($key);
                    }
                    break;

                case 'date':
                case 'time':
                    $keys['from'] = static::getSearchColumnKey($column, $prefix) . '_from';
                    $keys['to'] = static::getSearchColumnKey($column, $prefix) . '_to';
                    foreach($keys as $rangeKey => $key)
                    {
                        if(session()->has($key) && trim(session($key)) !=='')
                        {
                            $value = $type == 'date' ? Carbon::createFromFormat('d/m/Y', session($key))->toDateString() : session($key);
                            $operator = $rangeKey == 'from' ? '>=' : '<=';
                            $query->where($column, $operator , $value);
                            request()->session()->put($prefix . 'has_values', true);
                        }
                        else
                        {
                            session()->forget($key);
                        }
                    }
                    break;
            }

        }

        $query = $this->makeJoins($query);
        return $this->makeGroupBy($query);
    }


    /**
     * Save search request to session
     */
    public static function search()
    {
        foreach(request()->all() as $key => $value )
        {
            if(strpos($key,'_search_'))
            {
                request()->session()->put($key, $value);
            }
        }
    }

    /**
     * Get search columns
     */
    public static function getSearchableColumns()
    {
        if((new self)->searchable)
        {
            return (new self)->searchable['columns'];
        }
    }


    /**
     * Get search columns
     */
    public static function isInSearchState()
    {
        $key = static::getSearchPrefix() . 'has_values';
        return (session()->has($key) && session($key));
    }

    /**
     * Generate session key per column
     * @param $column
     * @param null $prefix
     * @return mixed
     */
    public static function getSearchColumnKey($column, $prefix = null)
    {
        return (!$prefix) ? strtolower(static::getSearchPrefix() . str_replace('.','_',$column)) : strtolower($prefix . str_replace('.','_',$column));
    }


    /**
     * Get search columns
     * @param Model $model
     * @param array $fields
     * @return
     */
    public static function getLookup($model, array $fields = null)
    {
        if (!$fields)
        {
            return (new $model)->all(['id', 'name'])->toArray();
        }
        return (new $model)->all($fields)->toArray();
    }

    /**
     * Get search prefix
     */
    public static function getSearchPrefix()
    {
        return strtolower((new self)->getTable() . '_search_');
    }


    /**
     * Returns the search columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if (array_key_exists('columns', $this->searchable)) {
            return $this->searchable['columns'];
        } else {
            return DB::connection()->getSchemaBuilder()->getColumnListing($this->table);
        }
    }

    /**
     * Returns the search columns.
     *
     * @return array
     */
    protected function getPrefix()
    {
        return strtolower($this->getTable());
    }

    /**
     * Returns the tables that are to be joined.
     *
     * @return array
     */
    protected function getJoins()
    {
        return array_get($this->searchable, 'joins', []);
    }



    protected function getGroupBy()
    {
        return array_get($this->searchable, 'groupBy', []);
    }


    /**
     * Adds the sql joins to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return Builder
     */
    protected function makeJoins(Builder $query)
    {
        foreach ($this->getJoins() as $table => $keys)
        {
            $query->leftJoin($table, function ($join) use ($keys) {
                $join->on($keys[0], '=', $keys[1]);
                if (array_key_exists(2, $keys) && array_key_exists(3, $keys)) {
                    $join->where($keys[2], '=', $keys[3]);
                }
            });
        }
        return $query;
    }

    /**
     * Adds the group by to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return Builder
     */
    protected function makeGroupBy(Builder $query)
    {
        foreach ($this->getGroupBy() as $groupBy)
        {
            $query->groupBy($groupBy);
        }
        return $query;
    }

}
