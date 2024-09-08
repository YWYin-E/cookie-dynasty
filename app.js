const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Cookie Extreme",
    price: 5,
    colors: [
      {
        code: "black",
        img: "./img/Product/extreme.png",
      },
      {
        code: "darkblue",
        img: "./img/Product/air2.png",
      },
    ],
  },
  {
    id: 2,
    title: "Purrfect Cookie",
    price: 6,
    colors: [
      {
        code: "lightgray",
        img: "./img/Product/purfect.png",
      },
      {
        code: "green",
        img: "./img/Product/jordan2.png",
      },
    ],
  },
  {
    id: 3,
    title: "Panda Best Cookie",
    price: 6,
    colors: [
      {
        code: "lightgray",
        img: "./img/Product/panda.png",
      },
      {
        code: "green",
        img: "./img/Product/blazer2.png",
      },
    ],
  },
  {
    id: 4,
    title: "Chocolate Delight",
    price: 5,
    colors: [
      {
        code: "black",
        img: "./img/Product/delight.png",
      },
      {
        code: "lightgray",
        img: "./img/Product/crater2.png",
      },
    ],
  },
  {
    id: 5,
    title: "Sugary Love Cookie",
    price: 7,
    colors: [
      {
        code: "gray",
        img: "./img/Product/love.png",
      },
      {
        code: "black",
        img: "./img/Product/hippie2.png",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductpieces = document.querySelectorAll(".piece");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    //change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    //change the choosen product
    choosenProduct = products[index];

    //change texts of currentProduct
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "RM" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

    //assing new colors
    currentProductColors.forEach((color, index) => {
      color.style.backgroundColor = choosenProduct.colors[index].code;
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    currentProductImg.src = choosenProduct.colors[index].img;
  });
});

currentProductpieces.forEach((piece, index) => {
  piece.addEventListener("click", () => {
    currentProductpieces.forEach((piece) => {
      piece.style.backgroundColor = "white";
      piece.style.color = "black";
    });
    piece.style.backgroundColor = "black";
    piece.style.color = "white";
  });
});


const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});