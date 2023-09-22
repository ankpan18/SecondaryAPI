// // JavaScript code goes here
// async function fetchData(url) {
//     const response = await fetch(url);
//     const data = await response.json();
//     console.log(data);
//   }
  
//   fetchData("http://localhost/SecondaryAPI/Shop/products/cat00000/5/1");


// fetch('http://localhost/SecondaryAPI/Shop/products/cat00000/5/1')
//   .then(response => response.json())
//   .then(data => console.log(data))
//   .catch(error => console.error(error));


  fetch("http://localhost/SecondaryAPI/shop/categories/100/1")
  .then((response) => {
    if (response.ok) {
      return response.json();
    } else {
      throw new Error("NETWORK RESPONSE ERROR");
    }
  })
  .then((data) => {
    console.log(data);
    displayCategories(data);
  })
  .catch((error) => console.error("FETCH ERROR:", error));


  function displayCategories(data) {
    const catDiv = document.getElementById("categories");
    const select = document.createElement("select");
    const defaultOption=document.createElement("option");
    defaultOption.text="Select Category";
    defaultOption.selected=true;
    select.appendChild(defaultOption);
    for(let i=0 ; i<data.categories.length;i++)
    {
        const cat = data.categories[i];
       
      
        // Display the category name
        const catName = cat.name;
        const option = document.createElement("option");
        option.text = catName;
        option.value=cat.categoryID;
        select.appendChild(option);
    }

    select.addEventListener("change", (event) => {
        const selectedValue = event.target.value;
        // const selectedOptionId=event.target.value;

        console.log(selectedValue);

        fetch(`http://localhost/SecondaryAPI/Shop/products/${selectedValue}/20/1`)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else {
            throw new Error("NETWORK RESPONSE ERROR");
          }
        })
        .then((data) => {
          console.log(data);
          displayProducts(data);
        })
        .catch((error) => console.error("FETCH ERROR:", error));
      });
        catDiv.appendChild(select);
  }

function createProduct(prod){
  //Display the Prod name,price, images and review
  var prodDiv = document.createElement("div");
  prodDiv.className="product";

  
  
  
  // const prodImages=prod.images;

  const name=document.createElement('h2');
  name.innerHTML=prod.name;
  prodDiv.appendChild(name);
  const price=document.createElement('p');
  price.className="price"
  price.innerHTML="Price:$"+prod.salePrice;
  const review=document.createElement('p');
  review.innerHTML=prod.customerReviewCount+" Reviews";
  review.className="review";
  
  var imgsDiv=document.createElement("div");
  imgsDiv.className="images_container";
  
  // var img=document.createElement("img");
  // img.src=prod.images[0].href;
  
  for(let k=0;k<prod.images.length;k++)
  {
    var img=document.createElement("img");
    img.className="image";
    img.loading="lazy";
    img.src=prod.images[k].href;
    imgsDiv.appendChild(img);
    if (k==0){
      img.classList.add("active");
    }
  }
  prodDiv.appendChild(imgsDiv);
  prodDiv.appendChild(price);
  prodDiv.appendChild(review);
  return prodDiv;
}
function displayProducts(data)
  {
    products.innerHTML=""; 
    for(let j=0 ; j<data.products.length;j++)
    {
        const prod = data.products[j];
        
        products.appendChild(createProduct(prod));

        
        

    }
  }

