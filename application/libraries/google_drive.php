<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_drive {

	const CALENDAR_ID 	= APP_EMAIL;
	const TIMEZONE 		= 'Asia/Jakarta';

	private $service;

    public function __construct() {
        require_once APPPATH.'third_party/Google/google.php';

    	$client_email 	= 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key 	= file_get_contents(APPPATH.'libraries/hmmmm-e411eec713f8.p12');
        $scopes 		= array('https://www.googleapis.com/auth/drive.file');

        $config = new Google_Config();
		$config->setClassConfig('Google_Cache_File', array('directory' => '../../tmp/google/cache'));

		$client = new Google_Client($config);

        $this->service = new Google_Service_Drive($client);

        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );

        $client->setAssertionCredentials($credentials);
        if ($client->getAuth()->isAccessTokenExpired()) {
        	$client->getAuth()->refreshTokenWithAssertion();
        }
    }

    /**
     * Insert new file.
     *
     * @param Google_Service_Drive $service Drive API service instance.
     * @param string $title Title of the file to insert, including the extension.
     * @param string $description Description of the file to insert.
     * @param string $parentId Parent folder's ID.
     * @param string $mimeType MIME type of the file to insert.
     * @param string $filename Filename of the file to insert.
     * @return Google_Service_Drive_DriveFile The file that was inserted. NULL is
     *     returned if an API error occurred.
     */
    function insertFile($title, $mimeType, $parentId, $filename) {
        $file = new Google_Service_Drive_DriveFile();
        $file->setName($title);
        $file->setViewersCanCopyContent(true);

        // Set the parent folder.
        if ($parentId != null) {
            $file->setParents(array($parentId));
        }

        try {
            $data = file_get_contents($filename);

            $createdFile = $this->service->files->create($file, array(
              'data'        => $data,
              'mimeType'    => $mimeType,
              'uploadType'  => 'media'
            ));

            return $createdFile;
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }
    }

    /**
    * Print a file's metadata.
    *
    * @param Google_Service_Drive $service Drive API service instance.
    * @param string $fileId ID of the file to print metadata for.
    */
    function printFile($fileId) {
        try {
            $file = $this->service->files->get($fileId);
            return $file;
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }
    }

    /**
     * Download a file's content.
     *
     * @param Google_Service_Drive $service Drive API service instance.
     * @param File $file Drive File instance.
     * @return String The file's content if successful, null otherwise.
    */
    function downloadFile($fileId) {
        $file = $this->printFile($fileId);

        $content = $this->service->files->get($file->id, array(
            'alt' => 'media'));

        header('Content-Disposition: attachment; filename="'.$file->name.'"');
        header('Content-type: '.$file->mimeType);

        echo $content;

    }

}