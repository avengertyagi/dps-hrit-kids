<?php

namespace App\Http\Controllers;

use App\Models\{State, City, Page, PageSection};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MasterController extends Controller
{
    /**
     * Fetch states based on the given query string and country id.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchState(Request $request)
    {
        $query = $request["q"];
        $data = State::where('status', 'active')->where('country_id', 101)
            ->when($query, function ($q) use ($query) {
                return $q->whereLike('name', "%{$query}%");
            })->paginate(10);
        return Response::json($data);
    }
    /**
     * Fetch cities based on the given query string and state id.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchCity(Request $request)
    {
        $query = $request["q"];
        $data = City::where('status', 'active')->where('state_id', $request['state_id'])
            ->when($query, function ($q) use ($query) {
                return $q->whereLike('name', "%{$query}%");
            })->paginate(10);
        return Response::json($data);
    }
    /**
     * Fetch pages based on the given query string.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchPages(Request $request)
    {
        $query = $request["q"];
        $data = Page::where('parent_id', '0')->when($query, function ($q) use ($query) {
            return $q->whereLike('title', "%{$query}%");
        })->paginate(10);
        return Response::json($data);
    }
    /**
     * Fetch page sections based on the given query string.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchPageSections(Request $request)
    {
        $query = $request["q"];
        $data = PageSection::where('parent_id', '0')->when($query, function ($q) use ($query) {
            return $q->whereLike('title', "%{$query}%");
        })->paginate(10);
        return Response::json($data);
    }
}
