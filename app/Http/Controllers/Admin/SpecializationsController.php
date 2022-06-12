<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specialization\BulkDestroySpecialization;
use App\Http\Requests\Admin\Specialization\DestroySpecialization;
use App\Http\Requests\Admin\Specialization\IndexSpecialization;
use App\Http\Requests\Admin\Specialization\StoreSpecialization;
use App\Http\Requests\Admin\Specialization\UpdateSpecialization;
use App\Models\Specialization;
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

class SpecializationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSpecialization $request
     * @return array|Factory|View
     */
    public function index(IndexSpecialization $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Specialization::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'degree_id'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.specialization.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.specialization.create');

        return view('admin.specialization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSpecialization $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSpecialization $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Specialization
        $specialization = Specialization::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/specializations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/specializations');
    }

    /**
     * Display the specified resource.
     *
     * @param Specialization $specialization
     * @throws AuthorizationException
     * @return void
     */
    public function show(Specialization $specialization)
    {
        $this->authorize('admin.specialization.show', $specialization);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Specialization $specialization
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Specialization $specialization)
    {
        $this->authorize('admin.specialization.edit', $specialization);


        return view('admin.specialization.edit', [
            'specialization' => $specialization,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSpecialization $request
     * @param Specialization $specialization
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSpecialization $request, Specialization $specialization)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Specialization
        $specialization->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/specializations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/specializations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroySpecialization $request
     * @param Specialization $specialization
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySpecialization $request, Specialization $specialization)
    {
        $specialization->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroySpecialization $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySpecialization $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Specialization::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
