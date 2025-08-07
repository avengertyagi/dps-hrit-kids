<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class AdmissionController extends Controller
{
    /**
     * Admission page view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.admission.index');
    }
    /**
     * Generate the Datatable for the Admission index page.
     *
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxTable(Request $request)
    {
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $admission_for = $request->admission_for;
        $dateRange = $request->date;
        $addmission = Admission::query()
            // ->when($country !== null, function ($addmission) use ($country) {
            //     return $addmission->where('country_id', '=', $country);
            // })
            // ->when($state !== null, function ($addmission) use ($state) {
            //     return $addmission->where('state_id', '=', $state);
            // })
            // ->when($city !== null, function ($addmission) use ($city) {
            //     return $addmission->where('city_id', '=', $city);
            // })
            ->when($admission_for !== null, function ($addmission) use ($admission_for) {
                return $addmission->where('admission_for', '=', $admission_for);
            })
            ->when($dateRange, function ($addmission) use ($dateRange) {
                $dates = explode(' to ', $dateRange);
                if (count($dates) == 2) {
                    $fromDate = Carbon::createFromFormat('Y/m/d', trim($dates[0]))->startOfDay();
                    $toDate = Carbon::createFromFormat('Y/m/d', trim($dates[1]))->endOfDay();
                    return $addmission->whereBetween('created_at', [$fromDate, $toDate]);
                }
                return $addmission;
            });
        return Datatables::of($addmission)
            ->addIndexColumn()
            ->editColumn('date', function ($data) {
                return $data->created_at->format('d/m/Y');
            })
            // ->addColumn('country', function ($data) {
            //     return ucfirst($data->country->name ?? 'NA');
            // })
            // ->addColumn('state', function ($data) {
            //     return ucfirst($data->state->name ?? 'NA');
            // })
            // ->addColumn('city', function ($data) {
            //     return ucfirst($data->city->name ?? 'NA');
            // })
            ->editColumn('admission_for', function ($data) {
                if ($data->admission_for == 'playgroup') {
                    return '<span class="badge bg-primary">Playgroup</span>';
                } elseif ($data->admission_for == 'nursery') {
                    return '<span class="badge bg-pink">Nursery</span>';
                } elseif ($data->admission_for == 'lkg') {
                    return '<span class="badge bg-warning">LKG</span>';
                } elseif ($data->admission_for == 'ukg') {
                    return '<span class="badge bg-purple">UKG</span>';
                }
            })
            ->rawColumns(['date', 'admission_for'])
            ->make(true);
    }
}
