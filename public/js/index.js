jQuery(function ($) {

  $(document).ready(function () {
    function responsive() {
      $("#mobile-menu-button").click(function (e) {
        e.preventDefault()
        $("body").addClass("has-menu")
      })
      $("#mobile-cross").click(function (e) {
        e.preventDefault()
        $("body").removeClass("has-menu")
      })
      $("#site-cache").click(function (e) {
        e.preventDefault()
        $("body").removeClass("has-menu")
      })
    }
    responsive()
  })
})
/*
var menuMobileMenu = document.getElementById("mobile-menu-button")
var body = document.body
var siteCache = document.getElementById("site-cache")
var closeMenu = document.getElementById("mobile-cross")

menuMobileMenu.addEventListener("click", function (e) {
  e.preventDefault()
  body.classList.toggle("has-menu")
})
if (siteCache !== null) {
  siteCache.addEventListener("click", function (e) {
    e.preventDefault()
    body.classList.remove("has-menu")
  })
}

closeMenu.addEventListener("click", function (e) {
  e.preventDefault()
  body.classList.remove("has-menu")
})

*/