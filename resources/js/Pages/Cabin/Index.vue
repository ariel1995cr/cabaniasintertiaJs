<template>
  <app-layout>
      <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cabañas - Gestión
            </h2>
    </template>
    <div class="px-6 p-mt-4">
        <Toolbar class="p-mb-4">
            <template #left>
                <Button label="Crear" @click="abrirModal(null, 'crear')" icon="pi pi-plus" class="p-button-success p-mr-2" />
            </template>

            <template #right>
                <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)"  />
            </template>
        </Toolbar>

        <DataTable :value="data" :paginator="true" class="p-datatable-customers" :rows="10"
            dataKey="id" :rowHover="true" :selection.sync="selectedCabins" :filters="filters" :loading="loading"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[10,25,50]"
            currentPageReportTemplate="Mostrando {first} al {last} de {totalRecords} datos">
            <template #header>
                <div class="table-header">
                    Listado de cabañas
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText v-model="filters['global']" placeholder="Global Search" />
                    </span>
                </div>
            </template>
            <template #empty>
                No customers found.
            </template>
            <template #loading>
                Loading customers data. Please wait.
            </template>
            <Column selectionMode="multiple" headerStyle="width: 3em"></Column>
            <Column field="id" header="Nombre" :sortable="true">
                <template #body="slotProps">
                    <span class="p-column-title">Nombre</span>
                    {{slotProps.data.id}}
                </template>
                <template #filter>
                    <InputText type="text" v-model="filters['id']" class="p-column-filter" placeholder="Buscar por nombre"/>
                </template>
            </Column>
            <Column field="type" header="Tipo" :sortable="true" filterMatchMode="equals">
            <template #body="slotProps">
                <span class="p-column-title">Tipo</span>
                <span>{{slotProps.data.type}}</span>
            </template>
            <template #filter>
                <Dropdown v-model="filters['type']" :options="tipoCabañas" placeholder="Seleccionar tipo" class="p-column-filter" :showClear="true">
                    <template #option="slotProps">
                        <span>{{slotProps.option}}</span>
                    </template>
                </Dropdown>
            </template>
            </Column>
            <Column field="cantPax" header="Pax max." :sortable="true">
                <template #body="slotProps">
                    <span class="p-column-title">Pax max.</span>
                    {{slotProps.data.cantPax}}
                </template>
                <template #filter>
                    <InputText type="text" v-model="filters['cantPax']" class="p-column-filter" placeholder="Buscar por cantidad de personas"/>
                </template>
            </Column>
            <Column field="valorTemporadaAlta" header="Precio TEMPORADA ALTA" :sortable="true">
                <template #body="slotProps">
                    <span class="p-column-title">Precio TEMPORADA ALTA.</span>
                    ${{slotProps.data.valorTemporadaAlta}}
                </template>
                <template #filter>
                    <InputText type="text" v-model="filters['valorTemporadaAlta']" class="p-column-filter" placeholder="Buscar por valor temporada alta"/>
                </template>
            </Column>
            <Column field="valorTemporadaBaja" header="Precio TEMPORADA VAJA" :sortable="true">
                <template #body="slotProps">
                    <span class="p-column-title">Precio TEMPORADA BAJA.</span>
                    ${{slotProps.data.valorTemporadaBaja}}
                </template>
                <template #filter>
                    <InputText type="text" v-model="filters['valorTemporadaBaja']" class="p-column-filter" placeholder="Buscar por valor temporada baja"/>
                </template>
            </Column>
            <Column headerStyle="width: 8rem; text-align: center" bodyStyle="text-align: center; overflow: visible">
                <template #body>
                    <Button type="button" icon="pi pi-cog" class="p-button-secondary"></Button>
                </template>
            </Column>
        </DataTable>
    </div>
    <Dialog :header="titleModal" :visible.sync="displayModal" :style="{width: '50vw'}" :modal="true">
                <div class="p-fluid p-formgrid p-grid">
                     <div class="p-field p-col-12 p-md-6">
                        <label for="nomCabaña">Nombre</label>
                        <InputText id="nomCabaña" type="text" v-model="form.id" />
                        <div v-if="$page.props.errors.id" class="text-red-500">{{ $page.props.errors.id }}</div>
                    </div>
                    <div class="p-field p-col-12 p-md-6">
                        <label for="nomCabaña">Tipo</label>
                        <Dropdown style="overflow: visible" v-model="form.type" :options="tipoCabañas" placeholder="Seleccionar Tipo" />
                        <div v-if="$page.props.errors.type" class="text-red-500">{{ $page.props.errors.type }}</div>
                    </div>
                    <div class="p-field p-col-12 p-md-4">
                      <label for="horizontal">Cantidad de personas</label>
                        <InputNumber id="horizontal" v-model="form.cantPax" showButtons buttonLayout="horizontal"
                        decrementButtonClass="p-button-danger" incrementButtonClass="p-button-success" incrementButtonIcon="pi pi-plus" decrementButtonIcon="pi pi-minus"/>
                        <div v-if="$page.props.errors.cantPax" class="text-red-500">{{ $page.props.errors.cantPax }}</div>
                    </div>
                    <div class="p-field p-col-12 p-md-4">
                      <label for="horizontal">Precio temporada alta</label>
                        <InputNumber id="horizontal" v-model="form.valorTemporadaAlta" showButtons buttonLayout="horizontal"
                        decrementButtonClass="p-button-danger" incrementButtonClass="p-button-success" incrementButtonIcon="pi pi-plus" decrementButtonIcon="pi pi-minus"/>
                        <div v-if="$page.props.errors.valorTemporadaAlta" class="text-red-500">{{ $page.props.errors.valorTemporadaAlta }}</div>
                    </div>
                    <div class="p-field p-col-12 p-md-4">
                      <label for="horizontal">Precio temporada baja</label>
                        <InputNumber id="horizontal" v-model="form.valorTemporadaBaja" showButtons buttonLayout="horizontal"
                        decrementButtonClass="p-button-danger" incrementButtonClass="p-button-success" incrementButtonIcon="pi pi-plus" decrementButtonIcon="pi pi-minus"/>
                        <div v-if="$page.props.errors.valorTemporadaBaja" class="text-red-500">{{ $page.props.errors.valorTemporadaBaja }}</div>
                    </div>
                    <div class="p-field p-col-12">
                        <label for="descripcion">Descripción</label>
                        <Editor v-model="form.descripcion" editorStyle="height: 220px">
                            <template #toolbar>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                            </span>
                            </template>
                        </Editor>
                        <div v-if="$page.props.errors.descripcion" class="text-red-500">{{ $page.props.errors.descripcion }}</div>
                    </div>
                </div>
            <template #footer>
                <Button label="Actualizar" @click="actualizar(form)" icon="pi pi-check"  v-if="modo == 'editar'" />
                <Button label="Guardar" @click="guardar(form)" icon="pi pi-check"  v-if="modo == 'crear'" />
            </template>
        </Dialog>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import ColumnGroup from 'primevue/columngroup'
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import Toolbar from 'primevue/toolbar';
import Dialog from 'primevue/dialog';
import InputNumber from 'primevue/inputnumber';
import Editor from 'primevue/editor';
import FileUpload from 'primevue/fileupload';

export default {
    props: ['data', 'errors', 'tipoCabañas'],
    components:{
        AppLayout,
        DataTable,
        Column,
        ColumnGroup,
        InputText,
        Dropdown,
        Button,
        Toolbar,
        Dialog,
        InputNumber,
        Editor,
        FileUpload
    },
    data(){
        return{
            selectedCabins: null,
            filters: {},
            loading: false,
            form:{},
            displayModal: false,
            titleModal: '',
            modo: '',
        }
    },
    methods:{
        abrirModal: function(cabaña,modo){
            this.modo = modo;
            if(this.modo == 'editar'){
                this.form = Object.assign({}, cabaña);
                this.titleModal= `Editar cabaña ${cabaña.id}`;
            }
            if(this.modo == 'crear'){
                this.form = {
                id: null,
                type: null,
                cantPax: null,
                valorTemporadaAlta: null,
                valorTemporadaBaja: null,
                descripcion: null,
                };
                this.titleModal= 'Agregar nueva Cabaña';
            }
            this.displayModal = true;
        },
        closeModal: function(){
            this.displayModal = false;
            this.titleModal = '';
            this.modo = '';
        },
        actualizar: function (data) {
            data._method = 'PUT';
            this.$inertia.post('/cabin/' + data.id, data)
            this.form = {};
            this.closeModal();
        },
        guardar: async function (data) {
            this.$inertia.post('/cabin', data,{
                onError: (errors) => {
                    
                },
            })
        },
    }
}
</script>

<style>
.p-cascadeselect .p-cascadeselect-panel {
    min-width: 50%;
}
</style>

<style lang="scss" scoped>
/deep/ .p-paginator {
    .p-paginator-current {
        margin-left: auto;
    }
}

/deep/ .p-progressbar {
    height: .5rem;
    background-color: #D8DADC;

    .p-progressbar-value {
        background-color: #00ACAD;
    }
}

.table-header {
    display: flex;
    justify-content: space-between;
}

/deep/ .p-datepicker {
    min-width: 25rem;

    td {
        font-weight: 400;
    }
}

/deep/ .p-datatable.p-datatable-customers {
    .p-datatable-header {
        padding: 1rem;
        text-align: left;
        font-size: 1.5rem;
    }

    .p-paginator {
        padding: 1rem;
    }

    .p-datatable-thead > tr > th {
        text-align: left;
    }

    .p-datatable-tbody > tr > td {
        cursor: auto;
    }

    .p-dropdown-label:not(.p-placeholder) {
        text-transform: uppercase;
    }
}

/* Responsive */
.p-datatable-customers .p-datatable-tbody > tr > td .p-column-title {
    display: none;
}

@media screen and (max-width: 64em) {
    /deep/ .p-datatable {
        &.p-datatable-customers {
            .p-datatable-thead > tr > th,
            .p-datatable-tfoot > tr > td {
                display: none !important;
            }

            .p-datatable-tbody > tr > td {
                text-align: left;
                display: block;
                border: 0 none !important;
                width: 100% !important;
                float: left;
                clear: left;
                border: 0 none;

                .p-column-title {
                    padding: .4rem;
                    min-width: 30%;
                    display: inline-block;
                    margin: -.4rem 1rem -.4rem -.4rem;
                    font-weight: bold;
                }
            }
        }
    }
}

.p-dialog .p-dialog-content {
	overflow-y: visible !important;
}
.p-dialog-mask {
	position: absolute;
	pointer-events: auto; /* (optional, doesn't cover whole area when scroll presents) */
}
</style>