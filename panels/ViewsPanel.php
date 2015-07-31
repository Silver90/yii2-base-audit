<?php
namespace app\panels;

use bedezign\yii2\audit\components\panels\Panel;
use yii\base\Event;
use yii\base\ViewEvent;
use yii\web\View;

/**
 * ViewsPanel
 * @package app\panels
 */
class ViewsPanel extends Panel
{
    /**
     * @var array This will store a list of views that have been rednered.
     */
    private $_viewFiles = [];

    /**
     * Add an event listener to the View::EVENT_BEFORE_RENDER event to capture the view filenames.
     */
    public function init()
    {
        parent::init();
        Event::on(View::className(), View::EVENT_BEFORE_RENDER, function (ViewEvent $event) {
            $this->_viewFiles[] = $event->sender->getViewFile();
        });
    }

    /**
     * Returns the data that will be saved into the `audit_data` table.
     */
    public function save()
    {
        return $this->_viewFiles;
    }

    /**
     * Get the name of the panel.
     */
    public function getName()
    {
        return \Yii::t('app', 'Views');
    }

    /**
     * Get the label that will be used on the tab in the entry view page.
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->data) . ')</small>';
    }

    /**
     * Get the HTML output that will be rendered into the tab view area on the entry view page.
     */
    public function getDetail()
    {
        return '<ol><li>' . implode('<li>', $this->data) . '</ol>';
    }
}
