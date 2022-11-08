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
        return new Response(
            '<html><body>List of all providers</body></html>'
        );
    }
}
?>