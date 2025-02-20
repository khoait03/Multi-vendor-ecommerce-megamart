<script>
    $(document).ready(function() {
        function customFormatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(".", ",");
        }

        $(document).on("submit", ".shopping-cart-form", function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            console.log(formData);

            $.ajax({
                method: "POST",
                url: "{{ route('add-to-cart') }}",
                data: formData,
                success: function(data) {
                    if (data.status == "success") {
                        fetchSidebarCartProducts()
                        getCartCount()
                        $(".mini-cart-action").removeClass("d-none")
                        toastr.success(data.message)
                    }
                    if (data.status == "error") {
                        toastr.error(data.message)
                    }
                },
                error: function(data) {

                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: "GET",
                url: "{{ route('cart-count') }}",
                success: function(data) {
                    $("#cart-count").text(data)
                },
                error: function(data) {

                }
            })
        }

        function fetchSidebarCartProducts() {
            $.ajax({
                url: "{{ route('cart-products') }}",
                method: "GET",
                success: function(data) {
                    $(".mini-cart-wrapper").html("")
                    var html = ""
                    for (let item in data) {
                        let product = data[item]
                        let variants_display = ""

                        for (let key in product.options.variants) {
                            let variant = product.options.variants[key];
                            variants_display += `
                              <small>${key}: ${variant.name}</small><br>
                          `;
                        }
                        html += `
                        <li id="mini-cart-${product.rowId}" style="display: flex; align-items: center">
                          <div class="wsus__cart_img">
                            <a href="#"><img src="{{ asset('/') }}${product.options.image}" class="img-fluid w-100"/></a>
                            <a class="wsis__del_icon remove-sidebar-product" data-id="${product.rowId}" href=""><i class="fas fa-minus-circle"></i></a>
                          </div>  
                          <div class="wsus__cart_text">
                            <a class="wsus__cart_title" href="{{ url('/product-detail') }}/${product.options.slug}">${product.name}</a><br>
                            ${variants_display}
                            <small>Số lượng: ${product.qty}</small>
                            <p>${customFormatNumber(product.price+product.options.variants_total)}đ</p>
                          </div>
                        </li>
                      `
                    }
                    $(".mini-cart-wrapper").html(html)
                    getSidebarCartSubtotal()
                },
                error: function(data) {

                }
            })
        }

        $("body").on('click', ".remove-sidebar-product", function(e) {
            e.preventDefault();

            let rowId = $(this).data("id")

            $.ajax({
                method: "POST",
                url: "{{ route('cart.remove-sidebar-product') }}",
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    let productId = "mini-cart-" + rowId
                    $("#" + productId).remove()
                    getSidebarCartSubtotal()
                    if ($(".mini-cart-wrapper").find("li").length === 0) {
                        $(".mini-cart-action").addClass("d-none")
                        $(".mini-cart-wrapper").html(
                            "<li style='text-align: center'>Giỏ hàng đang trống</li>")
                    }
                    getCartCount()
                    toastr.success(data.message)
                },
                error: function(data) {

                }
            })
        })

        function getSidebarCartSubtotal() {
            $.ajax({
                method: "GET",
                url: "{{ route('cart.cart-total') }}",
                success: function(data) {
                    $("#mini-cart-subtotal").text(customFormatNumber(data) + "đ")
                },
                error: function(data) {

                }
            })
        }

        $(document).on("click", ".wishlist-btn", function(e) {
            e.preventDefault();
            let id = $(this).data("id")

            $.ajax({
                method: "POST",
                url: "{{ route('wishlist.store') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status == "error") {
                        toastr.error(data.message)
                    }
                    if (data.status == "success") {
                        toastr.success(data.message)
                        $("#wishlist-count").text(data.count)
                    }
                },
                error: function(data) {

                }
            })
        })

        $("#new-letter").on("submit", function(e) {
            e.preventDefault();

            let data = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "{{ route('new-letter-request') }}",
                data: data,
                beforeSend: function() {
                    $(".subscriber-btn").text("Đang gửi...")
                    $(".subscriber-btn").attr("disabled", true)
                },
                success: function(data) {
                    if (data.status == "success") {
                        toastr.success(data.message)
                        $(".subscriber-btn").text("Đã Gửi")
                        $(".subscriber-btn").attr("disabled", false)
                    }
                    if (data.status == "error") {
                        toastr.error(data.message)
                        $(".subscriber-btn").text("Đăng Ký")
                        $(".subscriber-btn").attr("disabled", false)
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    console.log(errors);
                    if (errors) {
                        $.each(errors, function(key, value) {
                            toastr.error(value[0])
                        })
                    }
                    $(".subscriber-btn").text("Đăng Ký")
                    $(".subscriber-btn").attr("disabled", false)
                }
            })
        })

        $(".show-product-modal").on("click", function() {
            let id = $(this).data("id")
            $.ajax({
                method: "GET",
                url: "{{ route('show-product-modal', ':id') }}".replace(":id", id),
                beforeSend: function() {
                    $(".product-modal-content").html(`
                    <span class='loader'></span>
                  `)
                },
                success: function(data) {
                    $(".product-modal-content").html(data)
                },
                error: function(data) {

                },
                complete: function() {

                }
            })

        })
    })
</script>
