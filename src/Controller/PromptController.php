<?php

namespace App\Controller;

use App\Entity\Prompt;
use App\Form\PromptType;
use App\Repository\PromptRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class PromptController extends AbstractController
{
    #[Route('/prompt', name: 'app_prompt_index', methods: ['GET'])]
    public function index(PromptRepository $promptRepository): Response
    {
        // TODO: lock this behind a login check
        return $this->render('prompt/index.html.twig', [
            'prompts' => $promptRepository->findAll(),
        ]);
    }

    #[Route('/prompt/new', name: 'app_prompt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prompt = new Prompt();
        $form = $this->createFormBuilder($prompt)
            ->add('text', TextType::class, ['label' => 'what to do'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prompt);
            $entityManager->flush();

            return $this->redirectToRoute('app_prompt_show', ["thanks_for_something" => "new"], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prompt/new.html.twig', [
            'prompt' => $prompt,
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'app_prompt_show', methods: ['GET'])]
    public function show(
        #[MapQueryParameter] ?string $thanks_for_something,
        PromptRepository $promptRepository
    ): Response {
        $todaysPrompt = $promptRepository->findOneBy(
            [
                'use_date' => new DateTime()
            ]
        );
        if (!$todaysPrompt) {
            throw new NotFoundHttpException('No prompt for today');
        }
        return $this->render('prompt/show.html.twig', [
            'prompt' => $todaysPrompt,
            'thanks' => !empty($thanks_for_something)
        ]);
    }

    #[Route('/prompt/{id}/edit', name: 'app_prompt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prompt $prompt, EntityManagerInterface $entityManager): Response
    {
        // TODO: lock this behind a login
        $form = $this->createForm(PromptType::class, $prompt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prompt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prompt/edit.html.twig', [
            'prompt' => $prompt,
            'form' => $form,
        ]);
    }

    #[Route('/prompt/{id}', name: 'app_prompt_delete', methods: ['POST'])]
    public function delete(Request $request, Prompt $prompt, EntityManagerInterface $entityManager): Response
    {
        // TODO: lock this behind a login
        if ($this->isCsrfTokenValid('delete'.$prompt->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($prompt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prompt_index', [], Response::HTTP_SEE_OTHER);
    }
}
