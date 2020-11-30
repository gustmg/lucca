<template>
    <app-layout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <h1 class="text-h1">Bienvenido</h1>
                </v-col>
            </v-row>
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
    components: {
        AppLayout,
        Welcome
    }
};
</script>
