<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PromptController extends AbstractController
{
    public function show(): Response
    {
        $prompt = "Make an open-faced sandwich";
        return $this->render('prompt.html.twig', [
            'prompt' => $prompt,
        ]);
    }
}
