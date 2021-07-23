<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Информация Профиля
        </template>


        <template #form>
            <jet-action-message :on="form.recentlySuccessful">
                Saved.
            </jet-action-message>


            <div class="w-75">
                <!-- Name -->
                <div class="form-group">
                    <jet-label for="name" value="Name"/>
                    <jet-input id="name" type="text" v-model="form.name"
                               :class="{ 'is-invalid': form.errors.name }" autocomplete="name"/>
                    <jet-input-error :message="form.errors.name"/>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <jet-label for="email" value="Email"/>
                    <jet-input id="email" type="email" v-model="form.email"
                               :class="{ 'is-invalid': form.errors.email }"/>
                    <jet-input-error :message="form.errors.email"/>
                </div>
                <!-- Email -->
            </div>
        </template>

        <template #actions>
            <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from '@/Jetstream/Button';
import JetFormSection from '@/Jetstream/FormSection';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ['user'],

    data() {
        console.log(this.user);
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.user.name,
                email: this.user.email,
            }),
            photoPreview: null,
        };
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(route('user-profile-information.update'), {
                errorBag: 'updateProfileInformation',
                preserveScroll: true,
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia.delete(route('current-user-photo.destroy'), {
                preserveScroll: true,
                onSuccess: () => (this.photoPreview = null),
            });
        },
    },
};
</script>
