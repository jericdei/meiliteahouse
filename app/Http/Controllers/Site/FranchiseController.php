<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Franchise\FranchisingFormRequest;
use App\Models\Franchise\FranchisingSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Throwable;

class FranchiseController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Landing/Franchise');
    }

    public function store(FranchisingFormRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            FranchisingSubmission::create([
                'full_name' => $request->validated('fullName'),
                'address' => $request->validated('address'),
                'age' => $request->validated('age'),
                'contact_no' => $request->validated('contactNo'),
                'email' => $request->validated('email'),
                'target_location' => $request->validated('targetLocation'),
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();

            throw $e;
        }

        return redirect()
            ->back()
            ->with('alert', 'Your details have been successfully submitted! We will contact you very soon after we verify your information.');
    }
}
