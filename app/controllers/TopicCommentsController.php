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
	 * Show the form for adding a new topiccomment
	 *
	 * @return Response
	 */
	public function postAdd()
	{
                $result = array();
                
		$validator = Validator::make($data = Input::all(), TopicComment::$rules);

                if ($validator->fails()) {
                    $result['error'] = $validator;
                } else {
                    $data['user_id'] = Auth::user()->id;
                    $comment = Topiccomment::create($data);
                    $result['comment'] = View::make('comments.show', array('comments' => array($comment), 'parent_id' => $data['parent_id']))->render();
                }
                return Response::json($result);
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
