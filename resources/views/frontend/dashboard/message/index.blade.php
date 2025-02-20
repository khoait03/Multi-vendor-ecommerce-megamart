@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Tin nhắn
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-comments" aria-hidden="true"></i> Tin nhắn</h3>
                <div class="wsus__dashboard_review">
                    <div class="row">
                        <div class="col-xl-4 col-md-5">
                            <div class="wsus__chatlist d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <h2>Danh sách gian hàng</h2>
                                    <div class="wsus__chatlist_body">
                                        {{-- <button class="nav-link seller" id="seller-list-6" data-bs-toggle="pill"
                                          data-bs-target="#v-pills-home" type="button" role="tab"
                                          aria-controls="v-pills-home" aria-selected="true">
                                          <div class="wsus_chat_list_img">
                                              <img src="http://127.0.0.1:8000/uploads/custom-images/robert-james-2022-08-15-01-18-57-7752.png"
                                                  alt="user" class="img-fluid">
                                              <span class="pending d-none" id="pending-6">0</span>
                                          </div>
                                          <div class="wsus_chat_list_text">
                                              <h4>Robert James</h4>
                                          </div>
                                      </button> --}}

                                        @foreach ($chatUsers as $chatUser)
                                            @php
                                                $unseenMessages = \App\Models\Chat::where([
                                                    'sender_id' => $chatUser->receiverProfile->id,
                                                    'receiver_id' => auth()->user()->id,
                                                    'seen' => 0,
                                                ])->exists();
                                            @endphp

                                            <button class="nav-link chat-user-profile"
                                                data-id="{{ $chatUser->receiverProfile->id }}" id="seller-list-6"
                                                data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button"
                                                role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                <div class="wsus_chat_list_img">
                                                    <img src="{{ asset($chatUser->receiverProfile->image) }}" alt="user"
                                                        class="img-fluid">
                                                    {{-- <span>5</span> --}}
                                                    @if ($unseenMessages)
                                                        <span class="shadow" style="background-color: #bf3039"></span>
                                                    @endif
                                                </div>
                                                <div class="wsus_chat_list_text">
                                                    <h4 class="fw-bold text-primary">
                                                        {{ $chatUser->receiverProfile && $chatUser->receiverProfile->vendor ? limitText($chatUser->receiverProfile->vendor->name, 20) : 'Người dùng' }}
                                                    </h4>
                                                    {{-- <span class="status active">online</span> --}}
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-7">
                            <div class="wsus__chat_main_area" style="position: relative;">
                                <div class="wsus__chat_area_header">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div id="chat_box">
                                                <div class="wsus__chat_area">
                                                    {{-- <h2>Chat with Daniel Paul</h2> --}}
                                                </div>
                                                <div class="wsus__chat_area_body" data-inbox="">

                                                    {{-- <div class="wsus__chat_single single_chat_2">
                                                        <div class="wsus__chat_single_img">
                                                            <img src="http://127.0.0.1:8000/uploads/custom-images/john-doe-2022-08-15-01-14-20-3892.png"
                                                                alt="user" class="img-fluid">
                                                        </div>
                                                        <div class="wsus__chat_single_text">
                                                            <p>Hello Paul</p>
                                                            <span>15 August, 2022, 12:57 PM</span>
                                                        </div>
                                                    </div> --}}

                                                    {{-- <div class="wsus__chat_single">
                                                        <div class="wsus__chat_single_img">
                                                            <img src="http://127.0.0.1:8000/uploads/custom-images/daniel-paul-2022-08-15-01-16-48-4881.png"
                                                                alt="user" class="img-fluid">
                                                        </div>
                                                        <div class="wsus__chat_single_text">
                                                            <p>Hi Joe, Thanks for your contact</p>
                                                            <span>15 August, 2022, 12:58 PM</span>
                                                        </div>
                                                    </div> --}}

                                                </div>
                                                <div class="wsus__chat_area_footer"
                                                    style="position: absolute; width: 100%; bottom: 0; left: 0; right: 0">
                                                    <form id="message-form" enctype="multipart/form-data">
                                                        @csrf

                                                        <input type="text" class="message-box"
                                                            placeholder="Nhập tin nhắn" id="message" name="message"
                                                            autocomplete="off">
                                                        <input type="hidden" name="receiver_id" value="5"
                                                            id="receiver_id">

                                                        <button type="submit"><i class="fas fa-paper-plane send-button"
                                                                aria-hidden="true"></i></button>

                                                        <input class="" type="file" name="images[]" id="file-input"
                                                            style="padding: 5px 15px" multiple>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
@endsection

@push('scripts')
    <script>
        const mainChatBox = $(".wsus__chat_area_body")

        function formatDatetime(datetimeString) {
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            const date = new Date(datetimeString);
            return date.toLocaleString('en-GB', options).replace(',', '');
        }

        function scrollToBottom() {
            mainChatBox[0].scrollTop = mainChatBox[0].scrollHeight;
        }

        $(document).ready(function() {
            // $("#message-form").on("click", function() {
            //     let $imgDiv = $(".chat-user-profile").find(".wsus_chat_list_img");
            //     let $span = $imgDiv.find("span.shadow");

            //     // Nếu thẻ span đã tồn tại thì xóa, nếu không thì thêm mới
            //     if ($span.length > 0) {
            //         $span.remove();
            //     }

            // })

            $(".chat-user-profile").on("click", function() {
                let receiverId = $(this).data("id");
                let receiverImage = $(this).find("img").attr("src");

                mainChatBox.attr("data-inbox", receiverId);
                $("#receiver_id").val(receiverId);

                let $imgDiv = $(this).find(".wsus_chat_list_img");
                let $span = $imgDiv.find("span.shadow");

                if ($span.length > 0) {
                    $span.remove();
                }

                $.ajax({
                    url: "{{ route('user.get-messages') }}",
                    method: "GET",
                    data: {
                        receiverId: receiverId
                    },
                    beforeSend: function() {
                        mainChatBox.html("");
                    },
                    success: function(data) {
                        let title = `<h2>Nhắn tin với ${data.vendorName}</h2>`;
                        $(".wsus__chat_area").html(title);
                        $.each(data.messages, function(index, value) {
                            let message = "";
                            let imagesHtml = "";

                            if (value.images && value.images.length > 0) {
                                // Kiểm tra nếu div cha ngoài cùng có class single_chat_2
                                let imageAlignment = value.sender_id == USER.id ?
                                    'flex-end' : 'flex-start';
                                imagesHtml =
                                    `<div style="display: flex; gap: 10px; margin-top: 10px; justify-content: ${imageAlignment};">` +
                                    value.images.map(image =>
                                        `<img src="${image}" alt="image" class="img-fluid mt-2" width="100px">`
                                    ).join('') +
                                    `</div>`;
                            }

                            if (value.sender_id == USER.id) {
                                message = `
                                    <div class="wsus__chat_single single_chat_2">
                                        <div class="wsus__chat_single_img">
                                            <img src="${USER.image}" alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${value.message}</p>
                                            ${imagesHtml}
                                            <span>${formatDatetime(value.created_at)}</span>
                                        </div>
                                    </div>
                                `;
                            } else {
                                message = `
                                    <div class="wsus__chat_single">
                                        <div class="wsus__chat_single_img">
                                            <img src="${receiverImage}" alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${value.message}</p>
                                            ${imagesHtml}
                                            <span>${formatDatetime(value.created_at)}</span>
                                        </div>
                                    </div>
                                `;
                            }

                            mainChatBox.append(message);
                        });



                        scrollToBottom();
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {}
                });
            });


            $("#message-form").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let messageData = $(".message-box").val();
                let files = $("#file-input")[0].files;

                var formSubmitting = false;

                if (formSubmitting || messageData === "") {
                    return
                }

                // let message = `
            //     <div class="wsus__chat_single single_chat_2 mb-3">
            //         <div class="wsus__chat_single_img">
            //             <img src="${USER.image}"
            //                 alt="user" class="img-fluid">
            //         </div>
            //         <div class="wsus__chat_single_text">
            //             <p>${messageData}</p>
            //             <span></span>
            //         </div>
            //     </div>
            //     `
                // if (files.length > 0) {
                //     $.each(files, function(index, file) {
                //         let reader = new FileReader();
                //         reader.onload = function(e) {
                //             message += `
            //                 <div class="wsus__chat_single single_chat_2 mb-3">
            //                     <div class="wsus__chat_single_img">
            //                         <img src="${USER.image}" alt="user" class="img-fluid">
            //                     </div>
            //                     <div class="wsus__chat_single_text">
            //                         <img src="${e.target.result}" alt="image" class="img-fluid" width="100px">
            //                     </div>
            //                 </div>
            //             `;
                //             if (index === files.length - 1) {
                //                 mainChatBox.append(message);
                //                 scrollToBottom();
                //             }
                //         }
                //         reader.readAsDataURL(file);
                //     });
                // } else {
                //     mainChatBox.append(message);
                //     scrollToBottom();
                // }

                let message = `
                    <div class="wsus__chat_single single_chat_2 mb-3">
                        <div class="wsus__chat_single_img">
                            <img src="${USER.image}" alt="user" class="img-fluid">
                        </div>
                        <div class="wsus__chat_single_text">
                            <p>${messageData}</p>
                `;

                if (files.length > 0) {
                    let imagesHtml =
                        '<div style="display: flex;justify-content: flex-end; gap: 10px; margin-top: 10px;">';
                    let filesProcessed = 0;

                    $.each(files, function(index, file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            imagesHtml += `
                                <img src="${e.target.result}" alt="image" class="img-fluid" style="width: 100px;">
                            `;
                            filesProcessed++;

                            if (filesProcessed === files.length) {
                                imagesHtml += '</div>'; // Đóng div chứa hình ảnh
                                message += imagesHtml;
                                message +=
                                    `</div><span></span></div>`; // Đóng thẻ div cho tin nhắn
                                mainChatBox.append(message);
                                scrollToBottom();
                            }
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    message += `</div><span></span></div>`; // Đóng thẻ div cho tin nhắn
                    mainChatBox.append(message);
                    scrollToBottom();
                }


                $.ajax({
                    method: "POST",
                    url: "{{ route('user.send-message') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".send-button").prop("disabled", true);
                        $(".message-box").prop("disabled", true);
                        $("#file-input").prop("disabled", true);
                    },
                    success: function(data) {
                        $(".message-box").val("");
                        $("#file-input").val("");
                    },
                    error: function(data) {
                        toastr.error(data.responseJSON.message);
                        $(".send-button").prop("disabled", false);
                        $(".message-box").prop("disabled", false);
                        $("#file-input").prop("disabled", false);
                    },
                    complete: function(data) {
                        $(".send-button").prop("disabled", false);
                        $(".message-box").prop("disabled", false);
                        $("#file-input").prop("disabled", false);
                    }
                })
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện click vào hình ảnh trong tin nhắn
            $('.wsus__chat_area_body').on('click', '.img-fluid', function() {
                var modal = document.getElementById("imageModal");
                var modalImg = document.getElementById("modalImage");

                modal.style.display = "block";
                modalImg.src = this.src;

                var span = document.getElementsByClassName("close")[0];
                span.onclick = function() {
                    modal.style.display = "none";
                }
            });
        });
    </script>

    <style>
        /* Style cho modal overlay */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 800px;
            max-height: 80%;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush
