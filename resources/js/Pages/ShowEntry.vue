<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-sheet color="white" elevation="1" class="px-8 mb-8">
                        <v-row>
                            <v-col cols="12">
                                <div class="text-h6">Entrada de inventario #{{ entry.entry_id }}</div>
                                <div class="text-subtitle-1">MARCA: {{ entry.brand.brand_name }}</div>
                                <div class="text-subtitle-1">REALIZADA POR: {{ entry.user.name }}</div>
                                <v-expansion-panels>
                                    <v-expansion-panel
                                        v-for="product in getProductsByEntry(entry.entry_products)"
                                        :key="product.product_id"
                                    >
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
                                                                                readonly
                                                                                solo
                                                                                :value="
                                                                                    getProductAmount(
                                                                                        entry.entry_products,
                                                                                        product.product_id,
                                                                                        color.color_id,
                                                                                        size.size_id
                                                                                    )
                                                                                "
                                                                            >
                                                                            </v-text-field>
                                                                            <v-text-field
                                                                                readonly
                                                                                solo
                                                                                :value="
                                                                                    getAverageCost(
                                                                                        entry.entry_products,
                                                                                        product.product_id,
                                                                                        color.color_id,
                                                                                        size.size_id
                                                                                    )
                                                                                "
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
                            </v-col>
                        </v-row>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
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
            entry: Object,
        },

        data() {
            return {
                brands: [],
                categories: [],
                genders: [],
                sizes: [],
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

            getProductAmount(product_entries, product_id, color_id, size_id) {
                var result = product_entries.filter(function(stock, index) {
                    return stock.product_id == product_id && stock.color_id == color_id && stock.size_id == size_id
                })

                if (result.length > 0) {
                    return result[0].product_entry_amount
                } else {
                    return 'N/A'
                }
            },

            getAverageCost(product_entries, product_id, color_id, size_id) {
                var result = product_entries.filter(function(stock, index) {
                    return stock.product_id == product_id && stock.color_id == color_id && stock.size_id == size_id
                })
                if (result.length > 0) {
                    return result[0].product_unit_cost
                } else {
                    return 'N/A'
                }
            },

            isAvailableForStock(product_entries, product_id, color_id, size_id) {
                var result = product_entries.filter(function(stock, index) {
                    return stock.product_id == product_id && stock.color_id == color_id && stock.size_id == size_id
                })
                if (result.length > 0) {
                    return 1
                } else {
                    return 0
                }
            },

            filterProductsListByBrand: function(brand_id) {
                return this.productsList.filter(product => {
                    return product.product_brand_id == brand_id
                })
            },

            selectBrand: function(brand_id) {
                var result = this.brands.filter(brand => {
                    return brand.brand_id == brand_id
                })

                this.selectedBrand = result[0]

                this.newEntryStepper++
            },

            hasNoEntryStock: function(product_unit_cost, product_id, color_id, size_id) {
                var result = this.entries.filter(entry => {
                    return entry.product_id == product_id && entry.color_id == color_id && entry.size_id == size_id
                })

                if (result[0].product_entry_amount == 0) {
                    return true
                } else return false
            },

            registerEntry: function() {
                axios
                    .post('/entries', { entries: this.entries })
                    .then(response => console.log(response.data.messagge))
                    .catch(error => console.log(error))
            },

            getProductsByEntry: function(entry_products) {
                var products = []

                entry_products.forEach(entry => {
                    if (products.length == 0) {
                        products.push(entry.product)
                    } else {
                        if (!products.some(product => product.product_id == entry.product.product_id)) {
                            products.push(entry.product)
                        }
                    }
                })

                return products
            },
        },
    }
</script>
