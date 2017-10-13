<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Actividades'])
    @slot('actions', [
            'link_back' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
        <div class="row">
            <div class="col-md-6">
                    {!! Field::hidden('id', $id) !!}
            </div>
            <div class="clearfix"> </div><br>
            <br>
            <br>
            <br>
            <div class="col-md-12">
                
                
            </div>
        </div>
    @endcomponent
       </div>


<script>
jQuery(document).ready(function () {    
});
</script>
