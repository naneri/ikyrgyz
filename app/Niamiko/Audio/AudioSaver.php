<?php 

class AudioSaver{

    public static function saveAudioFile($file)
    {

        $destinationPath = 'audio_files/user/' . Auth::id() . '/audios';

        if (!file_exists($destinationPath)) {

            File::makeDirectory($destinationPath, 0777, true);
        }

        $extension = $file->getClientOriginalExtension();

        $fileName = time() . rand(1, 100) . '.' . $extension;

        $file->move($destinationPath, $fileName);

        $avapath = URL::to('/') . '/' . $destinationPath . '/' . $fileName;
        
        return $avapath;
    }
}