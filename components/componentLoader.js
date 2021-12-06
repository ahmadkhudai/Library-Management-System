// // let components =
// // {
// //     navbar: ["main-nav", "components/navbar.html"],
// //     bookCard: ["book-card","components/book-card.html"],
// //     searchBar: ["search-bar", "components/search-bar.html"],
// //     pageBanner: ["page-banner", "components/page-banner.html"],
// //     testEl: ["test-el", "js/components.js"]
// // };

// let componentObjects =
// {
//     navbar: {
//         name: "main-nav",
//         location: "components/navbar.html",
//         functions: {
//             renderSearch: function(){
//                 $("#nav-search button").click(
//                     function(){
//                         $("search-bar").toggleClass("d-none");
//                     }
//                 )
//             }
//         }
//     },
//     bookCard: {
//         name: "book-card",
//         location: "components/book-card.html"
//     },
//     bookCard: {
//         name: "book-card",
//         location: "components/book-card.html"
//     },
//     searchBar: {
//         name: "search-bar",
//         location: "components/search-bar.html"
//     },
//     pageBanner: {
//         name: "page-banner",
//         location: "components/page-banner.html",
//         functions: {
//             setTitle: function(){
//                 let bannerTitle = "RECENT BOOKS";
//                 document.querySelector("page-banner").querySelector("h1").innerText =
//                 document.querySelector("page-banner").title || bannerTitle;
//                }
//             }
//     }
// };

// let componentFunctions =
// {
//     pageBanner: [
//         function(){
//             let bannerTitle = "RECENT BOOKS";

//             document.querySelector("page-banner").querySelector("h1").innerText =
//             document.querySelector("page-banner").title || bannerTitle;
//            }
//     ]
// }

// // Object.entries(components).forEach(objArray =>

// //     {
// //         fetch(objArray[1][1])
// //         .then(stream => stream.text())
// //         .then(text => define(objArray[0], objArray[1][0], text))
// //     }
// // );

//  let classes = {};
// // function define(className, elementName, html){

// //    classes[className] = class extends HTMLElement {
// //         constructor(){
// //             super();

// //             this.innerHTML = html;
// //             if(componentFunctions[className]){
// //                componentFunctions[className].forEach(e=> e());
// //             }

// //         }
// //     };

// //     customElements.define(elementName, classes[className])
// // }

// Object.entries(componentObjects).forEach(objArray =>

//     {
//         let elementClassName = objArray[0];
//         let elementObj = objArray[1];
//         fetch(elementObj.location)
//         .then(stream => stream.text())
//         .then(text => define(elementClassName, elementObj, text))
//     }
// );

// function define(className, element, html){

//     classes[className] = class extends HTMLElement {
//          constructor(){
//              super();

//              this.innerHTML = html;

//          }
//          connectedCallback(){
//             if(element.functions){
//                 for(let task in element.functions){
//                     element.functions[task]();
//                 }
//             }
//              console.log("connected");
//          }
//      };

//      customElements.define(element.name, classes[className])
//  }

// // components.array.forEach(element => {
// //     fetch(element)
// //     .then(stream => stream.text())
// //     .then(text => console.log(text))
// // });
// // fetch("components/navbar.html")
// //     .then(stream => stream.text())
// //     .then(text => console.log(text));

// // function define(html) {
// //     class MainNav extends HTMLElement {

// //         constructor() {
// //             super();
// //             this._value = 0;

// //             this.innerHTML = html;
// //             // var shadow = this.attachShadow({mode: 'open'});
// //             // shadow.innerHTML = html;

// //         }
// //     }

// //     customElements.define('main-nav', MainNav);
// // }
