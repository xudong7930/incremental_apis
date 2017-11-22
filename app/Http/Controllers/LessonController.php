<?php

namespace App\Http\Controllers;

use App\Acme\Transformer\LessonTransformer;
use App\Http\Conrollers\ApiController;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonController extends ApiController
{
    protected $transformer;

    public function __construct(LessonTransformer $transformer)
    {
        $this->transformer = $transformer;
        // $this->middleware('auth.basic');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. All is bad
        // 2. No way to atach meta data.
        // 3. Linking db structrue to the API output.
        // 4. No way to signal headers/response codes.
        // return Lesson::all(); // really bad practice
        


        /*
        $lessons = Lesson::all();
        return Response::json([
            // 'data' => $this->transformCollection($lessons)
            'data' => $this->transformer->transformCollection($lessons->toArray())
        ], 200);
        // curl  http://localhost:8000/api/lesson | python -mjson.tool
        */ 
       
       /*
        $lessons = Lesson::all();
        return $this->respond([
            'data' => $this->transformer->transformCollection($lessons->items())
        ]);
        */


        $limit = request('limit', 5);
        $lessons = Lesson::paginate($limit);
        return $this->respondWithPagination($lessons, $lessons->all());
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
        if(!$request->get('title') or !$request->get('content')) {
            return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a lesson.');
        }

        Lesson::create($request->all());

        return $this->respondCreated('lesson create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($lesson)
    {
        $lesson = Lesson::find($lesson);
        if (!$lesson) {
            /*
            return Response::json([
                'error' => [
                    'message' => 'Lesson does not exist'
                ]
            ], 404);
            */
            return $this->respondNotFound('Lesson does not exist');
        }


        /*
        return Response::json([
            // 'data' => $lesson->toArray()
            // 'data' => $this->transform($lesson)
            'data' => $this->transformer->transform($lesson->toArray())
        ], 200);
        */
       return $this->respond([
            'data' => $this->transformer->transform($lesson->toArray())
       ]);
    }

    protected function transformCollection($lessons)
    {
        return array_map([$this, 'transform'], $lessons->toArray());
    }

    protected function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['content'],
            'active' => (boolean)$lesson['some_bool']
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
