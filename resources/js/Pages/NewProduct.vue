<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Registrar producto nuevo</h5>
                </v-col>
                <v-col cols="12">
                    <v-form v-model="newProductForm">
                        <v-row>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="productModel"
                                    filled
                                    dense
                                    label="Modelo del producto"
                                    :rules="[rules.required]"
                                    validate-on-blur
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="9">
                                <v-text-field
                                    v-model="productDescription"
                                    dense
                                    filled
                                    :rules="[rules.required]"
                                    label="Descripción del producto"
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <div class="text-subtitle-2">Marca</div>
                                <v-radio-group v-model="brand">
                                    <v-radio
                                        label="Lucca Sport"
                                        :value="1"
                                    ></v-radio>
                                    <v-radio label="X10" :value="2"></v-radio>
                                </v-radio-group>
                            </v-col>
                            <v-col cols="4">
                                <div class="text-subtitle-2">
                                    Categoría del producto
                                </div>
                                <v-select
                                    v-model="productCategory"
                                    :items="filteredProductCategories"
                                    item-text="product_category_name"
                                    item-value="product_category_id"
                                >
                                </v-select>
                            </v-col>
                            <v-col cols="4" v-show="brand == 1">
                                <div class="text-subtitle-2">
                                    Género
                                </div>
                                <v-select
                                    v-model="productGender"
                                    :items="filteredProductGenders"
                                    item-text="product_gender_name"
                                    item-value="product_gender_id"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6">
                                <v-row>
                                    <v-col cols="12">
                                        <div class="text-subtitle-2">
                                            Colores disponibles
                                        </div>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-select
                                            v-model="productSelectedColors"
                                            :rules="[rules.requiredArray]"
                                            multiple
                                            chips
                                            hint="Elige los colores disponibles para este producto"
                                            persistent-hint
                                            :items="productColors"
                                            item-text="product_color_name"
                                            item-value="product_color_id"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="6">
                                <v-row>
                                    <v-col cols="12">
                                        <div class="text-subtitle-2">
                                            Tallas disponibles
                                        </div>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-select
                                            v-model="productSelectedSizes"
                                            :rules="[rules.requiredArray]"
                                            multiple
                                            chips
                                            hint="Elige las tallas disponibles para este producto"
                                            persistent-hint
                                            :items="productSizes"
                                            item-text="product_size_name"
                                            item-value="product_size_id"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-col>
                <v-col cols="12" align="right">
                    <v-btn class="mr-4" href="/products">Cancelar</v-btn>
                    <v-btn
                        color="primary"
                        :disabled="!newProductForm"
                        v-on:click="registerProduct"
                    >
                        Registrar
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>
        <v-snackbar v-model="registerSnackbar">
            {{ messagge }}
        </v-snackbar>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout
    },

    mounted() {
        this.fetchProducts();
        this.fetchProductCategories();
        this.fetchProductGenders();
        this.fetchProductColors();
        this.fetchProductSizes();
    },

    data() {
        return {
            productModel: "",
            productDescription: "",
            productCategory: 2,
            productGender: 2,
            products: [],
            productSelectedColors: [],
            productSelectedSizes: [],
            productCategories: [],
            productGenders: [],
            productColors: [],
            productSizes: [],
            newProductForm: false,
            brand: 1,
            registerSnackbar: false,
            messagge: "Hola",
            rules: {
                required: value => !!value || "Este campo es requerido.",
                requiredArray: value =>
                    value.length > 0 || "Debe elegir al menos 1 campo."
            }
        };
    },

    watch: {
        brand: function() {
            if (this.brand == 1) {
                this.productCategory = 2;
            } else {
                this.productCategory = 5;
            }
        }
    },

    computed: {
        filteredProductCategories: function() {
            if (this.brand == 1) {
                return this.productCategories.filter(
                    category =>
                        category.product_category_id < 5 &&
                        category.product_category_id > 1
                );
            } else {
                return this.productCategories.filter(
                    category => category.product_category_id > 4
                );
            }
        },

        filteredProductGenders: function() {
            if (this.brand == 1) {
                return this.productGenders.filter(
                    gender => gender.product_gender_id > 1
                );
            } else {
                return [];
            }
        }
    },

    methods: {
        fetchProducts: function() {
            axios
                .get("/products")
                .then(response => {
                    this.products = response.data.products;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        fetchProductCategories: function() {
            axios
                .get("/product_categories")
                .then(response => {
                    this.productCategories = response.data.product_categories;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        fetchProductGenders: function() {
            axios
                .get("/product_genders")
                .then(response => {
                    this.productGenders = response.data.product_genders;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        fetchProductColors: function() {
            axios
                .get("/product_colors")
                .then(response => {
                    this.productColors = response.data.product_colors;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        fetchProductSizes: function() {
            axios
                .get("/product_sizes")
                .then(response => {
                    this.productSizes = response.data.product_sizes;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        registerProduct: function() {
            axios
                .post("/products", {
                    product_model: this.productModel,
                    product_description: this.productDescription,
                    product_category_id: this.productCategory,
                    product_gender_id: this.productGender,
                    product_brand_id: this.brand,
                    product_available_colors: this.productSelectedColors,
                    product_available_sizes: this.productSelectedSizes
                })
                .then(response => {
                    this.messagge = response.data.messagge;
                    this.registerSnackbar = true;
                    window.location.href = "/products";
                })
                .catch(function(error) {
                    this.messagge =
                        "El producto no se registró debido a un error. Intente nuevamente.";
                    this.registerSnackbar = true;
                });
        }
    }
};
</script>
