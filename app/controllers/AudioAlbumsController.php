<?php

class AudioAlbumsController extends \BaseController {

    /**
     * Display a listing of audioalbums
     *
     * @return Response
     */
    public function index()
    {
        $audioalbums = AudioAlbum::all();

        return $this->makeView('audioalbums.index', compact('audioalbums'));
    }

    public function audioAlbumIndex($userId) {
        $user = User::find($userId);
        $audioAlbums = $user->audioAlbums;

        return $this->makeView('audioalbums.index', compact('audioAlbums', 'user'));
    }

    /**
     * Show the form for creating a new audioalbum
     *
     * @return Response
     */
    public function create()
    {
        return $this->makeView('audioalbums.create');
    }

    /**
     * Store a newly created audioalbum in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), AudioAlbum::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }


        if (Input::file('image'))
        {
            $data['cover'] = AudioAlbumImageSaver::saveImage(Input::file('image'));
        }

        $data['user_id'] = Auth::id();

        AudioAlbum::create($data);

        return Redirect::to('profile/' . Auth::id() . '/audios');
    }

    /**
     * Display the specified audioalbum.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $audioAlbum = AudioAlbum::findOrFail($id);
        $audioAlbums = AudioAlbum::where('user_id', $audioAlbum->user_id)->get(); // для показа списка альбомов(справа)

        return $this->makeView('audioalbums.show', compact('audioAlbums', 'audioAlbum'));
    }
    /**
     * Show the form for editing the specified audioalbum.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $audioAlbum = AudioAlbum::find($id);

        return $this->makeView('audioalbums.edit', compact('audioAlbum'));
    }

    /**
     * Update the specified audioalbum in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $audioalbum = AudioAlbum::findOrFail($id);

        $validator = Validator::make($data = Input::all(), AudioAlbum::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (Input::file('image')) {
            $data['cover'] = AudioAlbumImageSaver::saveImage(Input::file('image'));
        }
        $audioalbum->update($data);

        return Redirect::to('audioalbum/'. $audioalbum->id);
    }

    /**
     * Remove the specified audioalbum from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $audioAlbum = AudioAlbum::findOrFail($id);

        $audioAlbum->audios()->delete();
        
        $audioAlbum->delete();

        return Redirect::to('profile/' . Auth::id() . '/audios');
    }

}
