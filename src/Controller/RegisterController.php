<?php

namespace App\Controller;

use App\Entity\User;
use App\form\userRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createFormBuilder()
            ->add('username', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder'=>'username')))
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'required' => true,
                    'first_options'  => ['label' => 'Password'],
                    'second_options' => ['label' => 'Confirm Password']
                ]
            )

            ->add("fullname", TextType::class, array('attr' => ['placeholder' => "Full name"]))
            ->add("email", EmailType::class, array('attr' => ['placeholder' => "email@mail.com"]))
            ->add(
                "termsAgreed",
                CheckboxType::class,
                ['mapped' => false, 'constraints' => new IsTrue(), 'label' => 'I agree to the terms of service']
            )
            ->add('register', SubmitType::class, [
                'attr' => array('class' => 'btn btn-success float-right')
            ])
            ->getForm();;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = new user();
            $user->setUsername($data['username']);
            $user->setPassword($passwordEncoder->encodePassword($user, $data['password']));
            $user->setEmail($data['email']);
            $user->setFullname($data['fullname']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
