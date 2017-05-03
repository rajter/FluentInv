$(document).ready(function(){

    // alert("Helo");

    //-----------------------------------------
    //  Dodaje kontakt iz sifrarnika kontakti
    //-----------------------------------------
    $("#btn-add-contact").on("click", function(){
        $("#modal_add_contact").modal("toggle");
    });

    $('#add_contacts_table').on('click', 'tr', function(){
        // alertify.alert("Add contact");
        id = $(this).children().first().html();
        $("#modal_add_contact").modal("toggle");

        data = $(this).children();
        var contact =
        {
            id : data.eq(0).html(),
            name : data.eq(1).html(),
            surname : data.eq(2).html(),
            tel : data.eq(3).html(),
            mob : data.eq(4).html(),
            email : data.eq(5).html()
        };

        // alertify.alert(JSON.stringify(contact));
        var dodajKontakt = function(){
            // Dodajemo kontakt
            $("#company-contacts-list").append(
                "<div class='col-md-3' id='"+"contact-"+contact.id+"'>"+
                "   <div class='box box-solid box-primary'>"+
                "       <div class='box-header with-border'>"+
                "           <h3 class='box-title'><i class='fa fa-user'></i> "+contact.name+" "+contact.surname+"</h3>"+
                "           <div class='box-tools pull-right'>"+
                "               <button class='btn btn-box-tool btn-edit-contact' data-toggle='tooltip' data-placement='bottom' title='Uredi'"+
                "               id='"+contact.id+"'><i class='fa fa-edit'></i></button>"+
                "               <button class='btn btn-box-tool btn-remove-contact' type='button' name='button'"+
                "               data-toggle='tooltip' data-placement='bottom' title='Makni Kontakt' id="+contact.id+">"+
                "               <i class='fa fa-remove'></i></button>"+
                "           </div><!-- /.box-tools -->"+
                "       </div><!-- /.box-header -->"+
                "       <div class='box-body'>"+
                "           <p><strong><i class='fa fa-phone'></i> Tel:</strong>  "+contact.tel+"</p>"+
                "           <p><strong><i class='fa fa-mobile-phone'></i> Mob:</strong>  "+contact.mob+"</p>"+
                "           <p><strong><i class='fa fa-envelope'></i> E-mail:</strong>  "+contact.email+"</p>"+
                "       </div><!-- /.box-body -->"+
                "   </div><!-- /.box -->"+
                "</div><!--col-md-3-->"+
                ""+
                ""
            );
        };

        // Provjeravamo ako je vec dodan isti Kontakt
        if($("#contact-"+contact.id).length > 0)
        {
            alertify.alert("Kontakt <strong>"+ contact.name + " " + contact.surname +"</strong> je već dodan.");
        }
        else
        {
            var BASE_URL = $("#base_url").text();
            var _form = $("#ajaxform").serializeArray();
            var contactData = {name:"contact_id", value:contact.id};
            _form.push(contactData);

            $.ajax({
                type: "POST",
                url: BASE_URL + "index.php/company/addContact",
                data: _form,
                dataType: "text",
                success:
                function(result){
                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        if(obj==="TRUE")
                        {
                            alertify.success('Uspješno dodan kontakt sa id-em: ' + id);
                            dodajKontakt();
                        }
                        else {
                            alertify.error('Došlo je do greške! Nije moguće dodati kontakt sa id-em: ' + id + '.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus + errorThrown);
                }
            });
        }

    });

    //------------------------------------------------------
    //  Mice kontact iz veze s poduzecem, ne brise kontakt
    //------------------------------------------------------
    $('#company-contacts-list').on('click', '.btn-remove-contact', function(){
        var ID = $(this).attr("id");
        boxName = "#contact-"+ID;
        $(boxName).remove();

        var BASE_URL = $("#base_url").text();
        var _form = $("#ajaxform").serializeArray();
        var data = {name:"contact_id", value:ID};
        _form.push(data);

        $.ajax({
            type: "POST",
            url: BASE_URL + "index.php/company/removeContact",
            data: _form,
            dataType: "text",
            success:
            function(result){
                    var obj = JSON.parse(result);                   //parsira text u polje objekata
                    if(obj==="TRUE")
                    {
                        alertify.success('Uspješno uklonjen kontakt sa id-em: ' + ID);
                    }
                    else {
                        alertify.error('Nije moguće uklanjanje kontakta sa id-em: ' + ID + ' jer kontakt s tim id-em ne postoji.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + errorThrown);
            }
        });
        //alert(boxName);
    });

    //---------------------------------------------------------
    //  Kreira novi kontakt u sifrarniku i dodaje ga poduzecu
    //---------------------------------------------------------
    $("#btn-new-contact").on("click", function(){

        // Run this function when the auxiliary button is clicked
        var submitContactForm = function (closeEvent) {
            $("#contactForm").submit();
        };

        var custom = function () {
            if (!alertify.helper) {
                alertify.dialog('helper', function factory() {
                    return {
                        setup: function () {
                            return {
                                buttons: [{
                                    text: 'Spremi',
                                    className: "btn btn-success"
                                }],
                                options: {
                                    modal: false,
                                    resizable: true
                                }
                            };
                        },
                        hooks: {
                            onshow: function() {
                                this.elements.dialog.style.maxWidth = 'none';
                                this.elements.dialog.style.width = '350px';
                                this.elements.dialog.style.height = '550px';
                            }
                        }
                    };
                }, false, 'alert');
            }

            var BASE_URL = $("#base_url").text();
            var TOKEN = $("#token").text();
            var HASH = $("#hash").text();

            var content = "";
            alertify.helper('Novi Kontakt',
            "<form id='contactForm' action='" + BASE_URL + "index.php/company/addNewContact' enctype='multipart/form-data' method='post' accept-charset='utf-8'>"+
            "<input name='"+TOKEN.trim()+"' value='"+HASH.trim()+"' style='display:none;' type='hidden'>"+
            "<div class='col-md-12'>"+
            "   <div class='form-group'>"+
            "       <label for='name'>Ime</label>"+
            "       <div class='input-group'>"+
            "           <div class='input-group-addon'>"+
            "           <i class='fa fa-user'></i>"+
            "           </div>"+
            "           <input class='form-control' name='name' value='' placeholder='Ime' type='text'>"+
            "       </div>"+
            "   </div>"+
            "   <div class='form-group'>"+
            "       <label for='name'>Prezime</label>"+
            "       <div class='input-group'>"+
            "           <div class='input-group-addon'>"+
            "           <i class='fa fa-user'></i>"+
            "           </div>"+
            "           <input class='form-control' name='surname' value='' placeholder='Prezime' type='text'>"+
            "       </div>"+
            "   </div>"+
            "   <div class='form-group'>"+
            "       <label for='name'>Tel</label>"+
            "       <div class='input-group'>"+
            "           <div class='input-group-addon'>"+
            "           <i class='fa fa-phone'></i>"+
            "           </div>"+
            "           <input class='form-control' name='tel' value='' placeholder='Telefon' type='text'>"+
            "       </div>"+
            "   </div>"+
            "   <div class='form-group'>"+
            "       <label for='name'>Mob</label>"+
            "       <div class='input-group'>"+
            "           <div class='input-group-addon'>"+
            "           <i class='fa fa-mobile-phone'></i>"+
            "           </div>"+
            "           <input class='form-control' name='mob' value='' placeholder='Mobitel' type='text'>"+
            "       </div>"+
            "   </div>"+
            "   <div class='form-group'>"+
            "       <label for='name'>E-mail</label>"+
            "       <div class='input-group'>"+
            "           <div class='input-group-addon'>"+
            "           <i class='fa fa-envelope'></i>"+
            "           </div>"+
            "           <input class='form-control' name='email' value='' placeholder='e-mail' type='text'>"+
            "       </div>"+
            "   </div>"+
            "</div>"+
            "</form>",
            submitContactForm);
        };

        custom();
    });

    //---------------------------
    //  Mjenja podatke kontakta
    //---------------------------
    $(".btn-edit-contact").on("click", function(){
        var contactData = "";

        var ID = $(this).attr("id");

        var BASE_URL = $("#base_url").text();
        var _form = $("#ajaxform").serializeArray();
        var data = {name:"contactId", value:ID};
        _form.push(data);

        $.ajax({
            type: "POST",
            url: BASE_URL + "index.php/company/getContactInfo",
            data: _form,
            dataType: "text",
            success:
            function(result){
                    contactData = JSON.parse(result);
                    // alert(contactData.name);

                    // Run this function when the auxiliary button is clicked
                    // And do not close the dialog
                    var submitContactForm = function (closeEvent) {

                        // alertify.notify(contactData.name);
                        // closeEvent.cancel = true;
                        $("#contactForm").submit();
                    };

                    var custom = function () {
                        if (!alertify.helper) {
                            alertify.dialog('helper', function factory() {
                                return {
                                    setup: function () {
                                        return {
                                            buttons: [{
                                                text: 'Spremi',
                                                className: "btn btn-success"
                                            }],
                                            options: {
                                                modal: false,
                                                resizable: true
                                            }
                                        };
                                    },
                                    hooks: {
                                        onshow: function() {
                                            this.elements.dialog.style.maxWidth = 'none';
                                            this.elements.dialog.style.width = '350px';
                                            this.elements.dialog.style.height = '550px';
                                        }
                                    }
                                };
                            }, false, 'alert');
                        }

                        var BASE_URL = $("#base_url").text();
                        var TOKEN = $("#token").text();
                        var HASH = $("#hash").text();

                        var content = "";
                        alertify.helper('Uredi Kontakt',
                        "<form id='contactForm' action='" + BASE_URL + "index.php/company/updateContacts' enctype='multipart/form-data' method='post' accept-charset='utf-8'>"+
                        "<input name='"+TOKEN.trim()+"' value='"+HASH.trim()+"' style='display:none;' type='hidden'>"+
                        "<input name='contact_id' value='"+contactData.id+"' style='display:none;' type='hidden'>"+
                        "<div class='col-md-12'>"+
                        "   <div class='form-group'>"+
                        "       <label for='name'>Ime</label>"+
                        "       <div class='input-group'>"+
                        "           <div class='input-group-addon'>"+
                        "           <i class='fa fa-user'></i>"+
                        "           </div>"+
                        "           <input class='form-control' name='name' value='"+contactData.name+"' placeholder='Ime' type='text'>"+
                        "       </div>"+
                        "   </div>"+
                        "   <div class='form-group'>"+
                        "       <label for='name'>Prezime</label>"+
                        "       <div class='input-group'>"+
                        "           <div class='input-group-addon'>"+
                        "           <i class='fa fa-user'></i>"+
                        "           </div>"+
                        "           <input class='form-control' name='surname' value='"+contactData.surname+"' placeholder='Prezime' type='text'>"+
                        "       </div>"+
                        "   </div>"+
                        "   <div class='form-group'>"+
                        "       <label for='name'>Tel</label>"+
                        "       <div class='input-group'>"+
                        "           <div class='input-group-addon'>"+
                        "           <i class='fa fa-phone'></i>"+
                        "           </div>"+
                        "           <input class='form-control' name='tel' value='"+contactData.tel+"' placeholder='Telefon' type='text'>"+
                        "       </div>"+
                        "   </div>"+
                        "   <div class='form-group'>"+
                        "       <label for='name'>Mob</label>"+
                        "       <div class='input-group'>"+
                        "           <div class='input-group-addon'>"+
                        "           <i class='fa fa-mobile-phone'></i>"+
                        "           </div>"+
                        "           <input class='form-control' name='mob' value='"+contactData.mob+"' placeholder='Mobitel' type='text'>"+
                        "       </div>"+
                        "   </div>"+
                        "   <div class='form-group'>"+
                        "       <label for='name'>E-mail</label>"+
                        "       <div class='input-group'>"+
                        "           <div class='input-group-addon'>"+
                        "           <i class='fa fa-envelope'></i>"+
                        "           </div>"+
                        "           <input class='form-control' name='email' value='"+contactData.email+"' placeholder='e-mail' type='text'>"+
                        "       </div>"+
                        "   </div>"+
                        "</div>"+
                        "</form>",
                        submitContactForm);
                    };

                    custom();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + errorThrown);
            }
        });



    }); // END



});
