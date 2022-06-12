<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Revision\BulkDestroyRevision;
use App\Http\Requests\Admin\Revision\DestroyRevision;
use App\Http\Requests\Admin\Revision\IndexRevision;
use App\Http\Requests\Admin\Revision\StoreRevision;
use App\Http\Requests\Admin\Revision\UpdateRevision;
use App\Models\Revision;
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

class RevisionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRevision $request
     * @return array|Factory|View
     */
    public function index(IndexRevision $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Revision::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'result', 'comments', 'hrworker_id', 'request_id'],

            // set columns to searchIn
            ['id', 'comments']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.revision.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.revision.create');

        return view('admin.revision.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRevision $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRevision $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Revision
        $revision = Revision::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/revisions'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/revisions');
    }

    /**
     * Display the specified resource.
     *
     * @param Revision $revision
     * @throws AuthorizationException
     * @return void
     */
    public function show(Revision $revision)
    {
        $this->authorize('admin.revision.show', $revision);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Revision $revision
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Revision $revision)
    {
        $this->authorize('admin.revision.edit', $revision);


        return view('admin.revision.edit', [
            'revision' => $revision,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRevision $request
     * @param Revision $revision
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRevision $request, Revision $revision)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Revision
        $revision->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/revisions'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/revisions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRevision $request
     * @param Revision $revision
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRevision $request, Revision $revision)
    {
        $revision->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRevision $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRevision $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Revision::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
