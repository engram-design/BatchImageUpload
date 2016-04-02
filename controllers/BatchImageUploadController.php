<?php
namespace Craft;

class BatchImageUploadController extends BaseController
{
    protected $allowAnonymous = array('actionBatchUpload');

    public function actionBatchUpload()
    {
        $settings = craft()->batchImageUpload->getSettings();

        $imageFeed = UrlHelper::getUrl() . $settings->imageFeed;

        $data = craft()->batchImageUpload->getRawData($imageFeed);

        if ($data) {
            $json = json_decode($data);

            foreach ($json as $key => $item) {
                foreach ($item as $key => $url) {
                    $filename = basename($url);

                    // Check first to see if this asset is present - don't upload if it already is.
                    $existingImage = craft()->db->createCommand()
                        ->select('COUNT(*)')
                        ->from('assetfiles')
                        ->where('filename = "'.$filename.'"')
                        ->queryScalar();

                    if (!$existingImage) {

                        // Download the image temporarily
                        $tempFile = craft()->path->getTempPath().$filename;
                        copy($url, $tempFile);

                        $response = craft()->assets->insertFileByLocalPath(
                            $tempFile,
                            $filename,
                            2, // Properties folder
                            AssetConflictResolution::Replace
                        );

                        echo '<pre>';
                        if ($response->isSuccess()) {
                            print_r('Uploaded ' . $url . '<br>');
                        } else {
                            print_r('Failed ' . $url . '<br>');
                        }
                        echo '</pre>';

                    } else {
                        print_r('Already Uploaded ' . $url . '<br>');
                    }

                    
                }
            }

        }



        craft()->end();
    }
}
