function filePreview(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#img-new").attr("src",e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#img-super").change(function () {
    filePreview(this);
});