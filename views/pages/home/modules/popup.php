        <!-- PopUP Suscripcion Newsletter -->
        <!-- <div id="subscribe-popup" class="container subscribe-popup contact-form-style-01 position-relative text-center xs-p-0 mfp-hide"> -->
            <!-- start contact form -->
            <div class="row g-0 position-relative">
                <div class="col-lg-5 cover-background md-h-600px xs-h-400px" style="background-image:url('<?php echo $path ?>/views/assets/images/mercado.jpeg');"></div>
                <div class="col-lg-7">
                    <div class="p-14 xl-p-11 bg-white">
                        <!-- <span class="mb-5px d-block"></span> -->
                        <h3 class="d-inline-block alt-font fw-600 text-dark-gray mb-8 ls-minus-1px">¿Cómo podemos ayudarte?</h3>
                        <form action="email-templates/contact-form.php" method="post">
                            <div class="position-relative form-group mb-15px">
                                <span class="form-icon"><i class="bi bi-emoji-smile"></i></span>
                                <input type="text" name="name" class="form-control required" placeholder="Ingresa tu nombre*" />
                            </div>
                            <div class="position-relative form-group mb-15px">
                                <span class="form-icon"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control required" placeholder="Ingresa tu email*" />
                            </div>
                            <div class="position-relative form-group mb-15px">
                                <span class="form-icon"><i class="bi bi-telephone-outbound"></i></span>
                                <input type="tel" name="phone" class="form-control" placeholder="Ingresa tu celular" />
                            </div>
                            <div class="position-relative form-group form-textarea">
                                <span class="form-icon"><i class="bi bi-chat-square-dots"></i></span>
                                <textarea placeholder="Escribí tu mensaje..." name="comment" class="form-control" rows="3"></textarea>
                                <input type="hidden" name="redirect" value="">
                                <button class="btn btn-medium btn-box-shadow btn-round-edge w-100 btn-base-color submit mt-15px" type="submit">Enviar Mensaje</button>
                                <div class="form-results mt-20px d-none"></div>
                            </div>
                        </form>
                        <label for="newsletter-off" class="fs-15 mt-15px"><input class="w-auto me-10px position-relative top-1px p-0" type="checkbox" id="newsletter-off" name="newsletter-off">No mostrar de nuevo</label>
                    </div>
                </div>
                <button title="Close (Esc)" type="button" class="mfp-close text-dark-gray"></button>
            </div>
            <!-- end contact form -->
        <!-- </div>  -->
        <!-- end subscription popup -->