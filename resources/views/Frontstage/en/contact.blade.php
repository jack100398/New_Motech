@extends('Frontstage.en.layouts')
@section('content')
    <div id="app">


        <div class="page-title2">
            <h2 class="tk-century-gothic">CONTACT US</h2>
        </div>

        <div class="contact">
            <div class="wrap">
                <div class="steps" style="color: #fff;">Dear customer</div>
                <p>Thank you very much! If you have any questions or suggestions about our company's products and services, please feel free to let us know by filling out the form below. We will promptly address your concerns and provide you with an answer as soon as possible! (* indicates a required field)</p>
                <div class="form">
                    <form action="javascript:;">
                        <div class="title"><span>*</span>Subject</div>
                        <div class="block"><input v-model="data.title" type="text"></div>
                        <div class="flex-row">
                            <div class="col">
                                <div class="title"><span>*</span>Name</div>
                                <div class="block gender">
                                    <input v-model="data.name" type="text">
                                    <div class="gender-select">
                                        <label class="radio-container">Male
                                            <input v-model="data.sex" type="radio" name="radio1" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input v-model="data.sex" type="radio" name="radio1" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="title"><span>*</span>Phone</div>
                                <div class="block"><input v-model="data.phone" type="text"></div>
                            </div>
                        </div>
                        <div class="title"><span>*</span>Email</div>
                        <div class="block"><input v-model="data.mail" type="email"></div>
                        <div class="title"><span>*</span>Message</div>
                        <div class="block">
                            <textarea v-model="data.text"></textarea>
                        </div>
                        <div class="submit-content">
                            <div class="tips" lang="en">
                                <label class="checkbox-container">I confirm that I have completed the contact information and agree that my electronic representation is as effective as a written representation to your company.
                                    <input v-model="checker" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="g-api">
                                <div class="g-recaptcha" data-sitekey="6Lel4Z4UAAAAAOa8LO1Q9mqKRUiMYl_00o5mXJrR"></div>
                            </div>
                            <button v-on:click="sendContact" class="hover-scale real-btn"
                                style="background-color: black;">submit
                            </button>
                            <button type="submit" class="hover-scale fake-btn"
                                style="background-color: #bfbfbf;">submit</button>
                            <img v-show="is_loading" src="{{ asset('Frontstage/images/loading2.svg') }}" alt="">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="wrap">
            <div class="googlemap">
                <img src="{{ asset('Frontstage/images/google-map.png') }}" alt="">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.325026689142!2d121.57388631524736!3d25.056970543523637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442ab84971d1bed%3A0x483fd6830e15b048!2zMTE05Y-w5YyX5biC5YWn5rmW5Y2A6KGM5ZaE6LevNTjomZ8gNOiZn-S5iyAy!5e0!3m2!1sen-TW!2stw!4v1675441553925!5m2!1sen-TW!2stw"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="company-info">
                <a href="" class="logo"><img src="{{ asset('Frontstage/images/logo.png') }}" alt=""></a>
                <h2>NEWMOTECH CO., LTD.</h2>
                <div class="info">
                    <span>
                        <img src="{{ asset('Frontstage/images/location.svg') }}" alt="">
                        <i>4F.-2, No. 58, Xingshan Rd., Neihu Dist., Taipei City 11469, Taiwan (R.O.C.)</i>
                    </span>
                    <span>
                        <img src="{{ asset('Frontstage/images/phone.svg') }}" alt="">
                        <i>+886-2-8792-3073</i>
                    </span>
                    <span>
                        <img src="{{ asset('Frontstage/images/printer.svg') }}" alt="">
                        <i>+886-2-8792-9997</i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            grecaptcha.ready(function() {
                checkGrecaptcha = function() {
                    var cha_response = grecaptcha.getResponse();
                    if (cha_response.length == 0) {
                        $('.g-recaptcha').show();
                        $('.real-btn').hide();
                        $('.fake-btn').show();
                    } else {
                        $('.g-recaptcha').hide();
                        $('.real-btn').show();
                        $('.fake-btn').hide();
                    }
                };
                checkGrecaptcha();

                var myVar = setInterval(function() {
                    checkGrecaptcha();
                }, 1000);
            });
        });

        const {
            createApp
        } = Vue
        createApp({
            data() {
                return {
                    data: {
                        title: null,
                        name: null,
                        sex: 1,
                        phone: null,
                        mail: null,
                        text: null,
                    },
                    checker: false,
                    is_loading: false
                }
            },
            methods: {
                async sendContact() {
                    if (this.checkConsent()) {
                        this.is_loading = true;
                        await sendApiAjax('post', 'send_mail', this.data)
                            .then(value => {
                                alert('Send success!');
                                window.location.href = window.location.href
                            })
                            .catch(error => {
                                console.log(error.responseJSON.errors);
                                alert('Send failed, please ensure all information is entered or try again later.');
                            });
                        this.is_loading = false;
                    }
                },
                checkConsent() {
                    if (!this.checker) {
                        alert('Tick Consent Form Please');
                    }

                    return this.checker;
                },
            }
        }).mount('#app')
    </script>
@endsection
