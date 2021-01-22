<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Entradas de inventario</h5>
                </v-col>
                <v-col cols="12" v-if="entries.length > 0">
                    <v-row>
                        <v-col cols="12" v-for="entry in entries" :key="entry.entry_id">
                            <v-card>
                                <v-container>
                                    <v-row>
                                        <v-col cols="5">
                                            <div class="text-h6">Entrada de inventario #{{ entry.entry_id }}</div>
                                            <div class="text-subtitle-2 text--secondary">
                                                Registrada por {{ entry.user.name }} el
                                                {{ formatDate(entry.created_at) }} a las
                                                {{ formatTime(entry.created_at) }} hrs
                                            </div>
                                        </v-col>
                                        <v-col cols="3" align="center">
                                            <v-icon>mdi-tshirt-crew</v-icon>
                                            <div class="text-subtitle-1">
                                                {{ totalEntryProducts(entry.entry_products) }}
                                            </div>
                                            <div class="text-caption">PRODUCTOS INGRESADOS</div>
                                        </v-col>
                                        <v-col cols="2" align="center">
                                            <v-icon>mdi-currency-usd</v-icon>
                                            <div class="text-subtitle-1">
                                                ${{ totalEntryCost(entry.entry_products) }}
                                            </div>
                                            <div class="text-caption">COSTO DE MERCANCÍA</div>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-btn block class="primary mb-4" :href="'/entries/' + entry.entry_id"
                                                >Ver detalles</v-btn
                                            >
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col cols="12" v-else align="center">
                    <div class="text-h4 text--secondary">
                        No hay entradas registardas.
                    </div>
                </v-col>
            </v-row>
        </v-container>
        <v-speed-dial fixed bottom right>
            <template v-slot:activator>
                <v-btn class="primary white--text" href="/entries/create" fab>
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
            this.fetchEntries()
        },

        data() {
            return {
                entries: [],
            }
        },

        methods: {
            fetchEntries: function() {
                axios
                    .post('fetchEntries')
                    .then(response => {
                        this.entries = response.data.entries
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

            totalEntryProducts: function(entry_products) {
                var y = entry_products.reduce(function(valorAnterior, valorActual) {
                    return {
                        product_entry_amount:
                            parseInt(valorAnterior.product_entry_amount) + parseInt(valorActual.product_entry_amount),
                    }
                })
                return y.product_entry_amount
            },

            totalEntryCost: function(entry_products) {
                var y = entry_products.reduce(function(valorAnterior, valorActual) {
                    return {
                        product_unit_cost:
                            parseFloat(valorAnterior.product_unit_cost) + parseFloat(valorActual.product_unit_cost),
                    }
                })
                return y.product_unit_cost.toFixed(2)
            },
        },
    }
</script>
