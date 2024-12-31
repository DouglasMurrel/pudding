<?php

namespace App\Command;

use App\Entity\Category;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(name: 'my:make:test')]
class TestCommand extends Command {
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $food = new Category();
        $food->setName('Food')->setSlug('food');

        $fruits = new Category();
        $fruits->setName('Fruits')->setSlug('fruits');
        $fruits->setParent($food);
        
        $apples = new Category();
        $apples->setName('Apples')->setSlug('apples');
        $apples->setParent($fruits);

        $vegetables = new Category();
        $vegetables->setName('Vegetables')->setSlug('vegetables');
        $vegetables->setParent($food);

        $carrots = new Category();
        $carrots->setName('Carrots')->setSlug('carrots');
        $carrots->setParent($vegetables);

        $this->em->persist($food);
        $this->em->persist($fruits);
        $this->em->persist($vegetables);
        $this->em->persist($apples);
        $this->em->persist($carrots);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
