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
        accept: function(file, done) {
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

});
