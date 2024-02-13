<?php

namespace App\Http\Controllers\Api;

use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentCollection;

class ModAppointmentsController extends Controller
{
    public function index(Request $request, Mod $mod): AppointmentCollection
    {
        $this->authorize('view', $mod);

        $search = $request->get('search', '');

        $appointments = $mod
            ->appointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AppointmentCollection($appointments);
    }

    public function store(Request $request, Mod $mod): AppointmentResource
    {
        $this->authorize('create', Appointment::class);

        $validated = $request->validate([
            'case_hearing_id' => ['required', 'exists:case_hearings,id'],
            'empID' => ['required', 'max:255', 'string'],
            'fullname' => ['required', 'max:255', 'string'],
            'chargeType' => ['required', 'max:255', 'string'],
            'appointmentDate' => ['required', 'date'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $appointment = $mod->appointments()->create($validated);

        return new AppointmentResource($appointment);
    }
}
