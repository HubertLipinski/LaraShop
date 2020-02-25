@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="h1">Twój koszyk</p>
        <div class="container py-2">
            <p class="h3 pt-2">1. Przedmioty</p>
            <table class="table table-borderless text-center">
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
                <tr>
                    <td class="align-middle">
                        <div class="cart-image">
                            <img class="rounded img-fluid" src="{{route('getImages', [$product->id, 0])}}" alt="Card image cap">
                        </div>
                    </td>
                    <td class="align-middle">{{$product->name}}</td>
                    <td class="align-middle">{{$product->price}} zł</td>
                    <td class="align-middle">
                        <div class="form-group cart-qty m-auto p-0 m-0">
                            <input type="number" class="form-control" min="1" id="exampleInputPassword1" placeholder="1">
                        </div>
                    </td>
                    <td class="align-middle">razem</td>
                    <td class="align-middle">
                        <button type="button" class="btn btn-outline-danger">
                            Usuń <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
                <p class="h3 pt-2">2. Adres dostawy</p>
                <div class="row px-3 py-2">
                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                        <div class="form-group w-100">
                            <label for="shipping-address">Zapisane adresy</label>
                            <select class="form-control" id="shipping-address">
                                <option>Domowy</option>
                                <option>Dom 2</option>
                                <option>Poczta</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10 d-flex justify-content-center">
                        <div class="cart-saved-address ">
                            <p><b>Imie: </b> Jan </p>
                            <p><b>Nazwisko: </b> Nowak</p>
                            <p><b>Adres: </b> Tymczasowa 1 </p>
                            <p><b>Kod pocztowy: </b> 55-032 </p>
                            <p><b>Miasto: </b> Poznań</p>
                            <p><b>Kraj: </b> Polska</p>
                            <p><b>Nr. Telefonu: </b> +482300101092 </p>
                        </div>
                        <div class="w-75 d-none">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Imie</label>
                                        <input type="text" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Nazwisko</label>
                                        <input type="text" class="form-control" id="inputPassword4">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputAddress">Adres</label>
                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">Nr Telefonu</label>
                                        <input type="text" class="form-control" id="inputPassword4">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Miasto</label>
                                        <input type="text" class="form-control" id="inputCity">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Województwo</label>
                                        <select id="inputState" class="form-control">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">Kod pocztowy</label>
                                        <input type="text" class="form-control" id="inputZip">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-payment-container">
                <p class="h3 pt-2">3. Płatność</p>
                <div class="row m-3">

                    <input type="radio" id="credit-card" value="credit-card" name="payment-option">
                    <label for="credit-card">
                        <div class="cart-payment mr-3">
                            <i class="credit-card"></i>
                            <p class="font-weight-bold">Karta kredytowa</p>
                        </div>
                    </label>

                    <input type="radio" id="paypal" value="paypal" name="payment-option">
                    <label for="paypal">
                        <div class="cart-payment mr-3">
                            <i class="cc-paypal"></i>
                            <p class="font-weight-bold">PayPal</p>
                        </div>
                    </label>

                    <input type="radio" id="payU" value="payU" name="payment-option">
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
{{--                <p class="text-muted">Kupon rabatowy -</p>--}}
                <a href="#" role="button" class="btn btn-lg btn-outline-primary py-2">Przejdź do płatności</a>
            </div>
        </div>
    </div>
@endsection
