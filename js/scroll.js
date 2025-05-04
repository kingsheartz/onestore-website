//-------------------------------------SCROLL WITH DRAG----------------------------------------------------------------------->
//////////////////////////////////////////////BODY LOTION//////////////////////////////////////////////////////////////////////
let isDown = false;
let startX;
let scrollLeft;
if (document.querySelector(".bl_item_scroll") != null) {
  const blslider = document.querySelector(".bl_item_scroll");
  blslider.addEventListener("mousedown", (e) => {
    isDown = true;
    blslider.classList.add("bl_scroll_active");
    startX = e.pageX - blslider.offsetLeft;
    scrollLeft = blslider.scrollLeft;
  });
  blslider.addEventListener("mouseleave", () => {
    isDown = false;
    blslider.classList.remove("bl_scroll_active");
  });
  blslider.addEventListener("mouseup", () => {
    isDown = false;
    blslider.classList.remove("bl_scroll_active");
  });
  blslider.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - blslider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    blslider.scrollLeft = scrollLeft - walk;
    console.log(walk);
  });
}
//////////////////////////////////////////////MAKE UP ITEMS//////////////////////////////////////////////////////////////////////
if (document.querySelector(".mui_item_scroll") != null) {
  const muislider = document.querySelector(".mui_item_scroll");
  muislider.addEventListener("mousedown", (e) => {
    isDown = true;
    muislider.classList.add("mui_scroll_active");
    startX = e.pageX - muislider.offsetLeft;
    scrollLeft = muislider.scrollLeft;
  });
  muislider.addEventListener("mouseleave", () => {
    isDown = false;
    muislider.classList.remove("mui_scroll_active");
  });
  muislider.addEventListener("mouseup", () => {
    isDown = false;
    muislider.classList.remove("mui_scroll_active");
  });
  muislider.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - muislider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    muislider.scrollLeft = scrollLeft - walk;
    console.log(walk);
  });
}
//////////////////////////////////////////////TOP CATEGORY//////////////////////////////////////////////////////////////////////
if (document.querySelector(".cat_item_scroll") != null) {
  const slider = document.querySelector(".cat_item_scroll");
  slider.addEventListener("mousedown", (e) => {
    isDown = true;
    slider.classList.add("cat_scroll_active");
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });
  slider.addEventListener("mouseleave", () => {
    isDown = false;
    slider.classList.remove("cat_scroll_active");
  });
  slider.addEventListener("mouseup", () => {
    isDown = false;
    slider.classList.remove("cat_scroll_active");
  });
  slider.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    slider.scrollLeft = scrollLeft - walk;
    console.log(walk);
  });
}
//-------------------------------------SCROLL WITH DRAG----------------------------------------------------------------------->
