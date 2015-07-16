<?php

class AudioController extends \BaseController
{

    /**
     * Display a listing of audio
     *
     * @return Response
     */
    public function index()
    {
        $audio = Audio::all();

        return View::make('audio.index', compact('audio'));
    }

    /**
     * Show the form for creating a new audio
     *
     * @return Response
     */
    public function create($audioAlbumId)
    {
        $audioAlbum = AudioAlbum::findOrFail($audioAlbumId);
        return View::make('audio.create', compact('audioAlbum'));
    }

    /**
     * Store a newly created audio in storage.
     *
     * @return Response
     */
    public function store($albumId)
    {
        $audios = array();
        $audioFiles = Input::file('audio_files');
        foreach ($audioFiles as $audioFile) {
            $rules = array('file' => 'required|mimes:mpga'); // main extension for the audio/mpeg mime type in the Apache list is mpga, not mp3
            $validator = Validator::make(array('file' => $audioFile), $rules);
            if ($validator->passes()) {
                $data['url'] = $this->saveAudioFile($audioFile);
                $data['user_id'] = Auth::id();
                $data['album_id'] = $albumId;
                $data['name'] = $file_name = pathinfo($audioFile->getClientOriginalName(), PATHINFO_FILENAME);
                $audio = Audio::create($data);
//              BonusRating::addBonusRating('upload_audio', $audio->id, Config::get('bonus_rating.upload_audio'));
                $audios[] = $audio;
            }
        }

        return View::make('audio.setnames', compact('audios', 'albumId'));
    }

    public function setNames($albumId)
    {
        $audioNames = Input::get('audio_names');
        foreach ($audioNames as $audioId => $audioName) {
            Audio::find($audioId)->update(array('name' => $audioName));
        }
        return Redirect::to('audioalbum/' . $albumId);
    }

    private function saveAudioFile($file)
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

    public function saveFromUrl()
    {
        // Your file
        $file = 'http://....';

        // Open the file to get existing content
        $data = file_get_contents($file);

        // New file
        $new = '/var/www/uploads/';

        // Write the contents back to a new file
        file_put_contents($new, $data);
    }

    /**
     * Display the specified audio.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $audio = Audio::findOrFail($id);

        return View::make('audio.show', compact('audio'));
    }

    /**
     * Show the form for editing the specified audio.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $audio = Audio::find($id);

        return View::make('audio.edit', compact('audio'));
    }

    /**
     * Update the specified audio in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $audio = Audio::findOrFail($id);

        $rules = Audio::$rules;
        $rules['audio_file'] = 'audio';

        $validator = Validator::make($data = Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (Input::hasFile('audio_file')) {
            $data['url'] = $this->saveAudioFile(Input::file('audio_file'));
        }
        $audio->update($data);

        return Redirect::to('audio/' . $audio->id);
    }

    /**
     * Remove the specified audio from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $album = Audio::find($id)->album;
        Audio::destroy($id);

        return Redirect::to('audioalbum/' . $album->id);
    }

}
