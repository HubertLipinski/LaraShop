<template>
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="col-md-8 offset-md-2 px-0">
                    <p class="h1 pt-5 py-5">Sprzedaj Przedmiot</p>
                </div>
            </div>
        </div>
        <div class="container">
            <form method="post" :action="this.actionRoute" enctype="multipart/form-data">
               <input name="_token" v-bind:value="this.$csrfToken" type="hidden">
                <div class="form-group">
                    <label for="name" class="h5">Nazwa:</label>
                    <input name="name" type="text" class="form-control form-control-lg" id="name" aria-describedby="name" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="h5">Opis:</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="4" required></textarea>
                </div>
                <div class="form-group w-50">
                    <label for="exampleFormControlSelect2" class="h5">Kategoria:</label>
                    <select name="category" class="form-control" id="exampleFormControlSelect2" required>
                        <option value="" disabled selected>Wybierz</option>
                        <option v-for="category in JSON.parse(this.categories)" :value="category.id">  {{category.name}} </option>
                    </select>
                </div>
                <label for="price" class="h5">Cena:</label>
                <div class="form-group col-4 input-group pl-0">
                    <input name="price" type="number" class="form-control form-control-lg" id="price" aria-describedby="price" min="0" required>
                    <div class="input-group-append">
                        <div class="input-group-text text-uppercase" id="btnGroupAddon">zł</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="h5">Zdjęcia <span class="text-muted">(Maksymalnie 5 zdjęć)</span></label>
                    <input name="images[]" id="image" type="file" multiple="multiple" accept="image/jpg, image/jpeg" class="form-control-file" @change="imageCheck" required>
                    <p class="text-danger" v-if="imagesNumber > maxImagesNumber">Maxymalna ilość zdjęć to {{maxImagesNumber}}</p>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-block w-25 btn-lg btn-outline-success" v-if="canSend">Wyślij</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import VueCsrf from 'vue-csrf';
    Vue.use(VueCsrf);

    export default {
        name: "SellProductComponent",
        props: ['actionRoute', 'categories'],
        data() {
            return {
                canSend: true,
                maxImagesNumber: 5,
                imagesNumber: 0
            }
        },
        methods: {
            imageCheck() {
                let images = event.target.files;
                this.imagesNumber = images.length;
                (this.imagesNumber > this.maxImagesNumber) ? this.canSend = false : this.canSend = true;
            }
        },
        created: function () {
            // console.log(this.errors);
        }
    }
</script>

<style scoped>

</style>
