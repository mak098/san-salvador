"use strict";
var $;
(function () {
    var handler = document.querySelector("#menuHandler");
    var menu = document.querySelector("#menu");
    handler &&
        handler.addEventListener("click", function () {
            $("#menuContainer").css("padding", "15px");
            $(menu).slideToggle();
        });
})();
/**
 * All these lines bellow concern menu humberger
 */
var toggleButton = document.getElementById("toggle-button");
if (toggleButton) {
    var iconButton_1 = toggleButton.querySelector(".fas");
    var navbar_1 = document.getElementById("navbar");
    toggleButton.addEventListener("click", function () {
        navbar_1 && navbar_1.classList.toggle("hidden");
        if (iconButton_1)
            if (iconButton_1.classList.contains("fa-bars")) {
                iconButton_1.classList.remove("fa-bars");
                iconButton_1.classList.add("fa-times");
            }
            else {
                iconButton_1.classList.remove("fa-times");
                iconButton_1.classList.add("fa-bars");
            }
    });
}
//End of menu humberger code
/**
 * This function handles the admin time each minutes.
 */
var timeHandler = function () {
    var time = new Date;
    var adminTimer = document.querySelector("#adminTimer");
    if (adminTimer) {
        adminTimer.textContent = time.getHours() + " : " + time.getMinutes();
    }
};
$(document).ready(function () {
    setInterval(function () { return timeHandler(); }, 10000);
    $("#hamburger").on("click", function () {
        $("#other").slideUp("slow");
        $("#mobile").slideDown("slow");
    });
    $("#times").on("click", function () {
        $("#mobile").slideUp("slow");
        $("#other").slideDown("slow");
    });
    $("#year").text(new Date().getFullYear().toString());
});
/**
 * Initializing cropper class
 */
var cropper = new Cropper({
    width: 320,
    height: 320,
    onChange: function () {
        var image = this.getCroppedImage();
        var file = dataURLtoFile(image, "test");
    },
});
/**
 * Covert base64 data image to Javascript object File
 * @param dataUrl
 * @param filename
 * @returns {File | undefined}
 */
function dataURLtoFile(dataUrl, filename) {
    var array = dataUrl.split(",");
    if (array !== null) {
        var matchExtension = array[0].match(/data:(.*);/);
        var matchMimeType = array[0].match(/:(.*?);/);
        var extension = void 0;
        var mime = void 0;
        if (matchExtension !== null) {
            extension = matchExtension[1].split("/")[1];
            if (matchMimeType !== null) {
                mime = matchMimeType[1];
                var bstr = atob(array[1]);
                var n = bstr.length;
                var u8array = new Uint8Array(n);
                while (n--) {
                    u8array[n] = bstr.charCodeAt(n);
                }
                return new File([u8array], filename + "." + extension, { type: mime });
            }
        }
    }
}
var imageUploader = document.querySelector("#image");
imageUploader !== null && imageUploader.addEventListener("change", function (evt) {
    if (evt.target !== null) {
        var target = evt.target;
        var image = target.files[0];
    }
});
cropper.render("#crop");
//Add user interactions stars here
var formStepsButtons = document.querySelectorAll(".form-user-btn");
formStepsButtons && formStepsButtons.forEach(function (button) {
    var buttonName = button.name;
    $(button).on("click", function (e) {
        e.preventDefault();
        useFormButtons(buttonName);
    });
    function useFormButtons(name) {
        switch (name) {
            case "2":
                $(".form-1").slideUp();
                $(".form-2").slideDown();
                $(".form-3").slideUp();
                break;
            case "-2":
                $(".form-1").slideDown();
                $(".form-2").slideUp();
                $(".form-3").slideUp();
                break;
        }
    }
});
