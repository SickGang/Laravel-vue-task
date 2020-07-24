<template>
    <div class="container">
        <nav class="row">
            <div class="col-12 p-3">
                LaravelVueCrud
            </div>
        </nav>

        <departament></departament>

        <div class="input-group mt-3">
            <input type="text" class="form-control" placeholder="Имя получателя" aria-label="Название отдела" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary bg-success text-light" type="button">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    import departament from './Departament'
    export default {
        components: {departament}
    }
</script>

<style scoped>
    nav {
        background-color: #007bff;
        color: white;
        font-size: 22px;
    }
</style>
