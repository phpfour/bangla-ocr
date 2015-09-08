<?php

namespace App\Jobs;

use App\Image;
use Google_Http_Request;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\App;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class PerformOcr extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /** @var Image */
    private $image;

    /**
     * Create a new job instance.
     *
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $google = App::make('App\Services\Google');
        $client = $google->getClient();

        $client->setAccessToken($this->image->user->access_token);
        $service = new Google_Service_Drive($client);

        $file = new Google_Service_Drive_DriveFile();
        $file->setTitle($this->image->filename);
        $file->setMimeType($this->image->mime_type);

        $data = Storage::get('images/' . $this->image->path);

        $createdFile = $service->files->insert($file, [
            'data'       => $data,
            'ocr'        => true,
            'mimeType'   => $file->getMimeType(),
            'uploadType' => 'multipart'
        ]);

        $exportLinks = $createdFile->getExportLinks();
        $plainTextUrl = $exportLinks['text/plain'];

        $request = new Google_Http_Request($plainTextUrl, 'GET', null, null);
        $httpRequest = $service->getClient()->getAuth()->authenticatedRequest($request);

        if ($httpRequest->getResponseHttpCode() == 200) {

            $this->image->text = $httpRequest->getResponseBody();
            $this->image->status = Image::STATUS_COMPLETE;
            $this->image->save();

            $service->files->delete($createdFile->getId());

        }
    }
}
