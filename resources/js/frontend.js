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
    let mainChatBox = $(".wsus__chat_area_body");

    if (mainChatBox.attr("data-inbox") == e.sender_id) {
        var message = `
          <div class="wsus__chat_single mb-3">
              <div class="wsus__chat_single_img">
                  <img src="${e.sender_image}" alt="user" class="img-fluid">
              </div>
              <div class="wsus__chat_single_text">
                  <p>${e.message}</p>
                  ${
                      e.images && e.images.length > 0
                          ? `<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px">` +
                            e.images
                                .map(
                                    (image) =>
                                        `<img src="${image}" alt="image" class="img-fluid mb-3" style="width: 100px;">`
                                )
                                .join("") +
                            `</div>`
                          : ""
                  }
                  <span>${formatDatetime(e.date_time)}</span>
              </div>
          </div>
      `;
    }

    mainChatBox.append(message);
    scrollToBottom();

    $(".chat-user-profile").each(function () {
        let profileUserId = $(this).data("id");

        if (profileUserId == e.sender_id) {
            let $imgDiv = $(this).find(".wsus_chat_list_img");

            // Kiểm tra nếu thẻ span đã tồn tại thì không thêm nữa
            if ($imgDiv.find("span.shadow").length === 0) {
                $imgDiv.append(
                    `<span class="shadow" style="background-color: #bf3039"></span>`
                );
            }
        }
    });

    // $(value).find(".chat-user-image").attr("src",e.sender_image);
});
