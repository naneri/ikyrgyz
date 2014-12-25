<?php

class AudioController extends \BaseController {

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
	public function create()
	{
		return View::make('audio.create');
	}

	/**
	 * Store a newly created audio in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Audio::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Audio::create($data);

		return Redirect::route('audio.index');
	}

	/**
	 * Display the specified audio.
	 *
	 * @param  int  $id
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
	 * @param  int  $id
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$audio = Audio::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Audio::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$audio->update($data);

		return Redirect::route('audio.index');
	}

	/**
	 * Remove the specified audio from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Audio::destroy($id);

		return Redirect::route('audio.index');
	}

}
