<?php namespace Streams\Core\Ui;

use Streams\Core\Ui\Component\Form;
use Streams\Core\Ui\Entry\EntryResource;

class FormUi extends UiAbstract
{
    /**
     * The entry model.
     *
     * @var null
     */
    protected $entry = null;

    /**
     * Sections of form structure.
     *
     * @var null
     */
    protected $sections = null;

    /**
     * Fields to skip.
     *
     * @var array
     */
    protected $skips = [];

    /**
     * Form submittable actions.
     *
     * @var array
     */
    protected $actions = [];

    /**
     * The form view to use.
     *
     * @var string
     */
    protected $formView = 'streams/form';

    /**
     * The wrapper view to use.
     *
     * @var string
     */
    protected $wrapperView = 'html/blank';

    /**
     * Create a new FormUi instance.
     *
     * @param null $slug
     * @param null $namespace
     */
    public function __construct($model = null)
    {
        $this->resource = $this->newEntryResource();
        $this->form     = $this->newForm();

        if ($model) {
            $this->model = $model;
        }

        return $this;
    }

    /**
     * Do the work for rendering a form..
     *
     * @return $this
     */
    protected function trigger()
    {
        if ($_POST) {
            $this->entry = $this->resource->save();
        } elseif (is_numeric($this->entry)) {
            $this->entry = $this->resource->find($this->entry);
        }

        $this->output = \View::make(
            'html/form',
            $this->form->data()
        );

        return $this;
    }

    /**
     * Return the sections array.
     *
     * @return null
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections of the form.
     *
     * @param $sections
     * @return $this
     */
    public function setSections($sections)
    {
        foreach ($sections as $section) {
            $this->addSection($section);
        }

        return $this;
    }

    /**
     * Add a section to the form.
     *
     * @param $section
     * @return $this
     */
    public function addSection($section)
    {
        $this->sections[] = $section;

        return $this;
    }

    /**
     * Get the skips array.
     *
     * @return array
     */
    public function getSkips()
    {
        return $this->skips;
    }

    /**
     * Set the skipped fields.
     *
     * @param $skipped
     * @return $this
     */
    public function setSkips($skips)
    {
        foreach ($skips as $skip) {
            $this->addSkip($skip);
        }

        return $this;
    }

    /**
     * Add a field to skip.
     *
     * @param $skip
     * @return $this
     */
    public function addSkip($skip)
    {
        $this->skips[] = $skip;

        return $this;
    }

    /**
     * Get the actions for the form.
     *
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set the actions for the form.
     *
     * @param $actions
     * @return $this
     */
    public function setActions($actions)
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    /**
     * Add a action to the form.
     *
     * @param $action
     * @return $this
     */
    public function addAction($action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Get the entry object.
     *
     * @return null
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set the entry object.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Return a new Form instance.
     *
     * @return Form
     */
    public function newForm()
    {
        return new Form($this);
    }

    /**
     * Return a new entry resource instance.
     *
     * @return EntryResource
     */
    public function newEntryResource()
    {
        return new EntryResource($this);
    }
}
