<?php
namespace App\form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class userRegistration extends AbstractType{

    public function buildform(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class)
        ->add('email',EmailType::class)
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
            ->add("FullName", TextType::class)
            ->add(
                "termsAgreed",
                CheckboxType::class,
                ['mapped' => false, 'constraints' => new IsTrue(), 'label' => 'I agree to the terms of service']
            )
            ->add('register', SubmitType::class, [
                'attr' => array('class' => 'btn btn-success float-right')
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class'=>User::class]);
    }
}
