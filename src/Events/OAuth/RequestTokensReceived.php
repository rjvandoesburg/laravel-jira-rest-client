<?php

namespace Atlassian\JiraRest\Events\OAuth;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class RequestTokensReceived
{

    use Dispatchable, SerializesModels;

    /**
     * @var array
     */
    public $tokens;

    /**
     * RequestTokensReceived constructor.
     *
     * @param array $tokens
     */
    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }
}