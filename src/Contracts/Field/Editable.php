<?php

namespace Ingor\Contracts\Field;

use Illuminate\Database\Eloquent\Model;

interface Editable
{
    /**
     * Render the editable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\Ingor\Component
     */
    public function renderEditable($value, Model $model);
}
