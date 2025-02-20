function scrollToBottom() {
    mainChatBox[0].scrollTop = mainChatBox[0].scrollHeight;
}

function formatDatetime(datetimeString) {
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };

    const date = new Date(datetimeString);
    return date.toLocaleString("en-GB", options).replace(",", "");
}

window.Echo.private("message." + USER.id).listen("MessageEvent", (e) => {
    var mainChatBox = $(".chat-content");

    // if (mainChatBox.attr("data-inbox") == e.sender_id) {
    //     var message = `
    //   <div class="chat-item chat-left">
    //       <img src="${e.sender_image}" alt="">
    //       <div class="chat-details">
    //           <div class="chat-text">${e.message}</div>
    //           <div class="chat-time">${formatDatetime(e.date_time)}</div>
    //       </div>
    //   </div>
    //   `;
    // }

    if (mainChatBox.attr("data-inbox") == e.sender_id) {
        var message = `
          <div class="chat-item chat-left">
              <img src="${e.sender_image}" alt="">
              <div class="chat-details">
                  <div class="chat-text">${e.message}</div>
                  ${
                      e.images && e.images.length > 0
                          ? `<div style="display: flex; gap: 10px; margin-top: 10px;">` +
                            e.images
                                .map(
                                    (image) =>
                                        `<img src="${image}" alt="image" class="img-fluid mb-3" width="100px">`
                                )
                                .join("") +
                            `</div>`
                          : ""
                  }
                  <div class="chat-time">${formatDatetime(e.date_time)}</div>
              </div>
          </div>
      `;
    }

    mainChatBox.append(message);
    scrollToBottom();

    $(".chat-user-profile").each(function () {
        let profileUserId = $(this).data("id");

        if (profileUserId == e.sender_id) {
            $(this).children("img").css("border", "3px solid red");

            // if ($(this).find(".notify").length === 0) {
            //     $(this).children("img").after(`
            //     <div class="notify">
            //         <div class="text-danger text-small font-600-bold mr-2"><i
            //                 class="fas fa-circle"></i>
            //         </div>
            //     </div>
            //     `);
            // }
        }
    });
});
