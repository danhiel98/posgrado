<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\BulkDestroyApplication;
use App\Http\Requests\Admin\Application\DestroyApplication;
use App\Http\Requests\Admin\Application\IndexApplication;
use App\Http\Requests\Admin\Application\StoreApplication;
use App\Http\Requests\Admin\Application\UpdateApplication;
use App\Models\Application;
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

class ApplicationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexApplication $request
     * @return array|Factory|View
     */
    public function index(IndexApplication $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Application::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'entrence_year', 'graduation_year', 'cum', 'graduation_date', 'high_school_title', 'birth_certificate', 'paes', 'health_certificate', 'specialization_id', 'degree_id', 'applicant_id'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.application.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.application.create');

        return view('admin.application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApplication $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreApplication $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Application
        $application = Application::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/applications'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/applications');
    }

    /**
     * Display the specified resource.
     *
     * @param Application $application
     * @throws AuthorizationException
     * @return void
     */
    public function show(Application $application)
    {
        $this->authorize('admin.application.show', $application);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Application $application
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Application $application)
    {
        $this->authorize('admin.application.edit', $application);


        return view('admin.application.edit', [
            'application' => $application,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplication $request
     * @param Application $application
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateApplication $request, Application $application)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Application
        $application->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/applications'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/applications');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyApplication $request
     * @param Application $application
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyApplication $request, Application $application)
    {
        $application->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyApplication $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyApplication $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Application::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
