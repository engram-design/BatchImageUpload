<?php
namespace Craft;

class BatchImageUploadPlugin extends BasePlugin
{
    /* --------------------------------------------------------------
    * PLUGIN INFO
    * ------------------------------------------------------------ */

    public function getName()
    {
        return Craft::t('Batch Image Upload');
    }

    public function getVersion()
    {
        return '0.1.0';
    }

    public function getDeveloper()
    {
        return 'S. Group';
    }

    public function getDeveloperUrl()
    {
        return 'http://sgroup.com.au';
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('batchimageupload/settings', array(
            'settings' => $this->getSettings()
        ));
    }

    protected function defineSettings()
    {
        return array(
            'imageFeed' => AttributeType::String,
        );
    }


    /* --------------------------------------------------------------
    * HOOKS
    * ------------------------------------------------------------ */

    
 
}
