<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

use App\Entity\Job;
use App\Entity\Category;

/**
 * @Route("/")
 */
class JobController extends AbstractController {

    /**
     * Lists all job entities.
     * 
     * @Route("/", name="job.list")
     * 
     * @return Response
     */
    public function list(EntityManagerInterface $em) : Response {
        $categories = $em->getRepository(Category::class)->findWithActiveJobs();

        return $this->render('job/list.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * Fins and displays a job entity.
     * 
     * @Route("/job/{id}", name="job.show")
     * @Entity("job", expr="repository.findActiveJob(id)")
     * 
     * @param Job $job
     * 
     * @return Response
     */
    public function show(Job $job) : Response {
        return $this->render('job/show.html.twig', [
            'job' => $job
        ]);
    }


}


?>