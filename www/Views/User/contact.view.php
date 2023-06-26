<form action="/validContact" method="POST" id="contact-form">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="contact__input">
                <label>Nom <span class="required">*</span></label>
                <input class="form-control" name="name" type="text" placeholder="Veuillez saisir votre nom" data-sb-validations="required" />
                <div class="invalid-feedback" data-sb-feedback="name:required">Veuillez saisir votre nom</div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="contact__input">
                <label>Email <span class="required">*</span></label>
                <input class="form-control" name="email" type="email" placeholder="Veuillez saisir votre adresse" data-sb-validations="required, email" />
                <div class="invalid-feedback" data-sb-feedback="email:required">Veuillez saisir votre email</div>
                <div class="invalid-feedback" data-sb-feedback="email:email">Veuillez saisir un email valide</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="contact__input">
                <label>Sujet <span class="required">*</span></label>
                <input class="form-control" name="subject" type="text" placeholder="Veuillez saisir le sujet" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="subject:required">Veuillez saisir le sujet</div>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="contact__input">
                <label>Message</label>
                <textarea class="form-control" name="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
                <div class="invalid-feedback" data-sb-feedback="message:required">Veuillez saisir votre message</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="contact__submit">
                <button type="submit" class="os-btn os-btn-black">Envoyez votre Message</button>
            </div>
        </div>
    </div>
</form>