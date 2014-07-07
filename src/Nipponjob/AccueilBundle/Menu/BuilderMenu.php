<?php
// src/Nipponjob/AccueilBundle/Menu/BuilderMenu.php
namespace Nipponjob\AccueilBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class BuilderMenu extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('Principal');

        $menu->addChild('Acceuil', array('uri' => '/'));
        $menu->addChild('Contact', array('uri' => 'contact'));

        return $menu;
    }
}
?>