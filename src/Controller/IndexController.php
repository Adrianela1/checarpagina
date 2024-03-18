<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class IndexController extends AbstractController {

	/**
	 * @Route("", methods={"GET"}, name="get.home");
	 */
	public function index(Request $request): Response {
		return $this->render('home/index.twig.html', [
			'seccion' => "Inicio"
		]);
	}

	/**
	 * @Route("/acerca", methods={"GET"}, name="get.home.acerca");
	 */
	public function acerca(Request $request): Response {
		return $this->render('home/acerca.twig.html', [
			'seccion' => "Acerca"
		]);
	}

	/**
	 * @Route("/beneficios", methods={"GET"}, name="get.home.beneficios");
	 */
	public function beneficios(Request $request): Response {
		return $this->render('home/beneficios.twig.html', [
			'seccion' => "Beneficios"
		]);
	}

	/**
	 * @Route("/requisitos", methods={"GET"}, name="get.home.requisitos");
	 */
	public function requisitos(Request $request): Response {
		return $this->render('home/requisitos.twig.html', [
			'seccion' => "Requisitos"
		]);
	}

	/**
	 * @Route("/contacto", methods={"GET"}, name="get.home.contacto");
	 */
	public function contacto(Request $request): Response {
		return $this->render('home/contacto.twig.html', [
			'seccion' => "Contacto"
		]);
	}

	/**
	 * @Route("/calendario_eventos", methods={"GET"}, name="get.home.calendario_eventos");
	 */
	public function calendario_eventos(Request $request): Response {
		return $this->render('home/calendario_eventos.twig.html', [
			'seccion' => "Calendario_eventos"
		]);
	}

}
