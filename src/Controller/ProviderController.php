<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProviderController extends AbstractController {
    /**
     * @route("/", name="provider_list")
     */
    public function list(): Response {
        return $this->render('providers/list/table.html.twig');
    }
}
?>