<template>
    <app-header></app-header>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form method="post" @submit.prevent="submit">
                <h2 class="text-left">Update Product</h2>

                <errors-and-messages :errors="errors"></errors-and-messages>

                <div class="form-group">
                    <label for="upc">Product UPC</label>
                    <input
                        type="text"
                        class="form-control"
                        name="upc"
                        id="upc"
                        v-model="form.upc"
                        disabled
                        readonly
                    />
                </div>

                <div class="form-group">
                    <label for="productname">productname</label>
                    <input
                        type="text"
                        id="productname"
                        name="productname"
                        class="form-control"
                        v-model="form.productname"
                    />
                </div>

                <div class="form-group">
                    <label for="sku">sku</label>
                    <input
                        type="text"
                        class="form-control"
                        name="sku"
                        id="sku"
                        v-model="form.sku"
                    />
                </div>

                <div class="form-group">
                    <label for="Price">Price</label>
                    <input
                        type="text"
                        id="Price"
                        name="Price"
                        class="form-control"
                        v-model="form.Price"
                    />
                </div>

                <div class="form-group">
                    <label for="tax">tax</label>
                    <input
                        type="text"
                        id="tax"
                        name="tax"
                        class="form-control"
                        v-model="form.tax"
                        disabled
                        readonly
                    />
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <img
                        :src="image_url"
                        width="100"
                        height="90"
                        v-if="image_url"
                    />
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
                    value="Update"
                />
            </form>
        </div>
    </div>
</template>

<script>
import AppHeader from "../../Partials/AppHeader";
import { inject, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    name: "Edit",
    components: {
        ErrorsAndMessages,
        AppHeader,
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = reactive({
            upc: null,
            productname: null,
            sku: null,
            Price: null,
            tax: null,
            image: null,
            _token: usePage().props.value.csrf_token,
            _method: "PUT",
        });

        // retrieve post prop
        const { upc, productname, sku, Price, tax, image_url, id } =
            usePage().props.value.post;
        form.upc = upc;
        form.productname = productname;
        form.sku = sku;
        form.Price = Price;
        form.tax = tax;

        const route = inject("$route");

        function selectFile($event) {
            form.image = $event.target.files[0];
        }

        function submit() {
            Inertia.post(route("post.update", { id: id }), form, {
                forceFormData: true,
            });
        }

        return {
            form,
            submit,
            selectFile,
            image_url,
        };
    },
};
</script>

<style scoped>
form {
    margin-top: 20px;
}
</style>
