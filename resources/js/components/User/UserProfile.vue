<template>
    <div class="row text-left py-3" v-if="!edition">
        <div class="col-md-2 text-center">
            <img class="img-fluid pt-2" :src="userArr.user_avatar" alt="User avatar">
        </div>
        <div class="col-md-3">
            <span class="font-weight-bold">Imie: </span> <p>{{userArr.name}}</p>
            <span class="font-weight-bold">Nazwisko: </span> <p>{{userArr.name}}</p>
            <span class="font-weight-bold">Email: </span> <p>{{userArr.email}}</p>
        </div>
        <div class="col-md-3">
            <span class="font-weight-bold">Hasło: </span> <p>**********</p>
            <span class="font-weight-bold">Liczba adresów: </span> <p>{{userArr.address_number}}</p>
            <span class="font-weight-bold">Liczba przedmiotów: </span> <p>{{userArr.product_number}}</p>
        </div>
        <div class="col-md-2">
            <span class="font-weight-bold">Kupione przedmioty: </span> <p>{{userArr.items_bought}}</p>
            <span class="font-weight-bold">Konto od: </span> <p>{{userArr.created_at}}</p>
        </div>
        <div class="col-md-1 p-1">
            <b-button @click="edit"
                      variant="outline-primary"
                      >
                Edytuj
            </b-button>
        </div>
    </div>
    <div class="py-3" v-else>
        <b-overlay :show="isSending"
                   spinner-variant="primary">
            <div class="row text-left">
                <div class="col-md-3 text-center">
                    <img class="img-fluid pt-2" :src="userArr.user_avatar" alt="User avatar" v-if="!userNewAvatar">
                    <img class="img-fluid pt-2 img-fluid" :src="userNewAvatar" alt="User avatar" v-else>
                    <div class="form-group pt-2">
                        <label for="avatar" class="text-danger" v-if="avatarError">Wybierz poprawny format!</label>
                        <label for="avatar" v-else>Wybierz nowy avatar</label>
                        <input type="file" class="form-control-file form-control-file-sm" id="avatar" name="avatar" @change="onFileSelected">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user_name" class="font-weight-bold">Imię: </label>
                        <input type="text" class="form-control" name="name" id="user_name" v-model="userArr.name"/>
                    </div>
                    <div class="form-group">
                        <label for="user_surname" class="font-weight-bold">Nazwisko: </label>
                        <input type="text" class="form-control" name="surname" id="user_surname" v-model="userArr.name"/>
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="font-weight-bold">Email: </label>
                        <input type="email" class="form-control" name="email" id="user_email" v-model="userArr.email"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user_password" class="font-weight-bold">Hasło: </label>
                        <input type="password" class="form-control" name="password" id="user_password" v-model="userArr.password"/>
                    </div>
                    <div class="form-group">
                        <label for="user_password_confirm" class="font-weight-bold">Potwierdź hasło: </label>
                        <input type="password" class="form-control" name="password_confirm" id="user_password_confirm" v-model="userArr.password_confirm"/>
                    </div>
                    <small class="form-text text-muted font-weight-bold">
                        Jeśli nie chcesz zmieniać hasła zostaw puste pola.
                    </small>
                </div>
                <div class="col-md-1 offset-md-1 p-1">
                    <b-button @click="save"
                              variant="outline-success"
                              >
                        Zapisz
                    </b-button>
                </div>
            </div>
        </b-overlay>
        <b-toast id="response-info" variant="success" solid>
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
        name: "UserProfile",
        props: [
            'user',
            'user_avatar',
            'product_number',
            'items_bought',
            'address_number',
            'route'
        ],

        data() {
            return {
                acceptedImageTypes: [
                    'image/jpeg',
                    'image/png'
                ],
                edition: false,
                userNewAvatar: null,
                userArr: {},
                message: '',
                isSending: false,
                avatarError: false
            }
        },

        methods: {
            onFileSelected(event) {
                let data = new FormData();
                const img = event.target.files[0];
                if(this.acceptedImageTypes.includes(img.type)) {
                    this.userNewAvatar = URL.createObjectURL(img);
                    data.append('name', 'avatar');
                    data.append('file', img);
                    this.userArr.avatar = this.userNewAvatar; //todo repair
                }
                else
                    this.avatarError = true;
            },
            edit() {
                this.edition = true;
            },
            async save() {
                this.isSending = true;
                console.log(this.userArr.avatar);
                await axios.put('edit/'+this.userArr.id, this.userArr)
                .then((response) => {
                    this.message = response.data;
                    this.$bvToast.show('response-info');
                    this.isSending = false;
                    this.edition = false;
                    if(this.userNewAvatar)
                        this.userArr.user_avatar = this.userNewAvatar;
                })
                .catch(err => console.log("err!",err));
            },
        },

        created() {
            this.userArr = this.user;
            this.userArr.products = null;
            this.userArr.user_avatar = this.user_avatar;
            this.userArr.product_number = this.product_number;
            this.userArr.items_bought = this.items_bought;
            this.userArr.address_number = this.address_number;
        }
    }
</script>

<style scoped>

</style>
