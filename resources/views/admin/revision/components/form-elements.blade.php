<div class="form-check row" :class="{'has-danger': errors.has('result'), 'has-success': fields.result && fields.result.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="result" type="checkbox" v-model="form.result" v-validate="''" data-vv-name="result"  name="result_fake_element">
        <label class="form-check-label" for="result">
            {{ trans('admin.revision.columns.result') }}
        </label>
        <input type="hidden" name="result" :value="form.result">
        <div v-if="errors.has('result')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('result') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('comments'), 'has-success': fields.comments && fields.comments.valid }">
    <label for="comments" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.revision.columns.comments') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.comments" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('comments'), 'form-control-success': fields.comments && fields.comments.valid}" id="comments" name="comments" placeholder="{{ trans('admin.revision.columns.comments') }}">
        <div v-if="errors.has('comments')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('comments') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('hrworker_id'), 'has-success': fields.hrworker_id && fields.hrworker_id.valid }">
    <label for="hrworker_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.revision.columns.hrworker_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.hrworker_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('hrworker_id'), 'form-control-success': fields.hrworker_id && fields.hrworker_id.valid}" id="hrworker_id" name="hrworker_id" placeholder="{{ trans('admin.revision.columns.hrworker_id') }}">
        <div v-if="errors.has('hrworker_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('hrworker_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('request_id'), 'has-success': fields.request_id && fields.request_id.valid }">
    <label for="request_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.revision.columns.request_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.request_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('request_id'), 'form-control-success': fields.request_id && fields.request_id.valid}" id="request_id" name="request_id" placeholder="{{ trans('admin.revision.columns.request_id') }}">
        <div v-if="errors.has('request_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('request_id') }}</div>
    </div>
</div>


