<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lucky/number', name: 'lucky_')]
class LuckyController extends AbstractController
{
    #[Route(path: ['en' => '/notify', 'ru' => '/notify1',], name: 'number_notify')]
    public function numberNotify(): Response
    {
        return new Response('notify number'.rand(0,1000));
    }

    #[Route('/test', name: 'test', priority: 1)]
    public function test(SessionInterface $session)
    {
        if (!$session->get('test')){
            $session->set('test','session data');
        }
        //dd($session->get('test'));
//        dd($this->generateUrl('lucky_number',['selected'=>10]));

      return $this->redirectToRoute('lucky_number',['selected'=>10],301);
    }

    #[Route('/{selected?}',
        name: 'number',
        requirements: ['selected' => '\d+'],
        defaults: ['selected' => 1],
        priority: 2,
        stateless: true)]
    public function number(?int $selected,Request $request): Response
    {
//        dd($request->attributes->get('selected'),$request->query->get('page'));
//        dd($request->server->get('HTTP_HOST'));
//        dd( $request->cookies->get('PHPSESSID'),$request->headers->get('content-type'));
        $number = $selected ?? rand(0, 100);
        $title='test';
        $price=10000;
        return $this->render('lucky/number.html.twig', compact('number','title','price'));
    }

}
