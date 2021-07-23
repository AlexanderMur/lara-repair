<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Запчасти
            </h2>
        </template>


        <div class="container py-5">
            <inertia-link class="btn btn-lg btn-primary mb-5" href="/profile/products/create">Создать</inertia-link>
            <table class="table">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Бренд</th>
                        <th>Цена</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product of products">
                        <td>{{product.name}}</td>
                        <td>{{product.brand.name}}</td>
                        <td>{{product.price}}</td>
                        <td>
                                <button class="btn btn-sm btn-danger mr-3" @click="onDelete(product.id)">Удалить</button>

                                <inertia-link :href="'/profile/products/' + product.id" class="btn btn-sm btn-info">Редактировать</inertia-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['products'],

    components: {
        AppLayout,
    },
    data() {
        return {
        }
    },
    methods: {
        onDelete(id) {
            if (confirm('Удалить?')) {
                this.$inertia.delete(`/profile/products/${id}`)
            }
        }
    }
}
</script>
