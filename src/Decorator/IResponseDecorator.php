<?php

namespace Apitte\Mapping\Decorator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Milan Felix Sulc <sulcmil@gmail.com>
 */
interface IResponseDecorator extends IDecorator
{

	/**
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface $response
	 * @return ResponseInterface
	 */
	public function decorateResponse(ServerRequestInterface $request, ResponseInterface $response);

}
