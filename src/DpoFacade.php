<?php

namespace Epmnzava\Dpo;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Epmnzava\Dpo\Skeleton\SkeletonClass
 */
class DpoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dpo';
    }
}
