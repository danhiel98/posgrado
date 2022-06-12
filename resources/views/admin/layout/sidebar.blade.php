<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/posts') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.post.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/applicants') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.applicant.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/hrworkers') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.hrworker.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/degrees') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.degree.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/specializations') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.specialization.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/revisions') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.revision.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/applications') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.application.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
