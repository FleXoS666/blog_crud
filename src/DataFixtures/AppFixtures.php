<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        for($c = 1; $c <=3; $c++) {
            $category = new Category;
            $category->setTitle($faker->sentence)
                    ->setDescription($faker->paragraph(3));
            
            $manager->persist($category);

            for($a = 0; $a <= mt_rand(4, 6); $a++) {
                $article = new Article();
                $article->setTitle($faker->sentence)
                        ->setContent($faker->paragraph(6))
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween("-6 months"))
                        ->setCategory($category);

                $manager->persist($article);
        
                for($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $comment = new Comment();
                    $comment->setAuthor($faker->name)
                            ->setContent($faker->paragraph(2))
                            ->setCreatedAt($faker->dateTimeBetween("-6 months"))
                            ->setArticle($article);
                    
                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }
}