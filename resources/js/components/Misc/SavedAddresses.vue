<template>
    <div class="container py-2 d-flex flex-row flex-md-wrap align-content-between">
        <div class="p-2" v-for="(address, index) in this.addresses">
            <span class="h5"> {{index+1}}. {{address.display_name}} </span>
            <b-button @click="modal(index, address.id)"
                      variant="outline-primary"
                      size="sm">
                Edytuj
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
                id: {{id}}
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
        props: ['addresses'],
        data() {
            return {
                edit: true,
                id: null,
            }
        },
        methods: {
            modal(index, id) {
                this.id = id;
                this.$bvModal.show('modal-'+index);
            },
            send(index) {
                console.log('sending');
                this.$bvModal.hide('modal-'+index);
                this.$bvToast.show('my-toast');
            }
        },
        mounted() {
            console.log(this.addresses);
        }
    }
</script>

<style scoped>

</style>
