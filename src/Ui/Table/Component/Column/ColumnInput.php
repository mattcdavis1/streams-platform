<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ColumnInput
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\Column
 */
class ColumnInput
{

    /**
     * The resolver utility.
     *
     * @var ColumnResolver
     */
    protected $resolver;

    /**
     * The column normalizer.
     *
     * @var ColumnNormalizer
     */
    protected $normalizer;

    /**
     * Create a new ColumnInput instance.
     *
     * @param ColumnResolver   $resolver
     * @param ColumnNormalizer $normalizer
     */
    public function __construct(ColumnResolver $resolver, ColumnNormalizer $normalizer)
    {
        $this->resolver   = $resolver;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the builder's column input.
     *
     * @param TableBuilder $builder
     */
    public function read(TableBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->normalizer->normalize($builder);
    }
}
