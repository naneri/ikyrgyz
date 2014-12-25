<?php

class AlbumImagesController extends \BaseController {

	/**
	 * Display a listing of albumimages
	 *
	 * @return Response
	 */
	public function index()
	{
		$albumimages = Albumimage::all();

		return View::make('albumimages.index', compact('albumimages'));
	}

	/**
	 * Show the form for creating a new albumimage
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('albumimages.create');
	}

	/**
	 * Store a newly created albumimage in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Albumimage::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Albumimage::create($data);

		return Redirect::route('albumimages.index');
	}

	/**
	 * Display the specified albumimage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$albumimage = Albumimage::findOrFail($id);

		return View::make('albumimages.show', compact('albumimage'));
	}

	/**
	 * Show the form for editing the specified albumimage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$albumimage = Albumimage::find($id);

		return View::make('albumimages.edit', compact('albumimage'));
	}

	/**
	 * Update the specified albumimage in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$albumimage = Albumimage::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Albumimage::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$albumimage->update($data);

		return Redirect::route('albumimages.index');
	}

	/**
	 * Remove the specified albumimage from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Albumimage::destroy($id);

		return Redirect::route('albumimages.index');
	}

}
