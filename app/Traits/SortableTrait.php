<?php namespace App\Traits;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

trait SortableTrait {

    public function scopeSorted($query, $field = false, $direction = false)
    {
        $field = $this->getSortingField($field);
        $direction = $this->getSortingDirection($direction);

        if(!$this->isSortable($field))
        {
            return $query;
        }

        if($direction !== 'asc' && $direction !== 'desc')
        {
            $direction = 'asc';
        }

        if(!key_exists($field, static::getSortableColumns()))
        {
            return $query;
        }

        return $query->orderBy($field, $direction);
    }

    /**
     * Get sortable columns
     */
    public static function getSortableColumns()
    {
        if((new self)->sortable)
        {
            return (new self)->sortable['columns'];
        }
    }


    /**
     * Returns the user-requested sorting field or the default for this model.
     * If none is set, returns the primary key.
     *
     * @param $field
     * @return string
     * @internal param $defaultField
     */
    public function getSortingField($field)
    {
        if(Request::input('sort'))
        {
            // User is requesting a specific column
            return Request::input('sort');
        }

        if($field)
        {
            return $field;
        }

        return $this->getPrimaryKey();
    }

    /**
     * Returns the default sorting field for this model.
     * If none is set, returns the primary key.
     *
     * @param $direction
     * @return string
     */
    public function getSortingDirection($direction)
    {
        if(Request::input('dir'))
        {
            // User is requesting a specific column
            return Request::input('dir');
        }

        if($direction)
        {
            return $direction;
        }

        return 'asc';

    }


    /**
     * Checks if this column is currently being sorted.
     * @param $field
     * @return bool
     */
    public static function isSorted($field)
    {
        if (Request::input('sort') == $field) {
            return true;
        }

        return false;
    }

    /**
     * Generates a URL to toggle sorting by this column.
     * @param $field
     * @param bool $direction
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public static function getSortURL($field, $direction = false)
    {
        if (!$direction) {
            // No direction indicated, determine automatically from defaults.
            $direction = static::getDirection($field);

            if (static::isSorted($field)) {
                // If we are already sorting by this column, swap the direction
                $direction = $direction == 'asc' ? 'desc' : 'asc';
            }
        }

        // Generate and return a URL which may be used to sort this column
        return static::generateUrl(array_filter([
            'sort'  => $field,
            'dir'   => $direction,
        ]));
    }

    /**
     * Returns the default sorting
     * @param $field
     * @return string
     */
    public static function getDirection($field)
    {
        if (static::isSorted($field)) {
            // If the column is currently being sorted, grab the direction from the query string
            return Request::input('dir');
        }

        return 'asc';
    }

    /**
     * @param $field
     * @return bool
     */
    public static function isSortable($field)
    {
        $columns = static::getSortableColumns();
        if (key_exists( $field, $columns ))
        {
            return (!key_exists('sortable', $columns[$field])) ? true : $columns[$field]['sortable'];
        }
        return false;

    }

    public static function generateUrl($parameters = [])
    {
        // Generate our needed parameters
        $parameters = array_merge(static::getCurrentInput(), $parameters);

        // Grab the current URL
        $path = URL::getRequest()->path();

        return url($path . '/?' . http_build_query($parameters));
    }

    public static function getCurrentInput()
    {
        return Input::only([
            'sort' => Request::input('sort'),
            'dir'  => Request::input('dir'),
        ]);
    }

    /**
     * @param $field
     * @return string
     */
    public static function getLabel($field)
    {
        $columns = static::getSortableColumns();
        if(key_exists( $field, $columns ))
        {
            return $columns[$field]['label'];
        }
        return false;
    }

}

