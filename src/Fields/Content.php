<?php

namespace Ingor\Fields;

use Illuminate\Database\Eloquent\Model;
use Ingor\Fields\Concerns\DisplayableField;
use Ingor\Fields\Concerns\EditableField;
use Ingor\Contracts\Field\Displayable;
use Ingor\Contracts\Field\Editable;
use Ingor\Field;

class Content extends Field implements Displayable, Editable
{
    use DisplayableField;
    use EditableField;

    /**
     * Render the displayable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\Ingor\Component
     */
    public function renderDisplayable($value, Model $model)
    {
        return $value;
    }

    /**
     * Render the editable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\Ingor\Component
     */
    public function renderEditable($value, Model $model)
    {
        return $value;
    }
}
