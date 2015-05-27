<?php

class PhotoAlbumsController extends \BaseController {

	/**
	 * Display a listing of photoalbums
	 *
	 * @return Response
	 */
	public function index()
	{
		$photoalbums = PhotoAlbum::all();

		return View::make('photoalbums.index', compact('photoalbums'));
	}

        public function photoAlbumIndex($userId) {
            $user = User::find($userId);
            $photoAlbums = $user->photoAlbums;

            return View::make('photoalbums.index', compact('photoAlbums', 'user'));
        }

        /**
	 * Show the form for creating a new photoalbum
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('photoalbums.create');
	}

	/**
	 * Store a newly created photoalbum in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	   $validator = Validator::make($data = Input::all(), PhotoAlbum::$rules);

    	if ($validator->fails())
    	{
    		return Redirect::back()->withErrors($validator)->withInput();
    	}


    	if (Input::file('image')) 
        {
            $data['cover'] = $this->saveImage();
        }

        $data['user_id'] = Auth::id();

        PhotoAlbum::create($data);

        return Redirect::to('profile/' . Auth::id() . '/photos');
    }

    private function saveImage() {
        $file = Input::file('image');
        $destinationPath = 'images/user/' . Auth::id() . '/photos';
        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath);
        }
        $extension = Input::file('image')->getClientOriginalExtension();
        $fileName = time() . rand(1, 100) . '.' . $extension;
        $file->move($destinationPath, $fileName);
        $avapath = URL::to('/') . '/' . $destinationPath . '/' . $fileName;
        return $avapath;
    }

        /**
	 * Display the specified photoalbum.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$photoAlbum = PhotoAlbum::findOrFail($id);

		return View::make('photoalbums.show', compact('photoAlbum'));
	}
        /**
	 * Show the form for editing the specified photoalbum.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$photoAlbum = PhotoAlbum::find($id);

		return View::make('photoalbums.edit', compact('photoAlbum'));
	}

	/**
	 * Update the specified photoalbum in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$photoalbum = PhotoAlbum::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PhotoAlbum::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (Input::file('image')) {
                    $data['cover'] = $this->saveImage();
                }
                $photoalbum->update($data);

                return Redirect::to('photoalbum/'. $photoalbum->id);
        }

	/**
	 * Remove the specified photoalbum from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
                $photoAlbum = PhotoAlbum::findOrFail($id);
                $photoAlbum->photos()->delete();
                $photoAlbum->delete();

		return Redirect::to('profile/' . Auth::id() . '/photos');
        }

}
