<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Productos</h5>
                </v-col>
                <v-col cols="2">
                    <div class="text-title-1">Marcas</div>
                    <v-checkbox
                        class="mb-0 py-0"
                        v-model="showLuccaSportProducts"
                        label="Lucca Sport"
                    ></v-checkbox>
                    <v-checkbox
                        class="my-0 py-0"
                        v-model="showX10Products"
                        label="X10"
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
                class="px-8"
                v-show="showLuccaSportProducts"
            >
                <v-row>
                    <v-col cols="12">
                        <h6 class="text-h6 pb-4">Lucca Sport</h6>
                        <v-row>
                            <v-col cols="3">
                                <v-select
                                    v-model="luccaSelectedCategory"
                                    solo
                                    label="Categoría"
                                    :items="luccaSportCategories"
                                    item-text="product_category_name"
                                    item-value="product_category_id"
                                ></v-select>
                            </v-col>
                            <v-col cols="3">
                                <v-select
                                    v-model="luccaSelectedGender"
                                    solo
                                    label="Género"
                                    :items="productGenders"
                                    item-text="product_gender_name"
                                    item-value="product_gender_id"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="product in luccaSportProducts"
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
                                                {{
                                                    product.product_category
                                                        .product_category_name
                                                }}
                                            </v-col>
                                            <v-col cols="3">
                                                Genero:
                                                {{
                                                    product.product_gender
                                                        .product_gender_name
                                                }}
                                            </v-col>
                                            <v-col cols="3">
                                                Costo por pieza: ${{
                                                    product.product_cost
                                                }}
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
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XCH
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    CH
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    M
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    G
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XG
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XXG
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XXXG
                                                                </th>
                                                                <th
                                                                    class="text-center primary--text"
                                                                >
                                                                    <b
                                                                        >Total
                                                                        por
                                                                        color</b
                                                                    >
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="color in getProductAvailableColors(
                                                                    product.product_stock
                                                                )"
                                                                :key="
                                                                    color.color_id
                                                                "
                                                            >
                                                                <td>
                                                                    {{
                                                                        color.color_name
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            1
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            2
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            3
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            4
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            5
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            6
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            7
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td>
                                                                    <b
                                                                        >Total
                                                                        por
                                                                        talla</b
                                                                    >
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                            </tr>
                                                        </tfoot>
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
            <br />
            <v-sheet
                color="white"
                elevation="1"
                class="px-8"
                v-show="showX10Products"
            >
                <v-row>
                    <v-col cols="12">
                        <h6 class="text-h6 pb-4">X10</h6>
                        <v-row>
                            <v-col cols="3">
                                <v-select
                                    v-model="x10SelectedCategory"
                                    solo
                                    label="Categoría"
                                    :items="x10Categories"
                                    item-text="product_category_name"
                                    item-value="product_category_id"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="product in x10Products"
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
                                                {{
                                                    product.product_category
                                                        .product_category_name
                                                }}
                                            </v-col>
                                            <v-col cols="3">
                                                Costo por pieza: ${{
                                                    product.product_cost
                                                }}
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
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XCH
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    CH
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    M
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    G
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XG
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XXG
                                                                </th>
                                                                <th
                                                                    class="text-center"
                                                                >
                                                                    XXXG
                                                                </th>
                                                                <th
                                                                    class="text-center primary--text"
                                                                >
                                                                    <b
                                                                        >Total
                                                                        por
                                                                        color</b
                                                                    >
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="color in getProductAvailableColors(
                                                                    product.product_stock
                                                                )"
                                                                :key="
                                                                    color.color_id
                                                                "
                                                            >
                                                                <td>
                                                                    {{
                                                                        color.color_name
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            1
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            2
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            3
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            4
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            5
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            6
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    {{
                                                                        getStockByColorSize(
                                                                            product.product_stock,
                                                                            color.color_id,
                                                                            7
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td>
                                                                    <b
                                                                        >Total
                                                                        por
                                                                        talla</b
                                                                    >
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td>
                                                            </tr>
                                                        </tfoot>
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
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout
    },

    mounted() {
        this.fetchProducts();
        this.fetchProductCategories();
        this.fetchProductGenders();
    },

    data() {
        return {
            products: [],
            productStock: [],
            productCategories: [],
            productGenders: [],
            showLuccaSportProducts: true,
            showX10Products: true,
            luccaSelectedCategory: 1,
            luccaSelectedGender: 1,
            x10SelectedCategory: 1,
            searchProductValue: ""
        };
    },

    computed: {
        filteredProducts: function() {
            return this.products.filter(product => {
                return (
                    product.product_description
                        .toLowerCase()
                        .indexOf(this.searchProductValue.toLowerCase()) >= 0 ||
                    product.product_model
                        .toLowerCase()
                        .indexOf(this.searchProductValue.toLowerCase()) >= 0
                );
            });
        },

        luccaSportCategories: function() {
            return this.productCategories.filter(
                productCategory => productCategory.product_category_id < 5
            );
        },

        luccaSportProducts: function() {
            if (this.luccaSelectedCategory == 1) {
                if (this.luccaSelectedGender == 1) {
                    return this.filteredProducts.filter(
                        product => product.product_brand_id == 1
                    );
                } else {
                    return this.filteredProducts.filter(
                        product =>
                            product.product_brand_id == 1 &&
                            product.product_gender_id ==
                                this.luccaSelectedGender
                    );
                }
            } else {
                if (this.luccaSelectedGender == 1) {
                    return this.filteredProducts.filter(
                        product =>
                            product.product_brand_id == 1 &&
                            product.product_category_id ==
                                this.luccaSelectedCategory
                    );
                } else {
                    return this.filteredProducts.filter(
                        product =>
                            product.product_brand_id == 1 &&
                            product.product_category_id ==
                                this.luccaSelectedCategory &&
                            product.product_gender_id ==
                                this.luccaSelectedGender
                    );
                }
            }
        },

        x10Categories: function() {
            return this.productCategories.filter(
                productCategory =>
                    productCategory.product_category_id > 4 ||
                    productCategory.product_category_id == 1
            );
        },

        x10Products: function() {
            if (this.x10SelectedCategory == 1) {
                return this.filteredProducts.filter(
                    product => product.product_brand_id == 2
                );
            } else {
                return this.filteredProducts.filter(
                    product =>
                        product.product_brand_id == 2 &&
                        product.product_category_id == this.x10SelectedCategory
                );
            }
        }
    },

    methods: {
        fetchProducts: function() {
            axios
                .post("fetchProducts")
                .then(response => {
                    this.products = response.data.products;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        fetchProductCategories: function() {
            axios
                .get("product_categories")
                .then(response => {
                    this.productCategories = response.data.product_categories;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        fetchProductGenders: function() {
            axios
                .get("product_genders")
                .then(response => {
                    this.productGenders = response.data.product_genders;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        getProductAvailableColors: function(product_stock) {
            var availableColors = [];

            product_stock.forEach(product => {
                if (
                    !availableColors.some(
                        color =>
                            color.color_id ===
                            product.product_color.product_color_id
                    )
                ) {
                    availableColors.push({
                        color_id: product.product_color.product_color_id,
                        color_name: product.product_color.product_color_name
                    });
                }
            });

            return availableColors;
        },

        getStockByColorSize: function(product_stock, color_id, size) {
            var stock = "NA";

            product_stock.forEach(product => {
                if (
                    product.product_size_id == size &&
                    product.product_color_id == color_id
                ) {
                    stock = product.product_stock;
                }
            });

            return stock;
        }
    }
};
</script>
