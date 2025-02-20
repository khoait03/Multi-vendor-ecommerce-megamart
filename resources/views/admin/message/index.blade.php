@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tin Nhắn</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tin Nhắn</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card" style="height: 70vh">
                        <div class="card-header">
                            <h4>Danh sách khách hàng</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">

                                @foreach ($chatUsers as $chatUser)
                                    @php
                                        $unseenMessages = \App\Models\Chat::where([
                                            'sender_id' => $chatUser->senderProfile->id,
                                            'receiver_id' => auth()->user()->id,
                                            'seen' => 0,
                                        ])->exists();
                                    @endphp

                                    <li class="d-flex align-items-center chat-user-profile"
                                        data-id="{{ $chatUser->senderProfile->id }}"
                                        style="cursor: pointer;
                                        padding-bottom: 10px;
                                        border-bottom: 1px solid #eee;">
                                        <img alt="image" class="mr-3 rounded-circle"
                                            style="border: {{ $unseenMessages ? '3px solid red' : '' }}" width="50"
                                            src="{{ asset($chatUser->senderProfile->image) }}">

                                        {{-- @if ($unseenMessages)
                                            <div class="notify">
                                                <div class="text-danger text-small font-600-bold mr-2"><i
                                                        class="fas fa-circle"></i>
                                                </div>
                                            </div>
                                        @endif --}}

                                        <div class="font-weight-bold profile-name">
                                            {{ limitText($chatUser->senderProfile->name, 20) }}
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-lg-9">
                    <div class="card chat-box" id="mychatbox" style="height: 70vh">
                        <div class="card-header title">
                            {{-- <h4>Chat with Rizal</h4> --}}
                        </div>
                        <div class="card-body chat-content" data-inbox="">
                            {{-- <div class="chat-item chat-left">
                                <img src="" alt="">
                                <div class="chat-details">
                                    <div class="chat-text">Hello</div>
                                    <div class="chat-time">10:20</div>
                                </div>
                            </div>
                            <div class="chat-item chat-right">
                                <img src="" alt="">
                                <div class="chat-details">
                                    <div class="chat-text">Hello</div>
                                    <div class="chat-time">10:20</div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-footer chat-form" style="display: none;">
                            <form id="message-form" enctype="multipart/form-data">
                                <input type="text" class="form-control message-box" placeholder="Nhập tin nhắn"
                                    name="message">
                                <input type="hidden" name="receiver_id" value="" id="receiver_id">
                                <button class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                                <input class="" type="file" name="images[]" id="file-input"
                                    style="padding: 5px 15px" multiple>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
@endsection

@push('scripts')
    <script>
        const mainChatBox = $(".chat-content")

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
            // $(".chat-form").on("click", function() {
            //     let $span = $(".chat-user-profile").find(".notify");

            //     // Nếu thẻ span đã tồn tại thì xóa, nếu không thì thêm mới
            //     if ($span.length > 0) {
            //         $span.remove();
            //     }
            // })

            $(".chat-user-profile").on("click", function() {
                $(".card-footer.chat-form").css("display", "block");

                let receiverId = $(this).data("id");
                let receiverImage = $(this).find("img").attr("src");
                let receiverName = $(this).find(".profile-name").text();

                mainChatBox.attr("data-inbox", receiverId);
                $(".title").html(`<h4>Nhắn tin với ${receiverName}</h4>`);
                $("#receiver_id").val(receiverId);

                $(this).children("img").css("border", "none");
                // let $span = $(this).find(".notify");

                // // Nếu thẻ span đã tồn tại thì xóa, nếu không thì thêm mới
                // if ($span.length > 0) {
                //     $span.remove();
                // }

                $.ajax({
                    url: "{{ route('admin.get-messages') }}",
                    method: "GET",
                    data: {
                        receiverId: receiverId
                    },
                    beforeSend: function() {
                        mainChatBox.html("");
                    },
                    success: function(data) {
                        console.log(data);

                        $.each(data, function(index, value) {
                            let message = "";
                            let imagesHtml = "";

                            // Xử lý hình ảnh nếu có
                            if (value.images && value.images.length > 0) {
                                imagesHtml = value.images.map(image =>
                                    `<img src="${image}" alt="image" class="img-fluid mt-3" width="100px">`
                                ).join('');
                            }

                            if (value.sender_id == USER.id) {
                                message = `
                                    <div class="chat-item chat-right">
                                        <img src="${USER.image}" alt="">
                                        <div class="chat-details">
                                            <div class="chat-text">${value.message}</div></br>
                                            <div class="d-flex justify-content-end mb-2">${imagesHtml}</div>
                                            <div class="chat-time">${formatDatetime(value.created_at)}</div>
                                        </div>
                                    </div>
                                `;
                            } else {
                                message = `
                                    <div class="chat-item chat-left">
                                        <img src="${receiverImage}" alt="">
                                        <div class="chat-details">
                                            <div class="chat-text">${value.message}</div></br>
                                            ${imagesHtml}
                                            <div class="chat-time">${formatDatetime(value.created_at)}</div>
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
                    complete: function() {

                    }
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
            //     <div class="chat-item chat-right">
            //         <img src="${USER.image}" alt="">
            //         <div class="chat-details">
            //             <div class="chat-text">${messageData}</div>
            //             <div class="chat-time"></div>
            //         </div>
            //     </div>
            //     `

                // if (files.length > 0) {
                //     $.each(files, function(index, file) {
                //         let reader = new FileReader();
                //         reader.onload = function(e) {
                //             message += `
            //                 <div class="chat-item chat-right">
            //                     <img src="${USER.image}" alt="">
            //                     <div class="chat-details">
            //                         <img src="${e.target.result}" alt="image" class="img-fluid" style="width: 100px;"">
            //                         <div class="chat-time"></div>
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
                    <div class="chat-item chat-right">
                        <img src="${USER.image}" alt="">
                        <div class="chat-details">
                            <div class="chat-text">${messageData}</div>
                `;

                if (files.length > 0) {
                    let imagesHtml =
                        `<div class="mt-3" style="display: flex; justify-content: end; gap: 10px;">`;
                    let filesProcessed = 0;

                    $.each(files, function(index, file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            imagesHtml +=
                                `<img src="${e.target.result}" alt="image" class="img-fluid" style="width: 100px;">`;
                            filesProcessed++;

                            if (filesProcessed === files.length) {
                                imagesHtml += `</div>`; // Đóng thẻ div cho image-row
                                message += imagesHtml;
                                message +=
                                    `<div class="chat-time"></div></div></div>`; // Đóng thẻ div cho chat-details và chat-item
                                mainChatBox.append(message);
                                scrollToBottom();
                            }
                        }
                        reader.readAsDataURL(file);
                    });
                } else {
                    message +=
                        `<div class="chat-time"></div></div></div>`; // Đóng thẻ div cho chat-details và chat-item
                    mainChatBox.append(message);
                    scrollToBottom();
                }


                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.send-message') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".send-button").prop("disabled", true)
                        $(".message-box").prop("disabled", true)
                        $("#file-input").prop("disabled", true);
                        formSubmitting = true
                    },
                    success: function(data) {
                        $(".message-box").val("")
                        $("#file-input").val("");
                    },
                    error: function(data) {
                        toastr.error(data.responseJSON.message)
                        $(".send-button").prop("disabled", false)
                        $(".message-box").prop("disabled", false)
                        $("#file-input").prop("disabled", false);
                        formSubmitting = false
                    },
                    complete: function(data) {
                        $(".send-button").prop("disabled", false)
                        $(".message-box").prop("disabled", false)
                        $("#file-input").prop("disabled", false);
                        formSubmitting = false
                    }
                })
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện click vào hình ảnh trong tin nhắn
            $('.chat-content').on('click', '.img-fluid', function() {
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
