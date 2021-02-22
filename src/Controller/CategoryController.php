<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController {

    /**
     * Finds and displays a category entity
     * 
     * @Route("/category/{slug}/{page}", name="category.show", methods="GET", requirements={"page"="\d+"}))
     * 
     * @param Category $category
     * 
     * @return Response
     */
    public function show(Category $category, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request, int $page = 1) {
        $query = $em->getRepository(Job::class)->getPaginatedActiveJobsByCategoryQuery($category->getId());

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', $page),
            10
        );

        return $this->render('category/show.html.twig', [
                    'category' => $category,
                    'pagination' => $pagination
                ]);
        // TODO: Estilos paginación
    }
}

?>