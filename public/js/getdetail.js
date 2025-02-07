function showDetail(clickedElement) {
  const id = clickedElement.dataset.id;

  // Get the modal body element
  let modalBody = document.querySelector(".modal-body");

  // Check if the accordion already exists
  let accordionContainer = document.getElementById("accordionExample");

  if (accordionContainer) {
    // If it exists, clear its content
    accordionContainer.innerHTML = "";
  } else {
    // If it doesn't exist, create a new accordion container
    accordionContainer = document.createElement("div");
    accordionContainer.className = "accordion";
    accordionContainer.id = "accordionExample";
  }

  fetch("http://localhost/Deliziosa_Restaurant/public/orders/getDetail/" + id)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      // Handle the retrieved JSON data here
      document.getElementById("meals-type").innerHTML =
        "<b>Meals: </b>" +
        data.orders.meals_type +
        " - " +
        data.orders.time_desc;
      document.getElementById("reservation-date").innerHTML =
        "<b>Reservation Date: </b>" + data.orders.date_reservation;
      document.getElementById("ticket-code").innerHTML =
        "<b>Ticket: </b>" +
        (data.orders.ticket === null || data.orders.ticket === undefined
          ? "-"
          : data.orders.ticket);

          let rsvBtn = document.querySelector('.btn-rsv');
          rsvBtn.href = new URL("http://localhost/Deliziosa_Restaurant/public/reservation/formByOrder/" + id, window.location.origin).href;
      data.reservation.forEach(function (reservation) {

        // Create accordion item
        let accordionItem = document.createElement("div");
        accordionItem.className = "accordion-item";

        // Create accordion header
        let accordionHeader = document.createElement("h2");
        accordionHeader.className = "accordion-header";

        let accordionButton = document.createElement("button");
        accordionButton.className = "accordion-button";
        accordionButton.type = "button";
        accordionButton.setAttribute("data-bs-toggle", "collapse");
        accordionButton.setAttribute(
          "data-bs-target",
          `#collapse${reservation.id_reservation}`
        );
        accordionButton.setAttribute("aria-expanded", "false");
        accordionButton.setAttribute(
          "aria-controls",
          `collapse${reservation.id_reservation}`
        );
        accordionButton.innerHTML = `<b>Reservation ID</b>&nbsp;- ${reservation.id_reservation}`;

        // Append accordion button to header
        accordionHeader.appendChild(accordionButton);

        // Create accordion body
        let accordionBody = document.createElement("div");
        accordionBody.id = `collapse${reservation.id_reservation}`;
        accordionBody.className = "accordion-collapse collapse";
        accordionBody.setAttribute("data-bs-parent", "#accordionExample");

        let accordionBodyContent = document.createElement("div");
        accordionBodyContent.className = "accordion-body";

        if(data.orders.paid_stat !== 'Paid') {
          accordionBodyContent.innerHTML = `
                        <strong>Class:</strong> ${reservation.class_type} - ${reservation.class_price} (IDR)<br>
                        <strong>Party ID:</strong> ${reservation.party_type} - ${reservation.capacity} people - ${reservation.party_price} (IDR)<br>
                        <strong>Price:</strong> ${reservation.price} (IDR)<br>
                        <strong>Quantity:</strong> ${reservation.quantity}<br>
                        <div class="d-flex justify-content-end">
                          <a href="http://localhost/Deliziosa_Restaurant/public/reservation/formByOrder/${id}/${reservation.id_reservation}" 
                          class="text-decoration-none mt-2 fs-6 me-3 btn btn-warning">Edit</a>
                          <a href="http://localhost/Deliziosa_Restaurant/public/reservation/delete/${reservation.id_reservation}" 
                          class="text-decoration-none mt-2 fs-6 btn btn-danger">Delete</a>
                        </div>
                    `;
          rsvBtn.href = new URL("http://localhost/Deliziosa_Restaurant/public/reservation/formByOrder/" + id, window.location.origin).href;
          rsvBtn.style.display = "block";
        } else {
          accordionBodyContent.innerHTML = `
                        <strong>Class:</strong> ${reservation.class_type} - ${reservation.class_price} (IDR)<br>
                        <strong>Party ID:</strong> ${reservation.party_type} - ${reservation.capacity} people - ${reservation.party_price} (IDR)<br>
                        <strong>Price:</strong> ${reservation.price} (IDR)<br>
                        <strong>Quantity:</strong> ${reservation.quantity}<br>
                    `;
          rsvBtn.style.display = "none";
        }

        // Append accordion body content to body
        accordionBody.appendChild(accordionBodyContent);

        // Append header and body to accordion item
        accordionItem.appendChild(accordionHeader);
        accordionItem.appendChild(accordionBody);

        // Append accordion item to container
        accordionContainer.appendChild(accordionItem);
      });

      // Append the accordion container to modal body
      modalBody.appendChild(accordionContainer);
    })
    .catch((error) => console.error("Error:", error));
}
