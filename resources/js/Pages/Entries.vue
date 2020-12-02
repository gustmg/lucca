<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Entradas de inventario</h5>
                </v-col>
                <v-col cols="12" v-if="entries.length > 0">
                    <v-card> </v-card>
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
        },
    }
</script>
