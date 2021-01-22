<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Entradas de inventario</h5>
                </v-col>
                <v-col cols="12" v-if="inventoryExits.length > 0">
                    <!-- <v-row>
                        <v-col cols="12" v-for="inventory_exit in exits" :key="inventory_exit.product_exit_id">
                            <v-card>
                                <v-container>
                                    <v-row>
                                        <v-col cols="5">
                                            <div class="text-h6">
                                                Entrada de inventario #{{ inventory_exit.product_exit_id }}
                                            </div>
                                            <div class="text-subtitle-2 text--secondary">
                                                Registrada por {{ inventory_exit.user.name }} el
                                                {{ formatDate(inventory_exit.created_at) }} a las
                                                {{ formatTime(inventory_exit.created_at) }} hrs
                                            </div>
                                        </v-col>
                                        <v-col cols="3" align="center">
                                            <v-icon>mdi-tshirt-crew</v-icon>
                                            <div class="text-subtitle-1">
                                                {{ totalEntryProducts(inventory_exit.inventory_exit_products) }}
                                            </div>
                                            <div class="text-caption">PRODUCTOS INGRESADOS</div>
                                        </v-col>
                                        <v-col cols="2" align="center">
                                            <v-icon>mdi-currency-usd</v-icon>
                                            <div class="text-subtitle-1">
                                                ${{ totalEntryCost(inventory_exit.inventory_exit_products) }}
                                            </div>
                                            <div class="text-caption">COSTO DE MERCANCÍA</div>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-btn
                                                block
                                                class="primary mb-4"
                                                :href="'/inventory_exits/' + inventory_exit.inventory_exit_id"
                                                >Ver detalles</v-btn
                                            >
                                            <v-btn block class="primary">Descargar</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row> -->
                </v-col>
                <v-col cols="12" v-else align="center">
                    <div class="text-h4 text--secondary">
                        No hay salidas registardas.
                    </div>
                </v-col>
            </v-row>
        </v-container>
        <v-speed-dial fixed bottom right>
            <template v-slot:activator>
                <v-btn class="primary white--text" href="/inventory_exits/create" fab>
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
        </v-speed-dial>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from 'moment'
    export default {
        components: {
            AppLayout,
        },

        mounted() {
            this.fetchInventoryExits()
        },

        data() {
            return {
                inventoryExits: [],
            }
        },

        methods: {
            fetchInventoryExits: function() {
                console.log('Hacinedo fetch')
                axios
                    .post('fetchExits')
                    .then(response => {
                        console.log('Realizado')
                        this.inventoryExits = response.data.inventory_exits
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            formatDate: function(date) {
                return moment(date).format('DD/MMMM/YYYY')
            },

            formatTime: function(date) {
                return moment(date).format('LT')
            },

            totalExitProducts: function(inventory_exit_products) {
                var y = inventory_exit_products.reduce(function(valorAnterior, valorActual) {
                    return {
                        product_exit_amount:
                            parseInt(valorAnterior.product_exit_amount) + parseInt(valorActual.product_exit_amount),
                    }
                })
                return y.product_exit_amount
            },
        },
    }
</script>
