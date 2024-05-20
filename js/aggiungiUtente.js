function changeUploadFile() {
  let istruttore = $("#tipo").val() === "istruttore";
  $("#img-upload").attr("type", istruttore ? "file" : "hidden");
}

$("#tipo").on("change", changeUploadFile);

changeUploadFile();
