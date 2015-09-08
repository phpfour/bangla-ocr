<?php

namespace App\Http\Controllers;

use App\Repository\ImageRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** @var ImageRepository */
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getIndex(Request $request)
    {
        $user = $request->user();
        $images = ($user) ? $this->imageRepository->getByUser($user) : [];

        return view('index', [
            'user'   => $user,
            'images' => $images
        ]);
    }
}
