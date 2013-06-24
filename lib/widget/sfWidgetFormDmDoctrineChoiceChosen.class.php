<?php


class sfWidgetFormDmDoctrineChoiceChosen extends sfWidgetFormDoctrineChoice {

    /**
     * Constructor.
     *
     * Available options:
     *
     *  * model:        The model class (required)
     *  * add_empty:    Whether to add a first empty value or not (false by default)
     *                  If the option is not a Boolean, the value will be used as the text value
     *  * method:       The method to use to display object values (__toString by default)
     *  * key_method:   The method to use to display the object keys (getPrimaryKey by default)
     *  * order_by:     An array composed of two fields:
     *                    * The column to order by the results (must be in the PhpName format)
     *                    * asc or desc
     *  * query:        A query to use when retrieving objects
     *  * multiple:     true if the select tag must allow multiple selections
     *  * table_method: A method to return either a query, collection or single object
     *
     *
     * Available options for chosen:
     *
     *  * no_results_text:              No result text in search
     *  * theme:                        CSS file to use for styling the chosen select
     *  * max_selected_options:         Maximum available options to select, if select is multiple
     *  * placeholder_text_multiple:    Placeholder text for multiple choices
     *  * placeholder_text_single:      Placeholder text for single choice
     *
     * @see sfWidgetFormSelect
     */
    protected function configure($options = array(), $attributes = array())
    {
        $this->addOption('no_results_text', 'No results matched');
        $this->addOption('theme', 'admin');
        $this->addOption('max_selected_options', 0);
        $this->addOption('placeholder_text_multiple', 'Select options');
        $this->addOption('placeholder_text_single', 'Select option');
        parent::configure($options, $attributes);
    }

    /**
     * Renders the widget.
     *
     * @param  string $name        The element name
     * @param  string $value       The value selected in this widget
     * @param  array $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $i18n = dmContext::getInstance()->getServiceContainer()->getService('i18n');

        $attributes['data-dme-chosen-select-widget'] = 'true';
        $attributes['data-dme-chosen-select-no-result-text'] = $i18n->__($this->getOption('no_results_text'), array(), 'dmChosenSelectJQueryPlugin');
        $attributes['data-dme-chosen-select-placeholder-text-multiple'] = $i18n->__($this->getOption('placeholder_text_multiple'), array(), 'dmChosenSelectJQueryPlugin');
        $attributes['data-dme-chosen-select-placeholder-text-single'] = $i18n->__($this->getOption('placeholder_text_single'), array(), 'dmChosenSelectJQueryPlugin');
        $choices = $this->getOption('choices');
        if (!$this->getOption('multiple') && isset($choices[''])) {
            $attributes['data-dme-chosen-select-allow-single-deselect'] = 'true';
        }
        if ($this->getOption('multiple') && $this->getOption('max_selected_options') > 0) {
            $attributes['data-dme-chosen-select-max-selected-options'] = $this->getOption('max_selected_options');
        }
        return parent::render($name, $value, $attributes, $errors);
    }

    /**
     * Gets the stylesheet paths associated with the widget.
     *
     * @return array An array of stylesheet paths
     */
    public function getStylesheets()
    {
        $themes = sfConfig::get('dm_dmChosenSelectJQueryPlugin_themes');
        return array_merge(
            array($themes[$this->getOption('theme')] => null),
            $this->getRenderer()->getStylesheets()
        );
    }

    /**
     * Gets the JavaScript paths associated with the widget.
     *
     * @return array An array of JavaScript paths
     */
    public function getJavaScripts()
    {
        return array_merge(
            array(
                'dmChosenSelectJQueryPlugin.chosen',
                'dmChosenSelectJQueryPlugin.launch'
            ),
            $this->getRenderer()->getJavaScripts()
        );
    }

}