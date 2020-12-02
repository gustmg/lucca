<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Nueva entrada de inventario</h5>
                </v-col>
                <v-col cols="2">
                    <div class="text-title-1">Marcas</div>
                    <v-checkbox
                        v-for="brand in brands"
                        :key="brand.brand_id"
                        class="mt-1"
                        dense
                        :value="brand.brand_id"
                        v-model="showBrands"
                        :label="brand.brand_name"
                    ></v-checkbox>
                </v-col>
                <v-col cols="4" offset-md="6" align="right">
                    <v-text-field
                        v-model="searchProductValue"
                        solo
                        label="Buscar por modelo o descripción"
                        append-icon="mdi-magnify"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-sheet
                color="white"
                elevation="1"
                class="px-8 mb-8"
                v-for="(brand, index) in brands"
                :key="brand.brand_id"
                v-show="showBrands.includes(brand.brand_id)"
            >
                <v-row>
                    <v-col cols="12" align="center">
                        <h6 class="text-h6 pb-4">Productos {{ brand.brand_name }}</h6>
                        <v-row>
                            <v-col cols="3">
                                <v-select
                                    v-model="brandSelectedCategory[index]"
                                    solo
                                    dense
                                    clearable
                                    label="Categoría"
                                    :items="brand.brand_categories"
                                    item-text="category_name"
                                    item-value="category_id"
                                ></v-select>
                            </v-col>
                            <v-col cols="3" v-show="brand.brand_id == 1">
                                <v-select
                                    v-model="selectedGender"
                                    solo
                                    dense
                                    clearable
                                    label="Género"
                                    :items="genders"
                                    item-text="gender_name"
                                    item-value="gender_id"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-expansion-panels v-if="productsList[index].length > 0">
                            <v-expansion-panel v-for="product in productsList[index]" :key="product.product_id">
                                <v-expansion-panel-header>
                                    {{ product.product_model }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{
                                        product.product_description
                                    }}
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="3">
                                                Categoría:
                                                {{ product.category.category_name }}
                                            </v-col>
                                            <v-col cols="3">
                                                Genero:
                                                {{ product.gender.gender_name }}
                                            </v-col>
                                            <v-col cols="3">
                                                Stock: 0
                                            </v-col>
                                            <v-col cols="12">
                                                <v-simple-table>
                                                    <template v-slot:default>
                                                        <thead>
                                                            <tr>
                                                                <th>Color</th>
                                                                <th></th>
                                                                <th
                                                                    class="text-center"
                                                                    v-for="size in sizes"
                                                                    :key="size.size_id"
                                                                >
                                                                    {{ size.size_short_name }}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="color in product.product_colors"
                                                                :key="color.color_id"
                                                            >
                                                                <td>{{ color.color_name }}</td>
                                                                <td>
                                                                    <v-icon>mdi-package-variant</v-icon>
                                                                    <v-icon>mdi-currency-usd</v-icon>
                                                                </td>
                                                                <td v-for="size in sizes" :key="size.size_id">
                                                                    <v-text-field
                                                                        type="number"
                                                                        min="0"
                                                                        step="1"
                                                                        solo
                                                                        :disabled="
                                                                            !isAvailableForStock(
                                                                                product.product_stock,
                                                                                product.product_id,
                                                                                color.color_id,
                                                                                size.size_id
                                                                            )
                                                                        "
                                                                        value="0"
                                                                    >
                                                                    </v-text-field>
                                                                    <v-text-field
                                                                        type="number"
                                                                        min="0"
                                                                        step="0.01"
                                                                        solo
                                                                        :disabled="
                                                                            !isAvailableForStock(
                                                                                product.product_stock,
                                                                                product.product_id,
                                                                                color.color_id,
                                                                                size.size_id
                                                                            )
                                                                        "
                                                                        value="0.00"
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                </v-simple-table>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-dialog v-model="productsListDialog[index]" width="500">
                            <template v-slot:activator="{ on, attrs }">
                                <v-speed-dial v-bind="attrs" v-on="on">
                                    <template v-slot:activator>
                                        <v-btn class="primary white--text" v-bind="attrs" v-on="on" fab>
                                            <v-icon>mdi-plus</v-icon>
                                        </v-btn>
                                    </template>
                                </v-speed-dial>
                            </template>

                            <v-card>
                                <v-card-title>
                                    Elige productos
                                </v-card-title>

                                <v-card-text>
                                    <v-text-field
                                        solo
                                        append-icon="mdi-magnify"
                                        label="Buscar por modelo o descripción"
                                    >
                                    </v-text-field>
                                    <v-list-item-group multiple active-class="">
                                        <v-list-item v-for="product in brand.brand_products" :key="product.product_id">
                                            <template v-slot:default="{ active }">
                                                <v-list-item-action>
                                                    <v-checkbox
                                                        multiple
                                                        v-model="productsList[index]"
                                                        :value="product"
                                                    ></v-checkbox>
                                                </v-list-item-action>
                                                <v-list-item-content>
                                                    <v-list-item-title>{{ product.product_model }}</v-list-item-title>
                                                    <v-list-item-subtitle>{{
                                                        product.product_description
                                                    }}</v-list-item-subtitle>
                                                </v-list-item-content>
                                            </template>
                                        </v-list-item>
                                    </v-list-item-group>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" text v-on:click="productsListDialog = [0, 0]">
                                        I accept
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-col>
                </v-row>
            </v-sheet>
        </v-container>
        <v-speed-dial fixed bottom right>
            <template v-slot:activator>
                <v-btn class="primary white--text" href="/products/create" fab>
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
        </v-speed-dial>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },

        mounted() {
            this.fetchCategories()
            this.fetchGenders()
            this.fetchBrands()
            this.fetchSizes()
            this.fetchColors()
        },

        props: {
            products: Array,
        },

        data() {
            return {
                productsListDialog: [0, 0],
                productsList: [[], []],
                showBrands: [1, 2],
                brandSelectedCategory: [0, 0],
                brands: [],
                categories: [],
                genders: [],
                sizes: [],
                selectedGender: 0,
                searchProductValue: '',
                // entries: [
                //     {
                //         product_id: 1,
                //         color_id: 2,
                //         size_id: 3,
                //         product_entry_amount: 0,
                //         product_unit_cost: 0,
                //     },
                // ],
            }
        },

        computed: {
            filteredProducts: function() {
                return this.products.filter(product => {
                    return (
                        product.product_description.toLowerCase().indexOf(this.searchProductValue.toLowerCase()) >= 0 ||
                        product.product_model.toLowerCase().indexOf(this.searchProductValue.toLowerCase()) >= 0
                    )
                })
            },

            entries: function() {
                var entriesList = this.productsList[0].concat(this.productsList[1])
                var entries = []
                entriesList.forEach(product => {
                    product.product_colorsforEach()
                })
            },
        },

        methods: {
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

            getProductsByBrand: function(brand_id) {
                return this.products.filter(product => {
                    return product.product_brand_id == brand_id
                })
            },

            getProductAmount(product_stock, product_id, color_id, size_id) {
                var result = product_stock.filter(function(stock, index) {
                    return stock.product_id == product_id && stock.color_id == color_id && stock.size_id == size_id
                })

                if (result.length > 0) {
                    return result[0].product_amount
                } else {
                    return 'N/A'
                }
            },

            getAverageCost(product_stock, product_id, color_id, size_id) {
                var result = product_stock.filter(function(stock, index) {
                    return stock.product_id == product_id && stock.color_id == color_id && stock.size_id == size_id
                })
                if (result.length > 0) {
                    return result[0].product_average_cost
                } else {
                    return 'N/A'
                }
            },

            isAvailableForStock(product_stock, product_id, color_id, size_id) {
                var result = product_stock.filter(function(stock, index) {
                    return stock.product_id == product_id && stock.color_id == color_id && stock.size_id == size_id
                })
                if (result.length > 0) {
                    return 1
                } else {
                    return 0
                }
            },
        },
    }
</script>
