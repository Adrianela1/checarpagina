<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Cookie;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/auth")
 */
class AuthController extends AbstractController {

	/**
	 * @Route("", methods={"POST"}, name="post.auth.login");
	 */
	public function login(ManagerRegistry $doctrine, JWTEncoderInterface $JWTEncoder, UrlGeneratorInterface $urlGenerator, Request $request): RedirectResponse {
		try {
			$username = $request->request->get('email');
			$csrfToken = $request->request->get('_csrf_token');
			$referer = $request->request->get('referer');

			if (!isset($username)) {
				return $this->json(["status" => false, "message" => "DATA_NOT_PRESENT"]);
			}

			$user = $doctrine->getRepository(User::class)->findOneBy(["email" => $username]);

			if (!$user) {
				return new RedirectResponse($urlGenerator->generate('app_login', ['error' => 'not_user']));
			}

			if (!$user->getIsEnabled()) {
				return new RedirectResponse($urlGenerator->generate('app_login', ['error' => 'user_disabled']));
			}

			// $isValidPassword = $userPasswordEncoder->isPasswordValid($user, $data->password);

			// if (!$isValidPassword) {
			// 	return $this->json(["status" => false, "message" => "INVALID_PASSWORD"]);
			// }

			$token = $JWTEncoder->encode(["id" => $user->getId(), "email" => $user->getEmail(), "roles" => $user->getRoles()]);

			if ($referer) {
				$response = new RedirectResponse($referer);
			} else {
				$response = new RedirectResponse($urlGenerator->generate('get.home'));
			}

			$response->headers->setCookie(
				Cookie::create(
					"BEARER",
					$token,
					new \DateTime("+33600 second"),
					"/",
					null,
					true,
					true,
					false,
					"lax"
				)
			);
			return $response->send();
		} catch (\Exception $e) {
			return $this->json(["status" => false, "message" => "INTERNAL_ERROR", "error" => $e->getMessage()]);
		}
	}
}