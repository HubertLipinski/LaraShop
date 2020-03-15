<template>
    <div class="container py-2 d-flex flex-row flex-md-wrap align-content-between">
        <div class="p-2" v-for="(address, index) in this.addresses">
            <span class="h5"> {{index+1}}. {{address.display_name}} </span>
            <a href="#" class="text-decoration-none font-weight-bold"> Edytuj </a>
            <div class="cart-saved-address px-4 pt-2" v-if="edit">
                <p><b>Imie: </b> {{address.name}} </p>
                <p><b>Nazwisko: </b> {{address.surname}}</p>
                <p><b>Adres: </b> {{address.address}} </p>
                <p><b>Kod pocztowy: </b> {{address.zip_code}} </p>
                <p><b>Miasto: </b> {{address.city}}</p>
                <p><b>Kraj: </b> {{address.country}}</p>
                <p><b>Nr. Telefonu: </b> +{{address.number}} </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SavedAddresses",
        props: ['addresses'],
        data() {
            return {
                edit: true
            }
        },
        methods: {

        },
        mounted() {
            console.log(this.addresses);
        }
    }
</script>

<style scoped>

</style>
