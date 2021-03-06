<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumForm;
use App\Repository\GifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends AbstractController
{
    public function show(Album $album, Request $request, GifRepository $gifRepository)
    {
        return $this->render('album/show.html.twig', [
            'album' => $album,
            'gifs' => $album->getGifs()
        ]);
    }

    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $album = new Album();
        $form = $this->createForm(AlbumForm::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $album->setAuthor($this->getUser());

            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('album/create.html.twig', [
            'albumCreateForm' => $form->createView(),
        ]);
    }

    public function update(Album $album, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($album->getAuthor() !== $this->getUser()) {
            return new Response('', Response::HTTP_FORBIDDEN);
        }

        $form = $this->createForm(AlbumForm::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_album_show', ['album' => $album->getId()]);
        }

        return $this->render('album/update.html.twig', [
            'albumUpdateForm' => $form->createView(),
        ]);
    }

    public function delete(Album $album, EntityManagerInterface $entityManager, Request $request): Response {
        $album_id = $request->attributes->get('album');

        $entityManager->find(Album::class, $album_id);
        $entityManager->remove($album);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }
}
