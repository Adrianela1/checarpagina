<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/socios/ondemand")
 */
class OndemandController extends AbstractController {

	/**
	 * @Route("/eventos_anteriores", methods={"GET"}, name="get.socios.ondemand.eventos_anteriores");
	 */
	public function eventos(Request $request): Response {
		return $this->render('socios/ondemand/eventos_anteriores.twig.html', [
			'seccion' => "Eventos_Anteriores"
		]);
	}

	/**
	 * @Route("/eventos_anteriores/evento_12_03_22", methods={"GET"}, name="get.socios.ondemand.evento_12_03_22");
	 */
	public function evento_12_03_22(Request $request): Response {
		return $this->render('socios/ondemand/evento_12_03_22.twig.html', [
			'seccion' => "Evento_12_03_22"
		]);
	}
}
