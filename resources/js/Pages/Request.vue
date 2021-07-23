<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Заказать запчасть
            </h2>
        </template>
        <div class="container py-5">
            <form @submit.prevent="onSubmit()">
                <div class="form-group">
                    <label for="name">Название запчасти</label>
                    <input type="text" class="form-control" id="name" placeholder="Название" name="name" v-model="form.name">
                </div>
                <div class="form-group">
                    <label for="price_min">Цена от</label>
                    <input type="text" class="form-control" id="price_min" placeholder="Цена от" name="price_min" v-model="form.price_min">
                </div>
                <div class="form-group">
                    <label for="price_max">Цена до</label>
                    <input type="text" class="form-control" id="price_max" placeholder="Цена от" name="price_max" v-model="form.price_max">
                </div>
                <div class="form-group">
                    <label for="brand">Бренд</label>
                    <select class="form-control" id="brand" name="brand" v-model="form.brand_id">
                        <option v-for="brand of brands" :value="brand.id">{{brand.name}}</option>
                    </select>
                </div>
                <button class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['brands'],

    components: {
        AppLayout,
    },
    data() {
        return {
            form: {
                name: '',
                price_min: '',
                price_max: '',
                brand_id: '',
            }
        }
    },
    methods: {
        onSubmit() {
            console.log(this.form.name)
            this.$inertia.post('/request',this.form)
        }
    }
}
</script>
