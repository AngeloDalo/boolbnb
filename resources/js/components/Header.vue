<!-- navbar sotto nav login -->
<template>
    <nav
        class="navbar-search navbar navbar-expand-md navbar-light bg-white shadow-sm"
    >
        <div class="container d-flex justify-content-center">
            <nav class="btn-nav-search navbar navbar-light bg-light">
                <form class="container-fluid">
                    <button
                        class="btn-search btn btn-danger"
                        type="button"
                        v-for="item in menuItems"
                        :key="item.id"
                    >
                        <router-link
                            class="nav-search nav-link text-light"
                            :to="{ name: item.routeName }"
                            >{{ item.label }}</router-link
                        >
                    </button>
                </form>
            </nav>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            //percorso per il logo da nettere nella navbar
            menuItems: [
                {
                    label: "Search Apartment",
                    routeName: "map",
                },
            ],
        };
    },
};
</script>

<style lang="scss">
.navbar-search {
    padding: 0 !important;

    .btn-nav-search {
        padding-top: 0 !important;
        background-color: white !important;

        .btn-search {
            padding: 0 !important;

            .nav-search {
                padding: 0 5px !important;
            }
        }
    }
}
</style>
