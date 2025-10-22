<?php

namespace App\Controller;

use App\Form\FooType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/form', name: 'app_form')]
    public function form(Request $request, #[Autowire(env: 'SYMFONY_TRUSTED_PROXIES')] string $ips): Response
    {
        $form = $this->createForm(FooType::class);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_index', ['form' => 'ok']);
        }

        return $this->render('form.html.twig', [
            'ips' => $ips,
            'form' => $form,
            'errors' => $form->getErrors(),
        ]);
    }
}
