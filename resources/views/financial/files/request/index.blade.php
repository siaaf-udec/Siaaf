@extends('material.layouts.dashboard')

@push('styles')

@endpush

@section('title', ' | Aprobación de Archivos')

@section('page-title', 'Aprobar Archivos')

@section('page-description', 'para validación y aprobación de archivos Icetex y Apoyo Financiero')

@section('content')
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class=" icon-social-twitter font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Aprobar Archivos</span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_actions_pending" data-toggle="tab"> Pendiente </a>
                    </li>
                    <li>
                        <a href="#tab_actions_completed" data-toggle="tab"> Aprobado </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_actions_pending">
                    @php $faker = Faker\Factory::create('es_ES'); @endphp
                        <!-- BEGIN: Actions -->
                        <div class="mt-actions">
                            @for($i = 0; $i <= 5; $i++)
                                <div class="mt-action">
                                    <div class="mt-action-img"> <img class="hash-avatar" src=""> </div>
                                    <div class="mt-action-body">
                                        <div class="mt-action-row">
                                            <div class="mt-action-info ">
                                                <div class="mt-action-icon ">
                                                    <i class="icon-action-redo"></i>
                                                </div>
                                                <div class="mt-action-details ">
                                                    <span class="mt-action-author">{{ $faker->name }}</span>
                                                    <p class="mt-action-desc">{{ $faker->sentence }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-action-datetime ">
                                                <span class="mt-action-date">{{ $faker->dayOfMonth .' '. $faker->monthName }} </span>
                                                <span class="mt-action-dot bg-{{ $faker->randomElement(['red', 'green']) }}"></span>
                                                <span class="mt=action-time">{{ $faker->time($format = 'H:i') }}-{{ $faker->time($format = 'H:i') }}</span>
                                            </div>
                                            <div class="mt-action-buttons ">
                                                <div class="btn-group btn-group-circle">
                                                    <button type="button" class="btn btn-outline green btn-sm">Appove</button>
                                                    <button type="button" class="btn btn-outline red btn-sm">Reject</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <!-- END: Actions -->
                    </div>
                    <div class="tab-pane" id="tab_actions_completed">
                        <!-- BEGIN:Completed-->
                        <div class="mt-actions">
                            @for($i = 0; $i <= 3; $i++)
                                <div class="mt-action">
                                    <div class="mt-action-img"> <img class="hash-avatar" src=""> </div>
                                    <div class="mt-action-body">
                                        <div class="mt-action-row">
                                            <div class="mt-action-info ">
                                                <div class="mt-action-icon ">
                                                    <i class="icon-action-redo"></i>
                                                </div>
                                                <div class="mt-action-details ">
                                                    <span class="mt-action-author">{{ $faker->name }}</span>
                                                    <p class="mt-action-desc">{{ $faker->sentence }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-action-datetime ">
                                                <span class="mt-action-date">{{ $faker->dayOfMonth .' '. $faker->monthName }} </span>
                                                <span class="mt-action-dot bg-{{ $faker->randomElement(['red', 'green']) }}"></span>
                                                <span class="mt=action-time">{{ $faker->time($format = 'H:i') }}-{{ $faker->time($format = 'H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                            <!-- END: Completed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('plugins')
<script src="{{ asset('assets/pages/scripts/financial/md5.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/pnglib.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/identicon.min.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
<script type="text/javascript">
    jQuery(document).ready(function () {
        var hash = md5('#'+Math.floor(Math.random()*16777215).toString(16));
        $('.hash-avatar').each(function () {
            var data = new Identicon(hash, 45).toString();
            $(this).attr('src', 'data:image/png;base64,' + data);
        });
    });
</script>
@endpush