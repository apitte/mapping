<?php

/**
 * Test: Http\ApiRequest
 */

require_once __DIR__ . '/../../bootstrap.php';

use Apitte\Core\Exception\Logical\InvalidStateException;
use Apitte\Core\Http\RequestAttributes;
use Apitte\Core\Schema\Endpoint;
use Apitte\Mapping\Http\ApiRequest;
use Contributte\Psr7\Psr7ServerRequestFactory;
use Ninjify\Nunjuck\Toolkit;
use Tester\Assert;

// Endpoint
Toolkit::test(function () {
	$request = Psr7ServerRequestFactory::fromSuperGlobal();
	$apiRequest = new ApiRequest($request);

	Assert::null($apiRequest->getAttribute(RequestAttributes::ATTR_ENDPOINT, null));

	$endpoint = new Endpoint();
	$request = $request->withAttribute(RequestAttributes::ATTR_ENDPOINT, $endpoint);
	$apiRequest = new ApiRequest($request);

	Assert::type(Endpoint::class, $apiRequest->getAttribute(RequestAttributes::ATTR_ENDPOINT));
	Assert::same($endpoint, $apiRequest->getAttribute(RequestAttributes::ATTR_ENDPOINT));
});

// Parameters
Toolkit::test(function () {
	$request = Psr7ServerRequestFactory::fromSuperGlobal();
	$apiRequest = new ApiRequest($request);

	Assert::false($apiRequest->hasParameter('name'));
	Assert::equal('default', $apiRequest->getParameter('name', 'default'));
	Assert::exception(
		function () use ($apiRequest) {
			$apiRequest->getParameter('name');
		},
		InvalidStateException::class,
		'No parameter "name" found'
	);
	Assert::equal([], $apiRequest->getParameters());

	$request = $request->withAttribute(RequestAttributes::ATTR_PARAMETERS, ['name' => 'John Doe']);
	$apiRequest = new ApiRequest($request);

	Assert::true($apiRequest->hasParameter('name'));
	Assert::equal('John Doe', $apiRequest->getParameter('name'));
	Assert::equal(['name' => 'John Doe'], $apiRequest->getParameters());
	Assert::false($apiRequest->hasParameter('company'));
	Assert::equal('default', $apiRequest->getParameter('company', 'default'));
	Assert::exception(
		function () use ($apiRequest) {
			$apiRequest->getParameter('company');
		},
		InvalidStateException::class,
		'No parameter "company" found'
	);
});
