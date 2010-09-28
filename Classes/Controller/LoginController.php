<?php
declare(ENCODING = 'utf-8');
namespace F3\Blog\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * A controller which allows for logging into the backend
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class LoginController extends \F3\Blog\Controller\AbstractBaseController {

	/**
	 * @inject
	 * @var \F3\FLOW3\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;

	/**
	 *
	 *
	 * @return string
	 */
	public function indexAction() {

	}

	/**
	 * Authenticates an account by invoking the Provider based Authentication Manager.
	 *
	 * On successful authentication redirects to the list of posts, otherwise returns
	 * to the login screen.
	 *
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function authenticateAction() {
		try {
			$this->authenticationManager->authenticate();
			$this->redirect('index', 'Admin');
		} catch (\F3\FLOW3\Security\Exception\AuthenticationRequiredException $exception) {
			$this->flashMessageContainer->add('Wrong username or password.');
			throw $exception;
		}
	}

	/**
	 *
	 * @return void
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		$this->flashMessageContainer->add('Successfully logged out.');
		$this->redirect('index', 'Post');
	}
}

?>