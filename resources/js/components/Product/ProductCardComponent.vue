<template>
    <div class="item p-2 border-0">
        <div class="item-photos pt-2 pb-1">
            <div id="item_" class="carousel slide" data-ride="false" data-interval="false">
                <ol class="carousel-indicators">
<!--                    @for($i = 0; $i < count(json_decode($item->thumbnail)); $i++)-->
                    <li data-target="#item_" data-slide-to="" :class="item-indicator"></li>
<!--                    @endfor-->
                </ol>
                <div class="carousel-inner">
<!--                    @for($i = 0; $i < count(json_decode($item->thumbnail)); $i++)-->
                    <div class="carousel-item @if($i==0) active @endif">
<!--                        <img src="{{json_decode($item->thumbnail)[$i]}}" alt="image for product">-->
                    </div>
<!--                    @endfor-->
                </div>
                <a class="carousel-control-prev" href="#item_" role="button" data-slide="prev">
                    <span class="icon-left-arrow" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#item_" role="button" data-slide="next">
                    <span class="icon-right-arrow" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="item-body">
            <p class="h4 card-title mt-1 pt-3 text-truncate">Test</p>
            <p class="item-text p-0">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor eveniet incidunt ipsa iusto molestias obcaecati officiis praesentium qui sapiente sed. Culpa earum exercitationem, explicabo hic iure nam reprehenderit rerum unde?
            </p>
            <div class="item-price text-right">
                <p class="h5 text-muted"><s>550 zł</s></p>
                <p class="h3">Cena: 100 zł</p>
            </div>
            <div class="row pb-2">
                <div class="col-3 d-flex align-items-center">
<!--                    <fav-add-->
<!--                        :id="{{$item->id}}"-->
<!--                        isfavourite="{{Auth::user()->hasFavourite($item->id)}}"-->
<!--                        store="{{route('favourite.store')}}"-->
<!--                        delete="{{route('favourite.destroy', $item->id)}}"-->
<!--                    >-->
<!--                    </fav-add>-->
                </div>
                <div class="col-9 d-flex justify-content-center align-items-center">
<!--                    <cart-add-->
<!--                        :id="{{$item->id}}"-->
<!--                        cart_url="{{route('cart')}}"-->
<!--                    >-->
<!--                    </cart-add>-->
                    <a href="" class="btn btn-outline-primary w-50">Zobacz więcej</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductCardComponent"
    }
</script>

<style scoped>

</style>
