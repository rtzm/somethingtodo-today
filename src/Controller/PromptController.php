<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PromptController extends AbstractController
{
    public function show(): Response
    {
        // TODO: define prompts and pull from database using entity/repository
        $prompt = "Make an open-faced sandwich";
        return $this->render('prompt.html.twig', [
            'prompt' => $prompt,
        ]);
    }
}
