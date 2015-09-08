<?php

namespace App\Http\Controllers;

use App\Image;
use App\Jobs\PerformOcr;
use App\Services\Google;
use App\Repository\ImageRepository;
use Illuminate\Http\Request;
use Google_Http_Request;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class ImageController extends Controller
{
    /** @var Google */
    private $google;

    /** @var ImageRepository */
    private $imageRepository;

    public function __construct(Google $google, ImageRepository $imageRepository)
    {
        $this->google = $google;
        $this->imageRepository = $imageRepository;
    }

    public function postUpload(Request $request)
    {
        $file = $request->file('file');
        $token = $request->getSession()->get('access_token');

        if ($file->isValid()) {
            $uploadedFile = $this->imageRepository->create($file, $request->user());
            $this->dispatch(new PerformOcr($uploadedFile, $token));
            return json_encode(['status' => 'success']);
        }

        return json_encode(['status' => 'failed']);
    }

    public function getText(Request $request)
    {
        $id = $request->get('id');
        $image = Image::find($id);

        echo $image->text;
        exit();
    }

    public function updateText(Request $request)
    {
        $id = $request->get('id');
        $image = Image::find($id);

        $image->text = $request->get('text');
        $image->save();

        exit();
    }
}
