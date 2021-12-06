// $("#search-area").click(function () {
//     console.log("clicked");
//   });

// console.log("helo");

// -----------------------------------------UTILITY FUNCTIONS
function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

//   // Get the input box
// let input = document.getElementById('my-input');

// // Init a timeout variable to be used below
// let timeout = null;

// // Listen for keystroke events
// if(input !==null){input.addEventListener('keyup', function (e) {
//     // Clear the timeout if it has already been set.
//     // This will prevent the previous task from executing
//     // if it has been less than <MILLISECONDS>
//     clearTimeout(timeout);

//     // Make a new timeout set to go off in 1000ms (1 second)
//     timeout = setTimeout(function () {
//         console.log('Input Value:', textInput.value);
//     }, 1000);
// });}

async function postData(url = "", data = {}) {
  // Default options are marked with *
  const response = await fetch(url, {
    method: "POST", // *GET, POST, PUT, DELETE, etc.
    mode: "cors", // no-cors, *cors, same-origin
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    credentials: "same-origin", // include, *same-origin, omit
    headers: {
      "Content-Type": "application/json",
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: "follow", // manual, *follow, error
    referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: JSON.stringify(data), // body data type must match "Content-Type" header
  });
  return response.json(); // parses JSON response into native JavaScript objects
}

$(document).ready(function () {
  //add listeners

  console.log("hi");
  $("#nav-search button").click(function () {
    if (document.getElementById("search-bar") != null) {
      $("#search-bar").toggleClass("d-none");
    } else {
      insertSearchBar();
      refreshSuggestion();

      let currentSearchAreaPos = document
        .getElementById("search-area")
        .getBoundingClientRect();
      jQuery.fn.onPositionChanged = function (trigger, millis) {
        if (millis == null) millis = 100;
        var o = $(this[0]); // our jquery object
        if (o.length < 1) return o;

        var lastPos = null;
        var lastOff = null;
        setInterval(function () {
          if (o == null || o.length < 1) return o; // abort if element is non existend eny more
          if (lastPos == null) lastPos = o.position();
          if (lastOff == null) lastOff = o.offset();
          var newPos = o.position();
          var newOff = o.offset();
          if (lastPos.top != newPos.top || lastPos.left != newPos.left) {
            $(this).trigger("onPositionChanged", {
              lastPos: lastPos,
              newPos: newPos,
            });
            if (typeof trigger == "function") trigger(lastPos, newPos);
            lastPos = o.position();
          }
          if (lastOff.top != newOff.top || lastOff.left != newOff.left) {
            $(this).trigger("onOffsetChanged", {
              lastOff: lastOff,
              newOff: newOff,
            });
            if (typeof trigger == "function") trigger(lastOff, newOff);
            lastOff = o.offset();
          }
        }, millis);

        return o;
      };

      $("#search-area").onPositionChanged(function () {
        refreshSuggestion();
      });

      // $("#search-area").offset(function () {
      //   console.log("sup");
      // });

      // $("#search-area").on("click", function () {
      //   console.log("here");
      //   refreshSuggestion();
      //   $("#search-suggestion").toggleClass("d-block").focus();
      // });
      // $("#search-suggestion").on("blur", function () {
      //   console.log("dkfjdsl");
      //   $(this).removeClass("d-block");
      // });

      // Get the input box
      let input = document.getElementById("search-area");

      // Init a timeout variable to be used below
      let timeout = null;
      let mytimeout = null;

      // Listen for keystroke events
      if (input !== null) {
        input.addEventListener("keyup", function (e) {
          $("#search-suggestion").removeClass("d-block");
          // Clear the timeout if it has already been set.
          // This will prevent the previous task from executing
          // if it has been less than <MILLISECONDS>
          clearTimeout(mytimeout);
          clearTimeout(timeout);

          // Make a new timeout set to go off in 1000ms (1 second)
          timeout = setTimeout(function () {
            if (input.value.length <= 2) {
              clearTimeout(timeout);
              return;
            }
            refreshSuggestion();
            $("#search-suggestion").addClass("d-block").focus();
            let inVal = input.value;
            console.log("Searching for:" + inVal);

            getRes(inVal);

            clearTimeout(mytimeout);
            resetFocusTimeout();

            // searchSuggest(inVal);
          }, 350);
        });
      }

      function resetFocusTimeout() {
        clearTimeout(mytimeout);

        mytimeout = setTimeout(() => {
          $("#search-suggestion").removeClass("d-block");
        }, 2500);
      }

      // $("#search-suggestion").ho

      $("#search-suggestion").focus(function () {
        // resetFocusTimeout();
        clearTimeout(mytimeout);
      });

      $("#search-suggestion").scroll(function () {
        resetFocusTimeout();
        // clearTimeout(mytimeout);
      });

      $("#search-suggestion").mouseover(function () {
        // resetFocusTimeout();
        clearTimeout(mytimeout);
        // $(this).css("background-color", "rgb(242, 242, 0)");
      });

      $("#search-suggestion").click(function () {
        // resetFocusTimeout();
        clearTimeout(mytimeout);
        // $(this).css("background-color", "rgb(242, 242, 0)");
      });

      $("#search-suggestion").blur(function () {
        // $(this).css("background-color", "white");
        resetFocusTimeout();
      });

      $("#search-suggestion").focusout(function () {
        console.log("focus out!");
        // $(this).css("background-color", "white");
        resetFocusTimeout();
      });

      $("#search-suggestion").mouseleave(function () {
        // $(this).css("background-color", "white");
        resetFocusTimeout();
      });

      $(document).on("click", function (event) {
        var $trigger = $("#search-suggestion");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
          clearTimeout(mytimeout);
          $("#search-suggestion").removeClass("d-block");
        }
      });

      function refreshSuggestion() {
        let searchSuggest = document.getElementById("search-suggestion");
        let searchArea = document.getElementById("search-area");

        searchSuggest.clientWidth = searchArea.clientWidth;
        // searchSuggest.offsetTop = searchArea.getBoundingClientRect

        // searchSuggest.querySelector("img").width = 100;

        if (
          Math.abs(parseInt(searchSuggest.offsetLeft) - searchArea.offsetLeft) >
          10
        ) {
          searchSuggest.style.left = searchArea.offsetLeft + "px";
          searchSuggest.style.top =
            searchArea.offsetTop + searchArea.offsetHeight + "px";
          searchSuggest.style.width = searchArea.offsetWidth + "px";
          // console.log("RESIZED!");
        } else {
          // console.log("NOT RESIZING!");
        }
      }

      // document.getElementById("search-area").addEventListener("keyup", () => {
      //   console.log(this);
      // });

      // function searchSuggest(str) {
      //   if (str.length < 2) {
      //     $("#search-suggestion").removeClass("d-block");
      //   }

      //   return;

      //   let sReq = new XMLHttpRequest();
      //   console.log(str);
      //   sReq.open("GET", "searchSuggest.php?search=" + str);
      //   sReq.send();

      //   sReq.onreadystatechange = function () {
      //     if (sReq.readyState == 4 && sReq.status == 200) {
      //       document.getElementById("search-suggest").innerHTML = sReq.responseText;
      //       document.getElementById("search-suggest").style.border =
      //         "1px solid green";
      //     }
      //   };
      // }

      async function getRes(str) {
        // event.preventDefault();
        if (str.length < 2) {
          $("#search-suggestion").removeClass("d-block");
        }
        postData("./api/searchSuggest.php", str).then((data) => {
          populateSuggestion(data);
        });
        // console.log(event);
      }

      function populateSuggestion(data) {
        let suggestionBox = document.getElementById("search-suggestion");
        // if (data=) {

        //   return;
        // }
        suggestionBox.innerHTML = "";
        if (data === "error") {
          return;
        }

        // console.log(data[0][1]);
        for (let prop in data) {
          let newSuggestion = document.createElement("div");
          newSuggestion.classList.add(
            "search-suggestion-item",
            "row",
            "m-1",
            "p-2"
          );
          newSuggestion.innerHTML = getSuggestionTemplate(
            data[prop][1],
            data[prop][2],
            data[prop][3],
            data[prop][3]
          );
          suggestionBox.append(newSuggestion);

          // console.log(prop, data[prop][1]);
        }

        //1 title
        //2 author
        //3 isbn
        //4 publisher
        //5 amount
        // console.log(data);
      }

      function getSuggestionTemplate(title, author, img, isbn) {
        if (title.length > 20) {
          title =
            title.substring(0, 20) +
            "..." +
            title.substring(title.length - 10, title.length);
        }

        return `
      <figure class="col-12 col-sm-3 col-md-4">
        <img src=${
          img === isbn
            ? "http://covers.openlibrary.org/b/isbn/" +
              isbn +
              "-M.jpg?default=false"
            : img
        } onerror="this.onerror=null;this.src='https://picsum.photos/100/160';" alt="Book Cover" />
      </figure>
      <div class="item-info col-12 col-sm-6 col-md-5 text-left">
        <p class="title  ">${title}</p>
        <p class="text-center text-sm-left">${author}</p>
      </div>
      <a
        href="./bookView.php?current-book=${isbn}"
        class="col-12 col-sm-3"
      >
        <p>VIEW</p>
        <p>-></p>
      </a>
  `;
      }
    }
  });
  // let searchBar =$("#search-bar");
  // searchBar.click(function(){
  //     console.log("herere");
  // })
  // let bannerTitle = "RECENT BOOKS";

  // console.log(document.title);

  // document.querySelector("page-banner h1").innerText =
  // document.querySelector("page-banner").title || bannerTitle;

  //-------------------------------------------------------------------USER OPTIONS
  let nameEditButton = document.getElementById("edit-name-button");
  let nameEmailButton = document.getElementById("edit-email-button");
  let namePassButton = document.getElementById("edit-password-button");

  let formParentPane = "edit-pane";
  if (document.getElementById(formParentPane) !== null) {
    $("#edit-name-button").click(() => {
      $("#" + formParentPane + "-button").addClass("disabled");
      takeButtonOut(formParentPane);
      editAttribs("edit-name", "edit-email", "edit-password");
    });
    $("#edit-email-button").click(() => {
      $("#" + formParentPane + "-button").addClass("disabled");
      takeButtonOut(formParentPane);
      editAttribs("edit-email", "edit-name", "edit-password");
    });
    $("#edit-password-button").click(() => {
      $("#" + formParentPane + "-button").addClass("disabled");
      takeButtonOut(formParentPane);
      editAttribs("edit-password", "edit-email", "edit-name");
    });

    function editAttribs(attribID, otherID1, otherID2) {
      $("#" + attribID + "-button").removeClass("ak-red-bkg");
      $("#" + otherID1 + "-button").addClass("ak-red-bkg");
      $("#" + otherID2 + "-button").addClass("ak-red-bkg");

      // console.log(document.getElementById(attribID).value);
      $("#" + attribID).removeClass("d-none");
      $("#" + attribID + "-label").removeClass("d-none");
      $("#" + attribID).addClass("enabled");

      $("#" + otherID1).addClass("d-none");
      document.getElementById(otherID1).value = null;
      $("#" + otherID1).removeClass("enabled");
      $("#" + otherID2).addClass("d-none");
      document.getElementById(otherID2).value = null;
      $("#" + otherID2).removeClass("enabled");

      $("#" + otherID1 + "-label").addClass("d-none");
      $("#" + otherID2 + "-label").addClass("d-none");
    }

    // USER ADDITION
    // if(document.getElementById("add-user"))
  }

  //----------------- CREATE BOOK

  let createBookPanel = "create-book-panel";

  $("#" + createBookPanel).on("keyup", function () {
    checkFormValidation(createBookPanel);
    refreshImage(createBookPanel);
  });

  $("#" + createBookPanel).on("click", function () {
    checkFormValidation(createBookPanel);
    refreshImage(createBookPanel);
  });

  // $("#"+createBookPanel).click( function(){
  //     checkFormValidation(createBookPanel);
  // })
});

let borrowButton = $("#borrow-btn");
let reserveButton = $("#reserve-btn");
let cancelButton = $("#cancel-btn");
let returnButton = $("#return-btn");

function borrowBook() {
  borrowButton.toggleClass("d-none");
  reserveButton.addClass("d-none");
  returnButton.toggleClass("d-none");
  cancelButton.addClass("d-none");
}

function reserveBook() {
  cancelButton.toggleClass("d-none");
  reserveButton.toggleClass("d-none");
}

function resetButtons() {
  borrowButton.removeClass("d-none");
  reserveButton.removeClass("d-none");
  returnButton.addClass("d-none");
  cancelButton.addClass("d-none");
}

// function hideLogin() {
//     $("#login-panel").toggleClass("d-none");
//     $("#signup-panel").toggleClass("d-none");
// }

function hideOther() {
  $("#login-panel").toggleClass("d-none");
  $("#signup-panel").toggleClass("d-none");
}

//VALIDATION
const patterns = {
  telephone: /^[0-9]{11}$/,
  username: /^[a-zA-Z ]{2,30}$/i,
  password: /^[a-zA-Z0-9@-]{3,20}$/i,
  "login-pass": /^[a-z0-9@-]{3,20}$/i,
  "signup-pass": /^[a-z0-9@-]{3,20}$/i,
  slug: /^[a-z0-9-]{8,20}$/,
  email: /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
  "login-email": /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
  "signup-email": /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
  isbn13: /^(97(8|9))?\d{9}(\d|X)$/,
  base: /^[a-zA-Z0-9- ]{2,}$/,
  baseNum: /^[1-9]{1,}$/,
  publisher: /^[a-zA-Z0-9. ]{2,30}$/,
  author: /^[a-zA-Z0-9,. ]{2,150}$/i,
  title: /^[a-zA-Z,. ]{2,150}$/i,
};

function validate(field) {
  let fieldName = field.name;

  // console.log(patterns[fieldName]);
  console.log(field.type);
  if (typeof patterns[fieldName] === "undefined") {
    if (field.type === "number") {
      fieldName = "baseNum";
    } else {
      fieldName = "base";
    }
  }

  if (patterns[fieldName].test(field.value)) {
    field.classList.remove("is-invalid");
    field.classList.add("is-valid");
    return true;
  } else {
    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
    return false;
  }
}

function checkFormValidation(form_PARENT_ID, specificClass = "") {
  // console.log(formID);
  let allValidated = true;
  $("#" + form_PARENT_ID + " input" + specificClass).each(function (el) {
    if (!validate(this)) {
      allValidated = false;
    }
  });
  if (!allValidated) {
    console.log("NOT VALID!");
    // console.log("here")
    let button = document.getElementById(form_PARENT_ID + "-button");
    button.classList.add("disabled");
    takeButtonOut(form_PARENT_ID);
    // this.click(e=> e.preventDefault());
    // this.toggleClass("btn");

    // $("#"+form_PARENT_ID+" form button").click(e=>e.preventDefault());
  } else {
    console.log("YESSS!");
    putButtonInform(form_PARENT_ID);
    let button = document.getElementById(form_PARENT_ID + "-button");
    button.classList.remove("disabled");
  }
}

function putButtonInform(form_PARENT_ID) {
  let formEl = document.querySelector("#" + form_PARENT_ID + " form");
  let button = document.getElementById(form_PARENT_ID + "-button");
  formEl.appendChild(button);
}

function takeButtonOut(form_PARENT_ID) {
  // let formParent = document.getElementById(form_PARENT_ID);
  let formEl = document.querySelector("#" + form_PARENT_ID + " form");
  let button = document.getElementById(form_PARENT_ID + "-button");
  // formEl.appendChild(button);
  insertAfter(formEl, button);
}

let allowedForms = [document.querySelector("#search-bar form")];

$(document).ready(function () {
  $("form").keydown(function (event) {
    if (event.keyCode == 13) {
      if (!allowedForms.includes(this)) {
        event.preventDefault();
        return false;
      }
    }
  });
});

// ---------------------
function refreshImage(form_PARENT_ID) {
  let isbn13 = document.getElementById("isbn13");
  let img = document.getElementById("book-cover");
  if ($("#isbn13").hasClass("is-valid")) {
    img.src = `http://covers.openlibrary.org/b/isbn/${isbn13.value}-M.jpg?default=false`;
  } else {
    img.src = "https://picsum.photos/180/288";
    img.onerror = "this.onerror=null;this.src='https://picsum.photos/180/288';";
  }
}

// function validationFunction(formID) {
//     good=false;
//     $('#'+formID + ' input').each(
//     function(this) {
//       console.log(this);

//     })

//   }

// //   $(document).ready(function() {
// //     $(window).keydown(function(event){
// //       if( (event.keyCode == 13) && (validationFunction() == false) ) {
// //         event.preventDefault();
// //         return false;
// //       }
// //     });
// //   });

//-----------------------------------------------SEARCH BAR JS

//-----------------------------------------TEMPLATES

//--------------------------------------SEARCH BAR TEMPLATE

let searchBarInnerHTML = `<form
action="./search.php"
method="get"
class="row mx-auto pt-3 pb-3 align-content-center justify-content-center"
>
<h2 class="col-10 col-md-3 my-2 my-md-0 text-center">SEARCH</h2>
<input
  class="col-10 col-md-7 py-2 py-md-0 text-center"
  type="text"
  placeholder="Type something here..."
  name="search-area"
  id="search-area"
  autocomplete="off"
/>

<div id="search-suggestion" class="position-absolute text-center"></div>
<input type="submit" value="" />
<button class="pr-4 pl-4 my-2 my-md-0 text-center col-10 col-md-2">
  <i class="fa fa-search"></i>
</button>
</form>
`;

function insertSearchBar() {
  let searchBar = document.createElement("div");
  searchBar.id = "search-bar";
  searchBar.classList.add("mx-auto");
  searchBar.innerHTML = searchBarInnerHTML;
  let mainNav = document.getElementById("main-nav");
  if (mainNav == null) {
    return;
  }

  insertAfter(mainNav, searchBar);
}
