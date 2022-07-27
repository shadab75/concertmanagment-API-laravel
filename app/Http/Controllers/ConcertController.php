<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewConcertRequest;
use App\Http\Resources\ConcertResource;
use App\Models\concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    //
    public function index()
    {
        return response()->json([
           'data'=>[
               'concert'=>ConcertResource::collection(concert::paginate(5))->response()->getData()
           ]
        ]);
    }

    public function store(NewConcertRequest $request)
    {
        $otherActiveConcert =concert::query()->where('artist_id','=',$request->get('artist_id'))
            ->where(function($query) use ($request){
                $query->where(function ($query) use ($request){
                    $query->where('start_at','>=',$request->get('start_at'))
                        ->orwhere('start_at','<=',$request->get('ends_at'));
                })->orWhere(function ($query)use ($request){
                    $query->where('ends_at','>=',$request->get('start_at'))
                        ->orwhere('ends_at','<=',$request->get('ends_at'));
                });

            })->exists();

        if ($otherActiveConcert){
            return response()->json([
                'massage'=>'this artist already has plan'
            ])->setStatusCode(400);
        }

        $concert = concert::query()->create([
            'artist_id'=>$request->get('artist_id'),
           'title'=>$request->get('title'),
           'description'=>$request->get('description'),
           'start_at'=>$request->get('start_at'),
           'ends_at'=>$request->get('ends_at'),
           'is_published'=>(boolean)$request->get('is_published',false),
        ]);
        return response()->json([
            'data'=>[
                'concert'=>new ConcertResource($concert)
            ]
        ])->setStatusCode(200);
    }

    public function destroy(concert $concert)
    {
    $concert->delete();
    return response()->json([
       'data'=>[
           'message'=>'concert has been deleted successfully'
       ]
    ],200);
    }

}

