<template>
    <button type="button" class="btn btn-block p-2"
            :class="[isAdded ? 'favourite-saved' : 'favourite']"
            @click="addToFav">
    </button>
</template>

<script>
    export default {
        name: "AddToCart",
        props: ['id'],
        data() {
            return {
                isAdded: false, // .favourite || .favourite-saved
            }
        },
        methods: {
          async addToFav() {
              this.isAdded = true;
              await axios.post('favourites', {id: this.id})
                  .then((response) => {
                      //todo add modal
                  })
                  .catch((err) => {
                      console.log("Błąd podczas dodawania do koszyka:", err);
                  });
          }
        },
        created() {
            //check if its saved
        }
    }
</script>
