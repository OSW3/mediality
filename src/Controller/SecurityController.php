<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserFormType;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = New Users();

        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setStatus('ROLE_USER');

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);

            $entityManager->flush();

            $this->addFlash('success', 'Votre compte a bien été crée, vous pouvez vous connecter');
            
            return $this->redirectToRoute('login');

        }

        return $this->render('security/register.html.twig', [
            'formRegister' => $form->createView()
        ]);
    }

/**
     * @Route("/login", name="login")
     * @param Request $request
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        
        $form = $this->createFormBuilder()
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            ->add('submit', SubmitType::class, ['label'=>'Connexion', 'attr'=>['class'=>'btn-primary btn btn-block']])
            ->getForm();


        return $this->render('security/login.html.twig', [
            'formLogin' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        
    }
}
