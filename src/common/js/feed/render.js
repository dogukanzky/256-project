function handleLike() {
  const id = $(this).attr("data-post-id");

  $.ajax({
    method: "POST",
    url: "/like-post.php",
    data: {
      post_id: id,
    },
  })
    .done((d, res, o) => {
      if (res === "success") {
        const icon = $(this).find("iconify-icon").attr("icon");
        $(this)
          .find("iconify-icon")
          .attr(
            "icon",
            icon === "line-md:heart" ? "line-md:heart-filled" : "line-md:heart"
          );
      }
    })
    .fail((...res) => {
      console.log("Error:", res);
    });
}

function renderSingleCard(postData) {
  // Create the main card element
  const card = document.createElement("div");
  card.classList.add("card");
  card.style.width = "600px";

  // Create the card header
  const cardHeader = document.createElement("div");
  cardHeader.classList.add("card-header");
  card.appendChild(cardHeader);

  // Create the header content
  const headerContent = document.createElement("div");
  headerContent.classList.add(
    "d-flex",
    "align-items-center",
    "gap-2",
    "text-decoration-none"
  );
  cardHeader.appendChild(headerContent);

  // Create the profile image
  let profileImage;
  if (postData["user.picture"]) {
    profileImage = document.createElement("img");
    profileImage.src = postData["user.picture"];
  } else {
    profileImage = document.createElement("iconify-icon");
    profileImage.setAttribute("icon", "heroicons:rocket-launch-solid");
    profileImage.classList.add("text-danger");
  }
  profileImage.width = "32";
  profileImage.height = "32";
  profileImage.classList.add("rounded-circle");
  profileImage.style.objectFit = "cover";
  headerContent.appendChild(profileImage);

  // Create the name and date container
  const nameDateContainer = document.createElement("div");
  nameDateContainer.classList.add("d-flex", "flex-column");
  headerContent.appendChild(nameDateContainer);

  // Create the name link
  const nameLink = document.createElement("a");
  nameLink.href = "/profile.php?id=" + postData["user_id"];
  nameLink.classList.add(
    "d-flex",
    "align-items-stretch",
    "gap-2",
    "text-decoration-none"
  );
  nameLink.textContent = `${postData["user.name"]} ${postData["user.last_name"]}`;
  nameDateContainer.appendChild(nameLink);

  // Create the date element
  const dateElement = document.createElement("small");
  dateElement.classList.add("text-body-secondary");
  dateElement.textContent = new Date(postData["created_at"]).toLocaleDateString(
    "en-US",
    {
      year: "numeric",
      month: "short",
      day: "numeric",
    }
  );
  nameDateContainer.appendChild(dateElement);

  // Create the card image
  if (postData["image"]) {
    const cardImage = document.createElement("img");
    cardImage.src = postData["image"];
    cardImage.classList.add("card-img-top");

    const cardLink = document.createElement("a");
    cardLink.href = "/post-detail?id=" + postData["id"];
    cardLink.appendChild(cardImage);

    card.appendChild(cardLink);
  }

  // Create the card body
  const cardBody = document.createElement("div");
  cardBody.classList.add("card-body");
  card.appendChild(cardBody);

  // Create the card text paragraph
  const cardText = document.createElement("p");
  cardText.classList.add("card-text");
  cardText.textContent = postData["text"];
  cardBody.appendChild(cardText);

  // Create the like button
  const likeButton = document.createElement("a");
  likeButton.setAttribute("data-post-id", postData["id"]);
  likeButton.classList.add("btn", "btn-dark", "text-danger");
  likeButton.onclick = handleLike;
  cardBody.appendChild(likeButton);

  // Create the like button content
  const likeButtonContent = document.createElement("div");
  likeButtonContent.classList.add("d-flex", "align-items-center");
  likeButton.appendChild(likeButtonContent);

  // Create the like button icon
  const likeButtonIcon = document.createElement("iconify-icon");
  likeButtonIcon.setAttribute(
    "icon",
    postData["is_liked"] == 1 ? "line-md:heart-filled" : "line-md:heart"
  );
  likeButtonIcon.setAttribute("width", "24");
  likeButtonIcon.setAttribute("height", "24");
  likeButtonContent.appendChild(likeButtonIcon);

  // Create the like button text
  const likeButtonText = document.createTextNode("Like");
  likeButtonContent.appendChild(likeButtonText);

  // Create the comment button
  const commentButton = document.createElement("a");
  commentButton.href = "/post-detail?id=" + postData["id"];
  commentButton.classList.add("btn", "btn-dark", "text-info");
  cardBody.appendChild(commentButton);

  // Create the comment button content
  const commentButtonContent = document.createElement("div");
  commentButtonContent.classList.add("d-flex", "align-items-center");
  commentButton.appendChild(commentButtonContent);

  // Create the comment button icon
  const commentButtonIcon = document.createElement("iconify-icon");
  commentButtonIcon.setAttribute("icon", "line-md:email-twotone");
  commentButtonIcon.setAttribute("width", "24");
  commentButtonIcon.setAttribute("height", "24");
  commentButtonContent.appendChild(commentButtonIcon);

  // Create the comment button text
  const commentButtonText = document.createTextNode("Comment");
  commentButtonContent.appendChild(commentButtonText);

  // Append the card to the document body or any desired container
  $("#post-list").append(card);
}
