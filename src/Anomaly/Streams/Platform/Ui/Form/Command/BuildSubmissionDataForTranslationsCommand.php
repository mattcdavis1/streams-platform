<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\Form;

/**
 * Class BuildSubmissionDataForTranslationsCommand
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Command
 */
class BuildSubmissionDataForTranslationsCommand
{

    /**
     * The form object.
     *
     * @var \Anomaly\Streams\Platform\Ui\Form\Form
     */
    protected $form;

    /**
     * Create a new BuildSubmissionDataForTranslationsCommand instance.
     *
     * @param Form $form
     */
    function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Get the form object.
     *
     * @return \Anomaly\Streams\Platform\Ui\Form\Form
     */
    public function getForm()
    {
        return $this->form;
    }
}
 