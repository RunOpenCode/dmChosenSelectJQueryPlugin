<?php

class dmChosenSelectJQueryPluginConfiguration extends sfPluginConfiguration {
    /**
     * @see sfPluginConfiguration
     */
    public function initialize()
    {
        $this->dispatcher->connect('dm.form_generator.widget_subclass', array($this, 'listenToFormGeneratorWidgetSubclassEvent'));
    }

    public function listenToFormGeneratorWidgetSubclassEvent(sfEvent $e, $subclass)
    {
        if ($this->isChoiceChosen($e['column'])) {
            $subclass = 'DmChoiceChosen';
        }
        if ($this->isDoctrineChoiceChosen($e['column'])) {
            $subclass = 'DmDoctrineChoiceChosen';
        }
        return $subclass;
    }

    protected function isChoiceChosen(sfDoctrineColumn $column) {
        return false !== strpos(dmArray::get($column->getTable()->getColumnDefinition($column->getName()), 'extra', ''), 'choice_chosen');
    }

    protected function isDoctrineChoiceChosen(sfDoctrineColumn $column) {
        return false !== strpos(dmArray::get($column->getTable()->getColumnDefinition($column->getName()), 'extra', ''), 'doctrine_choice_chosen');
    }
}