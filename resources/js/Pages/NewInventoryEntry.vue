<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Registrar entrada de inventario #</h5>
                    <div class="text-subtitle-2">Registrada por</div>
                </v-col>
                <v-col cols="3" offset-md="9">
                    <div class="text-h6">Costo total:</div>
                </v-col>
            </v-row>
            <v-sheet color="white" elevation="1" class="px-8">
                <v-row>
                    <v-col cols="12">
                        <h6 class="text-h6 pb-4">Lucca Sport</h6>
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="(product, index) in luccaSportChecklist"
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
                                                <v-text-field
                                                    v-model="
                                                        luccaUnitCosts[index]
                                                    "
                                                    filled
                                                    label="Costo por pieza"
                                                    type="number"
                                                    min="1"
                                                ></v-text-field>
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
                                                                <!-- <th
                                                                    class="text-center primary--text"
                                                                >
                                                                    <b
                                                                        >Total
                                                                        por
                                                                        color</b
                                                                    >
                                                                </th> -->
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
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        min="0"
                                                                        step="1"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                1
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                2
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                3
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                4
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        class="mt-4"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                5
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                6
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                7
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <!-- <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td> -->
                                                            </tr>
                                                        </tbody>
                                                        <!-- <tfoot>
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
                                                                    {{ xc }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                            </tr>
                                                        </tfoot> -->
                                                    </template>
                                                </v-simple-table>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-col cols="12" align="center">
                            <v-dialog v-model="addProductDialog" width="500">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-speed-dial>
                                        <template v-slot:activator>
                                            <v-btn
                                                class="primary white--text"
                                                v-on="on"
                                                v-bind="attrs"
                                                fab
                                            >
                                                <v-icon>mdi-plus</v-icon>
                                            </v-btn>
                                        </template>
                                    </v-speed-dial>
                                </template>
                                <v-card>
                                    <v-card-title
                                        >Agregar producto</v-card-title
                                    >
                                    <v-card-text>
                                        <v-text-field
                                            v-model="searchProduct"
                                            solo
                                            label="Buscar producto"
                                        >
                                        </v-text-field>
                                        <v-list-item-group
                                            multiple
                                            active-class=""
                                        >
                                            <v-list-item
                                                v-for="product in luccaSportProducts"
                                            >
                                                <template
                                                    v-slot:default="{ active }"
                                                >
                                                    <v-list-item-action>
                                                        <v-checkbox
                                                            v-model="
                                                                luccaSportChecklist
                                                            "
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
                                            class="text--white"
                                            v-on:click="
                                                (addProductDialog = false),
                                                    (searchProduct = '')
                                            "
                                        >
                                            ACEPTAR
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-col>
                    </v-col>
                </v-row>
            </v-sheet>
            <v-sheet color="white" elevation="1" class="px-8">
                <v-row>
                    <v-col cols="12">
                        <h6 class="text-h6 pb-4">X10</h6>
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="product in x10Checklist"
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
                                                <v-text-field
                                                    v-model="
                                                        x10UnitCosts[index]
                                                    "
                                                    filled
                                                    label="Costo por pieza"
                                                    type="number"
                                                    min="1"
                                                ></v-text-field>
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
                                                                <!-- <th
                                                                    class="text-center primary--text"
                                                                >
                                                                    <b
                                                                        >Total
                                                                        por
                                                                        color</b
                                                                    >
                                                                </th> -->
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
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        min="0"
                                                                        step="1"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                1
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                2
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                3
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                4
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        class="mt-4"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                5
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                6
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                >
                                                                    <v-text-field
                                                                        value="0"
                                                                        type="number"
                                                                        filled
                                                                        dense
                                                                        class="mt-4"
                                                                        :rules="[
                                                                            rules.required
                                                                        ]"
                                                                        :disabled="
                                                                            isAvailableSize(
                                                                                product.product_stock,
                                                                                color.color_id,
                                                                                7
                                                                            )
                                                                        "
                                                                    >
                                                                    </v-text-field>
                                                                </td>
                                                                <!-- <td
                                                                    class="text-center"
                                                                >
                                                                    0
                                                                </td> -->
                                                            </tr>
                                                        </tbody>
                                                        <!-- <tfoot>
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
                                                                    {{ xc }}
                                                                </td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                                <td
                                                                    class="text-center"
                                                                ></td>
                                                            </tr>
                                                        </tfoot> -->
                                                    </template>
                                                </v-simple-table>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-col cols="12" align="center">
                            <v-dialog v-model="addProductx10Dialog" width="500">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-speed-dial>
                                        <template v-slot:activator>
                                            <v-btn
                                                class="primary white--text"
                                                v-on="on"
                                                v-bind="attrs"
                                                fab
                                            >
                                                <v-icon>mdi-plus</v-icon>
                                            </v-btn>
                                        </template>
                                    </v-speed-dial>
                                </template>
                                <v-card>
                                    <v-card-title
                                        >Agregar producto</v-card-title
                                    >
                                    <v-card-text>
                                        <v-text-field
                                            v-model="searchProduct"
                                            solo
                                            label="Buscar producto"
                                        >
                                        </v-text-field>
                                        <v-list-item-group
                                            multiple
                                            active-class=""
                                        >
                                            <v-list-item
                                                v-for="product in x10Products"
                                            >
                                                <template
                                                    v-slot:default="{ active }"
                                                >
                                                    <v-list-item-action>
                                                        <v-checkbox
                                                            v-model="
                                                                x10Checklist
                                                            "
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
                                            class="text--white"
                                            v-on:click="
                                                (addProductx10Dialog = false),
                                                    (searchProduct = '')
                                            "
                                        >
                                            ACEPTAR
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-col>
                    </v-col>
                </v-row>
            </v-sheet>
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
            luccaUnitCosts: [],
            x10UnitCosts: [],
            addProductDialog: false,
            addProductx10Dialog: false,
            luccaSportChecklist: [],
            x10Checklist: [],
            productUnitCost: 0,
            products: [],
            productStock: [],
            productCategories: [],
            productGenders: [],
            showLuccaSportProducts: true,
            showX10Products: true,
            luccaSelectedCategory: 1,
            luccaSelectedGender: 1,
            x10SelectedCategory: 1,
            searchProductValue: "",
            registerSnackbar: false,
            messagge: "",
            searchProduct: "",
            rules: {
                required: value => !!value || ""
            }
        };
    },

    computed: {
        filteredProducts: function() {
            return this.products.filter(product => {
                return (
                    product.product_description
                        .toLowerCase()
                        .indexOf(this.searchProduct.toLowerCase()) >= 0 ||
                    product.product_model
                        .toLowerCase()
                        .indexOf(this.searchProduct.toLowerCase()) >= 0
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
                .post("../fetchProducts")
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

        isAvailableSize: function(product_stock, color_id, size) {
            var available = false;

            product_stock.forEach(product => {
                if (
                    product.product_size_id == size &&
                    product.product_color_id == color_id
                ) {
                    available = true;
                }
            });

            return !available;
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
