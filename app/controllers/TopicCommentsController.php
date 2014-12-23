<?php

class TopicCommentsController extends \BaseController {

	/**
	 * Display a listing of topiccomments
	 *
	 * @return Response
	 */
	public function index()
	{
		$topiccomments = Topiccomment::all();

		return View::make('topiccomments.index', compact('topiccomments'));
	}

	/**
	 * Show the form for creating a new topiccomment
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('topiccomments.create');
	}

	/**
	 * Store a newly created topiccomment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Topiccomment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Topiccomment::create($data);

		return Redirect::route('topiccomments.index');
	}

	/**
	 * Display the specified topiccomment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$topiccomment = Topiccomment::findOrFail($id);

		return View::make('topiccomments.show', compact('topiccomment'));
	}

	/**
	 * Show the form for editing the specified topiccomment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$topiccomment = Topiccomment::find($id);

		return View::make('topiccomments.edit', compact('topiccomment'));
	}

	/**
	 * Update the specified topiccomment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$topiccomment = Topiccomment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Topiccomment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$topiccomment->update($data);

		return Redirect::route('topiccomments.index');
	}

	/**
	 * Remove the specified topiccomment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Topiccomment::destroy($id);

		return Redirect::route('topiccomments.index');
	}

}
