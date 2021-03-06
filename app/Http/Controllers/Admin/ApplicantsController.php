<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Applicant\BulkDestroyApplicant;
use App\Http\Requests\Admin\Applicant\DestroyApplicant;
use App\Http\Requests\Admin\Applicant\IndexApplicant;
use App\Http\Requests\Admin\Applicant\StoreApplicant;
use App\Http\Requests\Admin\Applicant\UpdateApplicant;
use App\Models\Applicant;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ApplicantsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexApplicant $request
     * @return array|Factory|View
     */
    public function index(IndexApplicant $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Applicant::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'first_name', 'last_name', 'dui', 'student_id', 'birth_date', 'phone_number', 'email'],

            // set columns to searchIn
            ['id', 'first_name', 'last_name', 'dui', 'student_id', 'phone_number', 'email']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.applicant.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.applicant.create');

        return view('admin.applicant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApplicant $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreApplicant $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Applicant
        $applicant = Applicant::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/applicants'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/applicants');
    }

    /**
     * Display the specified resource.
     *
     * @param Applicant $applicant
     * @throws AuthorizationException
     * @return void
     */
    public function show(Applicant $applicant)
    {
        $this->authorize('admin.applicant.show', $applicant);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Applicant $applicant
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Applicant $applicant)
    {
        $this->authorize('admin.applicant.edit', $applicant);


        return view('admin.applicant.edit', [
            'applicant' => $applicant,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplicant $request
     * @param Applicant $applicant
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateApplicant $request, Applicant $applicant)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Applicant
        $applicant->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/applicants'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/applicants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyApplicant $request
     * @param Applicant $applicant
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyApplicant $request, Applicant $applicant)
    {
        $applicant->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyApplicant $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyApplicant $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Applicant::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
