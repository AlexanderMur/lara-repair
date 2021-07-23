<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Создать запчасть
            </h2>
        </template>
        <div class="container py-5">
            <jet-form-section @submitted="createProduct()">
                <template #title>
                    Создать запчасть
                </template>


                <template #form>
                    <jet-action-message :on="form.recentlySuccessful">
                        Сохранено.
                    </jet-action-message>

                    <div class="w-75">
                        <div class="form-group">
                            <jet-label for="name" value="Название"/>
                            <jet-input id="name" type="text"
                                       :class="{ 'is-invalid': form.errors.name }" v-model="form.name" ref="name"/>
                            <jet-input-error :message="form.errors.name" class="mt-2"/>
                        </div>
                        <div class="form-group">
                            <jet-label for="price" value="Цена"/>
                            <jet-input id="price" type="number"
                                       :class="{ 'is-invalid': form.errors.price }" v-model="form.price" ref="price"/>
                            <jet-input-error :message="form.errors.price" class="mt-2"/>
                        </div>

                        <div class="form-group">
                            <label for="brand">Бренд</label>
                            <select type="text" class="form-control" :class="{ 'is-invalid': form.errors.price }"
                                    id="brand" name="brand" v-model="form.brand_id">
                                <option v-for="brand of brands" :value="brand.id">{{ brand.name }}</option>
                            </select>
                            <jet-input-error :message="form.errors.brand_id" class="mt-2"/>
                        </div>
                    </div>
                </template>

                <template #actions>
                    <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                        Сохранить
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
    </app-layout>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetButton from '@/Jetstream/Button';
import JetFormSection from '@/Jetstream/FormSection';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        AppLayout,
    },
    props: ['brands', 'product'],
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                price: '',
                brand_id: '',
            }),
        };
    },

    methods: {
        createProduct() {
            this.form.post(`/profile/products`, {
                errorBag: 'createProduct',
            });
        },
    },
};
</script>
