<?php

namespace Nipponjob\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NipponjobUserBundle extends Bundle
{
public function getParent()
  {
    return 'FOSUserBundle';
  }
    
}
