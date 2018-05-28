<template>
    <vue-modal id="modal-log" title="Log de Cambios" modalClass="container">
        <template slot="body">
            <div class="scroller" style="height:400px" data-rail-visible="1" data-rail-color="white" data-handle-color="#a1b2bd">
                <div class="row">
                    <div class="col-md-12">
                        <div class="timeline">
                            <div class="timeline-item  bg-white border-grey-steel" v-if="metadata.length > 0" v-for="data in metadata">
                                <div>
                                    <div class="timeline-badge">
                                        <img class="timeline-badge-userpic" :src="setIcon(data.profile_pic)">
                                    </div>
                                    <div class="timeline-body">
                                        <div class="timeline-body-arrow"> </div>
                                        <div class="timeline-body-head">

                                            <div class="timeline-body-head-caption">
                                                <a href="javascript:;" class="timeline-body-title font-blue-madison" v-text="data.user"></a>
                                                <span class="timeline-body-time font-grey-cascade"v-text="setDate(data.created_at)"></span>
                                            </div>

                                            <div class="timeline-body-head-actions">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline"
                                                            :class="data.event_class"
                                                            type="button"
                                                            v-text="data.event">
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="timeline-body-content">
                                            <div class="row">
                                                <div class="col-md-12 flip-scroll">
                                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                                        <tbody>
                                                            <tr>
                                                               <th width="20%"> ID </th>
                                                                <td>{{ data.id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> Usuario </th>
                                                                <td>{{ data.user }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> Teléfono </th>
                                                                <td>{{ data.phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> E-mail </th>
                                                                <td>{{ data.email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> Url de la petición </th>
                                                                <td>{{ data.url }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> IP </th>
                                                                <td>{{ data.ip_address }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> User Agent </th>
                                                                <td>{{ data.user_agent }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> Valor anterior </th>
                                                                <td><pre>{{ data.old_value }}</pre></td>
                                                            </tr>
                                                            <tr>
                                                                <th> Valor Nuevo </th>
                                                                <td><pre>{{ data.new_value }}</pre></td>
                                                            </tr>
                                                            <tr>
                                                                <th> Fecha de Creación del Evento </th>
                                                                <td>{{ data.created_at }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th> Fecha de Actualización del Evento </th>
                                                                <td>{{ data.updated_at }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="timeline-item">
                                <div class="timeline-badge">
                                    <div class="timeline-icon">
                                        <i class="icon-user-following font-green-haze"></i>
                                    </div>
                                </div>
                                <div class="timeline-body">
                                    <div class="timeline-body-arrow"> </div>
                                    <div class="timeline-body-content">
                                        <span class="font-grey-cascade">No hay datos para este recurso</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </vue-modal>
</template>

<script>
    import moment from 'moment-with-locales-es6'
    import {mixinProfilePic} from "../../../mixins/picture";
    import {mixinMomentLocale} from "../../../mixins/moment";
    export default {
        name: "laravel-audits",
        mixins: [mixinProfilePic, mixinMomentLocale],
        props: {
            metadata: {
                type: [Array, Object],
                required: true,
            }
        },
        methods: {
            setIcon: function ( image ) {
                return this.getSrc( image );
            },
            setDate: function ( date ) {
                return (date) ? moment(date).format('ll') : null
            }
        }
    }
</script>

<style scoped>

</style>