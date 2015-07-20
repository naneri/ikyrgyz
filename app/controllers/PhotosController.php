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
                $comments = $photo->commentsWithDataSortBy('old');

                return View::make('photos.show', compact('photo', 'comments'));
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

        public function postAction(){
            $result = array();
            
            switch(Input::get('action')){
                case 'delete':
                    $this->deleteImages(Input::get('photos'));
                    break;
                case 'copy':
                    break;
                case 'move':
                    break;
                default:
                    break;
            }
        }
        
        public function postActionDelete(){
            $result = array();
            
            $photoIds = Input::get('photo');
            
            if($photoIds == ''){
                return;
            }
            
            $result['results'] = $this->deleteImages($photoIds);
            
            $photoAlbum = PhotoAlbum::find(Input::get('photoAlbumId'));
            $photos = array();
            if($photoAlbum->canView()){
                $photos = $photoAlbum->photos;
            }
            $canEdit = $photoAlbum->canEdit();
            $result['render'] = View::make('photos.list', compact('photos', 'canEdit'))->render();
            
            return Response::json($result);
        }
        
        private function deleteImages($photoIds){
            $results = array();
            foreach($photoIds as $photoId){
                $photo = Photo::find($photoId);
                if($photo->canEdit()){
                    $path = str_replace(Config::get('app.base_url'), public_path(), $photo->url);
                    $photoName = $photo->name;
                    $error = false;
                    if(file_exists($path)){
                        try{
                            unlink($path);
                        }
                        catch(Exception $e){
                            $error = true;
                        }
                    }
                    if(!$error){
                        $photo->delete();
                        $results[] = array('status' => 'success', 'message' => 'Фотография "'.$photoName.'" успешно удалена!');
                    }else{
                        $results[] = array('status' => 'error', 'message' => 'Ошибка при удалении фотографии "' . $photoName . '"');
                    }
                }
            }
            return $results;
        }
}
