<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Запросы
            </h2>
        </template>


        <div class="container py-5">

            <div v-if="!requests.length" class="h3 mb-5">
                У вас нет запросов
            </div>
            <inertia-link v-if="!$page.props.user.is_shop" :href="route('request.create')" class="btn btn-lg btn-primary mb-5">
                Создать запрос
            </inertia-link>
            <div v-if="requests.length && $page.props.user.is_shop" class="card mb-4 card-primary" v-for="request of requests">
                <div class="card-header">Запрос #{{request.id}} от {{request.created_at}} <a href="#" @click="onDeleteRequest(request.id)" class="text-danger float-right">Удалить запрос</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div><inertia-link :href="route('profile.product.show', request.productId)">{{request.name}}</inertia-link></div>
                            <div>Цена: {{request.price_min}}-{{request.price_max}} руб</div>
                        </div>
                        <div class="col-lg-6">
                            email: {{request.user.email}}
                            <br>
                            Имя: {{request.user.name}}
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="requests.length && !$page.props.user.is_shop" class="card mb-4 card-primary" v-for="request of requests">
                <div class="card-header">Запрос #{{request.id}} от {{request.created_at}} <a href="#" @click="onDeleteRequest(request.id)" class="text-danger float-right">Удалить запрос</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>{{request.name}}</div>
                            <div>Цена: {{request.price_min}}-{{request.price_max}} руб</div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['requests'],
    components: {
        AppLayout,
    },
    data() {
        return {
        }
    },
    methods: {
        onDeleteRequest(id) {
            this.$inertia.delete('/profile/request/' + id)
        }
    }
}
</script>
