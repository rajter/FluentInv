$(document).ready(function() {
    //alert("Hello");
    var tmbWidth = '250';
    var tmbHeight = '250';

    // "myAwesomeDropzone" is the camelized version of the HTML element's ID
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        addRemoveLinks: true,
        maxFilesize: 2, // MB
        maxFiles: 1,
        thumbnailWidth: tmbWidth,
        thumbnailHeight: tmbHeight,
        accept: function(file, done) {    // Ako je slika uspjesno uvezena postavi hiden input na ime slike
            $("#item-image").val(file.name);
            done();
        },
        init: function() {
            this.on('maxfilesexceeded', function(file) {
                this.removeFile(file);
                alert("Dopusteno je unos samo jedne slike!");
            });
            this.on('removedfile', function(){
                $("#item-image").val('');
            });
            this.on('thumbnail', function(file) {
                $('.dz-image').css("width", "250px");
                $('.dz-image').css("height", "250px");
            });
        }
    };

    // Ako nema slike sakrije DROPZONE
    if($("#image").length)
    {
        $("#my-awesome-dropzone").hide();
    }

    // Kod promjene slike sakrij postojecu sliku i btn-image-change
    // te prikazi DROPZONE
    $("#btn-change-image").click(function(){
        // alertify.success("change");
        var itemImage = $("#image");
        itemImage.hide();
        $(this).hide();

        $("#my-awesome-dropzone").show();
        var attr = $("#my-awesome-dropzone").attr("class");
        $("#my-awesome-dropzone").attr("class", attr+" text-center"); // Nuzno da bi poravnalo sliku u sredinu jer makne text-center iz atributa class

        $("#btn-abort-image-upload").show();
    });

    // Gumb za prekid uploadanja nove slike
    // vraca sve u pocetno stanje
    $("#btn-abort-image-upload").click(function(){
         $("#image").show();
         $("#btn-change-image").show();
         $("#my-awesome-dropzone").hide();
         $(this).hide();
    });

    // Kod loadanja stranice sakrije gumb za prekid uploadanja nove slike
    $("#btn-abort-image-upload").hide();

});
