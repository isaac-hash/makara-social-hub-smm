function Common(){
    var self= this;
    this.init= function(){
        //Callback
        self.generalOption();
        self.users();
        self.add_funds();
       
        self.services();
        if ($("#order_resume").length > 0) {
            self.order();
            self.calculateOrderCharge();
        }
        
        if ($(".navbar-side").length > 0) {
            self.menuOption();
        }      
        
    };

    this.menuOption = function(){
        
        const ps1 = new PerfectScrollbar('.navbar-side .scroll-bar', {
            wheelSpeed: 1,
            wheelPropagation: true,
            minScrollbarLength: 10,
            suppressScrollX: true
        });

        $(document).on("click", ".mobile-menu", function(){
            var _that = $(".navbar.navbar-side");
            if (_that.hasClass('navbar-folded')) {
                _that.removeClass('navbar-folded');
            }
            _that.toggleClass("active");
        });
    }

//     this.add_funds = function(){
//     $(document).on("submit", ".actionAddFundsForm", function(event){
        
//         event.preventDefault();
//         pageOverlay.show();

//         let _that = $(this);
//         let _action = PATH + 'add_funds/process';
//         let _redirect = _that.data("redirect");
//         let _dataObj = _that.serializeArray(); // raw array for checking
//         let _data = _that.serialize() + '&' + $.param({token:token});

//         console.log("✅ Form Submitted");
//         console.log("✅ Raw form data:", _dataObj);

//         // ✅ Check for empty fields BEFORE sending to server
//         for (let i = 0; i < _dataObj.length; i++) {
//             if (_dataObj[i].value === "" || _dataObj[i].value === null) {
//                 pageOverlay.hide();
//                 console.error("❌ Missing field:", _dataObj[i].name);
//                 notify(`Field '${_dataObj[i].name}' is required`, "error");
//                 return false;
//             }
//         }

//         // ✅ Send AJAX request after validation passes
//         $.post(_action, _data, function(_result){

//             setTimeout(() => pageOverlay.hide(), 1500);

//             console.log("✅ Server response:", _result);

//             if (is_json(_result)) {

//                 _result = JSON.parse(_result);

//                 // Success → redirect
//                 if (_result.status === 'success' && typeof _result.redirect_url !== "undefined") {
//                     window.location.href = _result.redirect_url;
//                 }

//                 // Notification
//                 setTimeout(() => notify(_result.message, _result.status), 1500);

//                 // Optional reload page
//                 setTimeout(() => {
//                     if (_result.status === 'success' && typeof _redirect !== "undefined") {
//                         reloadPage(_redirect);
//                     }
//                 }, 2000);

//             } else {
//                 // Non-JSON HTML response
//                 setTimeout(() => {
//                     $(".add-funds-form-content").html(_result);
//                 }, 100);
//             }
//         });

//         return false;
//     });
// }
//     this.add_funds = function () {

//     // Keep modal instances available globally inside function
//     let pinModal = null;
//     let otpModal = null;

//     // HANDLE ADD FUNDS FORM SUBMIT
//     $(document).on("submit", ".actionAddFundsForm", function (event) {

//         event.preventDefault();
//         pageOverlay.show();

//         let _that = $(this);
//         let _action = PATH + 'add_funds/process';
//         let _redirect = _that.data("redirect");
//         let _dataObj = _that.serializeArray();
//         let _data = _that.serialize() + '&' + $.param({ token: token });

//         console.log("✅ Form Submitted:", _dataObj);

//         // Validate empty fields
//         for (let i = 0; i < _dataObj.length; i++) {
//             if (_dataObj[i].value === "" || _dataObj[i].value === null) {
//                 pageOverlay.hide();
//                 notify(`Field '${_dataObj[i].name}' is required`, "error");
//                 return false;
//             }
//         }

//         // NORMAL CHARGE REQUEST
//         $.post(_action, _data, function (_result) {

//             setTimeout(() => pageOverlay.hide(), 700);

//             console.log("✅ Server Response:", _result);

//             if (!is_json(_result)) {
//                 $(".add-funds-form-content").html(_result);
//                 return;
//             }

//             _result = JSON.parse(_result);

//             // ✅ SUCCESS WITH REDIRECT (Visa or no authentication)
//             if (_result.status === "success" && _result.redirect_url) {
//                 window.location.href = _result.redirect_url;
//                 return;
//             }

//             // ✅ PIN REQUIRED
//             if (_result.status === "requires_pin") {
//                 console.log("🟦 We reached the requires_pin block!!");

//                 console.log("🔐 PIN required. Charge ID:", _result.charge_id);

//                 window.korapayChargeId = _result.charge_id;

//                 // Bootstrap 5 modal
//                 pinModal = new bootstrap.Modal(document.getElementById("pinModal"));
//                 pinModal.show();

//                 notify("Please enter your card PIN", "info");
//                 return;
//             }

//             // ✅ OTP REQUIRED
//             if (_result.status === "requires_otp") {

//                 console.log("📩 OTP required. Charge ID:", _result.charge_id);

//                 window.korapayChargeId = _result.charge_id;

//                 otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
//                 otpModal.show();

//                 notify("Enter OTP sent to your phone", "info");
//                 return;
//             }

//             // ❌ ERROR
//             notify(_result.message, _result.status);

//             // Optional reload on success
//             setTimeout(() => {
//                 if (_result.status === 'success' && typeof _redirect !== "undefined") {
//                     reloadPage(_redirect);
//                 }
//             }, 2000);

//         });

//         return false;
//     });

//     // ✅ SUBMIT PIN HANDLER
//     $(document).on("click", "#submitPinBtn", function () {

//         let pin = $("#pinInput").val();

//         if (!pin) {
//             notify("PIN is required", "error");
//             return;
//         }

//         pageOverlay.show();

//         $.post(PATH + "add_funds/korapay/validate_charge", {
//             charge_id: window.korapayChargeId,
//             type: "pin",
//             value: pin,
//             token: token
//         }, function (res) {

//             setTimeout(() => pageOverlay.hide(), 800);

//             console.log("✅ PIN Validation Response:", res);

//             if (!is_json(res)) {
//                 notify("Invalid response", "error");
//                 return;
//             }

//             res = JSON.parse(res);

//             // ✅ PIN accepted → OTP required
//             if (res.status === "requires_otp") {

//                 console.log("📩 Switching to OTP modal...");

//                 if (pinModal) pinModal.hide();

//                 otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
//                 otpModal.show();

//                 notify("OTP is required to continue", "info");
//                 return;
//             }

//             // ✅ Payment completed after PIN
//             if (res.status === "success") {
//                 window.location.href = res.redirect_url;
//                 return;
//             }

//             // ❌ Failed
//             notify(res.message, res.status);

//         });

//     });

//     // ✅ SUBMIT OTP HANDLER
//     $(document).on("click", "#submitOtpBtn", function () {

//         let otp = $("#otpInput").val();

//         if (!otp) {
//             notify("OTP is required", "error");
//             return;
//         }

//         pageOverlay.show();

//         $.post(PATH + "add_funds/korapay/validate_charge", {
//             charge_id: window.korapayChargeId,
//             type: "otp",
//             value: otp,
//             token: token
//         }, function (res) {

//             setTimeout(() => pageOverlay.hide(), 800);

//             console.log("✅ OTP Validation Response:", res);

//             if (!is_json(res)) {
//                 notify("Invalid response", "error");
//                 return;
//             }

//             res = JSON.parse(res);

//             // ✅ SUCCESS after OTP
//             if (res.status === "success") {
//                 window.location.href = res.redirect_url;
//                 return;
//             }

//             // ❌ Error
//             notify(res.message, res.status);

//         });

//     });

// };




    this.users = function(){

        $(document).on("click", ".ajaxBackToAdmin" , function(){
            event.preventDefault();
            pageOverlay.show();
            _that       = $(this);
            _action     = _that.attr("href");
            _data       = $.param({token:token});
            $.post( _action, _data, function(_result){
                setTimeout(function () {
                    pageOverlay.hide();
                    notify(_result.message, _result.status);
                    if (_result.status == 'success') {
                        _redirect = PATH + 'users';
                        reloadPage(_redirect);
                    }
                }, 2000);
            },'json')
        }) 

    }

    this.services = function(){

        /*----------  Get Service details  ----------*/
        $(document).on("click", ".ajaxGetServiceDescription", function(){
            event.preventDefault();
            _that     = $(this);
            _url = PATH + 'services/desc/' + _that.data("ids");
            $('#modal-ajax').load(_url, function(){
                $('#modal-ajax').modal({
                    backdrop: 'static',
                    keyboard: false 
                });
                $('#modal-ajax').modal('show');
            });
            return false;
        })


        $(document).on('click', '.check-all', function(){
            _that      = $(this);
            _checkName = _that.data('name');
            $('.'+_checkName+'').prop('checked', this.checked);
        })

        $(document).on("change", ".ajaxChangeServiceType", function(){
            event.preventDefault();
            _that   = $(this);
            _type    = _that.val();
            switch(_type) {
              case "default":
                $("#add_edit_service .dripfeed-form").removeClass("d-none");
                break;  
              default:
                $("#add_edit_service .dripfeed-form").addClass("d-none");
                break;
            }
        })

        $(document).on("click", ".ajaxActionOptions" , function(){
            event.preventDefault();
            _that       = $(this);
            _type       = _that.data("type");

            if ((_type == 'delete' || _type == 'all_deactive' || _type == 'clear_all')) {
                if(!confirm_notice('deleteItems')){
                    return;
                }
            }
            _action     = _that.attr("href");
            _form       = _that.closest('form');
            _ids        = _form.serialize();
            _data       = _ids + '&' +$.param({token:token, type:_type});

            pageOverlay.show();
            $.post( _action, _data, function(_result){
                setTimeout(function () {
                    pageOverlay.hide();
                    notify(_result.message, _result.status);
                    if (_result.status == 'success') {
                        _redirect = '';
                        reloadPage(_redirect);
                    }
                }, 2000);
            },'json')
        }) 
    }

    this.generalOption = function(){
        // Insert hyper-link
        $(document).on('focusin', function(e) {
            if ($(event.target).closest(".mce-window").length) {
              e.stopImmediatePropagation();
            }
        });

        // load ajax-Modal
        $(document).on("click", ".ajaxModal", function(){
            _that = $(this);
            _url = _that.attr("href");
            $('#modal-ajax').load(_url, function(){
                $('#modal-ajax').modal({
                    backdrop: 'static',
                    keyboard: false 
                });
                $('#modal-ajax').modal('show');
            });
            return false;
        });

        /*----------  ajaxChangeTicketSubject  ----------*/
        $(document).on("change", ".ajaxChangeTicketSubject", function(){
            event.preventDefault();
            _that   = $(this);
            _type    = _that.val();
            switch(_type) {

              case "subject_order":
                $("#add_new_ticket .subject-order").removeClass("d-none");
                $("#add_new_ticket .subject-payment").addClass("d-none");
                break;  
                              
              case "subject_payment":
                $("#add_new_ticket .subject-order").addClass("d-none");
                $("#add_new_ticket .subject-payment").removeClass("d-none");
                break;

              default:
                $("#add_new_ticket .subject-order").addClass("d-none");
                $("#add_new_ticket .subject-payment").addClass("d-none");
                break;
            }
        })

        // ajaxChangeLanguage
        $(document).on("change", ".ajaxChangeLanguage", function(){
            event.preventDefault();
            _that     = $(this);
            _ids      = _that.val();
            _action   = _that.data("url") + _ids;
            _redirect = _that.data("redirect");
            _data     = $.param({token:token, redirect:_redirect});
            $.post(_action, _data, function(_result){
                pageOverlay.show();
                setTimeout(function () {
                    pageOverlay.hide();
                    location.reload();
                }, 1000);
            },'json')
        })

        // ajaxChangeStatus ticket
        $(document).on("click", ".ajaxChangeStatus", function(){
            event.preventDefault();
            _that   = $(this);
            _action = _that.data("url");
            _status = _that.data("status");
            _data   = $.param({token:token, status:_status});
            $.post(_action, _data, function(_result){
                pageOverlay.show();
                setTimeout(function () {
                    pageOverlay.hide();
                    notify(_result.message, _result.status);
                }, 2000);
                if (_status == 'new' || _status == 'unread') {
                    _redirect = PATH + 'tickets';
                }else{
                    _redirect = '';
                }
                reloadPage(_redirect);
            },'json')
        })

        // callback ajaxChange
        $(document).on("change", ".ajaxChange" , function(){
            pageOverlay.show();
            event.preventDefault();
            _that       = $(this);
            _id         = _that.val();

            if (_id == "") {
                pageOverlay.hide();
                return false;
            }
            _action     = _that.data("url") + _id;
            _data       = $.param({token:token});
            $.post( _action, _data,function(_result){
                pageOverlay.hide();
                setTimeout(function () {
                    $("#result_ajaxSearch").html(_result);
                }, 100);
            });
        })  

        // callback ajaxChangeCategory
        $(document).on("change", ".ajaxChangeCategory" , function(){
            event.preventDefault();
            $("#new_order .drip-feed-option").addClass("d-none");
            if ($("#order_resume").length > 0) {
                $("#order_resume input[name=service_name]").val("");
                $("#order_resume input[name=service_min]").val("");
                $("#order_resume input[name=service_max]").val("");
                $("#order_resume input[name=service_price]").val("");
                $("#order_resume textarea[name=service_desc]").val("");
                $("#order_resume #service_desc").val("");

                $("#new_order input[name=service_price]").val("");
                $("#new_order input[name=service_min]").val("");
                $("#new_order input[name=service_max]").val("");
            }
            _that       = $(this);
            _id         = _that.val();
            if (_id == "") {
                return;
            }
            _action     = _that.data("url") + _id;
            _data       = $.param({token:token});
            $.post( _action, _data,function(_result){
                setTimeout(function () {
                    $("#result_onChange").html(_result);
                }, 100);
            });
        })  

        $(document).on("change", ".ajaxChangeService" , function(){
            event.preventDefault();
            _that         = $(this);
            _id           = _that.val();
            _dripfeed     = _that.children("option:selected").data("dripfeed");
            _service_type = _that.children("option:selected").data("type");

            $("#new_order .order-default-quantity input[name=quantity]").attr("disabled", false);
            $("#new_order .order-usernames-custom").addClass("d-none");
            $("#new_order .order-comments-custom-package").addClass("d-none");

            /*----------  reset quantity  ----------*/
            $("#new_order input[name=service_price]").val();
            $("#new_order input[name=service_min]").val();
            $("#new_order input[name=service_max]").val();

            $("#new_order .order-default-quantity input[name=quantity]").val('');
            _total_charge = 0;
            _currency_symbol = $("#new_order input[name=currency_symbol]").val();
            $("#new_order input[name=total_charge]").val(_total_charge);
            $("#new_order .total_charge span").html(_currency_symbol + _total_charge);
            switch(_service_type) {
              case "subscriptions":
                $("#new_order input[name=sub_expiry]").val('');
                
                // Disable Schedule
                $('.schedule-option').addClass('d-none');
                
                $("#new_order .order-default-link").addClass("d-none");
                $("#new_order .order-default-quantity").addClass("d-none");
                $("#new_order #result_total_charge").addClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                
                $("#new_order .order-subscriptions").removeClass("d-none");
                break;

              case "custom_comments":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-comments").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");

                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-default-quantity input[name=quantity]").attr("disabled", true);
                
                $("#new_order .order-subscriptions").addClass("d-none");
                break; 

              case "custom_comments_package":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-comments-custom-package").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-default-quantity").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                $("#new_order .order-subscriptions").addClass("d-none");
                break; 

              case "mentions_with_hashtags":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-usernames").removeClass("d-none");
                $("#new_order .order-hashtags").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                
                $("#new_order .order-subscriptions").addClass("d-none");

                break;

              case "mentions_custom_list":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-usernames-custom").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-default-quantity input[name=quantity]").attr("disabled", true);
                
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                
                $("#new_order .order-subscriptions").addClass("d-none");

                break;  

              case "mentions_hashtag":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-hashtag").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                $("#new_order .order-subscriptions").addClass("d-none");

                break;

              case "mentions_user_followers":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-username").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                $("#new_order .order-subscriptions").addClass("d-none");
                break;

              case "mentions_media_likers":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-media").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-subscriptions").addClass("d-none");

                break;  

              case "package":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");
                

                $("#new_order .order-default-quantity").addClass("d-none");
                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                $("#new_order .order-subscriptions").addClass("d-none");

                break;

              case "comment_likes":
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order .order-username").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");
                $("#new_order .order-subscriptions").addClass("d-none");
                break;

              default:
                $("#new_order .order-default-link").removeClass("d-none");
                $("#new_order .order-default-quantity").removeClass("d-none");
                $("#new_order #result_total_charge").removeClass("d-none");

                
                $("#new_order .order-comments").addClass("d-none");
                $("#new_order .order-usernames").addClass("d-none");
                $("#new_order .order-hashtags").addClass("d-none");
                $("#new_order .order-username").addClass("d-none");
                $("#new_order .order-hashtag").addClass("d-none");
                $("#new_order .order-media").addClass("d-none");

                $("#new_order .order-subscriptions").addClass("d-none");

                break;
            }

            if (_dripfeed) {
                $("#new_order .drip-feed-option").removeClass("d-none");
            } else {
                $("#new_order .drip-feed-option").addClass("d-none");
            }

            _action     = _that.data("url") + _id;
            _data       = $.param({token:token});
            $.post( _action, _data,function(_result){
                $("#result_onChangeService").html(_result);
                // display min-max on Mobile Reponsive
                _service_price  = $("#order_resume input[name=service_price]").val();
                _service_min    = $("#order_resume input[name=service_min]").val();
                _service_max    = $("#order_resume input[name=service_max]").val();
                $("#new_order input[name=service_price]").val(_service_price);
                $("#new_order input[name=service_min]").val(_service_min);
                $("#new_order input[name=service_max]").val(_service_max);

                setTimeout(function () {
                    if (_service_type == "package" || _service_type == "custom_comments_package" ) {
                        _total_charge   = _service_price;
                        _currency_symbol = $("#new_order input[name=currency_symbol]").val();
                        $("#new_order input[name=total_charge]").val(_total_charge);
                        $("#new_order .total_charge span").html(_currency_symbol + _total_charge);
                    }
                }, 100);
            });
        }) 

        // callback ajaxSearch
        $(document).on("submit", ".ajaxSearchItem" , function(){
            pageOverlay.show();
            event.preventDefault();
            var _that       = $(this),
                _action     = _that.attr("action"),
                _data       = _that.serialize();

            _data       = _data + '&' + $.param({token:token});
            $.post( _action, _data, function(_result){
                setTimeout(function () {
                    pageOverlay.hide();
                    $("#result_ajaxSearch").html(_result);
                }, 300);
            });
        })

        // callback ajaxSearchItemsKeyUp with keyup and Submit from
        var typingTimer;                //timer identifier
        $(document).on("keyup", ".ajaxSearchItemsKeyUp" , function(){
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                }
            });
            event.preventDefault();
            clearTimeout(typingTimer);
            $(".ajaxSearchItemsKeyUp .btn-searchItem").addClass("btn-loading");
            var _that       = $(this),
                _form       = _that.closest('form'),
                _action     = _form.attr("action"),
                _data       = _form.serialize();
            _data       = _data + '&' + $.param({token:token});

            // if ( $("input:text").val().length < 2 ) {
            //     $(".ajaxSearchItemsKeyUp .btn-searchItem").removeClass("btn-loading");
            //     return;
            // }

            typingTimer = setTimeout(function () {
                $.post( _action, _data, function(_result){
                    setTimeout(function () {
                        $(".ajaxSearchItemsKeyUp .btn-searchItem").removeClass("btn-loading");
                        $("#result_ajaxSearch").html(_result);
                    }, 10);
                });
            }, 1500);

        })

        $(document).on("submit", ".ajaxSearchItemsKeyUp" , function(){
            event.preventDefault();
        })

        /*----------  Add a service from API provider  ----------*/
        $(document).on("click", ".ajaxAddService", function(){
            event.preventDefault();
            _that = $(this);
            _serviceid          = _that.data("serviceid");
            _name               = _that.data("name");
            _min                = _that.data("min");
            _max                = _that.data("max");
            _price              = _that.data("price");
            _dripfeed           = _that.data("dripfeed");
            _api_provider_id    = _that.data("api_provider_id");
            _type               = _that.data("type");
            _service_desc       = _that.data("service_desc");
            $("#modal-add-service input[name=dripfeed]").val(_dripfeed);
            $("#modal-add-service input[name=service_id]").val(_serviceid);
            $("#modal-add-service input[name=name]").val(_name);
            $("#modal-add-service input[name=min]").val(_min);
            $("#modal-add-service input[name=max]").val(_max);
            $("#modal-add-service input[name=price]").val(_price);
            $("#modal-add-service input[name=api_provider_id]").val(_api_provider_id);
            $("#modal-add-service input[name=type]").val(_type);
            $("#modal-add-service textarea[name=service_desc]").val(_service_desc);
            $('#modal-add-service').modal('show');
        })

        $(document).on("click", ".ajaxUpdateApiProvider", function(){
            $("#result_notification").html("");
            pageOverlay.show();
            event.preventDefault();
            _that   = $(this);
            _action = _that.attr("href");
            _redirect   = _that.data("redirect");
            _data   = $.param({token:token});
            $.post(_action, _data, function(_result){
                setTimeout(function () {
                    pageOverlay.hide();
                    notify(_result.message, _result.status);
                    if(_result.status == 'success' && typeof _redirect != "undefined"){
                        reloadPage(_redirect);
                    }
                }, 2000);
            },'json')
        })


        /*----------  Sync Services  ----------*/
        $(document).on("submit", ".actionSyncApiServices", function(){
            $("#result_notification").html("");
            pageOverlay.show();
            event.preventDefault();
            _that       = $(this);
            _action     = _that.attr("action");
            _redirect   = _that.data("redirect");

            if ($("#mass_order").hasClass("active")) {
                _data = $("#mass_order").find("input[name!=mass_order]").serialize();
                _mass_order_array = [];
                _mass_orders = $("#mass_order").find("textarea[name=mass_order]").val();
                if (_mass_orders.length > 0 ) {
                    _mass_orders = _mass_orders.split(/\n/);
                    for (var i = 0; i < _mass_orders.length; i++) {
                        // only push this line if it contains a non whitespace character.
                        if (/\S/.test(_mass_orders[i])) {
                            _mass_order_array.push($.trim(_mass_orders[i]));
                        }
                    }
                }
                _data       = _data + '&' + $.param({mass_order:_mass_order_array, token:token});
            }else{
                _data       = _that.serialize();
                _data       = _data + '&' + $.param({token:token});
            }

            $.post(_action, _data, function(_result){
                if (is_json(_result)) {
                    _result = JSON.parse(_result);
                    if(_result.status == 'success' && typeof _redirect != "undefined"){
                        reloadPage(_redirect);
                    }
                    setTimeout(function(){
                        pageOverlay.hide();
                    },2000)
                    setTimeout(function () {
                        notify(_result.message, _result.status);
                    }, 3000);
                }else{
                    setTimeout(function(){
                        pageOverlay.hide();
                        $('#modal-ajax').modal('hide');
                        $("#result_notification").html(_result);
                    },2000)
                }
            })
            return false;
        })

        // callback actionForm
        $(document).on("submit", ".actionForm", function(){
            pageOverlay.show();
            event.preventDefault();
            var _that       = $(this),
                _action     = _that.attr("action"),
                _redirect   = _that.data("redirect");
            if ($("#mass_order").hasClass("active")) {
                _data = $("#mass_order").find("input[name!=mass_order]").serialize();
                _mass_order_array = [];
                _mass_orders = $("#mass_order").find("textarea[name=mass_order]").val();
                if (_mass_orders.length > 0 ) {
                    _mass_orders = _mass_orders.split(/\n/);
                    for (var i = 0; i < _mass_orders.length; i++) {
                        // only push this line if it contains a non whitespace character.
                        if (/\S/.test(_mass_orders[i])) {
                            _mass_order_array.push($.trim(_mass_orders[i]));
                        }
                    }
                }
                _data       = _data + '&' + $.param({mass_order:_mass_order_array, token:token});
            }else{
                var _token  = _that .find("input[name=token]").val();
                    _data   = _that.serialize();
                // if (typeof _token == "undefined") {
                //     _data       = _data + '&' + $.param({token:token});
                // }
            }
            
            $.post(_action, _data, function(_result){
                setTimeout(function(){
                    pageOverlay.hide();
                },1500)

                if (is_json(_result)) {
                    _result = JSON.parse(_result);
                    setTimeout(function(){
                        notify(_result.message, _result.status);
                    },1500)
                    setTimeout(function(){
                        if(_result.status == 'success' && typeof _redirect != "undefined"){
                            reloadPage(_redirect);
                        }
                    }, 2000)
                }else{
                    setTimeout(function(){
                        $("#result_notification").html(_result);
                    }, 1500)
                }
            })
            return false;
        })

        // actionFormWithoutToast
        $(document).on("submit", ".actionFormWithoutToast", function(){
            alertMessage.hide();
            event.preventDefault();
            var _that       = $(this),
                _action     = _that.attr("action"),
                _data       = _that.serialize();
                _data       = _data + '&' + $.param({token:token});
                _redirect   = _that.data("redirect");

                _that.find(".btn-submit").addClass('btn-loading');
            
            $.post(_action, _data, function(_result){
                if (is_json(_result)) {
                    _result = JSON.parse(_result);
                    setTimeout(function(){
                        alertMessage.show(_result.message, _result.status);
                    }, 1500)

                    setTimeout(function(){
                        if(_result.status == 'success' && typeof _redirect != "undefined"){
                            reloadPage(_redirect);
                        }
                    }, 2000)

                }else{
                    setTimeout(function(){
                        $("#resultActionForm").html(_result);
                    }, 1500)
                }

                setTimeout(function(){
                    _that.find(".btn-submit").removeClass('btn-loading');
                }, 1500)
            })
            return false;
        })

        // callback Delete item
        $(document).on("click", ".ajaxDeleteItem", function(){
            event.preventDefault();
            if(!confirm_notice('deleteItem')){
                return;
            }
            _that       = $(this);
            _action     = _that.attr("href");
            _data       = $.param({token:token});

            $.post(_action, _data, function(_result){
                pageOverlay.show();
                if(_result.status =='success'){
                    $(".tr_" + _result.ids).remove();
                }
                setTimeout(function () {
                    pageOverlay.hide();
                    notify(_result.message, _result.status);
                }, 2000);
            },'json')
        })

        /*----------  callback Change status itme  ----------*/
        $(document).on("click", ".ajaxChangeStatusItem", function(){
            event.preventDefault();
            _that       = $(this);
            _action     = _that.attr("href");
            _status     = _that.data("status");
            _redirect   = _that.data("redirect");
            _data       = $.param({token:token, status:_status});
            $.post(_action, _data, function(_result){
                pageOverlay.show();
                setTimeout(function () {
                    pageOverlay.hide();
                    notify(_result.message, _result.status);
                }, 2000);
                if (_result.status == 'success' && typeof _redirect != "undefined") {
                    reloadPage(_redirect);
                }
            },'json')
        })

        // callback ajaxGetContents
        $(document).on("click", ".ajaxGetContents" , function(){
            pageOverlay.show();
            _that       = $(this);
            $(".settings .sidebar li").removeClass("active");
            _that.parent().addClass("active");

            _type       = _that.data("content");
            _action     = _that.attr("href");
            _data       = $.param({token:token, type:_type});
            $.post( _action, _data, function(_result){
                $("#result_get_contents").html(_result);
                history.pushState(null, "", _action.replace("/ajax_get_contents/","?t="));
                setTimeout(function () {
                    pageOverlay.hide();
                }, 300);
            });
            return false;
        }) 

    }

    // Check post type
    $(document).on("change","input[type=radio][name=email_protocol_type]", function(){
      _that = $(this);
      _type = _that.val();
      if(_type == 'smtp'){
        $('.smtp-configure').removeClass('d-none');
      }else{
        $('.smtp-configure').addClass('d-none');
      }
    });
}
Common = new Common();
$(function(){
    // console.log("✅ common.js LOADED VERSION 3");
    Common.init();
});