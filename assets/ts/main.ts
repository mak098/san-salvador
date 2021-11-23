
var $: any;
((): void => {
  const handler: HTMLElement | null = document.querySelector("#menuHandler");
  const menu: HTMLDivElement | null = document.querySelector("#menu");
  if (handler !== null) {
      handler.addEventListener("click", (): void => {
        $("#menuContainer").css("height", "350px")
        $("#menuContainer").css("padding", "15px")
        $(menu).slideToggle()

    });
  } else {
    console.warn(
      `impossibleClickEvent :  document.querySelector("#menuHandler") returns a null value, this maybe due to a wrong selectedElement or and undefined element `
    );
  }
})()

$("[data-aos]").parent().addClass("hideOverflowOnMobile");
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


