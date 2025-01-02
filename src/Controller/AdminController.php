<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpKernel\KernelInterface;


#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(#[CurrentUser] ?User $user, AuthenticationUtils $authenticationUtils): Response
    {
        if ($user) {
            return $this->redirect($this->generateUrl('sonata_admin_redirect'));
        }
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    #[Route(path: '/upload', name: 'upload')]
    public function upload(Request $request, KernelInterface $kernel)
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        $filename = $file->getClientOriginalName();
        $content = $file->getContent();
        $dir = $kernel->getProjectDir() . '/public/img/';
        file_put_contents($dir . $filename, $content);
        $data = ['location'=>'/img/' . $filename];
        return $this->json($data);
    }
}