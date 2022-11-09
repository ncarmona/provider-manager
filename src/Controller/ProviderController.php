<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ProviderType;
use App\Entity\Provider;
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
        return $this->render('providers/list/table.html.twig', ['providers' => $providers]);
    }
    }
    /**
     * @route("/create", name="provider_create")
     */
    public function create(Request $request): Response {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider); 
        $render_parameters = array('provider_form' => $form->createView());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $provider = $form->getData();
            $doctrine_manager = $this->getDoctrine()->getManager();
            $doctrine_manager->persist($provider);
            $doctrine_manager->flush();

            return $this->redirectToRoute('provider_list');
        }
        return $this->render('providers/form/form.html.twig', $render_parameters);
    }
}
?>