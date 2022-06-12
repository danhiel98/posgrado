@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.application.actions.index'))

@section('body')

    <application-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/applications') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.application.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/applications/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.application.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">
                                            
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.application.columns.id') }}</th>
                                        <th is='sortable' :column="'entrence_year'">{{ trans('admin.application.columns.entrence_year') }}</th>
                                        <th is='sortable' :column="'graduation_year'">{{ trans('admin.application.columns.graduation_year') }}</th>
                                        <th is='sortable' :column="'cum'">{{ trans('admin.application.columns.cum') }}</th>
                                        <th is='sortable' :column="'graduation_date'">{{ trans('admin.application.columns.graduation_date') }}</th>
                                        <th is='sortable' :column="'high_school_title'">{{ trans('admin.application.columns.high_school_title') }}</th>
                                        <th is='sortable' :column="'birth_certificate'">{{ trans('admin.application.columns.birth_certificate') }}</th>
                                        <th is='sortable' :column="'paes'">{{ trans('admin.application.columns.paes') }}</th>
                                        <th is='sortable' :column="'health_certificate'">{{ trans('admin.application.columns.health_certificate') }}</th>
                                        <th is='sortable' :column="'specialization_id'">{{ trans('admin.application.columns.specialization_id') }}</th>
                                        <th is='sortable' :column="'degree_id'">{{ trans('admin.application.columns.degree_id') }}</th>
                                        <th is='sortable' :column="'applicant_id'">{{ trans('admin.application.columns.applicant_id') }}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="14">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/applications')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/applications/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                    <td>@{{ item.id }}</td>
                                        <td>@{{ item.entrence_year | date }}</td>
                                        <td>@{{ item.graduation_year | date }}</td>
                                        <td>@{{ item.cum }}</td>
                                        <td>@{{ item.graduation_date | date }}</td>
                                        <td>@{{ item.high_school_title }}</td>
                                        <td>@{{ item.birth_certificate }}</td>
                                        <td>@{{ item.paes }}</td>
                                        <td>@{{ item.health_certificate }}</td>
                                        <td>@{{ item.specialization_id }}</td>
                                        <td>@{{ item.degree_id }}</td>
                                        <td>@{{ item.applicant_id }}</td>
                                        
                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/applications/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.application.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </application-listing>

@endsection