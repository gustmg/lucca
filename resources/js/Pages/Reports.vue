<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h5 class="text-h5">Reportes</h5>
                </v-col>
            </v-row>
        </v-container>
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
