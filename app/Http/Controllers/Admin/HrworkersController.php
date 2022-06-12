<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hrworker\BulkDestroyHrworker;
use App\Http\Requests\Admin\Hrworker\DestroyHrworker;
use App\Http\Requests\Admin\Hrworker\IndexHrworker;
use App\Http\Requests\Admin\Hrworker\StoreHrworker;
use App\Http\Requests\Admin\Hrworker\UpdateHrworker;
use App\Models\Hrworker;
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

class HrworkersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexHrworker $request
     * @return array|Factory|View
     */
    public function index(IndexHrworker $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Hrworker::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'birth_date', 'phone_number', 'address', 'dui'],

            // set columns to searchIn
            ['id', 'name', 'phone_number', 'address', 'dui']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.hrworker.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.hrworker.create');

        return view('admin.hrworker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHrworker $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreHrworker $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Hrworker
        $hrworker = Hrworker::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/hrworkers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/hrworkers');
    }

    /**
     * Display the specified resource.
     *
     * @param Hrworker $hrworker
     * @throws AuthorizationException
     * @return void
     */
    public function show(Hrworker $hrworker)
    {
        $this->authorize('admin.hrworker.show', $hrworker);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hrworker $hrworker
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Hrworker $hrworker)
    {
        $this->authorize('admin.hrworker.edit', $hrworker);


        return view('admin.hrworker.edit', [
            'hrworker' => $hrworker,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHrworker $request
     * @param Hrworker $hrworker
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateHrworker $request, Hrworker $hrworker)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Hrworker
        $hrworker->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/hrworkers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/hrworkers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyHrworker $request
     * @param Hrworker $hrworker
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyHrworker $request, Hrworker $hrworker)
    {
        $hrworker->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyHrworker $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyHrworker $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Hrworker::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
