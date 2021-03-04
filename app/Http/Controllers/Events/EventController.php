<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $event = new Event;

        if ($request->file()) {
            $file_name = time() . '_' . $request->image->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('uploads', $file_name, 'public');

            $event->image_name = time() . '_' . $request->image->getClientOriginalName();
            $event->image_path = '/storage/' . $file_path;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->save();

            return response()->json(['success' => 'File uploaded successfully.']);
//        $newPath = $request->photo->store('image', 'public');
//        Event::create($validatedData);
//        return ['message' => 'Post Created'];
        }
    }
//
//        $request->validate([
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        $imageName = time().'.'.$request->image->extension();
//        print_r($imageName);
//        $attributes = [
//            'picture' => $request->picture->move(public_path('images'), $imageName),
//            'title' => $request->title,
//            'description' => $request->description,
//            'created_at' => Carbon::now(),
//            'start_at' => $request->start_at,
//            'ending_at' => $request->ending_at,
//            'nb_people_max' => $request->nb_people_max,
//            'need_subscribe' => $request->need_subscribe,
//            'place' => $request->place,
//            'address' => $request->address,
//            'street' => $request->street,
//            'town' =>$request->town,
//            'api_google_id' => $request->api_google_id,
//            'pictures' => $request->pictures,
//            'event_type_id' => $request->event_type_id
//        ];
//        print_r($attributes);
//        $event = Event::create($attributes);
//
//        return response()->json([
//            $event,
//            'message' => __('event created succefully')
//        ], 201, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Item
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item["name"];
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Event::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();


        $attributes = [
            'image' => $request->image->move(public_path('images'), $imageName),
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'nb_people_max' => $request->nb_people_max,
            'need_subscribe' => $request->need_subscribe,
            'api_google_id' => $request->api_google_id,
            'coordinates' => $request->coordinates,
            'pictures' => $request->pictures,
            'event_type_id' => $request->event_type_id
        ];

        $event = $this->event_interface->update($attributes, $id);

        return response()->json([
            'message' => __('event edit succefully')
        ], 201, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {

        $event = Event::find($id);

        if ($event) {
            // Editer l'utilisateur dans notre BDD
            $attributes = [
                'name' => $request->name,
                'created_at' => Carbon::now(),
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'nb_people_max' => $request->nb_people_max,
                'need_subscribe' => $request->need_subscribe,
                'api_google_id' => $request->api_google_id,
                'coordinates' => $request->coordinates,
                'pictures' => $request->pictures,
                'event_type_id' => $request->event_type_id
            ];
            $updateNow = $event->update($attributes);
            return $updateNow;
        } else {
            return "Event not found";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingEvent = Event::find( $id );
        if ($existingEvent ) {
            Event::findOrFail($id)->delete();
            return "Event succefully deleted";
        }else{
            return "Event not found";
        }
    }
}
