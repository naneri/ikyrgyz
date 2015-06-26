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
                $photos = array();
                
                $imagesInput = Input::file('images');
                foreach ($imagesInput as $image) {
                    $rules = array('file' => 'required|image'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                    $validator = Validator::make(array('file' => $image), $rules);
                    if ($validator->passes()) {
                        $data['url'] = $this->saveImage($image);
                        $data['user_id'] = Auth::id();
                        $data['album_id'] = $albumId;
                        $data['name'] = $file_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                        $photo = Photo::create($data);
                        BonusRating::addBonusRating('upload_photo', $photo->id, Config::get('bonus_rating.upload_photo'));
                        $photos[] = $photo;
                    }
                }
                
                return View::make('photos.setnames', compact('photos', 'albumId'));
	}

        public function setNames($albumId) {
            $photoNames = Input::get('photo_names');
            foreach ($photoNames as $photoId => $photoName) {
                Photo::find($photoId)->update(array('name' => $photoName));
            }
            return Redirect::to('photoalbum/' . $albumId);
        }

        private function saveImage($file) {
            $destinationPath = 'images/user/' . Auth::id() . '/photos';
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath);
            }
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . rand(1, 100) . '.' . $extension;
            $file->move($destinationPath, $fileName);
            $avapath = URL::to('/') . '/' . $destinationPath . '/' . $fileName;
            return $avapath;
        }
        
        public function saveFromUrl(){
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

		if (Input::hasFile('image')) {
                    $data['url'] = $this->saveImage(Input::file('image'));
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
