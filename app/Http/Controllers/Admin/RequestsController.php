<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request\BulkDestroyRequest;
use App\Http\Requests\Admin\Request\DestroyRequest;
use App\Http\Requests\Admin\Request\IndexRequest;
use App\Http\Requests\Admin\Request\StoreRequest;
use App\Http\Requests\Admin\Request\UpdateRequest;
use App\Models\Request;
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

class RequestsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return array|Factory|View
     */
    public function index(IndexRequest $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Request::class)->processRequestAndGet(
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

        return view('admin.request.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.request.create');

        return view('admin.request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRequest $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Request
        $request = Request::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/requests'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/requests');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @throws AuthorizationException
     * @return void
     */
    public function show(Request $request)
    {
        $this->authorize('admin.request.show', $request);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $this->authorize('admin.request.edit', $request);


        return view('admin.request.edit', [
            'request' => $request,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Request $request
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRequest $request, Request $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Request
        $request->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/requests'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/requests');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Request $request
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRequest $request, Request $request)
    {
        $request->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRequest $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRequest $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Request::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
