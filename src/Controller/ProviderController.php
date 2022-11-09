<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ProviderType;
use App\Entity\Provider;
use App\Repository\ProviderRepository;

// use App\Controller\Request;
use Symfony\Component\HttpFoundation\Request;

class ProviderController extends AbstractController {
    private $providerRepository;
    public function __construct(ProviderRepository $providerRepository) {
        $this->providerRepository = $providerRepository;
    }
    /**
     * @route("/", name="provider_list")
     */
    public function list(): Response {
        $providers = $this->providerRepository->findAll();
        return $this->render('views/list.html.twig', ['providers' => $providers, 'view_title' => 'providers list']);
    }
    /**
     * @route("/delete/{id}", name="provider_delete")
     */
    public function delete($id): Response {
        $doctrine_manager = $this->getDoctrine()->getManager();
        $providerToDelete = $this->providerRepository->find($id);

        if ($providerToDelete == null) $this->addFlash('error', 'Provider does not exists.');
        else {
            $doctrine_manager->remove($providerToDelete);
            $doctrine_manager->flush();
    
            $this->addFlash('success', 'Provider deleted successfully.');
        }

        return $this->redirectToRoute('provider_list');
    }
    /**
     * @route("/create", name="provider_create")
     */
    public function create(Request $request): Response {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $provider = $form->getData();
            $provider->setCreatedAt(new \Datetime());
            $provider->setUpdatedAt(new \Datetime());
            $doctrine_manager = $this->getDoctrine()->getManager();
            $doctrine_manager->persist($provider);
            $doctrine_manager->flush();

            $this->addFlash('success', 'Provider created successfully.');

            return $this->redirectToRoute('provider_list');
        }
        $render_parameters = array(
            'provider_form' => $form->createView(),
            'form_button_label' => 'Create',
            'view_title' => 'create provider'
        );
        return $this->render('views/providerForm.html.twig', $render_parameters);
    }
    /**
     * @route("/edit/{id}", name="provider_edit")
     */
    public function edit(Request $request, $id): Response {
        $doctrine_manager = $this->getDoctrine()->getManager();
        $fetchedProvider = $this->providerRepository->find($id);

        if ($fetchedProvider == null) {
            $this->addFlash('error', 'Provider does not exists.');
            return $this->redirectToRoute('provider_list');
        }
        
        $form = $this->createForm(ProviderType::class, $fetchedProvider); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $provider = $form->getData();
            $provider->setUpdatedAt(new \Datetime());
            $doctrine_manager = $this->getDoctrine()->getManager();
            $doctrine_manager->persist($provider);
            $doctrine_manager->flush();

            $this->addFlash('success', 'Provider edited successfully.');

            return $this->redirectToRoute('provider_list');
        }
        $render_parameters = array(
            'provider_form' => $form->createView(),
            'form_button_label' => 'Edit',
            'view_title' => 'edit provider'
        );
        return $this->render('views/providerForm.html.twig', $render_parameters);      
    }
}
?>