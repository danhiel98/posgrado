@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.revision.actions.edit', ['name' => $revision->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <revision-form
                :action="'{{ $revision->resource_url }}'"
                :data="{{ $revision->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.revision.actions.edit', ['name' => $revision->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.revision.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </revision-form>

        </div>
    
</div>

@endsection