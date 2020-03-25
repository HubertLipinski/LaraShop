<template>
    <div class="container py-2 d-flex flex-row flex-md-wrap align-content-between">
        <div class="p-2" v-for="(address, index) in this.addresses">
            <span class="h5"> {{index+1}}. {{address.display_name}} </span>
            <b-button @click="modal(index, address)"
                      variant="outline-primary"
                      size="sm">
                Edytuj
            </b-button>
            <b-button @click="deleteItem(address.id)"
                      variant="outline-danger"
                      size="sm">
                <i class="fas fa-trash"></i>
            </b-button>
            <div class="cart-saved-address px-4 pt-2" v-if="edit">
                <p><b>Imie: </b> {{address.name}} </p>
                <p><b>Nazwisko: </b> {{address.surname}}</p>
                <p><b>Adres: </b> {{address.address}} </p>
                <p><b>Kod pocztowy: </b> {{address.zip_code}} </p>
                <p><b>Miasto: </b> {{address.city}}</p>
                <p><b>Kraj: </b> {{address.country}}</p>
                <p><b>Nr. Telefonu: </b> +{{address.number}} </p>
            </div>
            <b-modal :id="'modal-'+index" title="Edytuj adres">
                <input type="hidden" :value="id" name="address_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Nazwa adresu</label>
                        <input type="text" class="form-control" id="display_name" name="display_name" v-model="form.display_name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Imie</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="form.name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">Nazwisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" v-model="form.surname" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Adres</label>
                        <input type="text" class="form-control" id="inputAddress" name="address" v-model="form.address" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="telephone">Nr Telefonu</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" v-model="form.number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Miasto</label>
                        <input type="text" class="form-control" id="inputCity" name="city" v-model="form.city" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputZip">Kod pocztowy</label>
                        <input type="text" class="form-control" id="inputZip" name="zip_code" placeholder="00-000" v-model="form.zip_code" required>
                    </div>
                </div>
                <template v-slot:modal-footer>
                    <div class="w-100">
                        <b-button
                            variant="primary"
                            class="float-right"
                            @click="send(index)"
                        >
                            Wyślij
                        </b-button>
                    </div>
                </template>
            </b-modal>
        </div>
        <b-toast id="my-toast" variant="success" solid>
            <template v-slot:toast-title>
                <div class="d-flex flex-grow-1 align-items-baseline">
                    <strong class="mr-auto">Sukces!</strong>
                </div>
            </template>
            Edycja adresu przebiegła pomyślnie
        </b-toast>
    </div>
</template>

<script>
    export default {
        name: "SavedAddresses",
        props: ['addresses', 'route'],
        data() {
            return {
                edit: true,
                id: null,
                form: {}
            }
        },
        methods: {
            modal(index, address) {
                console.log("Address: ",address);
                this.id = address.id;
                this.form = address;
                this.$bvModal.show('modal-'+index);
            },
            async send(index) {
                // let self = this;
                console.log('sending');
                await axios.put('saved-addresses/'+this.id, this.form)
                    .then((response) => console.log(response))
                    .catch((err) => console.log(err));
                this.$bvModal.hide('modal-'+index);
                this.$bvToast.show('my-toast');
            },
            async deleteItem(id) {
              console.log(id);
            }
        },
        mounted() {
            console.log(this.addresses);
        }
    }
</script>

<style scoped>

</style>
