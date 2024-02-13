<?php

namespace App\Http\Controllers\Api;

use App\Models\CaseHearing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentCollection;

class CaseHearingAppointmentsController extends Controller
{
    public function index(
        Request $request,
        CaseHearing $caseHearing
    ): AppointmentCollection {
        $this->authorize('view', $caseHearing);

        $search = $request->get('search', '');

        $appointments = $caseHearing
            ->appointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AppointmentCollection($appointments);
    }

    public function store(
        Request $request,
        CaseHearing $caseHearing
    ): AppointmentResource {
        $this->authorize('create', Appointment::class);

        $validated = $request->validate([
            'mod_id' => ['required', 'exists:mods,id'],
            'empID' => ['required', 'max:255', 'string'],
            'fullname' => ['required', 'max:255', 'string'],
            'chargeType' => ['required', 'max:255', 'string'],
            'appointmentDate' => ['required', 'date'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $appointment = $caseHearing->appointments()->create($validated);

        return new AppointmentResource($appointment);
    }
}
