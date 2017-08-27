<?php

namespace SAGITERRE\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SAGITERREUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
