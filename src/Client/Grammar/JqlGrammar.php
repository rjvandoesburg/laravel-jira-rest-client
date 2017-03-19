<?php

namespace Atlassian\JiraRest\Client\Grammar;

use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Query\Builder;

class JqlGrammar extends Grammar
{
    /**
     * The grammar specific operators.
     *
     * @var array
     */
    protected $operators = [];

    /**
     * The components that make up a select clause.
     *
     * @var array
     */
    protected $selectComponents = [
        'wheres',
        'orders',
        'limit',
        'offset'
    ];

    protected $functions = [
        'approved()',
        'approver()',
        'cascadeoption()',
        'closedsprints()',
        'componentsleadbyuser()',
        'currentlogin()',
        'currentuser()',
        'earliestunreleasedversion()',
        'endofday()',
        'endofmonth()',
        'endofweek()',
        'endofyear()',
        'issuehistory()',
        'issueswithremotelinksbyglobalid()',
        'lastlogin()',
        'latestreleasedversion()',
        'linkedissues()',
        'membersof()',
        'myapproval()',
        'mypending()',
        'now()',
        'opensprints()',
        'pending()',
        'pendingby()',
        'projectsleadbyuser()',
        'projectswhereuserhaspermission()',
        'projectswhereuserhasrole()',
        'releasedversions()',
        'standardissuetypes()',
        'startofday()',
        'startofmonth()',
        'startofweek()',
        'startofyear()',
        'subtaskissuetypes()',
        'unreleasedversions()',
        'votedissues()',
        'watchedissues()'
    ];

    protected $reserved = [
        '+',
        '.',
        ',',
        ';',
        '?',
        '|',
        '*',
        '/',
        '%',
        '^',
        '$',
        '#',
        '@',
        '[',
        ']'
    ];

    /**
     * Compile a select query into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return string
     */
    public function compileSelect(Builder $query)
    {
        $original = $query->columns;

        if (is_null($query->columns)) {
            $query->columns = ['*'];
        }

        $jql = trim($this->concatenate($this->compileComponents($query)));

        $query->columns = $original;

        return $jql;
    }

    /**
     * Compile the components necessary for a select clause.
     *
     * @param  Builder $query
     *
     * @return array
     */
    protected function compileComponents(Builder $query)
    {
        $jql = [];
        foreach ($this->selectComponents as $component) {
            // To compile the query, we'll spin through each component of the query and
            // see if that component exists. If it does we'll just call the compiler
            // function for the component which is responsible for making the SQL.
            if (! is_null($query->$component)) {
                $method = 'compile' . ucfirst($component);

                $jql[$component] = $this->$method($query, $query->$component);
            }
        }

        return $jql;
    }

    /**
     * Compile the "where" portions of the query.
     *
     * @param  Builder $query
     *
     * @return string
     */
    protected function compileWheres(Builder $query)
    {
        $jql = [];

        if (is_null($query->wheres)) {
            return '';
        }

        // Each type of where clauses has its own compiler function which is responsible
        // for actually creating the where clauses SQL. This helps keep the code nice
        // and maintainable since each clause has a very small method that it uses.
        foreach ($query->wheres as $where) {
            $method = "where{$where['type']}";

            $jql[] = $where['boolean'] . ' ' . $this->$method($query, $where);
        }

        // If we actually have some where clauses, we will strip off the first boolean
        // operator, which is added by the query builders for convenience so we can
        // avoid checking for the first clauses in each of the compilers methods.
        if (count($jql) > 0) {
            $jql = implode(' ', $jql);

            $conjunction = $query instanceof JoinClause ? 'on' : '';

            return $conjunction . ' ' . $this->removeLeadingBoolean($jql);
        }

        return '';
    }

    /**
     * Compile a nested where clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereNested(Builder $query, $where)
    {
        $nested = $where['query'];

        $offset = $query instanceof JoinClause ? 3 : 6;

        return '(' . substr($this->compileWheres($nested), $offset) . ')';
    }

    /**
     * Compile a where condition with a sub-select.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereSub(Builder $query, $where)
    {
        $select = $this->compileSelect($where['query']);

        return $where['column'] . ' ' . $where['operator'] . " ($select)";
    }

    /**
     * Compile a basic where clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereBasic(Builder $query, $where)
    {
        $value = $this->wrap($where['value']);

        return $where['column'] . ' ' . $where['operator'] . ' ' . $value;
    }

    /**
     * Compile a where clause comparing two columns..
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereColumn(Builder $query, $where)
    {
        $second = $where['second'];

        return $where['first'] . ' ' . $where['operator'] . ' ' . $second;
    }

    /**
     * Compile a "between" where clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereBetween(Builder $query, $where)
    {
        $between = $where['not'] ? 'not between' : 'between';

        return $where['column'] . ' ' . $between . ' ? and ?';
    }

    /**
     * Compile a where exists clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereExists(Builder $query, $where)
    {
        return 'exists (' . $this->compileSelect($where['query']) . ')';
    }

    /**
     * Compile a where exists clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereNotExists(Builder $query, $where)
    {
        return 'not exists (' . $this->compileSelect($where['query']) . ')';
    }

    /**
     * Compile a "where in" clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereIn(Builder $query, $where)
    {
        if (empty($where['values'])) {
            return '0 = 1';
        }

        $values = $this->parameterize($where['values']);

        return $where['column'] . ' in (' . $values . ')';
    }

    /**
     * Compile a "where not in" clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereNotIn(Builder $query, $where)
    {
        if (empty($where['values'])) {
            return '1 = 1';
        }

        $values = $this->parameterize($where['values']);

        return $where['column'] . ' not in (' . $values . ')';
    }

    /**
     * Compile a where in sub-select clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereInSub(Builder $query, $where)
    {
        $select = $this->compileSelect($where['query']);

        return $where['column'] . ' in (' . $select . ')';
    }

    /**
     * Compile a where not in sub-select clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereNotInSub(Builder $query, $where)
    {
        $select = $this->compileSelect($where['query']);

        return $where['column'] . ' not in (' . $select . ')';
    }

    /**
     * Compile a "where null" clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereNull(Builder $query, $where)
    {
        return $where['column'] . ' is null';
    }

    /**
     * Compile a "where not null" clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereNotNull(Builder $query, $where)
    {
        return $where['column'] . ' is not null';
    }

    /**
     * Compile a raw where clause.
     *
     * @param  Builder $query
     * @param  array   $where
     *
     * @return string
     */
    protected function whereRaw(Builder $query, $where)
    {
        return $where['jql'];
    }

    /**
     * Compile the "order by" portions of the query.
     *
     * @param  Builder $query
     * @param  array   $orders
     *
     * @return string
     */
    protected function compileOrders(Builder $query, $orders)
    {
        return 'order by ' . implode(', ', array_map(function ($order) {
                if (isset($order['sql'])) {
                    return $order['sql'];
                }

                return $this->wrap($order['column']) . ' ' . $order['direction'];
            }, $orders));
    }

    /**
     * Compile the "limit" portions of the query.
     *
     * @param  Builder $query
     * @param  int     $limit
     *
     * @return string
     */
    protected function compileLimit(Builder $query, $limit)
    {
        return 'limit ' . (int)$limit;
    }

    /**
     * Compile the "offset" portions of the query.
     *
     * @param  Builder $query
     * @param  int     $offset
     *
     * @return string
     */
    protected function compileOffset(Builder $query, $offset)
    {
        return 'offset ' . (int)$offset;
    }

    /**
     * Compile the "union" queries attached to the main query.
     *
     * @param  Builder $query
     *
     * @return string
     */
    protected function compileUnions(Builder $query)
    {
        $jql = '';

        foreach ($query->unions as $union) {
            $jql .= $this->compileUnion($union);
        }

        if (isset($query->unionOrders)) {
            $jql .= ' ' . $this->compileOrders($query, $query->unionOrders);
        }

        if (isset($query->unionLimit)) {
            $jql .= ' ' . $this->compileLimit($query, $query->unionLimit);
        }

        if (isset($query->unionOffset)) {
            $jql .= ' ' . $this->compileOffset($query, $query->unionOffset);
        }

        return ltrim($jql);
    }

    /**
     * Compile a single union statement.
     *
     * @param  array $union
     *
     * @return string
     */
    protected function compileUnion(array $union)
    {
        $joiner = $union['all'] ? ' union all ' : ' union ';

        return $joiner . $union['query']->toSql();
    }

    /**
     * Concatenate an array of segments, removing empties.
     *
     * @param  array $segments
     *
     * @return string
     */
    protected function concatenate($segments)
    {
        return implode(' ', array_filter($segments, function ($value) {
            return (string)$value !== '';
        }));
    }

    /**
     * Remove the leading boolean from a statement.
     *
     * @param  string $value
     *
     * @return string
     */
    protected function removeLeadingBoolean($value)
    {
        return preg_replace('/and |or /i', '', $value, 1);
    }

    /**
     * Get the grammar specific operators.
     *
     * @return array
     */
    public function getOperators()
    {
        return $this->operators;
    }

    public function wrap($value, $prefixAlias = false)
    {
        if (in_array(strtolower($value), $this->functions)) {
            return $value;
        }

        $escapedReserve = [];
        foreach ($this->reserved as $reserved) {
            $escapedReserve['search'][] = '{('.preg_quote($reserved).')}';
            // really?!
            $escapedReserve['replace'][] = '\\\\\\\\$1';
        }

        $value = preg_replace($escapedReserve['search'], $escapedReserve['replace'], $value);

        return "\"{$value}\"";
    }

    /**
     * Create query parameter place-holders for an array.
     *
     * @param  array $values
     *
     * @return string
     */
    public function parameterize(array $values)
    {
        return implode(', ', array_map([$this, 'parameter'], $values));
    }
}