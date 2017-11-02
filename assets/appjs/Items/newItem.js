Dropzone.autoDiscover = false;

var tmbWidth = '250';
var tmbHeight = '250';

var dropZoneOptions = {
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
        var isRemovedSecondFile = false;

        this.on("addedfile", function (file) {

        });
        this.on('maxfilesexceeded', function(file) {
            isRemovedSecondFile = true;
            this.removeFile(file);
            alert("Dopusteno je unos samo jedne slike!");
        });
        this.on('removedfile', function(){
            if(!isRemovedSecondFile)
            {
                $("#item-image").val('');
            }
            isRemovedSecondFile = false;
        });
        this.on('thumbnail', function(file) {
            $('.dz-image').css("width", "250px");
            $('.dz-image').css("height", "250px");
            $('.dz-image img').css("width", "250px");
        });
    }
};

$(document).ready(function() {

    var myDropzone = new Dropzone('#my-awesome-dropzone', dropZoneOptions);

    //--------------
    // Provjerava ako postoji slika nakon neuspjele validacije
    //--------------
    var imageName = $("#item-image").val();
    if(imageName.length > 0)
    {
        var BASE_URL = $("#base_url").text();
        var imageSrc = BASE_URL + "assets/dropzone/uploads/" + imageName;

        // Create the mock file:
        var mockFile = { name: imageName, size: 12345 };

        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);

        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, imageSrc);

        // Make sure that there is no progress bar, etc...
        myDropzone.emit("complete", mockFile);

        // If you use the maxFiles option, make sure you adjust it to the
        // correct amount:
        // var existingFileCount = 1; // The number of files already uploaded
        myDropzone.options.maxFiles = 1;
    }


});
