<?php

namespace Ingor\Contracts\Field;

use Illuminate\Database\Eloquent\Model;

interface Displayable
{
    /**
     * Render the displayable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\Ingor\Component
     */
    public function renderDisplayable($value, Model $model);
}
