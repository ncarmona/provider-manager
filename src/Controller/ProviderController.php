<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ProviderType;
use App\Entity\Provider;

class ProviderController extends AbstractController {
    /**
     * @route("/", name="provider_list")
     */
    public function list(): Response {
        return $this->render('providers/list/table.html.twig');
    }
    /**
     * @route("/create", name="provider_create")
     */
    public function create(): Response {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $render_parameters = array('provider_form' => $form->createView());

        return $this->render('providers/form/form.html.twig', $render_parameters);
    }
}
?>