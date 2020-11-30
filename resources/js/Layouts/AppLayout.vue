<template>
    <v-app>
        <v-navigation-drawer mini-variant permanent color="primary" app>
            <v-list dense>
                <v-tooltip right>
                    <template v-slot:activator="{ on, attrs }">
                        <v-list-item link v-bind="attrs" v-on="on" href="/dashboard">
                            <v-list-item-icon>
                                <v-icon color="white">mdi-home</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Inicio</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                    <span>Inicio</span>
                </v-tooltip>

                <v-tooltip right>
                    <template v-slot:activator="{ on, attrs }">
                        <v-list-item
                            link
                            v-bind="attrs"
                            v-on="on"
                            href="/products"
                        >
                            <v-list-item-icon>
                                <v-icon color="white">mdi-hanger</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Productos</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                    <span>Productos</span>
                </v-tooltip>

                <v-tooltip right>
                    <template v-slot:activator="{ on, attrs }">
                        <v-list-item
                            link
                            v-bind="attrs"
                            v-on="on"
                            href="/inventory_entries"
                        >
                            <v-list-item-icon>
                                <v-icon color="white">mdi-warehouse</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title
                                    >Entradas de inventario</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                    <span>Entradas de inventario</span>
                </v-tooltip>

                <v-tooltip right>
                    <template v-slot:activator="{ on, attrs }">
                        <v-list-item link v-bind="attrs" v-on="on" href="/inventory_exits">
                            <v-list-item-icon>
                                <v-icon color="white">mdi-exit-to-app</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title
                                    >Salidas de inventario</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                    <span>Salidas de inventario</span>
                </v-tooltip>

                <v-tooltip right>
                    <template v-slot:activator="{ on, attrs }">
                        <v-list-item link v-bind="attrs" v-on="on" href="/reports">
                            <v-list-item-icon>
                                <v-icon color="white">mdi-chart-bar</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Reportes</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                    <span>Reportes</span>
                </v-tooltip>
            </v-list>
            <template v-slot:append>
                <v-list dense>
                    <v-tooltip right>
                        <template v-slot:activator="{ on, attrs }">
                            <v-list-item
                                link
                                v-bind="attrs"
                                v-on="on"
                                v-on:click="logout"
                            >
                                <v-list-item-icon>
                                    <v-icon color="white">mdi-logout</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title
                                        >Cerrar sesión</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                        </template>
                        <span>Cerrar sesión</span>
                    </v-tooltip>
                </v-list>
            </template>
        </v-navigation-drawer>
        <v-main>
            <slot></slot>
        </v-main>
    </v-app>
</template>

<script>
export default {
    methods: {
        logout() {
            axios.post(route("logout").url()).then(response => {
                window.location = "/";
            });
        }
    }
};
</script>
