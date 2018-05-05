<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Collection;
use App\Form\EditCollectionType;
use App\Form\AddCollectionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CollectionController extends Controller
{
    /**
     * @Route("/collection", name="collection")
     * @Method("GET")
     */
    public function index(): Response
    {
        $collections = $this->getDoctrine()->getRepository('App:Collection')->findAll();

        $form = $this->createForm(AddCollectionType::class);

        return $this->render('collection/index.html.twig', [
            'collections' => $collections,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/collection/add", name="collection_add")
     * @Method("POST")
     */
    public function add(Request $request): Response
    {
        $collection = new Collection();

        $form = $this->createForm(AddCollectionType::class, $collection);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($collection);
            $entityManager->flush();

            $this->addFlash('success', sprintf('Kolekcja %s została dodana.', $collection->getName()));
        } else {
            $this->addFlash('warning', sprintf('Kolekcja %s nie została dodana.', $collection->getName()));
        }

        return $this->redirectToRoute('collection');
    }

    /**
     * @Route("/collection/edit/{collection}", name="collection_edit", requirements={"collection"="\d+"})
     * @Method("GET|POST")
     */
    public function edit(Request $request, Collection $collection): Response
    {
        $form = $this->createForm(EditCollectionType::class, $collection);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($collection);
            $entityManager->flush();
            $entityManager->flush();

            $this->addFlash('success', sprintf('Kolekcja %s została zedytowana.', $collection->getName()));
        }

        return $this->render('collection/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/collection/remove/{collection}", name="collection_remove", requirements={"collection"="\d+"})
     * @Method("GET")
     */
    public function remove(Collection $collection): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($collection);
        $entityManager->flush();

        return $this->redirectToRoute('collection');
    }
}
