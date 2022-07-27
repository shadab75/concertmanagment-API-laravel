<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewHallSeatRequest;
use App\Http\Resources\HallResource;
use App\Http\Resources\HallSeatResource;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HallSeatController extends Controller
{
    //
    public function store(Hall $hall,NewHallSeatRequest $request)
    {

     $seats = $request->get('seats');
      $requestedSeatCount = collect($seats)->sum('seat_count');
      if ($requestedSeatCount>$hall->seat_count){
          return response()->json([
              'errors'=>[
                  'seat count is greater than all hall capacity'
              ]
          ])->setStatusCode(200);
      }

      foreach ($seats as $seat){
          $id = $seat['seat_class_id'];
          unset($seat['seat_class_id']);
          $hall->seats()->attach($id,$seat);
      }
      return response()->json([
          'data'=>[
              new HallSeatResource($hall)
          ]
      ])->setStatusCode(200);
    }

    /**
     * @param Hall $hall
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Hall $hall)
    {
        return response()->json([
           'data'=>[
               'hall_seats'=>New HallSeatResource($hall)
           ]
        ])->setStatusCode(200);
    }

    public function update(Hall $hall,NewHallSeatRequest $request)
    {
        $hall->seats()->detach();
        $seats = $request->get('seats');
        $requestedSeatCount = collect($seats)->sum('seat_count');
        if ($requestedSeatCount>$hall->seat_count){
            return response()->json([
                'errors'=>[
                    'seat count is greater than all hall capacity'
                ]
            ])->setStatusCode(200);
        }

        foreach ($seats as $seat){
            $id = $seat['seat_class_id'];
            unset($seat['seat_class_id']);
            $hall->seats()->attach($id,$seat);
        }
        return response()->json([
            'data'=>[
                new HallSeatResource($hall)
            ]
        ])->setStatusCode(200);
    }
}
