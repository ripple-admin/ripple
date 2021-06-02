<?php

namespace Ingor;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Traits\Macroable;
use Ingor\Concerns\HasDroplet;
use Ingor\Concerns\HasRoute;
use Ingor\Concerns\HasWater;
use Ingor\Contracts\Molecule;
use Lorisleiva\Actions\Concerns\AsAction;

abstract class Action implements Molecule, Responsable
{
    use Macroable;
    use AsAction;
    use HasWater;
    use HasDroplet;
    use HasRoute;

    /**
     * Create a new redirect response to the current request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if (method_exists($this, 'handle')) {
            $response = App::call([$this, 'handle']);
        }

        return $response ?? back();
    }
}
