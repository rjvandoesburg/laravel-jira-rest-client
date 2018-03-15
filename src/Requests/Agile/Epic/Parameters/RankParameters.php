<?php

namespace Atlassian\JiraRest\Requests\Agile\Epic\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class RankParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Epic\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-epic-epicIdOrKey-rank-put
 */
class RankParameters extends AbstractParameters
{
    /**
     * @var string
     */
    public $rankAfterEpic;

    /**
     * @var string
     */
    public $rankBeforeEpic;

    /**
     * @var string
     */
    public $rankCustomFieldId;
}
