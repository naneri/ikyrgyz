<?php 

class AudioAlbumImageSaver{

    public static function saveImage($image){

        $file = $image;

        $destinationPath = 'images/user/' . Auth::id() . '/audioalbums';

        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $extension = $image->getClientOriginalExtension();

        $fileName = time() . rand(1, 100) . '.' . $extension;

        $file->move($destinationPath, $fileName);

        $avapath = URL::to('/') . '/' . $destinationPath . '/' . $fileName;
        
        return $avapath;
    }
}