function renderComment(comment) {
  const user_name = comment["user.name"] + " " + comment["user.last_name"];
  // Create the card element
  var card = document.createElement("div");
  card.className = "card";

  // Create the card header element
  var cardHeader = document.createElement("div");
  cardHeader.className = "card-header";

  // Create the d-flex align-items-center element
  var flexContainer = document.createElement("div");
  flexContainer.className = "d-flex align-items-center";

  // Create the user avatar image element
  var avatarImg;

  if (comment["user.picture"]) {
    avatarImg = document.createElement("img");
    avatarImg.src = comment["user.picture"];
    avatarImg.className = "rounded-circle me-2";
  } else {
    avatarImg = document.createElement("iconify-icon");
    avatarImg.setAttribute("icon", "heroicons:rocket-launch-solid");
    avatarImg.classList.add("text-danger");
    avatarImg.classList.add("me-2");
  }
  avatarImg.alt = user_name;
  avatarImg.width = "32";
  avatarImg.height = "32";
  avatarImg.style.objectFit = "cover";

  // Create the d-flex flex-column element
  var flexColumn = document.createElement("div");
  flexColumn.className = "d-flex flex-column";

  // Create the commenter name link element
  var commenterLink = document.createElement("a");
  commenterLink.href = "/profile.php?id=" + comment["user_id"];
  commenterLink.className = "text-decoration-none";
  commenterLink.textContent = user_name;

  // Create the date small element
  var dateSmall = document.createElement("small");
  dateSmall.className = "text-body-secondary";
  dateSmall.textContent = new Date(comment["created_at"]).toLocaleDateString(
    "en-US",
    {
      year: "numeric",
      month: "short",
      day: "numeric",
    }
  );

  // Append the commenter name and date elements to the flex column
  flexColumn.appendChild(commenterLink);
  flexColumn.appendChild(dateSmall);

  // Append the user avatar and flex column to the flex container
  flexContainer.appendChild(avatarImg);
  flexContainer.appendChild(flexColumn);
  if (comment["is_owned"]) {
    // Create the dropdown container element
    var dropdownContainer = document.createElement("div");
    dropdownContainer.className = "dropdown ms-auto";

    // Create the dropdown button
    var dropdownButton = document.createElement("button");
    dropdownButton.className =
      "btn btn-secondary edit-post dropdown-toggle rounded-circle p-1 d-flex align-items-center justify-content-center";
    dropdownButton.type = "button";
    dropdownButton.setAttribute("data-bs-toggle", "dropdown");
    dropdownButton.setAttribute("data-bs-auto-close", "true");
    dropdownButton.setAttribute("aria-expanded", "false");

    // Create the iconify icon element
    var iconifyIcon = document.createElement("iconify-icon");
    iconifyIcon.setAttribute("icon", "mingcute:more-2-fill");
    iconifyIcon.setAttribute("width", "24");
    iconifyIcon.setAttribute("height", "24");

    // Append the iconify icon to the dropdown button
    dropdownButton.appendChild(iconifyIcon);

    // Create the dropdown menu
    var dropdownMenu = document.createElement("ul");
    dropdownMenu.className = "dropdown-menu dropdown-menu-end";

    // Create the "Edit" item in the dropdown menu
    var editItem = document.createElement("li");
    var editLink = document.createElement("a");
    editLink.className = "dropdown-item";
    editLink.id = "edit";
    editLink.textContent = "Edit";
    editItem.appendChild(editLink);

    // Create the "Delete" item in the dropdown menu
    var deleteItem = document.createElement("li");
    var deleteLink = document.createElement("a");
    deleteLink.className = "dropdown-item text-danger";
    deleteLink.id = "delete";
    deleteLink.textContent = "Delete";
    deleteItem.appendChild(deleteLink);

    // Append the "Edit" and "Delete" items to the dropdown menu
    dropdownMenu.appendChild(editItem);
    dropdownMenu.appendChild(deleteItem);

    // Append the dropdown button and dropdown menu to the dropdown container
    dropdownContainer.appendChild(dropdownButton);
    dropdownContainer.appendChild(dropdownMenu);
    flexContainer.appendChild(dropdownContainer);
  }

  // Append the flex container to the card header
  cardHeader.appendChild(flexContainer);

  // Create the card body element
  var cardBody = document.createElement("div");
  cardBody.className = "card-body";

  // Create the comment paragraph element
  var commentText = document.createElement("p");
  commentText.className = "card-text";
  commentText.textContent = comment["text"];

  // Append the comment paragraph to the card body
  cardBody.appendChild(commentText);

  // Append the card header and card body to the card
  card.appendChild(cardHeader);
  card.appendChild(cardBody);

  return card;
}
