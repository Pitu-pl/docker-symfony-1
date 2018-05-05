<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Monitor;
use App\Form\AddMonitorType;
use App\Form\EditMonitorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MonitorController extends Controller
{
    /**
     * @Route("/monitor", name="monitor")
     * @Method("GET")
     */
    public function index(): Response
    {
        $monitors = $this->getDoctrine()->getRepository('App:Monitor')->findAll();

        $form = $this->createForm(AddMonitorType::class);

        return $this->render('monitor/index.html.twig', [
            'monitors' => $monitors,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/monitor/add", name="monitor_add")
     * @Method("POST")
     */
    public function add(Request $request): Response
    {
        $monitor = new Monitor();

        $form = $this->createForm(AddMonitorType::class, $monitor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($monitor);
            $entityManager->flush();

            $this->addFlash('success', sprintf('Monitor %s został dodany.', $monitor->getName()));
        } else {
            $this->addFlash('warning', sprintf('Monitor %s nie został dodany.', $monitor->getName()));
        }

        return $this->redirectToRoute('monitor');
    }

    /**
     * @Route("/monitor/edit/{monitor}", name="monitor_edit", requirements={"monitor"="\d+"})
     * @Method("GET|POST")
     */
    public function edit(Request $request, Monitor $monitor): Response
    {
        $form = $this->createForm(EditMonitorType::class, $monitor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($monitor);
            $entityManager->flush();

            $this->addFlash('success', sprintf('Monitor %s został zedytowany.', $monitor->getName()));
        }

        return $this->render('monitor/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/monitor/remove/{monitor}", name="monitor_remove", requirements={"monitor"="\d+"})
     * @Method("GET")
     */
    public function remove(Monitor $monitor): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($monitor);
        $entityManager->flush();

        return $this->redirectToRoute('monitor');
    }
}
