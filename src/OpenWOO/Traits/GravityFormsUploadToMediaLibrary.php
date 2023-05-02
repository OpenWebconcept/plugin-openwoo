<?php

namespace Yard\OpenWoo\Traits;

trait GravityFormsUploadToMediaLibrary
{
    /**
     * Add a Gravity Forms upload file to the Wordpress uploads folder.
     */
    public function gravityFormsUploadToMediaLibrary(string $url): int
    {
        if ($this->isExternalURL($url)) {
            return 0;
        }

        $uploadDirectory = \wp_upload_dir();
        $uploadFilename = $this->getUploadFilename($url);

        if (empty($uploadFilename)) {
            return 0;
        }

        $uploadFullPath = $uploadDirectory['path'] . $uploadFilename;
        $externalFile = $this->getFileFromGravityForms($url);

        if (empty($externalFile)) {
            return 0;
        }

        $attachmentID = $this->insertAttachment($uploadFullPath, $externalFile, $uploadFilename);
        
        if (! $attachmentID) {
            return 0;
        }

        $attachmentMetaData = $this->generateAttachmentMetaData($attachmentID);

        if (empty($attachmentMetaData)) {
            return 0;
        }

        \wp_update_attachment_metadata($attachmentID, $attachmentMetaData);

        return $attachmentID;
    }

    /**
     * Compare domain of the provided URL and the current site URL.
     */
    protected function isExternalURL(string $url): bool
    {
        $metaParsedURL = parse_url($url);
        $siteParsedURL = parse_url(get_site_url());
        
        return $metaParsedURL['host'] !== $siteParsedURL['host'];
    }

    protected function getUploadFilename(string $url): string
    {
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $query);
        $downloadName = $query['gf-download'] ?? '';

        if (empty($downloadName)) {
            return basename($url); // When the URL does not contain 'gf-download'.
        }

        return basename($downloadName);
    }

    protected function getFileFromGravityForms(string $url): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $externalFile = curl_exec($ch);
        
        curl_close($ch);

        return $externalFile ?: '';
    }

    protected function insertAttachment(string $uploadFullPath, string $externalFile, string $uploadFilename): int
    {
        // Open a local file stream for writing.
        $tempFile = fopen($uploadFullPath, 'w');

        // Write out the remote file to the local stream.
        fwrite($tempFile, $externalFile);

        // Close the stream.
        fclose($tempFile);

        $filetypeWP = \wp_check_filetype($uploadFullPath);

        $insertArgs = [
            'post_mime_type' => $filetypeWP['type'] ?? '',
            'post_title'     => $uploadFilename,
            'post_content'   => '',
            'post_status'    => 'inherit',
        ];

        $attachmentID = \wp_insert_attachment($insertArgs, $uploadFullPath);

        return \is_wp_error($attachmentID) ? 0 : $attachmentID;
    }

    protected function generateAttachmentMetaData(int $attachmentID): array
    {
        $attachmentFile = \get_attached_file($attachmentID);

        if (empty($attachmentFile)) {
            return [];
        }

        // Ensure the WP image library is loaded.
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        return \wp_generate_attachment_metadata($attachmentID, $attachmentFile);
    }
}
