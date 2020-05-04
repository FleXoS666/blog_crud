<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
// use Doctrine\ORM\EntityManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\EntityManagerInterface;
// use Doctrine\ORM\EntityManagerInterface as ORMEntityManagerInterface;

class AppFixtures extends Fixture
{
public function load(ObjectManager $manager)
{
    $faker = \Faker\Factory::create('fr_FR');
    
    for($c = 1; $c <=3; $c++) {
        $category = (new Category);
        $category->setTitle($faker->sentence)
                ->setDescription($faker->paragraph(3));
        
        
        $this->addReference('category'.$c, $category);
        $manager->persist($category);
    }
        for($a = 1; $a <= 20; $a++) {
            $article = (new Article());
            $article->setTitle($faker->sentence)
                    ->setContent($faker->paragraph(6))
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween("-6 months"))
                    ->setIsActive($faker->boolean);
                    // ->setCategory($category);
            /**
             * @var Category $category
             */
            $category= $this->getReference('category'.mt_rand(1,3));
            $article->setCategory($category);
            $this->addReference('article'.$a, $article);
            $manager->persist($article);
            
        }
            for($k = 1; $k <=30; $k++) {
                $comment = (new Comment());
                $comment->setAuthor($faker->name)
                        ->setContent($faker->paragraph(2))
                        ->setCreatedAt($faker->dateTimeBetween("-6 months"));
                        
            $article= $this->getReference('article'.mt_rand(1,20));
            $comment->setArticle($article);

                $manager->persist($comment);
            }
        
    $manager->flush();
}
}