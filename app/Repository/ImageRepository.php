<?php

namespace App\Repository;

use App\User;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageRepository
{
    public function create(UploadedFile $file, User $user)
    {
        $filename = sha1(rand(11111, 99999));
        $extension = $file->getClientOriginalExtension();

        Storage::put(
            'images/' . $filename . '.' . $extension,
            file_get_contents($file->getRealPath())
        );

        $image = new Image([
            'user_id'   => $user->id,
            'filename'  => $file->getClientOriginalName(),
            'path'      => $filename . '.' . $extension,
            'mime_type' => $file->getMimeType(),
            'location'  => 'local',
            'status'    => Image::STATUS_PENDING
        ]);

        $image->save();

        return $image;
    }

    public function getByUser(User $user)
    {
        $images = Image::where('user_id', $user->id)->get();
        return $images;
    }
}
