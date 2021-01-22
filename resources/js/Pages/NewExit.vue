<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">Salida de inventario #{{ exit_id }}</v-col>
                <v-col cols="12">
                    <v-stepper v-model="newExitStepper">
                        <v-stepper-header>
                            <v-stepper-step :complete="newExitStepper > 1" step="1">
                                Elegir marca
                            </v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step step="2">
                                Agregar entradas
                            </v-stepper-step>
                        </v-stepper-header>
                        <v-stepper-items>
                            <v-stepper-content step="1">
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" align="center">
                                            <div class="text-h4">¿De qué marca desea registrar entradas?</div>
                                        </v-col>
                                        <v-col cols="4" offset-md="2" align="center">
                                            <v-card hover v-on:click="selectBrand(1)">
                                                <v-card-text>
                                                    <v-icon size="80">mdi-tshirt-crew</v-icon>
                                                    <div class="text-h5">Lucca Sport</div>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="4" align="center">
                                            <v-card hover v-on:click="selectBrand(2)">
                                                <v-card-text>
                                                    <v-icon size="80">mdi-tshirt-crew</v-icon>
                                                    <div class="text-h5">X10</div>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-stepper-content>
                            <v-stepper-content step="2">
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-sheet color="white" elevation="1" class="px-8 mb-8">
                                                <v-row>
                                                    <v-col cols="12" align="center">
                                                        <h6 class="text-h6 pb-4">
                                                            Productos {{ selectedBrand.brand_name }}
                                                        </h6>
                                                        <v-row>
                                                            <v-col cols="3">
                                                                <v-select
                                                                    v-model="brandSelectedCategory"
                                                                    solo
                                                                    dense
                                                                    clearable
                                                                    label="Categoría"
                                                                    :items="selectedBrand.brand_categories"
                                                                    item-text="category_name"
                                                                    item-value="category_id"
                                                                ></v-select>
                                                            </v-col>
                                                            <v-col cols="3" v-show="selectedBrand.brand_id == 1">
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

                                                        <v-expansion-panels v-if="productsList.length > 0">
                                                            <v-expansion-panel
                                                                v-for="product in productsList"
                                                                :key="product.product_id"
                                                            >
                                                                <v-expansion-panel-header>
                                                                    {{
                                                                        product.product_model
                                                                    }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{
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
                                                                                                    {{
                                                                                                        size.size_short_name
                                                                                                    }}
                                                                                                </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr
                                                                                                v-for="(color,
                                                                                                index) in product.product_colors"
                                                                                                :key="color.color_id"
                                                                                            >
                                                                                                <td>
                                                                                                    {{
                                                                                                        color.color_name
                                                                                                    }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div>
                                                                                                        <div
                                                                                                            class="text-caption"
                                                                                                        >
                                                                                                            PZAS
                                                                                                        </div>
                                                                                                        <v-icon
                                                                                                            >mdi-package-variant</v-icon
                                                                                                        >
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td
                                                                                                    v-for="size in sizes"
                                                                                                    :key="size.size_id"
                                                                                                >
                                                                                                    <v-text-field
                                                                                                        @change="
                                                                                                            setProductAmount(
                                                                                                                $event,
                                                                                                                product.product_id,
                                                                                                                color.color_id,
                                                                                                                size.size_id
                                                                                                            )
                                                                                                        "
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
                                                                                                        :value="
                                                                                                            getProductAmount(
                                                                                                                product.product_id,
                                                                                                                color.color_id,
                                                                                                                size.size_id
                                                                                                            )
                                                                                                        "
                                                                                                        placeholder="0"
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
                                                        <v-dialog v-model="productsListDialog" width="500">
                                                            <template v-slot:activator="{ on, attrs }">
                                                                <v-speed-dial v-bind="attrs" v-on="on">
                                                                    <template v-slot:activator>
                                                                        <v-btn
                                                                            class="primary white--text"
                                                                            v-bind="attrs"
                                                                            v-on="on"
                                                                            fab
                                                                        >
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
                                                                        <v-list-item
                                                                            v-for="product in selectedBrand.brand_products"
                                                                            :key="product.product_id"
                                                                        >
                                                                            <template v-slot:default="{ active }">
                                                                                <v-list-item-action>
                                                                                    <v-checkbox
                                                                                        multiple
                                                                                        v-model="productsList"
                                                                                        :value="product"
                                                                                    ></v-checkbox>
                                                                                </v-list-item-action>
                                                                                <v-list-item-content>
                                                                                    <v-list-item-title>{{
                                                                                        product.product_model
                                                                                    }}</v-list-item-title>
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
                                                                    <v-btn
                                                                        color="primary"
                                                                        v-on:click="productsListDialog = 0"
                                                                    >
                                                                        Aceptar
                                                                    </v-btn>
                                                                </v-card-actions>
                                                            </v-card>
                                                        </v-dialog>
                                                    </v-col>
                                                </v-row>
                                            </v-sheet>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-stepper-content>
                        </v-stepper-items>
                    </v-stepper>
                </v-col>
            </v-row>
        </v-container>
        <v-speed-dial fixed bottom right v-show="isValidEntry">
            <template v-slot:activator>
                <v-btn class="primary white--text" v-on:click="registerEntry" fab>
                    <v-icon>mdi-content-save</v-icon>
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
            exit_id: Number,
        },

        data() {
            return {
                newExitStepper: 1,
                productsListDialog: 0,
                productsList: [],
                selectedBrand: 0,
                brandSelectedCategory: 0,
                brands: [],
                categories: [],
                genders: [],
                sizes: [],
                selectedGender: 0,
                searchProductValue: '',
                exits: [],
                exitForm: [],
                rules: {
                    required: value => !!value || 'Este campo es requerido.',
                    requiredArray: value => value.length > 0 || 'Debe elegir al menos 1 campo.',
                },
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

            isValidEntry: function() {
                if (this.exits.length > 0) {
                    var totalEntryStockByProduct = []
                    const reducer = (accumulator, currentValue) => accumulator + currentValue.product_exit_amount

                    this.productsList.forEach(product => {
                        var filteredEntriesByProduct = this.exits.filter(exit => {
                            return exit.product_id == product.product_id
                        })

                        var y = filteredEntriesByProduct.reduce(function(valorAnterior, valorActual) {
                            return {
                                product_exit_amount:
                                    parseInt(valorAnterior.product_exit_amount) +
                                    parseInt(valorActual.product_exit_amount),
                            }
                        })
                        totalEntryStockByProduct.push(y)
                    })

                    var x = totalEntryStockByProduct.filter(amount => {
                        return amount.product_exit_amount == 0
                    })

                    if (x.length > 0) {
                        return false
                    } else return true
                } else {
                    return false
                }
            },
        },

        watch: {
            productsList: function() {
                this.productsList.forEach(product => {
                    product.product_colors.forEach(color => {
                        product.product_sizes.forEach(size => {
                            const exists = exit =>
                                exit.product_id == product.product_id &&
                                exit.color_id == color.color_id &&
                                exit.size_id == size.size_id
                            if (!this.exits.some(exists)) {
                                this.exits.push({
                                    exit_id: this.exit_id,
                                    product_id: product.product_id,
                                    color_id: color.color_id,
                                    size_id: size.size_id,
                                    product_exit_amount: 0,
                                })
                            }
                        })
                    })
                })

                this.exits = this.exits.filter(exit => {
                    return this.productsList.some(product => product.product_id == exit.product_id)
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
                    return result[0].product_exit_amount
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

            filterProductsListByBrand: function(brand_id) {
                return this.productsList.filter(product => {
                    return product.product_brand_id == brand_id
                })
            },

            setProductAmount: function(product_exit_amount, product_id, color_id, size_id) {
                var result = this.exits.filter(exit => {
                    return exit.product_id == product_id && exit.color_id == color_id && exit.size_id == size_id
                })

                if (product_exit_amount == '') {
                    result[0].product_exit_amount = 0
                } else {
                    result[0].product_exit_amount = product_exit_amount
                }
            },

            getProductAmount: function(product_id, color_id, size_id) {
                var result = this.exits.filter(exit => {
                    return exit.product_id == product_id && exit.color_id == color_id && exit.size_id == size_id
                })

                return 0
            },

            selectBrand: function(brand_id) {
                var result = this.brands.filter(brand => {
                    return brand.brand_id == brand_id
                })

                this.selectedBrand = result[0]

                this.newExitStepper++
            },

            registerEntry: function() {
                axios
                    .post('/inventory_exits', { exit_brand_id: this.selectedBrand.brand_id, exits: this.exits })
                    .then(response => console.log(response.data.messagge))
                    .catch(error => console.log(error))
            },
        },
    }
</script>
