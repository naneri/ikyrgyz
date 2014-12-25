<?php

class PhotoAlbumsController extends \BaseController {

	/**
	 * Display a listing of photoalbums
	 *
	 * @return Response
	 */
	public function index()
	{
		$photoalbums = Photoalbum::all();

		return View::make('photoalbums.index', compact('photoalbums'));
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
		$validator = Validator::make($data = Input::all(), Photoalbum::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Photoalbum::create($data);

		return Redirect::route('photoalbums.index');
	}

	/**
	 * Display the specified photoalbum.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$photoalbum = Photoalbum::findOrFail($id);

		return View::make('photoalbums.show', compact('photoalbum'));
	}

	/**
	 * Show the form for editing the specified photoalbum.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$photoalbum = Photoalbum::find($id);

		return View::make('photoalbums.edit', compact('photoalbum'));
	}

	/**
	 * Update the specified photoalbum in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$photoalbum = Photoalbum::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Photoalbum::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$photoalbum->update($data);

		return Redirect::route('photoalbums.index');
	}

	/**
	 * Remove the specified photoalbum from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Photoalbum::destroy($id);

		return Redirect::route('photoalbums.index');
	}

}
