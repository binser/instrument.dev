<?php

namespace Binser\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BinserUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
