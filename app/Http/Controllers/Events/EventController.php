<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\CulturalJourney;
use App\Models\Event;
use App\Models\EventArt;
use App\Models\EventBookedUser;
use App\Models\EventGame;
use App\Models\EventJoinedUser;
use App\Models\EventLikedUser;
use App\Models\EventSport;
use App\Models\EventStyle;
use App\Models\EventSubStyle;
use App\Models\Game;
use App\Models\Sports;
use App\Models\Style;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $path = '/storage/app/json/france.json';
        $content = json_decode(file_get_contents($path), true);
        dd($content);
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

        $file_name = time() . '_' . $request->file('image')->getClientOriginalName();
        $file_path = $request->file('image')->storeAs('uploads', $file_name, 'public');

        $attributes = [
            'title' => $request->title,
            'image_name' => $file_name,
            'image_path' => '/storage/' . $file_path,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'start_at' => $request->start_at,
            'ending_at' => $request->ending_at,
            'nb_people_max' => $request->nb_people_max,
            'need_subscribe' => $request->need_subscribe,
            'place' => $request->place,
            'address' => $request->address,
            'street' => $request->street,
            'town' => $request->town,
            'api_google_id' => $request->api_google_id,
            'pictures' => $request->pictures,
            'event_type_id' => $request->event_type_id
        ];
        $attributes["user_id"] = Auth::id();
        $event = Event::create($attributes);

        return response()->json([
            $event->id,
            'message' => __('event created succefully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function joinEvent($id)
    {

        if (EventJoinedUser::where('user_id', Auth::id())->where('event_id', $id)->exists()) {

            $event = EventJoinedUser::where('user_id', Auth::id())
                ->where('event_id', $id)
                ->update(['deprecated' => false]);

            return response()->json([
                $event,
                'message' => __('event re like successfully')
            ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        } else {
            $attributes = [
                "user_id" => Auth::id(),
                "event_id" => $id,
            ];

            $event = EventJoinedUser::create($attributes);

            return response()->json([
                $event,
                'message' => __('event join successfully')
            ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function unJoinEvent($id)
    {

        $event = EventJoinedUser::where('user_id', Auth::id())
            ->where('event_id', $id)
            ->update(['deprecated' => true]);
        return response()->json([
            $event,
            'message' => __('event unjoin successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function likeEvent($id)
    {

        if (EventLikedUser::where('user_id', Auth::id())->where('event_id', $id)->exists()) {

            $event = EventLikedUser::where('user_id', Auth::id())
                ->where('event_id', $id)
                ->update(['deprecated' => false]);

            return response()->json([
                $event,
                'message' => __('event re like successfully')
            ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        } else {
            $attributes = [
                "user_id" => Auth::id(),
                "event_id" => $id,
            ];

            $event = EventLikedUser::create($attributes);

            return response()->json([
                $event,
                'message' => __('event like successfully')
            ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function unLikeEvent($id)
    {

        $event = EventLikedUser::where('user_id', Auth::id())
            ->where('event_id', $id)
            ->update(['deprecated' => true]);
        return response()->json([
            $event,
            'message' => __('event unlike successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function bookEvent($id)
    {
        if (EventBookedUser::where('user_id', Auth::id())->where('event_id', $id)->exists()) {

            $event = EventBookedUser::where('user_id', Auth::id())
                ->where('event_id', $id)
                ->update(['deprecated' => false]);

            return response()->json([
                $event,
                'message' => __('event re book successfully')
            ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        } else {
            $attributes = [
                "user_id" => Auth::id(),
                "event_id" => $id,
            ];

            $event = EventBookedUser::create($attributes);

            return response()->json([
                $event,
                'message' => __('event book successfully')
            ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function unBookEvent($id)
    {

        $event = EventBookedUser::where('user_id', Auth::id())
            ->where('event_id', $id)
            ->update(['deprecated' => true]);
        return response()->json([
            $event,
            'message' => __('event unbook successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function show($id)
    {
        $event = Event::find($id);
        $nb_like = EventLikedUser::where('event_id', $id)->count();
        $nb_book = EventBookedUser::where('event_id', $id)->count();
        $nb_join = EventJoinedUser::where('event_id', $id)->count();

        $tab_completed = [];

        $tab_completed["id"] = $event->id;
        $tab_completed["title"] = $event->title;
        $tab_completed["nb_like"] = $nb_like;
        $tab_completed["nb_book"] = $nb_book;
        $tab_completed["nb_join"] = $nb_join;
        $tab_completed["image_name"] = $event->file_name;
        $tab_completed["image_path"] = $event->file_path;
        $tab_completed["description"] = $event->description;
        $tab_completed["created_at"] = $event->created_at;
        $tab_completed["start_at"] = $event->start_at;
        $tab_completed["ending_at"] = $event->ending_at;
        $tab_completed["nb_people_max"] = $event->nb_people_max;
        $tab_completed["need_subscribe"] = $event->need_subscribe;
        $tab_completed["place"] = $event->place;
        $tab_completed["address"] = $event->address;
        $tab_completed["street"] = $event->street;
        $tab_completed["town"] = $event->town;
        $tab_completed["api_google_id"] = $event->api_google_id;
        $tab_completed["pictures"] = $event->pictures;
        $tab_completed["event_type_id"] = $event->event_type_id;

        return response()->json([
            $tab_completed,
            'message' => __('event unbook successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();


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
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request1
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


    public function eventSport(Request $request)
    {

        $attributes = [
            "sport_id" => $request->sport_id,
            "event_id" => $request->event_id,
        ];

        $event_sport = EventSport::create($attributes);
        return response()->json([
            $event_sport,
            'message' => __('event sport successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
    public function eventGame(Request $request)
    {

        $attributes = [
            "game_id" => $request->game_id,
            "event_id" => $request->event_id,
        ];

        $event_game = EventGame::create($attributes);
        return response()->json([
            $event_game,
            'message' => __('event game successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
    public function eventArt(Request $request)
    {

        $attributes = [
            "cultural_journey_id" => $request->cultural_journey_id,
            "event_id" => $request->event_id,
        ];

    $event_art = EventArt::create($attributes);
        return response()->json([
            $event_art,
            'message' => __('event art successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
    public function eventStyle(Request $request)
    {
        $attributes = [
            "style_id" => $request->style_id,
            "event_id" => $request->event_id,
        ];

        $event_style = EventStyle::create($attributes);
        return response()->json([
            $event_style,
            'message' => __('event sport successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
    public function eventSubStyle(Request $request)
    {

        $attributes = [
            "substyle_id" => $request->sub_style_id,
            "event_id" => $request->event_id,
        ];

        $event_sub_style = EventSubStyle::create($attributes);
        return response()->json([
            $event_sub_style,
            'message' => __('event sub_style_id successfully')
        ], 201, ['Content-type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy(int $id)
    {


        $existingEvent = Event::find($id);
        if ($existingEvent) {
            Event::findOrFail($id)->delete();
            return "Event succefully deleted";
        } else {
            return "Event not found";
        }
    }

    public function getStyle()
    {
        return DB::select("SELECT substyle.id as id_sub_style, substyle.sub_style_name, style_music.name, style_music.id
         FROM `substyle` INNER JOIN style_music ON substyle.style_id = style_music.id");
    }

    public function getGame()
    {
        return Game::all();
    }

    public function getCulturalJourney()
    {
        return CulturalJourney::all();
    }

    public function getSport()
    {
        return Sports::all();
    }
}
