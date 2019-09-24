<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\carsad;
use App\Entity\Carcategory;
use App\Repository\CarsadRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VisitorController extends AbstractController
{
    /**
     * @Route("/visitor", name="visitor")
     */
    public function index()
    {   $conn = $this->getDoctrine()->getEntityManager()
            ->getConnection();
        $sql = "SELECT image_carsad.image_id, image_carsad.carsad_id, image.id AS Expr1, image.nameimage, carsad.id, carsad.title, carsad.status
                    FROM     carsad INNER JOIN
                        image_carsad ON carsad.id = image_carsad.carsad_id INNER JOIN
                        image ON image_carsad.image_id = image.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $this->render('Visitor/index.html.twig', array('articles' => $stmt->fetchAll()));
    }

    /**
     *@Route("/visitor/search/{id}", name="user_posts")
     */
    public function userposts($id)
    {
        $conn = $this->getDoctrine()->getEntityManager()
            ->getConnection();
        $sql = "SELECT carsad.title, carsad.oldprice, carsad.price, carsad.category_id, image.nameimage, carsad.description, carsad.created_at
                FROM     carsad INNER JOIN
                                image ON carsad.id = image.id
                WHERE  carsad.category_id ='.$id.'";
         $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $this->render('Visitor/SearchCategory.html.twig', array('ads' => $stmt->fetchAll()));
    }
}
