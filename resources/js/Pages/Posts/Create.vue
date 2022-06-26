<template>
    <app-header></app-header>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form method="post" @submit.prevent="submit">
                <h2 class="text-left">Create Post</h2>

                <errors-and-messages :errors="errors"></errors-and-messages>

                <div class="form-group">
                    <label for="upc">Product UPC</label>
                    <input
                        type="text"
                        class="form-control"
                        name="upc"
                        id="upc"
                        disabled
                        readonly
                        v-model="form.upc"
                    />
                </div>

                <div class="form-group">
                    <label for="productname">productname</label>
                    <input
                        id="productname"
                        name="productname"
                        class="form-control"
                        v-model="form.productname"
                    />
                </div>

                <div class="form-group">
                    <label for="sku">sku</label>
                    <input
                        id="sku"
                        name="sku"
                        class="form-control"
                        v-model="form.sku"
                    />
                </div>

                <div class="form-group">
                    <label for="Price">Price</label>
                    <input
                        id="Price"
                        name="Price"
                        class="form-control"
                        v-model="form.Price"
                    />
                </div>

                <!-- <div class="form-group">
                    <label for="tax">tax</label>
                    <input
                        id="tax"
                        name="tax"
                        class="form-control"
                        v-model="form.tax"
                    />
                </div> -->

                <div class="form-group">
                    <label for="image">Image</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="form-control"
                        @change="selectFile"
                    />
                </div>

                <input
                    type="submit"
                    class="btn btn-primary btn-block"
                    value="Save"
                />
            </form>
        </div>
    </div>
</template>

<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import { inject, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    name: "Create",
    components: {
        ErrorsAndMessages,
        AppHeader,
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = reactive({
            upc: parseInt(Math.random() * 100),
            productname: null,
            sku: null,
            Price: null,
            image: null,
            _token: usePage().props.value.csrf_token,
        });

        const route = inject("$route");

        function selectFile($event) {
            form.image = $event.target.files[0];
        }

        function submit() {
            Inertia.post(route("post.store"), form, {
                forceFormData: true,
            });
        }

        return {
            form,
            submit,
            selectFile,
        };
    },
};
</script>

<style scoped>
form {
    margin-top: 20px;
}
</style>
