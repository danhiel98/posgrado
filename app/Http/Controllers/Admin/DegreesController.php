<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Degree\BulkDestroyDegree;
use App\Http\Requests\Admin\Degree\DestroyDegree;
use App\Http\Requests\Admin\Degree\IndexDegree;
use App\Http\Requests\Admin\Degree\StoreDegree;
use App\Http\Requests\Admin\Degree\UpdateDegree;
use App\Models\Degree;
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

class DegreesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDegree $request
     * @return array|Factory|View
     */
    public function index(IndexDegree $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Degree::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

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

        return view('admin.degree.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.degree.create');

        return view('admin.degree.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDegree $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDegree $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Degree
        $degree = Degree::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/degrees'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/degrees');
    }

    /**
     * Display the specified resource.
     *
     * @param Degree $degree
     * @throws AuthorizationException
     * @return void
     */
    public function show(Degree $degree)
    {
        $this->authorize('admin.degree.show', $degree);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Degree $degree
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Degree $degree)
    {
        $this->authorize('admin.degree.edit', $degree);


        return view('admin.degree.edit', [
            'degree' => $degree,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDegree $request
     * @param Degree $degree
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDegree $request, Degree $degree)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Degree
        $degree->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/degrees'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/degrees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDegree $request
     * @param Degree $degree
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDegree $request, Degree $degree)
    {
        $degree->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDegree $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDegree $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Degree::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
