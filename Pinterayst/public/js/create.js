var createImage = document.getElementById("createImg");
var createUrl = document.getElementById("createFile");

if (createImage && createUrl) {
    createImage.addEventListener("click", ()=> {
        createUrl.click();
    });

    createUrl.addEventListener("change", function (event) {
        var selectedImage = event.target.files[0];

        if (selectedImage && selectedImage.type.startsWith("image/")) {
            let url = URL.createObjectURL(selectedImage);
            createImage.src = `${url}`;
        }
    });
}

if(createUrl){
    createImage.src = `${url}`;
}
