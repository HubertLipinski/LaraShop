<template>
    <b-card
        :title="product.name"
        :img-src="thumbnail[0]"
        :img-alt="product.name"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="mb-2 img-fluid"
    >
        <b-card-text class="text-truncate">
            {{product.description}}
        </b-card-text>

        <div class="d-flex justify-content-end">
            <b-button
                :href="view_route"
                variant="outline-primary"
                class=""
            >
                Zobacz więcej
            </b-button>

            <b-button
                type="button"
                variant="outline-danger"
                class="ml-2"
                @click="deleteFavourite"
            >
                Usuń
            </b-button>
        </div>

    </b-card>
</template>

<script>
    export default {
        name: "ProductCardComponent",
        props: [
            'product',
            'view_route',
            'delete',
        ],
        data() {
            return {
                thumbnail: Array,
            }
        },
        methods: {
            async deleteFavourite() {
                await axios.delete(this.delete)
                    .then((response) => {
                        this.$bvToast.toast(response.data, {
                            title: 'Sukcess!',
                            variant: 'success',
                            solid: true
                        })

                    })
                    .finally(() => window.location.reload(true));
            }
        },
        created() {
            this.thumbnail = JSON.parse(this.product.thumbnail);
        }
    }
</script>

<style scoped>

</style>
