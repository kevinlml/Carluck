<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Carsad;
use App\Entity\Carmakers;
use App\Entity\Carmodels;
use App\Entity\Carcategory;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Security\Core\User\User as SymfonyUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface as SymfonyTokenStorageInterface;
use App\Repository\CarsadRepository;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {

    }
    /**
     * @Route("/user/{id}", name="post", requirements={"id":"\d+"}))
     */
    public function show($id, CarsadRepository $carRepository)
    {
        $tests = $carRepository->find($id);

        return $this->render('user/show.html.twig', array('ads' => $tests));
    }
    /**
     * @Route("/user/new", name="new_article")
     * Method({"GET", "POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function new(Request $request, SymfonyTokenStorageInterface $tokenStorage)
    {
        $post = new Carsad();
        $userid = $tokenStorage->getToken()->getUser();
        $form = $this->createFormBuilder()

            ->add('title', TextType::class, array('attr' => ['placeholder' => "Title of the car"]))

            ->add('description', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "Description of the car"]
            ))
            ->add('manufacturer', EntityType::class, ['placeholder' => "Maker  of the car", 'class' => Carmakers::class])
            ->add('model', EntityType::class, ['placeholder' => "Model  of the car", 'class' => Carmodels::class])
            ->add('category', EntityType::class, ['placeholder' => "Category of the car", 'class' => Carcategory::class])
            ->add('status', TextType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "body of car if is used or new"]
            ))
            ->add('pickyear', NumberType::class,[ 'attr' => ['placeholder' => "Year of the car"]])
            ->add('engine', NumberType::class,[ 'attr' => ['placeholder' => "Number of the engine"]])
            ->add('kilometers', NumberType::class,['attr' => ['placeholder' => "Number of Kms"]])
            ->add('cylender', NumberType::class, ['attr' => ['placeholder' => "Number of cylender"]])
            ->add('transmission', TextType::class,['attr' => ['placeholder' => "The type of transmission"]])
            ->add('drivetrain', TextType::class, ['attr' => ['placeholder' => "The type of drivetrain"]])
            ->add('exteriorColor', TextType::class, ['attr' => ['placeholder' => "The color of the car"]])
            ->add('interiorColor', TextType::class, ['attr' => [ 'required' => false, 'placeholder' => "The internal color of car"]])
            ->add('passengers', NumberType::class, ['attr' => ['placeholder' => "Number of passengers"]])
            ->add('doors', NumberType::class, ['attr' => [ 'required' => false, 'placeholder' => "Number of doors"]])
            ->add('fuelType', TextType::class, ['attr' => ['placeholder' => "The type of fuel"]])
            ->add('fuelTank', NumberType::class, ['attr' => ['placeholder' => "Many liters in the tank"]])
            ->add('price', NumberType::class, ['attr' => ['required' => false,'placeholder' => "The price of the car $$"]])
            ->add('oldPrice', NumberType::class, ['attr' =>
             [ 'required' => false,
             'placeholder' => "The old price of the car $$ (not required)"]])
            ->add('features', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "the features of the car"]
            ))
            ->add('otherSpecifications', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "Specifications of the car (not required)"]
            ))
            ->add('safety', TextareaType::class, array(
                'attr' => ['placeholder' => "Safety of the car"]
            ))
            ->add('comfort', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "Comfort of the car (not required)"]
            ))
            ->add('image', FileType::class, array('data_class' => Image::class,'multiple' => true,'label' =>'Please select multiple photos',
             'attr' => ['placeholder' => "image of car"]))
            ->add('save', SubmitType::class, array(
             'label' => 'Create','attr' => array('class' => 'btn btn-primary nt-3')
            ))->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $file */
            $files = $request->files->get('form')['image'];

            foreach ($files as $file) {


                    $image = new Image();
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $image->setNameimage($filename);

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );
                $post->addImage($image);

                $entityManager->persist($image);

            }
            $data = $form->getData();
            $post->setManufacturer($data['manufacturer']);
            $post->setModel($data['model']);
            $post->setCategory($data['category']);
            $post->setStatus($data['status']);
            $post->setYear($data['pickyear']);
            $post->setEngine($data['engine']);
            $post->setKilometres($data['kilometers']);
            $post->setCylender($data['cylender']);
            $post->setTransmission($data['transmission']);
            $post->setDrivertrain($data['drivetrain']);
            $post->setOutcolour($data['exteriorColor']);
            $post->setIncolour($data['interiorColor']);
            $post->setPassengers($data['passengers']);
            $post->setDoors($data['doors']);
            $post->setFueltype($data['fuelType']);
            $post->setFueltank($data['fuelTank']);
            $post->setPrice($data['price']);
            $post->setOldprice($data['oldPrice']);
            $post->setFeatures($data['features']);
            $post->setOtherparams($data['otherSpecifications']);
            $post->setSafety($data['safety']);
            $post->setComfort($data['comfort']);
            $post->setDescription($data['description']);
            $post->setTitle($data['title']);
            $post->setCategory($data['category']);
            $post->setCreatedAt(new \DateTime());
            $post->setUser($userid);
            $entityManager->persist($post);
            $entityManager->flush();



            return $this->redirectToRoute('visitor');
        }

        return $this->render('user/new.html.twig', array('form' => $form->createView()));
    }

    /**
     *@Route("/user/{username}", name="user_posts")
     */
    public function userposts(User $userWithPosts)
    {
        $tests = $this->getDoctrine()->getRepository(Carsad::class)->findBy(['user' => $userWithPosts]);

        return $this->render('user/userPosts.html.twig', array('ads' => $tests));
    }

    /**
     * @Route("/user/edit/{id}", name="edit_article")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id, SymfonyTokenStorageInterface $tokenStorage)
    {
        $post = new Carsad();
        $userid = $tokenStorage->getToken()->getUser();
        $tests = $this->getDoctrine()->getRepository(Carsad::class)->find($id);
        $form = $this->createFormBuilder($tests)
            ->add('title', TextType::class, array('attr' => ['placeholder' => "Title of the car"]))

            ->add('description', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "Description of the car"]
            ))
            ->add('manufacturer', EntityType::class, ['placeholder' => "Maker  of the car", 'class' => Carmakers::class])
            ->add('model', EntityType::class, ['placeholder' => "Model  of the car", 'class' => Carmodels::class])
            ->add('category', EntityType::class, ['placeholder' => "Category of the car", 'class' => Carcategory::class])
            ->add('status', TextType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "body of car if is used or new"]
            ))
            ->add('pickyear', NumberType::class,[ 'attr' => ['placeholder' => "Year of the car"]])
            ->add('engine', NumberType::class,[ 'attr' => ['placeholder' => "Number of the engine"]])
            ->add('kilometers', NumberType::class,['attr' => ['placeholder' => "Number of Kms"]])
            ->add('cylender', NumberType::class, ['attr' => ['placeholder' => "Number of cylender"]])
            ->add('transmission', TextType::class,['attr' => ['placeholder' => "The type of transmission"]])
            ->add('drivetrain', TextType::class, ['attr' => ['placeholder' => "The type of drivetrain"]])
            ->add('exteriorColor', TextType::class, ['attr' => ['placeholder' => "The color of the car"]])
            ->add('interiorColor', TextType::class, ['attr' => [ 'required' => false, 'placeholder' => "The internal color of car"]])
            ->add('passengers', NumberType::class, ['attr' => ['placeholder' => "Number of passengers"]])
            ->add('doors', NumberType::class, ['attr' => [ 'required' => false, 'placeholder' => "Number of doors"]])
            ->add('fuelType', TextType::class, ['attr' => ['placeholder' => "The type of fuel"]])
            ->add('fuelTank', NumberType::class, ['attr' => ['placeholder' => "Many liters in the tank"]])
            ->add('price', NumberType::class, ['attr' => ['required' => false,'placeholder' => "The price of the car $$"]])
            ->add('oldPrice', NumberType::class, ['attr' =>
             [ 'required' => false,
             'placeholder' => "The old price of the car $$ (not required)"]])
            ->add('features', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "the features of the car"]
            ))
            ->add('otherSpecifications', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "Specifications of the car (not required)"]
            ))
            ->add('safety', TextareaType::class, array(
                'attr' => ['placeholder' => "Safety of the car"]
            ))
            ->add('comfort', TextareaType::class, array(
                'required' => false,
                'attr' => ['placeholder' => "Comfort of the car (not required)"]
            ))
            ->add('image', FileType::class, array('data_class' => Image::class,'multiple' => true,'label' =>'Please select multiple photos',
             'attr' => ['placeholder' => "image of car"]))
            ->add('save', SubmitType::class, array(
             'label' => 'Create','attr' => array('class' => 'btn btn-primary nt-3')
            ))->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $file */
            $files = $request->files->get('form')['image'];

            foreach ($files as $file) {


                    $image = new Image();
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $image->setNameimage($filename);

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );
                $post->addImage($image);

                $entityManager->persist($image);

            }
            $data = $form->getData();
            $post->setManufacturer($data['manufacturer']);
            $post->setModel($data['model']);
            $post->setCategory($data['category']);
            $post->setStatus($data['status']);
            $post->setYear($data['pickyear']);
            $post->setEngine($data['engine']);
            $post->setKilometres($data['kilometers']);
            $post->setCylender($data['cylender']);
            $post->setTransmission($data['transmission']);
            $post->setDrivertrain($data['drivetrain']);
            $post->setOutcolour($data['exteriorColor']);
            $post->setIncolour($data['interiorColor']);
            $post->setPassengers($data['passengers']);
            $post->setDoors($data['doors']);
            $post->setFueltype($data['fuelType']);
            $post->setFueltank($data['fuelTank']);
            $post->setPrice($data['price']);
            $post->setOldprice($data['oldPrice']);
            $post->setFeatures($data['features']);
            $post->setOtherparams($data['otherSpecifications']);
            $post->setSafety($data['safety']);
            $post->setComfort($data['comfort']);
            $post->setDescription($data['description']);
            $post->setTitle($data['title']);
            $post->setCategory($data['category']);
            $post->setCreatedAt(new \DateTime());
            $post->setUser($userid);
            $entityManager->persist($post);
            $entityManager->flush();



            return $this->redirectToRoute('visitor');
        }

        return $this->render('user/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/user/delete/{id}")
     * Method({"delete"})
     */
    public function delete(Request $request, $id)
    {
        $tests = $this->getDoctrine()->getRepository(Carsad::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($tests);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }


}


