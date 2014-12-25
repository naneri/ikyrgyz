<?php

class AudioAlbumsController extends \BaseController {

	/**
	 * Display a listing of audioalbums
	 *
	 * @return Response
	 */
	public function index()
	{
		$audioalbums = Audioalbum::all();

		return View::make('audioalbums.index', compact('audioalbums'));
	}

	/**
	 * Show the form for creating a new audioalbum
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('audioalbums.create');
	}

	/**
	 * Store a newly created audioalbum in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Audioalbum::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Audioalbum::create($data);

		return Redirect::route('audioalbums.index');
	}

	/**
	 * Display the specified audioalbum.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$audioalbum = Audioalbum::findOrFail($id);

		return View::make('audioalbums.show', compact('audioalbum'));
	}

	/**
	 * Show the form for editing the specified audioalbum.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$audioalbum = Audioalbum::find($id);

		return View::make('audioalbums.edit', compact('audioalbum'));
	}

	/**
	 * Update the specified audioalbum in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$audioalbum = Audioalbum::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Audioalbum::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$audioalbum->update($data);

		return Redirect::route('audioalbums.index');
	}

	/**
	 * Remove the specified audioalbum from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Audioalbum::destroy($id);

		return Redirect::route('audioalbums.index');
	}

}
