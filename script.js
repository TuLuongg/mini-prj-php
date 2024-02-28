document
  .getElementById("createForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission
    var name = document.getElementsByName("name")[0].value;

    // Send AJAX request to handle CRUD operation (not implemented in this example)
  });
