const fileSelect = document.getElementById("fileSelect");
const fileElem = document.getElementById("fileElem");

fileSelect.addEventListener("click", function () {
    if (!fileElem) {
        return;
    }
    fileElem.click();
});

fileElem.addEventListener("change", function () {
    preview(this);
});

function preview(input) {
    if (!input.files.length) {
        return;
    }

    var fileReader = new FileReader();

    fileReader.onload = function (e) {
        var image = new Image();
        var fileName = document.createElement("span");
        image.src = e.target.result;
        fileName.textContent = input.files[0].name;
        image.classList.add("form__file--image");
        fileName.classList.add("form__file--name");
        fileElem.before(image);
        fileSelect.after(fileName);
    };

    fileReader.readAsDataURL(input.files[0]);
}
