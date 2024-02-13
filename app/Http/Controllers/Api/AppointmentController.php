<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentCollection;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;

class AppointmentController extends Controller
{
    public function index(Request $request): AppointmentCollection
    {
        $this->authorize('view-any', Appointment::class);

        $search = $request->get('search', '');

        $appointments = Appointment::search($search)
            ->latest()
            ->paginate();

        return new AppointmentCollection($appointments);
    }

    public function store(AppointmentStoreRequest $request): AppointmentResource
    {
        $this->authorize('create', Appointment::class);

        $validated = $request->validated();

        $appointment = Appointment::create($validated);

        return new AppointmentResource($appointment);
    }

    public function show(
        Request $request,
        Appointment $appointment
    ): AppointmentResource {
        $this->authorize('view', $appointment);

        return new AppointmentResource($appointment);
    }

    public function update(
        AppointmentUpdateRequest $request,
        Appointment $appointment
    ): AppointmentResource {
        $this->authorize('update', $appointment);

        $validated = $request->validated();

        $appointment->update($validated);

        return new AppointmentResource($appointment);
    }

    public function destroy(
        Request $request,
        Appointment $appointment
    ): Response {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return response()->noContent();
    }
}
