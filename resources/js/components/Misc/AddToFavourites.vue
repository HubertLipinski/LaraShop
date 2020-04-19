<template>
    <button type="button" class="btn btn-block p-2 favourite"
            @click="addToFav"
            v-if="isAdded !== true">
    </button>
    <button type="button" class="btn btn-block p-2 favourite-saved"
            @click="deleteFav"
            v-else>
    </button>
</template>

<script>
    export default {
        name: "AddToCart",
        props: [
            'id',
            'store',
            'delete',
            'name',
            'isfavourite'
        ],
        data() {
            return {
                isAdded: false, // .favourite || .favourite-saved
            }
        },
        methods: {
            async addToFav() {
              await axios.post(this.store, {product_id: this.id})
                  .then((response) => {
                      this.isAdded = true;
                      this.toast(true, response.data);
                  })
                  .catch(() => {
                     this.toast(false);
                  });
            },
            async deleteFav() {
                this.isAdded = false;
                await axios.delete(this.delete)
                    .then((response) => {
                        this.isAdded = false;
                        this.toast(true, response.data);
                    })
                    .catch(() => {
                        this.toast(false);
                    });
            },
            toast(success, msg = "") {
                if (success) {
                    this.$bvToast.toast(msg, {
                        title: 'Sukces!',
                        solid: true,
                        variant: 'success'
                    });
                } else {
                    this.$bvToast.toast(`Coś poszło nie tak...`, {
                        title: 'Oops!',
                        solid: true,
                        variant: 'danger'
                    });
                }
            }
        },
        created() {
            this.isAdded = (this.isfavourite == true);
        }
    }
</script>
