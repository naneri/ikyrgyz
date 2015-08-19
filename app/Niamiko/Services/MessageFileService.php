<?php 

class MessageFileService{


    public function saveFile($file){

        $extension = $file->getClientOriginalExtension();

        $fileName = time() . rand(1, 100) . '.' . $extension;

        $file->move($destinationPath, $fileName);

        $filePath = URL::to('/') . '/' . $destinationPath . '/' . $fileName;

        return $filePath;
    }
}