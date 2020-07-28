<template>
    <div v-if="loading||edit">
        Идет загрузка...
    </div>
    <div class="col-12 departament-content-wrap mt-2" v-else>
        <div class="departament-content row align-items-center p-2"
        v-for="worker in workers"
        :key="worker.id"
        >
            <input type="text"
                   class="form-control col-lg-6"
                   placeholder="Имя сотрудника"
                   v-model="worker.worker_name"
                   @keyup.enter="worker.edit = false; editWorker(worker)"
                   v-if="worker.edit"
                   v-focus
            >

            <div class="departament-content_head col-lg-6" v-else>
                {{ worker.worker_name }}
            </div>
            <div class="departament-content_btn col-lg-6 text-right">
                <button @click="worker.edit = true" type="button" class="btn btn-primary">
                    <i class="fa fa-pencil"></i>
                </button>
                <button @click="deleteWorker(worker.id)" type="button" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                </button>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['departamentId'],
        data() {
            return {
                workers: [],
                worker: {
                    id: '',
                    worker_name: '',
                    departamentd_id: ''
                },
                loading: true,
                edit: false
            }
        },
        mounted() {
            this.getWorkers()
        },
        methods: {
            getWorkers() {
                    axios.get('/api/departaments', {
                        params: {
                            workerId: this.departamentId
                        }
                    })
                        .then(response => {
                            this.workers = response.data
                        })
                        .catch(error =>{
                            console.log(error)
                        })
                        .finally(() => this.loading = false)
            },
            deleteWorker(id) {
                axios.delete(`/api/workers/${id}`)
                    .then(response => {
                        this.$emit('render')
                    })
                    .catch(error =>{
                        console.log(error)
                    })
                    .finally(() => this.loading = false)
            },
            editWorker(worker) {
                axios.put(`/api/workers/${worker.id}`, {
                    name: worker.worker_name
                })
                    .then(response => {
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
        }

    }
</script>

<style scoped>
    .departament-content {
        border: 1px solid #ced4da;
        border-radius: 0.25rem
    }
</style>
