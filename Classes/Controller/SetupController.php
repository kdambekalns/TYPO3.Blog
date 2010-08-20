<?php
declare(ENCODING = 'utf-8');
namespace F3\Blog\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Blog".                       *
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
 * The setup controller for the Blog package, currently just setting up some
 * data to play with.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SetupController extends \F3\FLOW3\MVC\Controller\ActionController {

	/**
	 * @inject
	 * @var \F3\Blog\Domain\Repository\BlogRepository
	 */
	protected $blogRepository;

	/**
	 * @inject
	 * @var \F3\Blog\Domain\Repository\PostRepository
	 */
	protected $postRepository;

	/**
	 * Index action for this controller
	 *
	 * @return string
	 */
	public function indexAction() {
		$this->blogRepository->removeAll();

		$blog = $this->objectFactory->create('F3\Blog\Domain\Model\Blog');
		$blog->setIdentifier('myblog');
		$blog->setTitle('My Blog');
		$blog->setDescription('A blog about Foo, Bar and Baz.');
		$this->blogRepository->add($blog);

		$post = $this->objectFactory->create('F3\Blog\Domain\Model\Post');
		$post->setAuthor('John Doe');
		$post->setTitle('Example Post');
		$post->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');

		$blog->addPost($post);

		return 'Successfully created a blog';
	}

}

?>