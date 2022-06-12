<div class="form-group row align-items-center" :class="{'has-danger': errors.has('entrence_year'), 'has-success': fields.entrence_year && fields.entrence_year.valid }">
    <label for="entrence_year" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.entrence_year') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.entrence_year" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('entrence_year'), 'form-control-success': fields.entrence_year && fields.entrence_year.valid}" id="entrence_year" name="entrence_year" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('entrence_year')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('entrence_year') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('graduation_year'), 'has-success': fields.graduation_year && fields.graduation_year.valid }">
    <label for="graduation_year" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.graduation_year') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.graduation_year" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('graduation_year'), 'form-control-success': fields.graduation_year && fields.graduation_year.valid}" id="graduation_year" name="graduation_year" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('graduation_year')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('graduation_year') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cum'), 'has-success': fields.cum && fields.cum.valid }">
    <label for="cum" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.cum') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cum" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cum'), 'form-control-success': fields.cum && fields.cum.valid}" id="cum" name="cum" placeholder="{{ trans('admin.application.columns.cum') }}">
        <div v-if="errors.has('cum')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cum') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('graduation_date'), 'has-success': fields.graduation_date && fields.graduation_date.valid }">
    <label for="graduation_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.graduation_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.graduation_date" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('graduation_date'), 'form-control-success': fields.graduation_date && fields.graduation_date.valid}" id="graduation_date" name="graduation_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('graduation_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('graduation_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('high_school_title'), 'has-success': fields.high_school_title && fields.high_school_title.valid }">
    <label for="high_school_title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.high_school_title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.high_school_title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('high_school_title'), 'form-control-success': fields.high_school_title && fields.high_school_title.valid}" id="high_school_title" name="high_school_title" placeholder="{{ trans('admin.application.columns.high_school_title') }}">
        <div v-if="errors.has('high_school_title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('high_school_title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('birth_certificate'), 'has-success': fields.birth_certificate && fields.birth_certificate.valid }">
    <label for="birth_certificate" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.birth_certificate') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.birth_certificate" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('birth_certificate'), 'form-control-success': fields.birth_certificate && fields.birth_certificate.valid}" id="birth_certificate" name="birth_certificate" placeholder="{{ trans('admin.application.columns.birth_certificate') }}">
        <div v-if="errors.has('birth_certificate')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('birth_certificate') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('paes'), 'has-success': fields.paes && fields.paes.valid }">
    <label for="paes" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.paes') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.paes" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('paes'), 'form-control-success': fields.paes && fields.paes.valid}" id="paes" name="paes" placeholder="{{ trans('admin.application.columns.paes') }}">
        <div v-if="errors.has('paes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('paes') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('health_certificate'), 'has-success': fields.health_certificate && fields.health_certificate.valid }">
    <label for="health_certificate" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.health_certificate') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.health_certificate" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('health_certificate'), 'form-control-success': fields.health_certificate && fields.health_certificate.valid}" id="health_certificate" name="health_certificate" placeholder="{{ trans('admin.application.columns.health_certificate') }}">
        <div v-if="errors.has('health_certificate')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('health_certificate') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('specialization_id'), 'has-success': fields.specialization_id && fields.specialization_id.valid }">
    <label for="specialization_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.specialization_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.specialization_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('specialization_id'), 'form-control-success': fields.specialization_id && fields.specialization_id.valid}" id="specialization_id" name="specialization_id" placeholder="{{ trans('admin.application.columns.specialization_id') }}">
        <div v-if="errors.has('specialization_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('specialization_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('degree_id'), 'has-success': fields.degree_id && fields.degree_id.valid }">
    <label for="degree_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.degree_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.degree_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('degree_id'), 'form-control-success': fields.degree_id && fields.degree_id.valid}" id="degree_id" name="degree_id" placeholder="{{ trans('admin.application.columns.degree_id') }}">
        <div v-if="errors.has('degree_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('degree_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('applicant_id'), 'has-success': fields.applicant_id && fields.applicant_id.valid }">
    <label for="applicant_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.applicant_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.applicant_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('applicant_id'), 'form-control-success': fields.applicant_id && fields.applicant_id.valid}" id="applicant_id" name="applicant_id" placeholder="{{ trans('admin.application.columns.applicant_id') }}">
        <div v-if="errors.has('applicant_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('applicant_id') }}</div>
    </div>
</div>


