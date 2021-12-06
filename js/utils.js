// function insertAfter(referenceNode, newNode) {
//     referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
//   }

// //   // Get the input box
// // let input = document.getElementById('my-input');

// // // Init a timeout variable to be used below
// // let timeout = null;

// // // Listen for keystroke events
// // if(input !==null){input.addEventListener('keyup', function (e) {
// //     // Clear the timeout if it has already been set.
// //     // This will prevent the previous task from executing
// //     // if it has been less than <MILLISECONDS>
// //     clearTimeout(timeout);

// //     // Make a new timeout set to go off in 1000ms (1 second)
// //     timeout = setTimeout(function () {
// //         console.log('Input Value:', textInput.value);
// //     }, 1000);
// // });}

// async function postData(url = "", data = {}) {
//   // Default options are marked with *
//   const response = await fetch(url, {
//     method: "POST", // *GET, POST, PUT, DELETE, etc.
//     mode: "cors", // no-cors, *cors, same-origin
//     cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
//     credentials: "same-origin", // include, *same-origin, omit
//     headers: {
//       "Content-Type": "application/json",
//       // 'Content-Type': 'application/x-www-form-urlencoded',
//     },
//     redirect: "follow", // manual, *follow, error
//     referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
//     body: JSON.stringify(data), // body data type must match "Content-Type" header
//   });
//   return response.json(); // parses JSON response into native JavaScript objects
// }