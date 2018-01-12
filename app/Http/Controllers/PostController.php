<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return response()->json(['posts' => \App\Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            	'name'        => 'required|alpha',
            	'salary' => 'required|numeric',
            	'priority' => 'required|integer'
        	],
         	[
         	    'name.required' => 'Название не введено',
      		  	'name.alpha' => 'Название введено не верно',
      		  	'salary.required' => 'Оклад не введен',
      		  	'salary.numeric' => 'Оклад введен не верно',
      		  	'priority.required' => 'Приоритет не введен',
      		  	'priority.integer' => 'Приоритет введен не верно'
        	]);
 
        Post::create([
            'name' => $request->name,
            'salary' => $request->salary,
            'post_priority' => $request->priority
        ]);
 
		return response()->json(['posts' => \App\Post::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
            $this->validate($request, [
            	'name'        => 'required|alpha',
            	'salary' => 'required|numeric',
            	'priority' => 'required|integer'
        	],
         	[
         	    'name.required' => 'Название не введено',
      		  	'name.alpha' => 'Название введено не верно',
      		  	'salary.required' => 'Оклад не введен',
      		  	'salary.numeric' => 'Оклад введен не верно',
      		  	'priority.required' => 'Приоритет не введен',
      		  	'priority.integer' => 'Приоритет введен не верно'
        	]);
 
        $post->name = $request->name;
        $post->salary = $request->salary;
        $post->post_priority = $request->priority;
		$post->save();
 
		return response()->json(['posts' => \App\Post::all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     *      * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
    	if( count(Post::find($post->id)->employees) > 0 )
    	{	
			return response()->json(['errors' => ['message' =>'Есть сотрудники в этой должности']])->setStatusCode(422);
		}
		$post->delete();
    }
}
