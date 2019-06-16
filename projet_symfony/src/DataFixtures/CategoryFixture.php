<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Category;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $names = array(
      	'Développement web',
      	'Développement mobile',
      	'Graphisme',
      	'Intégration',
      	'Réseau'
    	);

    	foreach ($names as $name) {
    		$category = new Category();
    		$category->setName($name);
    		$manager->persist($category);
    	}

        $manager->flush();
    }
}
