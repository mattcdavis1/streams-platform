<?php namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Presenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class EloquentCriteria
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Model
 */
class EloquentCriteria
{

    use DispatchesJobs;

    /**
     * Safe builder methods.
     *
     * @var array
     */
    private $safe = [
        'where',
        'orWhere',
        'andWhere',
        'orderBy',
        'limit',
        'with',
        'skip',
        'take'
    ];

    /**
     * The query builder.
     *
     * @var Builder|\Illuminate\Database\Query\Builder
     */
    protected $query;

    /**
     * Set the get method.
     *
     * @var string
     */
    protected $method;

    /**
     * Create a new EntryCriteria instance.
     *
     * @param Builder $query
     * @param string  $method
     */
    public function __construct(Builder $query, $method = 'get')
    {
        $this->query  = $query;
        $this->method = $method;
    }

    /**
     * Get the entries.
     *
     * @param array $columns
     * @return Collection|Presenter
     */
    public function get(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->{$this->method}($columns));
    }

    /**
     * Find an entry.
     *
     * @param       $identifier
     * @param array $columns
     * @return Presenter
     */
    public function find($identifier, array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->find($identifier, $columns));
    }

    /**
     * Find an entry by column value.
     *
     * @param       $column
     * @param       $value
     * @param array $columns
     * @return Presenter
     */
    public function findBy($column, $value, array $columns = ['*'])
    {
        $this->query->where($column, $value);

        return (new Decorator())->decorate($this->query->first($columns));
    }

    /**
     * Return the first entry.
     *
     * @param array $columns
     * @return Presenter
     */
    public function first(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->first($columns));
    }

    /**
     * Return whether the method is safe or not.
     *
     * @param $name
     * @return bool
     */
    protected function methodIsSafe($name)
    {
        return (in_array($name, $this->safe));
    }

    /**
     * Route through __call.
     *
     * @param $name
     * @return Builder|null
     */
    function __get($name)
    {
        return $this->__call($name, []);
    }

    /**
     * Call the method on the query.
     *
     * @param $name
     * @param $arguments
     * @return Builder|null
     */
    function __call($name, $arguments)
    {
        if ($this->methodIsSafe($name)) {

            call_user_func_array([$this->query, $name], $arguments);
        }

        if (starts_with($name, 'findBy') && $column = snake_case(substr($name, 6))) {

            call_user_func_array([$this->query, 'where'], array_merge([$column], $arguments));

            return $this->first();
        }

        if (starts_with($name, 'where') && $column = snake_case(substr($name, 5))) {
            call_user_func_array([$this->query, 'where'], array_merge([$column], $arguments));
        }

        return $this;
    }
}
