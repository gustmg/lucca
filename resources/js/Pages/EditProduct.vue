<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Editar información de producto</h5>
                </v-col>
                <v-col cols="12">
                    <v-form v-model="newProductForm">
                        <v-row>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="product.product_model"
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
                                    v-model="product.product_description"
                                    dense
                                    filled
                                    :rules="[rules.required]"
                                    label="Descripción del producto"
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <div class="text-subtitle-2">Marca</div>
                                <v-radio-group v-model="product.product_brand_id">
                                    <v-radio label="Lucca Sport" :value="1"></v-radio>
                                    <v-radio label="X10" :value="2"></v-radio>
                                </v-radio-group>
                            </v-col>
                            <v-col cols="4" v-if="brands.length > 0">
                                <div class="text-subtitle-2">
                                    Categoría del producto
                                </div>
                                <v-select
                                    v-model="product.product_category_id"
                                    :items="brands[product.product_brand_id - 1].brand_categories"
                                    item-text="category_name"
                                    item-value="category_id"
                                >
                                </v-select>
                            </v-col>
                            <v-col cols="4" v-show="product.product_brand_id == 1">
                                <div class="text-subtitle-2">
                                    Género
                                </div>
                                <v-select
                                    v-model="product.product_gender_id"
                                    :items="genders"
                                    item-text="gender_name"
                                    item-value="gender_id"
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
                                            :items="colors"
                                            item-text="color_name"
                                            item-value="color_id"
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
                                            :items="sizes"
                                            item-text="size_name"
                                            item-value="size_id"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-col>
                <v-col cols="12" align="right">
                    <v-btn class="mr-4" href="/products">Cancelar</v-btn>
                    <v-btn color="primary" :disabled="!newProductForm" v-on:click="editProduct">
                        Editar
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
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },

        mounted() {
            this.fetchProducts()
            this.fetchBrands()
            this.fetchCategories()
            this.fetchGenders()
            this.fetchColors()
            this.fetchSizes()
            this.setProductColors()
            this.setProductSizes()
        },

        props: {
            product: Object,
        },

        data() {
            return {
                products: [],
                productSelectedColors: [],
                productSelectedSizes: [],
                genders: [],
                colors: [],
                sizes: [],
                newProductForm: false,
                brands: [],
                registerSnackbar: false,
                messagge: '',
                rules: {
                    required: value => !!value || 'Este campo es requerido.',
                    requiredArray: value => value.length > 0 || 'Debe elegir al menos 1 campo.',
                },
            }
        },

        watch: {
            product: {
                handler: function() {
                    if (this.product.product_brand_id == 1) {
                        this.product.product_category_id = 1
                        this.productGender = 1
                    } else {
                        this.product.product_category_id = 4
                    }
                },

                deep: true,
            },
        },

        computed: {
            productColorsToRemove: function() {
                return this.product.product_colors.filter(color => {
                    return !this.productSelectedColors.includes(color.color_id)
                })
            },

            productSizesToRemove: function() {
                return this.product.product_sizes.filter(size => {
                    return !this.productSelectedSizes.includes(size.size_id)
                })
            },
        },

        methods: {
            fetchProducts: function() {
                axios
                    .get('/products')
                    .then(response => {
                        this.products = response.data.products
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            fetchBrands: function() {
                axios
                    .get('/brands')
                    .then(response => {
                        this.brands = response.data.brands
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            fetchCategories: function() {
                axios
                    .get('/categories')
                    .then(response => {
                        this.categories = response.data.categories
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            fetchGenders: function() {
                axios
                    .get('/genders')
                    .then(response => {
                        this.genders = response.data.genders
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            fetchColors: function() {
                axios
                    .get('/colors')
                    .then(response => {
                        this.colors = response.data.colors
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            fetchSizes: function() {
                axios
                    .get('/sizes')
                    .then(response => {
                        this.sizes = response.data.sizes
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            editProduct: function() {
                axios
                    .put('/products/' + this.product.product_id, {
                        product_model: this.product.product_model,
                        product_description: this.product.product_description,
                        product_category_id: this.product.product_category_id,
                        product_gender_id: this.product.product_gender_id,
                        product_brand_id: this.product.product_brand_id,
                        product_colors: this.productSelectedColors,
                        product_sizes: this.productSelectedSizes,
                        product_colors_to_remove: this.productColorsToRemove,
                        product_sizes_to_remove: this.productSizesToRemove,
                    })
                    .then(response => {
                        this.messagge = response.data.messagge
                        this.registerSnackbar = true
                        window.location.href = '/products'
                    })
                    .catch(function(error) {
                        this.messagge = 'El producto no pudo ser editado debido a un error. Intente nuevamente.'
                        this.registerSnackbar = true
                    })
            },

            setProductColors: function() {
                this.product.product_colors.forEach(color => {
                    this.productSelectedColors.push(color.color_id)
                })
            },

            setProductSizes: function() {
                this.product.product_sizes.forEach(size => {
                    this.productSelectedSizes.push(size.size_id)
                })
            },
        },
    }
</script>
