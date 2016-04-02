<?php
namespace Craft;

class BatchImageUploadService extends BaseApplicationComponent
{
    // Public Methods
    // =========================================================================

    public function getPlugin()
    {
        return craft()->plugins->getPlugin('batchImageUpload');
    }

    public function getSettings()
    {
        return $this->getPlugin()->getSettings();
    }

    public function getRawData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);

        if (!$response) {
            return false;
        }

        curl_close($curl);

        return $response;
    }
}
