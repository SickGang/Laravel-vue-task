<template>
    <div class="departament-wrap container mt-3">
        <div v-if="loading">
            Идет загрузка...
        </div>
        <div v-else v-for="departament in departaments" :key="departament.id">
            <div class="row departament align-items-center p-2 mt-3">
                <input type="text"
                       class="form-control col-lg-6"
                       placeholder="Название отдела"
                       v-model="departament.departament_name"
                       @keyup.enter="departament.edit = false; editDepartament(departament)"
                       v-if="departament.edit"
                       v-focus
                >
                <div class="departament-head col-lg-6" v-else>
                    {{ departament.departament_name }}
                </div>
                <div class="departament-head_btn col-lg-6 text-right">
                    <button @click="departament.edit = true" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button @click="deleteDepartament(departament.id)" type="button" class="btn btn-danger">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
                <departament-worker
                    @render="renderComponentMethod"
                    v-if="renderComponent"
                    :departamentId="departament.id"
                    :renderComponent="renderComponent"
                >
                </departament-worker>
                <div class="input-group mt-3">
                    <input @keyup.enter="saveWorker(departament.id)"
                            type="text"
                            class="form-control"
                            v-model="worker.worker_name[departament.id]"
                            :key="departament.id"
                            placeholder="Имя сотрудника"
                    >
                    <div class="input-group-append">
                        <button @click="saveWorker(departament.id)" class="btn btn-outline-secondary btn-primary text-light" type="button">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import deletemodal from './DeleteModal'
    import departamentWorker from './DepartamentWorker'

    export default {
        data() {
            return {
                departaments: [],
                departament: {
                    id: '',
                    departament_name: ''
                },
                worker: {
                    worker_name: []
                },
                loading: true,
                edit: false,
                renderComponent: true
            }
        },
        mounted() {
            this.getDepartaments()
        },
        methods: {
            getDepartaments() {
            axios.get('/api/departaments')
                .then(response => {
                    this.departaments = response.data
                })
                .catch(error =>{
                    console.log(error)
                })
                .finally(() => this.loading = false)
            },
            deleteDepartament(id) {
                axios.delete(`/api/departaments/${id}`)
                    .then(response => {
                        this.getDepartaments()
                    })
                    .catch(error =>{
                        console.log(error)
                    })
                    .finally(() => this.loading = false)
            },
            editDepartament(departament) {
                axios.put(`/api/departaments/${departament.id}`, {
                    name: departament.departament_name
                })
                    .then(response => {
                    })
                    .catch(error =>{
                        console.log(error)
                    })
                    .finally(() => this.loading = false)

            },
            renderComponentMethod() {
                this.renderComponent = false

                this.$nextTick(() => {
                    this.renderComponent = true
                })
            },
            saveWorker(departamentId) {
                    // Добавление сотрудника
                    axios.post('/api/workers', {
                        name: this.worker.worker_name[departamentId],
                        id: departamentId
                    })
                        .then(response => {
                            this.worker.worker_name[departamentId] = ''
                            this.renderComponentMethod()
                        })
                        .catch(error =>{
                            console.log(error)
                        })
                        .finally(() => this.loading = false)
            }
        },
        directives: {
            focus: {
                inserted (el) {
                    el.focus()
                }
            }
        },
        components: {departamentWorker,deletemodal}
    }
</script>

<style scoped>
    .departament, .departament-content-wrap, .departament-content {
        border: 1px solid #ced4da;
        border-radius: 0.25rem
    }
</style>
