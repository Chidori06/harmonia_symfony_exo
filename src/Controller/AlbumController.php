<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class AlbumController extends AbstractController
{
    #[Route('/album/{id}', name: 'app_album_item')]
    public function item($id, AlbumRepository $albumRepository): Response
    {
        $album = $albumRepository->find($id);
        if ($album === null) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('album/item.html.twig', [
            'album' => $album

        ]);
    }

    #[Route('/add-album/{id}', name: 'app_album_add')]
    public function addAlbum(Artist $artist, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $album = new Album();

        $form = $this->createForm(AlbumType::class, $album);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $coverFile = $form->get('cover')->getData();

            $originalFilename = pathinfo(
                $coverFile->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $coverFile->guessExtension();
            $coverFile->move(
                $this->getParameter('kernel.project_dir') . '/public/uploads',
                $newFilename
            );
            $album->setCover('uploads/' . $newFilename);

            $album->setArtist($artist);
            $album->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('app_album_item', [
                'id' => $album->getId()
            ]);
        }

        return $this->render('album/add.html.twig', [
            'albumForm' => $form->createView(),
            'artist' => $artist,
        ]);
    }

    #[Route('/edit-album/{id}', name: 'app_album_edit')]
    public function editAlbum(Album $album, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {

        $form = $this->createForm(AlbumType::class, $album);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $album = $form->getData();

            $coverFile = $form->get('cover')->getData();
            if ($coverFile) {
                $oldCover = $album->getCover();
                $originalFilename = pathinfo(
                    $coverFile->getClientOriginalName(),
                    PATHINFO_FILENAME
                );

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $coverFile->guessExtension();
                $uploadDirectory = $this->getParameter('kernel.project_dir')
                    . '/public/uploads';

                $coverFile->move(
                    $uploadDirectory,
                    $newFilename
                );

                $album->setCover('uploads/' . $newFilename);


                if ($oldCover) {
                    $oldCoverPath = $this->getParameter('kernel.project_dir')
                        . '/public/'
                        . $oldCover;
                    if (file_exists($oldCoverPath)) {
                        unlink($oldCoverPath);
                    }
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_album_item', [
                'id' => $album->getId()
            ]);
        }

        return $this->render('album/edit.html.twig', [
            'albumForm' => $form->createView(),
            'album' => $album
        ]);
    }


}
