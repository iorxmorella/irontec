<?php

namespace App\Controller;

use App\Entity\Urls;
use App\Entity\User;
use App\Form\UrlType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @ param $em
     */

    #[Route('/url', name: 'app_url')]
    public function index(Request $request): Response
    {
        // $data["test"] = $this->em->getRepository(Urls::class)->findAll();
        // $data["test"] = $this->em->getRepository(Urls::class)->findUrl();
        $url = new Urls();
        $form = $this->createForm(UrlType::class, $url);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist();
            $this->em->flush();
            return $this->redirectToRoute('app_url');
        }

        return $this->render('url/index.html.twig', [
            'form' => $form
        ]);
    }


    #[Route('/url/insert', name: 'insert_url')]
    public function insert(): Response
    {
        $url = new Urls('test.com');
        $this->em->persist($url);
        $this->em->flush();

        $data["test"] = $this->em->getRepository(Urls::class)->findUrl();
        return $this->render('url/index.html.twig', $data);
    }


    #[Route('/url/update/{id}', name: 'update_url')]
    public function update($id): Response
    {
        $url = $this->em->getRepository(Urls::class)->find($id);
        $url->setUrl("qqq.test2.com");
        $this->em->flush();

        $data["test"] = $this->em->getRepository(Urls::class)->findUrl();
        return $this->render('url/index.html.twig', $data);
    }

    #[Route('/url/remove/{id}', name: 'remove_url')]
    public function remove($id): Response
    {
        $url = $this->em->getRepository(Urls::class)->find($id);
        $this->em->remove($url);
        $this->em->flush();

        $data["test"] = $this->em->getRepository(Urls::class)->findUrl();
        return $this->render('url/index.html.twig', $data);
    }
}
