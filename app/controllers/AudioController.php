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
                $data['is_hidden'] = Input::get('is_hidden');
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

    public function getCopyToAlbum($id)
    {
        $audio = Audio::findOrFail($id);

        $tmpAudioAlbums = AudioAlbum::where('user_id', Auth::id())->where('id', '<>', $audio->album_id)->get();

        $audioAlbums = array();
        foreach ($tmpAudioAlbums as $a) {
            $audioAlbums[$a->id] = $a->name;
        }

        if (!$audio)
            return Response::json(array('error' => 'Аудио не найдено'));

        if (!count($audioAlbums))
            return Response::json(array('error' => 'У вас нет аудио альбомов для копирования аудио'));

        return Response::json(array('html' => View::make('audio.copy-modal-audio-albums', compact('audioAlbums'))->render()));
    }

    public function getMoveToAlbum($id)
    {
        $audio = Audio::findOrFail($id);
        $tmpAudioAlbums = AudioAlbum::where('user_id', Auth::id())->where('id', '<>', $audio->album_id)->get();

        $audioAlbums = array();
        foreach ($tmpAudioAlbums as $a) {
            $audioAlbums[$a->id] = $a->name;
        }

        if (!$audio)
            return Response::json(array('error' => 'Аудио не найдено'));

        if (!count($audioAlbums))
            return Response::json(array('error' => 'У вас нет аудио альбомов для перемещения аудио'));

        return Response::json(array('html' => View::make('audio.move-modal-audio-albums', compact('audioAlbums'))->render()));
    }

    public function postCopyToAlbum($audioId, $albumId)
    {
        $audio = Audio::findOrFail($audioId);
        $audioAlbum = AudioAlbum::findOrFail($albumId);

        if (!$audio)
            return Response::json(array('error' => 'Аудио не найдено'));

        if (!$audioAlbum->canEdit())
            return Response::json(array('error' => 'Вы не можете копировать в данный альбом'));

        $new_audio = $audio->replicate();
        $new_audio->album_id = $albumId;
        $new_audio->user_id = Auth::id();
        $new_audio->push();

        return Response::json(array('success' => 'Аудио успешно скопировано'));
    }

    public function postMoveToAlbum($audioId, $albumId)
    {
        $audio = Audio::findOrFail($audioId);
        $audioAlbum = AudioAlbum::findOrFail($albumId);

        if (!$audio)
            return Response::json(array('error' => 'Аудио не найдено'));

        if (!$audioAlbum->canEdit())
            return Response::json(array('error' => 'Вы не можете переместить в данный альбом'));

        $audio->album_id = $albumId;
        $audio->save();
        return Response::json(array('success' => 'Аудио успешно перемещено'));
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
        $audioAlbum = AudioAlbum::findOrFail($audio->album_id);
        $tmpAudioAlbums = AudioAlbum::where('user_id', $audioAlbum->user_id)->get();

        $audioAlbums = array();
        foreach ($tmpAudioAlbums as $a) {
            $audioAlbums[$a->id] = $a->name;
        }

        return View::make('audio.edit', compact('audio', 'audioAlbums'));
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
