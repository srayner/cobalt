
function FileDragHover(e) {
	    e.stopPropagation();
	    e.preventDefault();
	    e.target.className = (e.type === "dragover" ? "hover" : "");
            console.log('ok');
        }


function FileSelectHandler(e) {

	// cancel event and hover styling
	FileDragHover(e);

	// fetch FileList object
	var files = e.target.files || e.dataTransfer.files;

	// process all File objects
	for (var i = 0, f; f = files[i]; i++) {
		//ParseFile(f);
		UploadFile(f);
	}

}

// upload JPEG files
function UploadFile(file) {
    
    var urlParts = window.location.pathname.split('/');
    var hardwareId = urlParts[urlParts.length -1];

    console.log('upload');
    var xhr = new XMLHttpRequest();
    if (xhr.upload && file.type == "image/jpeg" && file.size <= 300000) {

        // callback
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                var response = JSON.parse(xhr.responseText);
                var src = response.src;
                var imgTag = '<img id="img" width="320" src="' + src + '">';
                $('#img').replaceWith(imgTag);
            }
        };

        // start upload
        xhr.open("POST", '/hardware/uploadimage/' + hardwareId, true);
	xhr.setRequestHeader("X_FILENAME", file.name);
        xhr.setRequestHeader("X_FILETYPE", file.type);
	xhr.send(file);
    }
}

$(document).ready(function() {

    // Sticky tabs
    $('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    $('#tabs').stickyTabs();
    
    // Monitoring checkboxes
    $('input[type=checkbox]').change(function() {

        var id = $(this).val();
        var check = $(this).prop('checked');
        console.log(check);
        var url = '/network-adapter/monitor/' + id;
        data = {
            'id': id,
            'monitor' : check
        };
        $.post(url, data);
    });


    
    
    filedrag = document.getElementById('imgdrop');
    filedrag.addEventListener("dragover", FileDragHover, false);
    filedrag.addEventListener("dragleave", FileDragHover, false);
    filedrag.addEventListener("drop", FileSelectHandler, false);
            
    
});