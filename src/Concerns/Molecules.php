<?php

namespace Ingor\Concerns;

use Ingor\Contracts\Molecule;
use Ingor\Drop;
use Ingor\Water;

trait Molecules
{
    /**
     * Define the molecules.
     *
     * @var array
     */
    protected $molecules = [];

    /**
     * The molecules instance.
     *
     * @var array
     */
    protected $loadedMolecules = [];

    /**
     * Boot the molecules.
     *
     * @return void
     */
    public function bootMolecules()
    {
        foreach ($this->molecules() as $name => $args) {
            list($method, $path, $className) = $args;

            $this->molecule($name, $className)
                ->setRoute($method, $path, is_string($name) ? $name : null);
        }
    }

    /**
     * Merge molecules from other object.
     *
     * @param  object  $class
     * @return void
     */
    public function mergeMolecules($class)
    {
        /** @var \Ingor\Concerns\Molecules $class */
        if (isset(class_uses_recursive($class)[Molecules::class])) {
            $this->loadedMolecules = collect($this->loadedMolecules)
                ->merge($class->loadedMolecules())
                ->unique()
                ->all();
        }
    }

    /**
     * Make a new molecule instance.
     *
     * @param  string  $name
     * @param  string|\Ingor\Contracts\Molecule  $molecule
     * @return \Ingor\Contracts\Molecule
     */
    public function molecule(string $name, $molecule)
    {
        if (! $molecule instanceof Molecule) {
            $molecule = app($molecule);
        }

        /** @var \Ingor\Contracts\Molecule $molecule */
        if ($this instanceof Water)   $molecule->setWater($this);
        if ($this instanceof Drop) $molecule->setDrop($this);

        return $this->loadedMolecules[$name] = $molecule;
    }

    /**
     * Get the loaded molecules instance
     *
     * @return array
     */
    public function loadedMolecules()
    {
        return $this->loadedMolecules;
    }

    /**
     * Define the molecules. Can be overwritten.
     *
     * @return array
     */
    protected function molecules()
    {
        return $this->molecules;
    }
}
