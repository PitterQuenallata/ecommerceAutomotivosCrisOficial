<!-- Quickview Wrapper -->
<div class="modal" id="modal1" data-animation="slideInUp">
    <div class="modal-dialog quickview__main--wrapper">
        <header class="modal-header quickview__header">
            <button class="close-modal quickview__close--btn" aria-label="close modal" data-close>✕ </button>
        </header>

        <div class="quickview__inner">
            <div class="row row-cols-lg-2 row-cols-md-2">
                <div class="col-5">
                    <div class="quickview__gallery align-items-center">

                        <img class="product__media--preview__items--img" src="#" alt="product-media-img" style="width: 100%; max-width: 100%;">

                    </div>
                </div>


                <div class="col-7">
                    <div class="quickview__info">
                        <form action="/cart" method="get">
                            <h2 class="product__details--info__title"></h2>
                            <div class="product__card--price mb-10">
                                <span class="current__price"></span>
                                <span class="old__price"></span>
                            </div>

                            <p class="product__details--info__desc"></p>
                            <p class="marca"></p>
                            <div class="product__variant">
                                <input type="hidden" id="hidden_id_repuesto" value="">
                                <input type="hidden" value="" id="stock_repuesto">

                                <div class="quickview__variant--list quantity d-flex align-items-center mb-10">
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <button class="primary__btn quickview__cart--btn" type="submit">Añadir al carrito</button>
                                </div>

                            </div>

                            <div class="quickview__social d-flex align-items-center pt-5">
                                <label class="quickview__social--title">Compartir:</label>
                                <ul class="quickview__social--wrapper mt-0 d-flex">
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://www.facebook.com">
                                            <i class="fa-brands fa-facebook-f"></i>
                                            <span class="visually-hidden">Facebook</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://twitter.com">
                                            <i class="fab fa-twitter"></i>
                                            <span class="visually-hidden">Twitter</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://www.instagram.com">
                                            <i class="fab fa-instagram"></i>
                                            <span class="visually-hidden">Instagram</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://www.youtube.com">
                                            <i class="fab fa-youtube"></i>
                                            <span class="visually-hidden">YouTube</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quickview Wrapper End -->