
// Check browser support
if (typeof(Storage) !== "undefined") {
    // Store
    localStorage.setItem("open", math);
    // Retrieve
    document.getElementById("p").innerHTML = localStorage.getItem("lastname");
  } else {
    document.getElementById("p").innerHTML = "Sorry, your browser does not support Web Storage...";
  }
  