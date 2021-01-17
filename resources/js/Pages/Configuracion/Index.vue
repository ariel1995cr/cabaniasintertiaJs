<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Configuracion
            </h2>
        </template>
        <div class="p-fluid p-formgrid p-grid p-mx-6 card">
            <div class="p-field p-col-12 p-md-6">
                <label for="nombreComplejo">Nombre complejo</label>
                <InputText id="nombreComplejo" type="text" v-model="data.nombreComplejo" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="direccion">Dirección</label>
                <InputText id="direccion" type="text" v-model="data.direccion" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="ubicacion">Ubicación</label>
                <InputText id="ubicacion" type="text" v-model="data.ubicacion" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="pais">País</label>
                <InputText id="pais" type="text" v-model="data.pais" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="provincia">Provincia</label>
                <InputText id="provincia" type="text" v-model="data.provincia" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="ciudad">Ciudad</label>
                <InputText id="ciudad" type="text" v-model="data.ciudad" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="telefono">Telefono</label>
                <InputText id="telefono" type="text" v-model="data.telefono" />
            </div>
            <div class="p-field p-col-12 p-md-6">
                <label for="email">Email</label>
                <InputText id="email" type="text" v-model="data.email" />
            </div>
            <div class="p-field p-col-12">
                <label for="email">Descripción</label>
                <Textarea v-model="data.descripcion" :autoResize="true" rows="5" cols="30" />
            </div>
            <div class="p-field p-col-12">
                <Button @click="update(data)" label="Guardar"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import InputText from 'primevue/inputtext'
    import Textarea from 'primevue/textarea'
    import Button from 'primevue/button';

    export default {
        components: {
            AppLayout,
            Welcome,
            InputText,
            Textarea,
            Button,
        },
        props: ['data', 'errors'],
        methods:{
            update: function (data){
                this.$inertia.put('/configuracion/' + data.id, data)
            },
        }
    }
</script>
