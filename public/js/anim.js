console.log("OUI BONJOUR");

const links = document.querySelectorAll(".trait-lien");

links.forEach((link) => {
  link.addEventListener("mouseover", () => {
    console.log("coucou");
  });
});
