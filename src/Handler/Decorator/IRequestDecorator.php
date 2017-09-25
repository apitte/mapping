<?php

namespace Apitte\Mapping\Handler\Decorator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Milan Felix Sulc <sulcmil@gmail.com>
 */
interface IRequestDecorator extends IDecorator
{

	/**
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface $response
	 * @return ResponseInterface|ServerRequestInterface
	 */
	public function decorateRequest(ServerRequestInterface $request, ResponseInterface $response);

}
