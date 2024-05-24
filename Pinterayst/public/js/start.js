var profileImage = document.getElementById("profileImg");
var profileUrl = document.getElementById("profileFile");

if (profileImage && profileUrl) {
    profileImage.addEventListener("click", ()=> {
        profileUrl.click();
    });

    profileUrl.addEventListener("change", function (event) {
        var selectedImage = event.target.files[0];

        if (selectedImage && selectedImage.type.startsWith("image/")) {
            let url = URL.createObjectURL(selectedImage);
            profileImage.src = `${url}`;
        }
    });
}

if(profileUrl){
    profileImage.src = `${url}`;
}
