<?php

declare(strict_types=1);

namespace Src\BoundedContext\Urls\Domain\ValueObjects;

use Illuminate\Support\Facades\Response;
use InvalidArgumentException;

final class FormattedUrl
{
    private $value;

    /**
     * FormattedUrl constructor.
     * @param string $url
     * @throws InvalidArgumentException
     */
    public function __construct(string $url)
    {
        $this->validate($url);
        $this->value = $url;
        
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     */
    private function validate(string $url): void
    {   // Verficar si es una url valida si no devuelve un error
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid url: <%s>.', static::class, $url)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function formatUrlToJson()
    {   
        return Response::json(['url' => $this->value]);
    }
}