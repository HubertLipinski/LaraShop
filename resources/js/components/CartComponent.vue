<template>
    <div class="container">
        <p class="h1">Twój koszyk</p>
        <div class="container py-2" v-if="productsList.length > 0">
            <form method="POST" :action="this.actionRoute">
                <input name="_token" v-bind:value="this.$csrfToken" type="hidden">
                <p class="h3 pt-2">1. Przedmioty</p>
                <table class="table table-borderless text-center" v-if="productsList.length > 0">
                    <thead>
                    <tr>
                        <th scope="col" colspan="2">Produkt</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena razem</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, index) in productsList">
                        <td class="align-middle">
                            <div class="cart-image">
                                <img class="rounded img-fluid" :src="JSON.parse(product.thumbnail)[0]" alt="Card image cap">
                            </div>
                        </td>
                        <td class="align-middle">{{product.name}}</td>
                        <td class="align-middle">{{product.price}} zł</td>
                        <td class="align-middle">
                            <div class="form-group cart-qty m-auto p-0 m-0">
                                <input type="number" :name="'qty['+index+']'" class="form-control" value="1" min="1" placeholder="1">
                            </div>
                        </td>
                        <td class="align-middle">razem</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-outline-danger" @click="deleteItem(product.id)">
                                Usuń <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="h5 p-3" v-else>Nie masz żadnych przedmiotów w koszyku!</p>
                <div>
                    <p class="h3 pt-2">2. Adres dostawy</p>
                    <div class="row px-3 py-2">
                        <div class="col-md-2 d-flex align-items-center justify-content-center">
                            <div class="form-group w-100">
                                <label class="h5" for="shipping-address">Zapisane adresy</label>
                                <select class="form-control" id="shipping-address" v-if="savedAddresses.length !== 0" v-model="selectedAddress">
                                    <option value="new_address">Nowy adres</option>
                                    <option v-for="(address, index) in this.savedAddresses" :value="index">{{address.display_name}}</option>
                                </select>
                                <p class="pl-3" v-else>
                                    Brak zapisanych adresów! <br/> Możesz je dodać w ustawieniach.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-10 d-flex justify-content-center">
                            <div class="cart-saved-address" v-if="this.savedAddresses.length > 0 && selectedAddress !== 'new_address'">
                                <p><b>Imie: </b> {{savedAddresses[selectedAddress].name}} </p>
                                <p><b>Nazwisko: </b> {{savedAddresses[selectedAddress].surname}}</p>
                                <p><b>Adres: </b> {{savedAddresses[selectedAddress].address}} </p>
                                <p><b>Kod pocztowy: </b> {{savedAddresses[selectedAddress].zip_code}} </p>
                                <p><b>Miasto: </b> {{savedAddresses[selectedAddress].city}}</p>
                                <p><b>Kraj: </b> {{savedAddresses[selectedAddress].country}}</p>
                                <p><b>Nr. Telefonu: </b> +{{savedAddresses[selectedAddress].number}} </p>
                                <input type="hidden" class="form-control" :value="savedAddresses[selectedAddress].id" name="saved_address">
                            </div>
                            <div class="w-75" v-if="this.savedAddresses.length === 0 || selectedAddress === 'new_address'">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Imie</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="surname">Nazwisko</label>
                                        <input type="text" class="form-control" id="surname" name="surname" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputAddress">Adres</label>
                                        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="telephone">Nr Telefonu</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Miasto</label>
                                        <input type="text" class="form-control" id="inputCity" name="city" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="voivodeship">Województwo</label>
                                        <select id="voivodeship" class="form-control" name="voivodeship" required>
                                            <option>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">Kod pocztowy</label>
                                        <input type="text" class="form-control" id="inputZip" name="zip_code" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-payment-container">
                    <p class="h3 pt-2">3. Płatność</p>
                    <div class="row m-3">
                        <input type="radio" id="credit-card" value="credit-card" name="payment-option" required>
                        <label for="credit-card">
                            <div class="cart-payment mr-3">
                                <i class="credit-card"></i>
                                <p class="font-weight-bold">Karta kredytowa</p>
                            </div>
                        </label>

                        <input type="radio" id="paypal" value="paypal" name="payment-option" required>
                        <label for="paypal">
                            <div class="cart-payment mr-3">
                                <i class="cc-paypal"></i>
                                <p class="font-weight-bold">PayPal</p>
                            </div>
                        </label>

                        <input type="radio" id="payU" value="payU" name="payment-option" required>
                        <label for="payU">
                            <div class="cart-payment">
                                <i class="payu"></i>
                                <p class="font-weight-bold">PayU</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="p-5 text-right">
                    <p class="h4">Do zapłaty: <b>123 zł</b></p>
<!--                    <p class="text-muted">Kupon rabatowy -</p>-->
                    <button type="submit" class="btn btn-lg btn-outline-primary py-2">Przejdź do płatności</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center align-content-center p-5 m-5 m-auto " v-else>
            <p class="h5 p-3">Dodaj najpierw przedmioty do koszyka!</p>
        </div>
    </div>
</template>

<script>
    import VueCsrf from 'vue-csrf';
    Vue.use(VueCsrf);
    export default {
        name: "CartComponent",
        props: ['actionRoute', 'products', 'saved_addresses', 'errors'],
        data() {
            return {
                imageLinks: [],
                productsList: {},
                savedAddresses: [],
                selectedAddress: 'new_address',
            }
        },
        methods: {
          deleteItem(id) {
              this.productsList.splice(-1, 1);
              //ajax request to delete from cart
          },

        },
        mounted() {
            this.productsList = JSON.parse(this.products);
            this.savedAddresses = JSON.parse(this.saved_addresses);
            // console.log(this.savedAddresses);
        }
    }
</script>

<style scoped>

</style>
