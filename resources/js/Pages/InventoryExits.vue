<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Salidas de inventario</h5>
                </v-col>
                <v-col cols="12" align="center">
                    <div class="text-h4 text--secondary">
                        No hay salidas registardas.
                    </div>
                </v-col>
            </v-row>
        </v-container>
        <v-speed-dial fixed bottom right>
            <template v-slot:activator>
                <v-btn
                    class="primary white--text"
                    fab
                >
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
        // this.fetchInventoryExits();
    },

    data() {
        return {
            inventoryExits: []
        };
    },

    methods: {
        fetchInventoryExits: function() {
            axios
                .post("fetchInventoryEntries")
                .then(response => {
                    this.inventoryEntries = response.data.inventory_entries;
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
};
</script>
