<?php

namespace Atlassian\JiraRest\Requests\Middleware;

use Psr\Http\Message\RequestInterface;

class ImpersonateMiddleware
{
    /**
     * @var string
     */
    protected $userId;

    /**
     * ImpersonnateMiddleware constructor.
     *
     * @param string $userId
     */
    function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $queryparams = \GuzzleHttp\Psr7\parse_query($request->getUri()->getQuery());
            $query = \GuzzleHttp\Psr7\build_query(["user_id" => $this->userId] + $queryparams);

            return $handler($request->withUri($request->getUri()->withQuery($query)), $options);
        };
    }
}
