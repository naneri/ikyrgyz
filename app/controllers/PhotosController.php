<?php

class PhotosController extends \BaseController {

	/**
	 * Display a listing of photos
	 *
	 * @return Response
	 */
	public function index()
	{
		$photos = Photo::all();

		return View::make('photos.index', compact('photos'));
	}

	/**
	 * Show the form for creating a new photo
	 *
	 * @return Response
	 */
	public function create($photoAlbumId)
	{
            $photoAlbum = PhotoAlbum::findOrFail($photoAlbumId);
            return View::make('photos.create', compact('photoAlbum'));
	}

	/**
	 * Store a newly created photo in storage.
	 *
	 * @return Response
	 */
	public function store($albumId)
	{
		$validator = Validator::make($data = Input::all(), Photo::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
                
		if (Input::file('image')) {
                    $data['url'] = $this->saveImage();
                }
                $data['user_id'] = Auth::id();
                $data['album_id'] = $albumId;
                Photo::create($data);

		return Redirect::to('photoalbum/'.$albumId);
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
	 * Display the specified photo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$photo = Photo::with('album')->findOrFail($id);

		return View::make('photos.show', compact('photo'));
	}

	/**
	 * Show the form for editing the specified photo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$photo = Photo::find($id);

		return View::make('photos.edit', compact('photo'));
	}

	/**
	 * Update the specified photo in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$photo = Photo::findOrFail($id);
                
                $rules = Photo::$rules;
                $rules['image'] = 'image';

                $validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (Input::file('image')) {
                    $data['url'] = $this->saveImage();
                }
                $photo->update($data);

		return Redirect::to('photo/'.$photo->id);
	}

	/**
	 * Remove the specified photo from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
                $album = Photo::find($id)->album;
		Photo::destroy($id);

		return Redirect::to('photoalbum/' . $album->id);
        }

}
