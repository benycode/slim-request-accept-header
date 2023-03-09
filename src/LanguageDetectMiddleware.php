<?php

declare(strict_types=1);

namespace BenyCode\Slim\RequestAcceptHeader;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class LanguageDetectMiddleware implements MiddlewareInterface
{
    public function __construct(
        private string $defaultLanguage,
		private array $languageList,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
		$language = $this
			->defaultLanguage
		;
		
		$headerLanguages = $request->getHeader('accept-language');
		
		if(!empty($headerLanguages)){
			$prefLocales = array_reduce(
			  explode(',', $headerLanguages[0]), 
			  function ($res, $el) { 
				list($l, $q) = array_merge(explode(';q=', $el), [1]); 
				$res[$l] = (float) $q; 
				return $res; 
			  }, []);
			arsort($prefLocales);
			
			$language = array_key_first($prefLocales);
		}
		
        $request = $request
            ->withAttribute('accept-language', $language)
		;

        return $handler
            ->handle($request)
		;
    }
}


