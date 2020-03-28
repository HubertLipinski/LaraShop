<template>
    <div class="container py-2 d-flex flex-row flex-md-wrap align-content-between">
        <div class="p-2" v-for="(address, index) in this.list">
            <span class="h5"> {{index+1}}. {{address.display_name}} </span>
            <b-button @click="modal(index, address)"
                      variant="outline-primary"
                      size="sm">
                Edytuj
            </b-button>
            <b-button @click="deleteItem(address.id, index)"
                      variant="outline-danger"
                      size="sm">
                <i class="fas fa-trash"></i>
            </b-button>
            <div class="cart-saved-address px-4 pt-2">
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

                <div class="errors text-danger" v-if="errorResponse.message">
                    Wystąpił błąd:
                    <ul v-for="(errorList) in errorResponse.errors" class="pl-3 my-0 mx-2">
                        <li class="" v-for="error in errorList">{{error}}</li>
                    </ul>
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
        <b-toast id="success" variant="success" solid>
            <template v-slot:toast-title>
                <div class="d-flex flex-grow-1 align-items-baseline">
                    <strong class="mr-auto">Sukces!</strong>
                </div>
            </template>
            {{message}}
        </b-toast>
    </div>
</template>

<script>
    export default {
        name: "SavedAddresses",
        props: ['addresses', 'route'],
        data() {
            return {
                list: {},
                id: null,
                form: {},
                message: "",
                errorResponse: {}
            }
        },
        methods: {
            modal(index, address) {
                this.id = address.id;
                this.form = address;
                this.$bvModal.show('modal-'+index);
            },
            async send(index) {
                await axios.put('saved-addresses/'+this.id, this.form)
                    .then(response => {
                        this.message = response.data;
                        this.$bvModal.hide('modal-'+index);
                        this.$bvToast.show('success');
                    })
                    .catch(err => this.errorResponse = err.response.data);
            },
            async deleteItem(id, arrayIndex) {
                await axios.delete('saved-addresses/'+id)
                    .then(response => {
                        this.message = response.data;
                        this.list.splice(arrayIndex, 1);
                        this.$bvToast.show('success');
                    })
                    .catch(err => console.log(err));
            }
        },
        created() {
            this.list = this.addresses;
        }
    }
</script>

<style scoped>

</style>
