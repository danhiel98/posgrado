<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.hrworker.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.hrworker.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('birth_date'), 'has-success': fields.birth_date && fields.birth_date.valid }">
    <label for="birth_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.hrworker.columns.birth_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.birth_date" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('birth_date'), 'form-control-success': fields.birth_date && fields.birth_date.valid}" id="birth_date" name="birth_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('birth_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('birth_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('phone_number'), 'has-success': fields.phone_number && fields.phone_number.valid }">
    <label for="phone_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.hrworker.columns.phone_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.phone_number" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('phone_number'), 'form-control-success': fields.phone_number && fields.phone_number.valid}" id="phone_number" name="phone_number" placeholder="{{ trans('admin.hrworker.columns.phone_number') }}">
        <div v-if="errors.has('phone_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address'), 'has-success': fields.address && fields.address.valid }">
    <label for="address" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.hrworker.columns.address') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address'), 'form-control-success': fields.address && fields.address.valid}" id="address" name="address" placeholder="{{ trans('admin.hrworker.columns.address') }}">
        <div v-if="errors.has('address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('dui'), 'has-success': fields.dui && fields.dui.valid }">
    <label for="dui" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.hrworker.columns.dui') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.dui" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('dui'), 'form-control-success': fields.dui && fields.dui.valid}" id="dui" name="dui" placeholder="{{ trans('admin.hrworker.columns.dui') }}">
        <div v-if="errors.has('dui')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('dui') }}</div>
    </div>
</div>


