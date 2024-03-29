
var $: any;
((): void => {
  const handler: HTMLElement | null = document.querySelector("#menuHandler");
  const menu: HTMLDivElement | null = document.querySelector("#menu");
  handler &&
      handler.addEventListener("click", (): void => {
        $("#menuContainer").css("padding", "15px")
        $(menu).slideToggle()

    });
})()

/**
 * All these lines bellow concern menu humberger
 */
const toggleButton: Element | null = document.getElementById("toggle-button");
if (toggleButton) {
  const iconButton: Element | null = toggleButton.querySelector(".fas");
  const navbar : Element | null = document.getElementById("navbar");

toggleButton.addEventListener("click", () => {
  navbar && navbar.classList.toggle("hidden");
  if (iconButton)
    if (iconButton.classList.contains("fa-bars")) {
      iconButton.classList.remove("fa-bars");
      iconButton.classList.add("fa-times");
    } else {
      iconButton.classList.remove("fa-times");
      iconButton.classList.add("fa-bars");
    }
});
}
//End of menu humberger code
/**
 * This function handles the admin time each minutes.
 */
const timeHandler = (): void => {
  const time: Date = new Date
  const adminTimer: Element | null = document.querySelector("#adminTimer");
  if (adminTimer) {
      adminTimer.textContent = `${time.getHours()} : ${time.getMinutes()}`;
  }
}
$(document).ready(() => {
  setInterval(() => timeHandler(), 10000);
     $("#hamburger").on("click", () => {
       $("#other").slideUp("slow");
       $("#mobile").slideDown("slow");
     });
     $("#times").on("click", () => {
       $("#mobile").slideUp("slow");
       $("#other").slideDown("slow");
     });
     $("#year").text(new Date().getFullYear().toString());
})

const imageUpload: HTMLInputElement | null = document.querySelector("#image");
$(".hide-b4-save").hide()
/**
 * Initializing cropper class
 */

const cropper = new Cropper({
  width: 320,
  height: 320,
  onChange: function () {
    const image = this.getCroppedImage();
    const file = dataURLtoFile(image, "user");
    if (imageUpload && file && imageUpload.files) {
      const dataTransfer = new DataTransfer()
      dataTransfer.items.add(file)
      imageUpload.files = dataTransfer.files
    }
  },
});
type stringable = string | null
/**
 * Covert base64 data image to Javascript object File
 * @param dataUrl 
 * @param filename 
 * @returns {File | undefined}
 */
function dataURLtoFile(dataUrl:string, filename:string) : File | undefined {
  let array = dataUrl.split(",")
  if (array !== null) {
    const matchExtension: RegExpMatchArray | null = array[0].match(/data:(.*);/);
    const matchMimeType: RegExpMatchArray | null = array[0].match(/:(.*?);/);
    let extension: stringable
    let mime : stringable
    
    if (matchExtension !== null) {

      extension = matchExtension[1].split("/")[1];

      if (matchMimeType !== null) {

        mime = matchMimeType[1]

        let bstr = atob(array[1])
        let n = bstr.length
        let u8array : Uint8Array = new Uint8Array(n)
      
        while (n--) {
          u8array[n] = bstr.charCodeAt(n);
        }
        return new File([u8array], filename + "." + extension, { type: mime });
      }
    }
  }
}
const imageUploader: HTMLInputElement | null = document.querySelector("#imageToCrop")
imageUploader && imageUploader.addEventListener("change", (evt) => {
  if (evt.target !== null) {
    const target : any = evt.target
    const image = target.files[0];
    if (image) {
      const fileReader = new FileReader()
      fileReader.onload = function () {
        cropper.loadImage(fileReader.result).then(() : void =>{})
        $("#crop").slideDown()
        $("#crop").removeClass(".hidden")
        $(".hide-b4-save").slideDown();
      }
      fileReader.readAsDataURL(image)
    }
  }
});
cropper.render("#crop");



//Add user interactions stars here

const formStepsButtons: NodeListOf<HTMLButtonElement> | null = document.querySelectorAll(".form-user-btn")
formStepsButtons && formStepsButtons.forEach((button : HTMLButtonElement) => {
  const buttonName: string = button.name
  $(button).on("click", function (e : Event) {
    e.preventDefault()
    useFormButtons(buttonName)
  })

  const cameraBtn: HTMLButtonElement | null = document.querySelector("#camera")
  if(cameraBtn && imageUploader)
  cameraBtn.addEventListener("click", (e: Event) => {
    e.preventDefault()
    imageUploader.click()
    e.stopImmediatePropagation()
  })


  function useFormButtons(name: string): void{
    switch (name) {
      case "2":
        $(".form-1").slideUp()
        $("#register-title").text(
          "Ajouter votre photo en cliquant sur le bouton ci-bas"
        );
        $("#userIcon").slideUp();
        $(".form-2").slideDown()
        break;
      case "-2":
        $(".form-1").slideDown()
        $(".form-2").slideUp()
        break;
    }
  }
})