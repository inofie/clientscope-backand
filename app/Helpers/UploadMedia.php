<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;

class UploadMedia
{
    public static function uploadMedia($path,$file,$resize = NULL)
    {
        if(is_array($file)){
            foreach ($file as $value)
            {
                $extension  = $value->extension();
                $fileUrl   = Storage::putFile($path, $value);
                if($extension == 'jpg' || $extension = 'png' || $extension == 'jpeg')
                    self::resize($path,$fileUrl,$resize);

                $filename[] = $fileUrl;
            }
        }else{
            $extension  = $file->extension();
            $filename = Storage::put($path, $file);
            if($extension == 'jpg' || $extension = 'png' || $extension == 'jpeg')
                self::resize($path,$filename,$resize);
        }
        return $filename;
    }

    public static function uploadMediaByPath($path,$file,$resize = NULL)
    {
        if(is_array($file)){
            foreach ($file as $value)
            {
                $extension  = $value->extension();
                $fileUrl   = Storage::putFile($path, new File($value));
                if($extension == 'jpg' || $extension = 'png' || $extension == 'jpeg')
                    self::resize($path,$fileUrl,$resize);

                $filename[] = $fileUrl;
            }
        }else{
            $extension  = pathinfo($file,PATHINFO_EXTENSION);
            $filename = Storage::putFile($path, new File($file));
            if($extension == 'jpg' || $extension = 'png' || $extension == 'jpeg')
                self::resize($path,$filename,$resize);
        }
        return $filename;
    }

    public static function resize($path,$file,$dimension)
    {
        if(!empty($dimension)){
            $getImageDimension = explode('x',$dimension);
            $resizeWidth       = $getImageDimension[0];
            $resizeHeight      = $getImageDimension[1];
            Image::make(Storage::path($file))
                ->resize($resizeWidth, $resizeHeight)
                ->save( Storage::path($path . '/thumb_' . basename($file)) );
        }

    }

    public static function optimizeImage($source_path, $destination_path, $quality)
    {
        $info = getimagesize($source_path);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_path);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_path);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_path);

        //save file
        imagejpeg($image, $destination_path, $quality);

        //return destination file
        return $destination_path;
    }
}