<?php

namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Description of resetPasswordCommand
 *
 * @author murrel
 */
#[AsCommand(name: 'my:make:user')]
class ResetPasswordCommand extends Command {
    protected EntityManagerInterface $em;
    protected UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher) 
    {
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('user',InputArgument::REQUIRED)
            ->addArgument('password',InputArgument::REQUIRED)
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('user');
        $password = $input->getArgument('password');
        
        $user = $this->em->getRepository(User::class)->findOneBy(['name'=>$name]);
        if (!$user) {
            $user = new User();
            $user->setName($name);
        }
        
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        
        $this->em->persist($user);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
