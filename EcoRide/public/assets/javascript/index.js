// "router" for import with the page
document.addEventListener("DOMContentLoaded", () => {
  if (!document.querySelectorAll("section[id]").length) return;

  const mainSection = document.querySelectorAll("section[id]");
  const sectionId = mainSection[0].id;
  const modulePath = `./modules/pages/${sectionId}.js`;

  if (modulePath) {
    import(modulePath).then((module) => {
      if (typeof module.init === "function") module.init();
    });
  }
});
