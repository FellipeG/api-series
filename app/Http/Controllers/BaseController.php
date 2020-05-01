<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class BaseController extends Controller
{

    private $classe;

    public function __construct($classe)
    {
        $this->classe = $classe;
    }

    public function index()
    {
        return $this->classe::paginate();
    }

    public function show(int $id)
    {
        $model = $this->classe::find($id);

        if (is_null($model)) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], Response::HTTP_NO_CONTENT);
        }

        return response()->json($model, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        return response()->json($this->classe::create($request->all()), Response::HTTP_CREATED);

    }

    public function update(Request $request, int $id)
    {
        $model = $this->classe::find($id);

        if(is_null($model)) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $model->fill($request->all());

        if ($model->save()) {
            return response()->json($model, Response::HTTP_OK);
        }

        return response()->json('', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(int $id)
    {
        if (!$this->classe::destroy($id)) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Episode deleted'
        ], Response::HTTP_OK);
    }
}
