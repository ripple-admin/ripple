<?php

namespace Ingor;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Traits\Macroable;
use Inertia\Inertia;
use Ingor\AbstractComponent;
use Ingor\Concerns\HasDroplet;
use Ingor\Concerns\HasRoute;
use Ingor\Concerns\HasWater;
use Ingor\Contracts\Molecule;

abstract class Page extends AbstractComponent implements Molecule, Responsable
{
    use Macroable;
    use HasWater;
    use HasDroplet;
    use HasRoute;

    /**
     * The page title.
     *
     * @var string
     */
    protected $title;

    /**
     * Handle the page rendering.
     *
     * @return void
     */
    // public function handle()
    // {
    //     //
    // }

    /**
     * Define the page title.
     *
     * @param  string  $title
     * @return $this
     */
    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the page props.
     *
     * @return array
     */
    protected function pageProps(): array
    {
        return [];
    }

    /**
     * Get the page all props.
     *
     * @return array
     */
    public function props()
    {
        return array_merge([
            'title' => $this->title,
        ], $this->pageProps());
    }

    /**
     * Register the current class route.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    // abstract public function registerRoute(Router $router): void;

    /**
     * Get this page fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->droplet->getFields();
    }

    /**
     * Add the page row content.
     *
     * @param  array|\Ingor\Component  $content
     * @return void
     */
    // public function row($content)
    // {
    //     if (is_array($content)) {
    //         //
    //     } elseif ($content instanceof Component) {
    //         //
    //     } else {
    //         throw new InvalidArgumentException(
    //             sprintf('The argument $content must be an instance of %s or array.', Component::class)
    //         );
    //     }

    //     return $this;
    // }

    /**
     * Add the page content.
     *
     * @param  \Ingor\Component  $content
     * @return void
     */
    // public function content(Component $content)
    // {
    //     //

    //     return $this;
    // }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if (method_exists($this, 'handle')) {
            App::call([$this, 'handle']);
        }

        return Inertia::render($this->name(), $this->props())
            ->toResponse($request);
    }
}
