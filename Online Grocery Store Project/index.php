<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=devide-width, initial-scale=1" />
    <title>Index</title>
    <link rel="stylesheet" href="index.css" />
    <script
      src="https://kit.fontawesome.com/5dd9030673.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <!-- NAV BAR -->
    <nav class="navbar"></nav>
    <script defer>
      var navbar = document.getElementsByClassName("navbar")[0];
      var logo = document.createElement("a");
      var logoImg = document.createElement("img");
      logo.href = "index.php";
      logoImg.src = "logo.png";
      logo.appendChild(logoImg);
      navbar.appendChild(logo);

      var drops = document.createElement("div");
      var fas = document.createElement("i");
      drops.className = "drop_main";
      fas.className = "fas fa-caret-square-down fa-2x";
      drops.appendChild(fas);

      var xmlhttp, xmlDoc;

      xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "product_list.xml", false);
      xmlhttp.send();
      xmlDoc = xmlhttp.responseXML;

      let itemIDs = [];
      let itemPrices = [];
      let itemNames = [];
      let itemAisles = [];
      let itemWeights = [];
      let itemImages = [];

      let allItemIDs = xmlDoc.getElementsByTagName("itemID");
      let allItemPrices = xmlDoc.getElementsByTagName("itemPrice");
      let allItemNames = xmlDoc.getElementsByTagName("itemName");
      let allItemAisles = xmlDoc.getElementsByTagName("aisle");
      let allItemWeights = xmlDoc.getElementsByTagName("weight");
      let allItemImages = xmlDoc.getElementsByTagName("image");

      for (let i = 0; i < allItemIDs.length; i++) {
        itemIDs.push(allItemIDs[i].childNodes[0].nodeValue);
        itemPrices.push(allItemPrices[i].childNodes[0].nodeValue);
        itemNames.push(allItemNames[i].childNodes[0].nodeValue);
        itemAisles.push(allItemAisles[i].childNodes[0].nodeValue);
        itemWeights.push(allItemWeights[i].childNodes[0].nodeValue);
        itemImages.push(allItemImages[i].childNodes[0].nodeValue);
      }
      var fruitDrops = document.createElement("div");
      fruitDrops.className = "drop_cat";
      var fruitHolder = document.createElement("div");
      fruitHolder.className = "drop_sub1";
      var fruitLink = document.createElement("a");
      fruitLink.href = "aisle.html?aisleID=fruits";
      fruitLink.innerHTML = "Fruits";

      fruitDrops.appendChild(fruitLink);
      fruitDrops.appendChild(fruitHolder);

      var vegeDrops = document.createElement("div");
      vegeDrops.className = "drop_cat";
      var vegeHolder = document.createElement("div");
      vegeHolder.className = "drop_sub1";
      var vegeLink = document.createElement("a");
      vegeLink.href = "aisle.html?aisleID=vegetables";
      vegeLink.innerHTML = "Vegetables";

      vegeDrops.appendChild(vegeLink);
      vegeDrops.appendChild(vegeHolder);

      var meatDrops = document.createElement("div");
      meatDrops.className = "drop_cat";
      var meatHolder = document.createElement("div");
      meatHolder.className = "drop_sub1";
      var meatLink = document.createElement("a");
      meatLink.href = "aisle.html?aisleID=meat";
      meatLink.innerHTML = "Meat";

      meatDrops.appendChild(meatLink);
      meatDrops.appendChild(meatHolder);

      var dairyDrops = document.createElement("div");
      dairyDrops.className = "drop_cat";
      var dairyHolder = document.createElement("div");
      dairyHolder.className = "drop_sub1";
      var dairyLink = document.createElement("a");
      dairyLink.href = "aisle.html?aisleID=dairy";
      dairyLink.innerHTML = "Dairy";

      dairyDrops.appendChild(dairyLink);
      dairyDrops.appendChild(dairyHolder);

      var bakeryDrops = document.createElement("div");
      bakeryDrops.className = "drop_cat";
      var bakeryHolder = document.createElement("div");
      bakeryHolder.className = "drop_sub1";
      var bakeryLink = document.createElement("a");
      bakeryLink.href = "aisle.html?aisleID=bakery";
      bakeryLink.innerHTML = "Bakery";

      bakeryDrops.appendChild(bakeryLink);
      bakeryDrops.appendChild(bakeryHolder);

      for (let i = 0; i < itemIDs.length; i++) {
        var currentItem = document.createElement("a");
        currentItem.className = "drop_sub_item";
        currentItem.href =
          "itemTemplate.html?itemID=" +
          itemIDs[i] +
          "&itemName=" +
          itemNames[i] +
          "&itemPrice=" +
          itemPrices[i] +
          "&aisle=" +
          itemAisles[i] +
          "&measureUnit=" +
          itemWeights[i];
        currentItem.innerHTML = itemNames[i];
        if (itemAisles[i] == "fruits") {
          fruitHolder.appendChild(currentItem);
        } else if (itemAisles[i] == "vegetables") {
          vegeHolder.appendChild(currentItem);
        } else if (itemAisles[i] == "meat") {
          meatHolder.appendChild(currentItem);
        } else if (itemAisles[i] == "dairy") {
          dairyHolder.appendChild(currentItem);
        } else if (itemAisles[i] == "bakery") {
          bakeryHolder.appendChild(currentItem);
        }
      }

      drops.appendChild(fruitDrops);
      drops.appendChild(vegeDrops);
      drops.appendChild(meatDrops);
      drops.appendChild(dairyDrops);
      drops.appendChild(bakeryDrops);

      var otherHolder = document.createElement("div");
      otherHolder.className = "other_items";
      var cartHolder = document.createElement("a");
      cartHolder.href = "addtocart.php";
      var cart = document.createElement("i");
      cart.className = "fas fa-shopping-cart";
      cartHolder.appendChild(cart);
      cart.innerHTML = "Cart";
      otherHolder.appendChild(cartHolder);

      navbar.appendChild(drops);
      </script>

      <?php if (isset($_SESSION["username"])): ?>
      <script>
        var logoutHolder = document.createElement("a");
        logoutHolder.href = "logout.php";
        var logout = document.createElement("i");
        logout.className = "far fa-user-circle";
        logoutHolder.appendChild(logout);
        logout.innerHTML = "Log Out";
        otherHolder.appendChild(logoutHolder);

        navbar.appendChild(otherHolder);
      </script>
      <?php endif ?>
      <?php if (!(isset($_SESSION["username"]))): ?>
      <script>
      var signupHolder = document.createElement("a");
      signupHolder.href = "signup.php";
      var signup = document.createElement("i");
      signup.className = "far fa-user-circle";
      signupHolder.appendChild(signup);
      signup.innerHTML = "Sign Up";
      otherHolder.appendChild(signupHolder);

      var signinHolder = document.createElement("a");
      signinHolder.href = "signin.php";
      var signin = document.createElement("i");
      signin.className = "far fa-user-circle";
      signinHolder.appendChild(signin);
      signin.innerHTML = "Sign In";
      otherHolder.appendChild(signinHolder);

      //navbar.appendChild(drops);
      navbar.appendChild(otherHolder);
    </script>
    <?php endif ?>
    <?php if(isset($_SESSION["username"]) && $_SESSION["username"] == "admin@email.com"): ?>
    <script>
      var backstoreHolder = document.createElement("a");
      backstoreHolder.href = "p7.php";
      var backstore = document.createElement("i");
      backstore.className = "fas fa-user-cog";
      backstore.innerHTML = "Backstore";
      backstoreHolder.appendChild(backstore);
      otherHolder.appendChild(backstoreHolder);
    </script>
    <?php endif ?>

    <?php if(isset($_SESSION["username"])) {
        $email = $_SESSION["username"];
        $usersxml = 'addoredituser.xml';
        $users = simplexml_load_file($usersxml) or die("XML File no work lol");
        $userslist = "";
        foreach ($users as $userinfo)
        {
        if($userinfo->email == $email) {
          $firstName = $userinfo->firstname;
        }
        }
        $firstName = ucfirst($firstName);
    }
    if(isset($firstName))
    echo "<h1 class=\"heading\"> Hi, $firstName! <br> WELCOME TO ORGANIK FOODS </h1>";
    else
    echo "<h1 class=\"heading\">WELCOME TO ORGANIK FOODS</h1> "
    ?>
    <!-- <h1 class="heading">WELCOME TO ORGANIK FOODS</h1> -->
    <section class="products" id="Index">
      <!-- strawb -->
      <div class="box">
        <h3>
          <a class="links" href="aisle.html?aisleID=fruits"
            ><img src="fruits.jpg" alt="Fruits Aisle" width="90%" /> <br />
            <br />
            Organik Fruits
          </a>
        </h3>

        <div class="star_rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <i class="far fa-star"></i>
        </div>
        <a href="aisle.html?aisleID=fruits" class="cart-button">
          <i class="fas fa-shopping-cart"></i>
          Go to aisle</a
        >
      </div>
      <!-- garlic naan -->
      <div class="box">
        <h3>
          <a class="links" href="aisle.html?aisleID=vegetables"
            ><img src="vegetable aisle.jpg" alt="Vegetable Aisle" /> <br />
            <br />
            Organik Vegetables
          </a>
        </h3>

        <div class="star_rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
        </div>
        <a href="aisle.html?aisleID=vegetables" class="cart-button">
          <i class="fas fa-shopping-cart"></i>
          Go to aisle</a
        >
      </div>
      <!-- muffins -->
      <div class="box">
        <h3>
          <a class="links" href="aisle.html?aisleID=meat"
            ><img src="meat3.jpg" alt="Meat Aisle" /> <br />
            <br />
            Organik Meats</a
          >
        </h3>

        <div class="star_rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
          <i class="far fa-star"></i>
        </div>
        <a href="aisle.html?aisleID=meat" class="cart-button">
          <i class="fas fa-shopping-cart"></i>
          Go to aisle</a
        >
      </div>
      <!-- loaf -->
      <div class="box">
        <h3>
          <a class="links" href="aisle.html?aisleID=dairy"
            ><img src="cheese 2.jpeg" alt="Dairy Aisle" width="90%" /><br />
            <br />
            Organik Dairy
          </a>
        </h3>

        <div class="star_rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <a href="aisle.html?aisleID=dairy" class="cart-button">
          <i class="fas fa-shopping-cart"></i>
          Go to aisle</a
        >
      </div>
      <!-- cake -->
      <div class="box">
        <h3>
          <a class="links" href="aisle.html?aisleID=bakery"
            ><img src="bakery.jpg" alt="Bakery Aisle" width="80%" /> <br />
            <br />
            Organik Bakery
          </a>
        </h3>

        <div class="star_rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
        </div>
        <a href="aisle.html?aisleID=bakery" class="cart-button">
          <i class="fas fa-shopping-cart"></i>
          Got to aisle</a
        >
      </div>
    </section>
  </body>
</html>
