<?php

namespace ServerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MessageController
 * @package RealtimeBundle\Controller
 *
 * @Route("/message")
 */
class MessageController extends Controller
{
    /**
     * @Route("/new", name="server_new")
     */
    public function indexAction(Request $request)
    {
        $msg = $request->get('msg');

        $pusher = $this->container->get('lopi_pusher.pusher');

        $pusher->trigger(
            'chat',
            'new_message',
            [
                'message' => $msg
            ]
        );

        return new JsonResponse([
            'status' => 'ok'
        ]);
    }
}
