<section id="breadcrumb">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<section id="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 gotham-medium fsize-2 pbottom3 text-center">
                CONTACT US
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="gotham-medium title-contact-us">
                        DROP YOUR INQUIRIES HERE
                    </div>
                    <div class="form-inquiries myprofile customer-info">
                        <form method="post" action="contact/sendinquiries">
                            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-left: 0px; padding-bottom: 4%;">
                                NAME
                            </div>
                            <div class="col-lg-9" style="padding-right: 0px; padding-left: 0px; padding-bottom: 4%;">
                                <input id="fname" class="email" type="text" name="name" placeholder="Name">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-left: 0px; padding-bottom: 4%;">
                                EMAIL
                            </div>
                            <div class="col-lg-9" style="padding-right: 0px; padding-left: 0px; padding-bottom: 4%;">
                                <input id="fname" class="email" type="text" name="email" placeholder="Email">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-left: 0px; padding-bottom: 4%;">
                                SUBJECT
                            </div>
                            <div class="col-lg-9" style="padding-right: 0px; padding-left: 0px; padding-bottom: 4%;">
                                <input id="fname" class="email" type="text" name="subject" placeholder="Subject">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-left: 0px; padding-bottom: 4%;">
                                MESSAGE
                            </div>
                            <div class="col-lg-9" style="padding-right: 0px; padding-left: 0px; padding-bottom: 4%;">
                                <textarea name="message" class="email" style="width: 100%" rows="5"></textarea>
                                <br/>
                                <b>Your inquiries has been sent!</b>
                            </div>
                            <div class="col-lg-12" style="padding-right: 0px;">
                                <div class="pull-right">
                                    <a class="edit" onclick="submit()">SAVE</a>
                                    <button id="btn-submit" style="display: none;">save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="gotham-medium title-contact-us">
                        CUSTOMER & AFTER SALES SERVICE
                    </div>
                    <div class="form-inquiries myprofile customer-info" style="margin-bottom: 10%;">
                        <table>
                            <tr>
                                <td width="2%" style="padding-bottom: 1%;">CALL</td>
                                <td width="1%" style="padding-bottom: 1%;">:</td>
                                <td width="10%" style="padding-bottom: 1%;">+62 813 68001010</td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 1%;">HOUR</td>
                                <td style="padding-bottom: 1%;">:</td>
                                <td style="padding-bottom: 1%;">9AM-5PM (+7 GMT)</td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 1%;">EMAIL</td>
                                <td style="padding-bottom: 1%;">:</td>
                            <td style="padding-bottom: 1%;">CS@THEWATCH.CO</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td style="padding-bottom: 1%;">AFTERSALES@THEWATCH.CO</td>
                        </tr>
                    </table>
                </div>

                <div class="gotham-medium title-contact-us">
                    LINE
                </div>
                <div class="form-inquiries myprofile customer-info">
                    LINE ID : @thewatchco<br/>
                    (please include the '@' symbol)<br/>

                    <img src='../img/logos/qrline.jpg' width='25%' style='margin-top: 2%;'/>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<style>
    .title-contact-us{
        font-style: bold;
        border-bottom: 2px solid black;
        padding-bottom: 3%;
        margin-bottom: 5%;
    }

    .input-inquiries{

    }

</style>

<script>
    function submit() {
        $('#btn-submit').click();
    }
</script>