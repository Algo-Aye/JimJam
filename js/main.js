//nav menu
function myFunction() {
    var element = document.getElementById("myDIV");
    element.classList.toggle("show");
  }
//http://673591573d18cb60cdda.appwrite.global/
// Create a function to send an AJAX GET request
function sendGetRequest(food_id, food) {
  // Create an XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Prepare the URL with the query parameters
  var url = "/Restuarant/addvector.php?food_id=" + encodeURIComponent(food_id) + "&food=" + encodeURIComponent(food);

  // Set up the request
  xhr.open("GET", url, true);

  // Define a callback function to handle the response
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          // Log the response to the console (you can handle it as needed)
          console.log("Response received:", xhr.responseText);
      }
  };

  // Send the request
  xhr.send();
}

