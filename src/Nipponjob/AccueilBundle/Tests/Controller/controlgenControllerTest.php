<?php

namespace Nipponjob\AccueilBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class controlgenControllerTest extends WebTestCase
{
    public function testUn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/genun');
    }

}
