@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.degree.actions.edit', ['name' => $degree->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <degree-form
                :action="'{{ $degree->resource_url }}'"
                :data="{{ $degree->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.degree.actions.edit', ['name' => $degree->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.degree.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </degree-form>

        </div>
    
</div>

@endsection