<?php

class TopicController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('topic.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array('title' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
                    return Redirect::to('topic/create')->withErrors($validator);
                }
                
                $topic = new Topic;
                $topic->title = Input::get('title');
                $topic->content = Input::get('content');
                $topic->blog_id = 1;
                $topic->user_id = Auth::user()->id;
                $topic->topic_type_id = Input::get('topic_type_id');
                $topic->save();

                $tags = array();
                foreach (explode(', ', Input::get('tags')) as $tag_name) {
                    if ($tag = Tag::where('name', '=', $tag_name)->first()) {
                        $tag_id = $tag->id;
                    } else {
                        $tag_id = DB::table('tags')->insertGetId(array('name' => $tag_name));
                    }
                    $tags[] = $tag_id;            
                }
                $topic->tags()->sync($tags);
                
                return Redirect::to('main/index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
