<template>
    <button type="button" class="btn btn-link ml-auto mr-2 px-3" @click="addToCart">
        <i class="shopping-cart"></i>
    </button>
</template>

<script>
    export default {
        name: "AddToCart",
        props: ['id', 'cart_url'],
        methods: {
          addToCart() {
              this.request()
                  .then(()=>{
                      window.location.href = this.cart_url;
                  })
          },
          async request() {
              await axios.post('cart/add', {id: this.id})
                  .catch((err) => {
                      console.log("Błąd podczas dodawania do koszyka:", err);
                  });
          }
        },
    }
</script>
