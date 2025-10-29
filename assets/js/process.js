"use strict";
var pageOverlay = pageOverlay || (function ($) {
  return {
    show: function () {
      if (!$('#page-overlay').hasClass('active')) {
        $('#page-overlay').addClass('active');
        $('#page-overlay .page-loading-image').removeClass('d-none'); 
      }
    },
/*
 * This script handles form submissions and AJAX responses.
 */

    hide: function () {
      if ($('#page-overlay').hasClass('active')) {
        $('#page-overlay').removeClass('active');
        $('#page-overlay .page-loading-image').addClass('d-none');
      } 
    }
  };
})(jQuery);

var alertMessage = alertMessage || (function ($) {
  var $html = $('<div class="alert alert-icon content d-none" role="alert">' +
    '<i class="fe icon-symbol" aria-hidden="true"></i>' +
    '<span class="message">Message is in here</span>' +
    '</div>');
  return {
    show: function (_message, _type) {
      switch (_type) {
        case 'error':
          var _type = 'alert-warning',
            _icon = 'fe-alert-triangle';
          break;
        case 'success':
          var _type = 'alert-success',
            _icon = 'fe-check';
          break;
        default:
          var _type = 'alert-warning',
            _icon = 'fe-bell';
      }
      $('.alert-message-reponse').html($html);
      if (_type == 'alert-success') {
        $('.alert-message-reponse .content').removeClass('alert-warning');
      } else {
        $('.alert-message-reponse .content').removeClass('alert-success');
      }
      $('.alert-message-reponse .content').addClass(_type);
      $('.alert-message-reponse .icon-symbol').addClass(_icon);
      $('.alert-message-reponse .content').removeClass('d-none');
      $('.alert-message-reponse .content .message').html(_message);
    },
    hide: function () {
      $('.alert-message-reponse').html('');
    }
  };
})(jQuery);
// Confirm notice
function confirm_notice(_ms) {
  switch (_ms) {
    case 'deleteItem':
      return confirm(deleteItem);
      break;
    case 'deleteItems':
      return confirm(deleteItems);
      break;
    default:
      return confirm(_ms);
  }
  return confirm(_ms);
}

function is_json(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}

// Reload page
function reloadPage(_url) {
  if (_url) {
    setTimeout(function () { window.location = _url; }, 2500);
  } else {
    setTimeout(function () { location.reload() }, 2500);
  }
}

function notify(_ms, _type) {
  var _text = _ms;
  var _icon = _type;
  if (_type == 'error') {
    _icon = 'warning';
  }
  $.toast({
    text: _text,
    icon: _icon,
    showHideTransition: 'fade',
    allowToastClose: true,
    hideAfter: 3000,
    stack: 5,
    position: 'bottom-center',
    textAlign: 'left',
    loader: true,
    loaderBg: '#0ef1f1',
    beforeShow: function () { },
    afterShown: function () { },
    beforeHide: function () { },
    afterHidden: function () { }
  });
}

/*----------  Configure tinymce editor  ----------*/

var fileManagerUrlElfinder = PATH + 'admin/file_manager/elfinder_init';

function plugin_editor(selector, settings) {
  selector = typeof (selector) == 'undefined' ? '.tinymce' : selector;
  var _settings = {
    selector: selector,
    theme: "modern",
    branding: false,
    paste_data_images: true,
    relative_urls: false,
    convert_urls: false,
    inline_styles: true,
    verify_html: false,
    cleanup: false,
    autoresize_bottom_margin: 25,
    plugins: [
      "advlist autolink lists link charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "undo redo formatselect | fontselect fontsizeselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image media | print preview emoticons | code codesample pagebreak",
    style_formats: [
      { title: 'Heading 2', format: 'h2' },
      { title: 'Heading 3', format: 'h3' },
      { title: 'Heading 4', format: 'h4' },
      { title: 'Heading 5', format: 'h5' },
      { title: 'Heading 6', format: 'h6' },
      { title: 'Normal', block: 'div' }
    ],
    file_browser_callback: elFinderBrowser,
  }

  if (typeof (settings) != 'undefined') {
    for (var key in settings) {
      if (key != 'append_plugins') {
        _settings[key] = settings[key];
      } else {
        _settings['plugins'].push(settings[key]);
      }
    }
  }
  var editor = tinymce.init(_settings);
  return editor;
}


function elFinderBrowser(field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: fileManagerUrlElfinder,// use an absolute path!
    title: 'File manager',
    width: 900,
    height: 450,
    resizable: 'yes',
    inline: true
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}

/*----------  Upload media and return path to input selector  ----------*/
function getPathMediaByelFinderBrowser(_this, default_selector) {
  var _that = _this;
  var _passToElement = typeof (default_selector) == 'undefined' ? _that.siblings('input') : default_selector;
  tinymce.activeEditor.windowManager.open({
    file: fileManagerUrlElfinder,
    title: 'File manager',
    width: 900,
    height: 450,
    resizable: 'yes',
    inline: true
  }, {
    setUrl: function (url) {
      _passToElement.val(url);
    }
  });
  return false;
}


function sendXMLPostRequest($url, $params) {
  var Url = $url;
  var params = $params;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', Url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = processRequest;
  function processRequest(e) {
    console.log(xhr);
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      console.log(response.status);
    }
  }
  xhr.send(params);
}

/**
 * Call Ajax function with type option
 * @param {selector} element 
 * @param {url} url 
 * @param {option} type 
 */
function callPostAjax(element, url, data, type, redirect = null) {
  var data_type = (type == 'get-result-html') ? 'html' : 'json';
  $.post(url, data, function (_result) {
    switch (type) {
      case 'sort':
        notifyJS(element, _result.status, _result.message);
        break;
      case 'status':
        notifyJS(element, _result.status, _result.message);
        break;
      case 'sort-table':
        notify(_result.message, _result.status);
        break;
      case 'delete-item':
        pageOverlay.show();
        if (_result.status == 'success') {
          $(".tr_" + _result.ids).remove();
        }
        setTimeout(function () {
          pageOverlay.hide();
          notify(_result.message, _result.status);
        }, 2000);
        break;
      case 'copy-to-clipboard':
        pageOverlay.hide();
        if (_result.status == 'success') {
          var params = {
            'type': 'text',
            'value': _result.value,
          };
          copyToClipBoard(params);
        }
        break;
      case 'get-result-html':
        console.log(_result);
        setTimeout(function () {
          pageOverlay.hide();
          $("#result_html").html(_result);
        }, 1000);
        break;

      default:
        setTimeout(function () {
          pageOverlay.hide();
          console.log(_result.status);
          notify(_result.message, _result.status);
          if (_result.status == 'success') {
            if (_result.redirect_url) {
              var redirect = _result.redirect_url;
            } else {
              var redirect = '';
            }
            reloadPage(redirect);
          }
        }, 2000);
        break;
    }
  }, data_type);
  // return result;
}

/**
 * Call Ajax function with type option
 * @param {element} element 
 * @param {className} className 
 * @param {message} message 
 * @param {option} option 
 */
function notifyJS(element, className, message, option) {
  var options = {
    autoHide: true,
    position: '',
    autoHideDelay: 2000,
    className: className,
  };
  if (element === '') {
    options.position = "bottom center";
    $.notify(message, options);
  } else {
    options.position = "top center";
    element.notify(message, options);
  }
}

/**
 * Call Ajax function with type option
 * @param {element} element 
 * @param {type} text or element Dom
 */
function copyToClipBoard(params) {
  if (typeof (params) != 'undefined') {
    var $temp = $("<input>");
    switch (params.type) {
      case 'text':
        var copyText = $temp.val(params.value);
        break;
      default:
        var $element = params.element.closest(".text-to-cliboard").find('.content');
        var copyText = $temp.val($($element).text());
        break;
    }
    console.log(copyText);
    $("body").append($temp);
    copyText.select();
    document.execCommand("copy");
    $temp.remove();
  }
}

Number.prototype.countDecimals = function () {
  if (Math.floor(this.valueOf()) === this.valueOf()) return 0;
  var str = this.toString();
  if (str.indexOf(".") !== -1 && str.indexOf("-") !== -1) {
    return str.split("-")[1] || 0;
  } else if (str.indexOf(".") !== -1) {
    return str.split(".")[1].length || 0;
  }
  return str.split("-")[1] || 0;
}

/**
 * Number format
 * @param {value} input value 
 * @param {toFixed} message 
 */
function preparePrice(value, toFixed = 6) {
  if (countDecimals(value) > toFixed) {
    return value.toFixed(toFixed);
  } else {
    return value.toString();
  }
}

function countDecimals(value) {
  if (Math.floor(value) === value) return 0; 
  var str = value.toString();
  if (str.indexOf(".") !== -1) {
    return str.split(".")[1].length || 0;
  }
  return 0;
}

function Common() {
  var self = this;
  this.init = function () {
    //Callback
    self.Common();
  };

  // Common Function
  this.Common = function () {
    var btnSearch = ".search-area button.btn-search",
      btnClear = ".search-area button.btn-clear",
      searchArea = $(".search-area"),
      inputSearchQuery = $(".search-area input[name = query]");

    // Click Search
    $(document).on('click', btnSearch, function () {
      var $btn = $(this);
      $btn.addClass('btn-loading'); // ✅ Add loading class
      $(btnClear).removeClass('d-none');
      searchResult($btn); // Pass the button to searchResult
    });

    // Enter key
    inputSearchQuery.on('keyup', function (e) {
      if (e.key === 'Enter' || e.keyCode === 13) {
        var $btn = $(btnSearch);
        $btn.addClass('btn-loading'); // ✅ Add loading class
        $(btnClear).removeClass('d-none');
        searchResult($btn); // Pass the button to searchResult
      }
    });

    // Click Btn Clear Option
    $(document).on('click', btnClear, function () {
      window.history.pushState({}, document.title, window.location.pathname);
      location.reload();
    });

    // Pagination links
    $(document).on('click', '.page-link', function (e) {
      e.preventDefault();
      var url = $(this).attr('href');
      loadTableData(url);
      window.history.pushState({ path: url }, '', url);
    });

    // Order group
    $(document).on('click', '.order_btn_group a', function (e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $(this).addClass('btn-primary').parent().siblings().find('a').removeClass('btn-primary');
      loadTableData(url);
      window.history.pushState({ path: url }, '', url);
    });

    // Filter status group
    $(document).on('click', '.btn-filter-status a', function (e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $(this).addClass('btn-primary').siblings().removeClass('btn-primary');
      loadTableData(url);
      window.history.pushState({ path: url }, '', url);
    });

    // Modified searchResult to accept a button element
    function searchResult($btn) {
      var searchQuery = inputSearchQuery.val();
      var searchField = searchArea.find('select').val();

      var pathname = window.location.pathname;
      var searchParams = new URLSearchParams(window.location.search);
      var params = ['status'], link = '';

      $.each(params, function (key, value) {
        if (searchParams.has(value)) {
          link += value + "=" + searchParams.get(value) + "&";
        }
      });

      var pathlink = pathname + "?" + link + "query=" + searchQuery;
      if (searchArea.find('option:selected').length > 0) {
        pathlink += "&field=" + searchArea.find('option:selected').val();
      }

      loadTableData(pathlink, function () {
        if ($btn) {
          $btn.removeClass('btn-loading'); // ✅ Remove loading class when done
        }
      });

      window.history.pushState({ path: pathlink }, '', pathlink);
    }
  }

}

Common = new Common();
$(function () {
  Common.init();
});

/*
 * This script handles form submissions and AJAX responses.
 */
$(function(){
    // Intercept all AJAX responses on the page
    $(document).ajaxSuccess(function(event, xhr, settings) {
        try {
            var response = JSON.parse(xhr.responseText);

            // Check for our custom 'debug' status from korapay.php
            if (response.status === 'debug') {
                console.group("--- PHP Debug Data ---");
                console.log(response.message);
                console.log("Credentials:", response.korapay_credentials);
                console.log("Form Data:", response.form_data_received);
                console.groupEnd();

                // Display a notification to the user that debug mode is on
                notify("Debug mode is active. Check the browser console for details.", "info");

            }
        } catch (e) {
            // Not a JSON response, or JSON is malformed. Ignore it.
        }
    });
});


// Function to load table data from the server
function loadTableData(url, callback) {

  var $appContent = $('.app-content');
  var $listsIndexAjax = $appContent.find('.lists-index-ajax');

  if ($listsIndexAjax.length === 0) {
    window.location.href = url;
    return;
  }

  // Reset check all
  $('.check-all').prop('checked', false);
  $('.massAction .card-title').removeClass('d-none');
  $('.massAction .btnActions').addClass('d-none');


  // Declare DOM variables
  var $loadingIndicator = $('.ajax-loading-overlay');
  var $tableBody = $('#table-body');
  var $pagination = $('#pagination');
  var $btnFilterGroup = $('#btn-filter-group');

  $loadingIndicator.show();
  $.ajax({
    url: url,
    type: 'GET',
    cache: false,
    dataType: 'json',
    success: function (response) {

      $loadingIndicator.hide();
      $tableBody.html(response.table_html);
      $pagination.html(response.pagination_html);
      $btnFilterGroup.html(response.btn_filter_group_html);

      initializeTooltipsAndPopovers();
      // load Refill | Cancel Button event
      handleButtonRequestForElements(".component-button-cancel .btn-cancel");
      handleButtonRequestForElements(".component-button-refill .btn-refill");

      updatePaginationActiveState();
      if (typeof callback === 'function') {
        callback();
      }

    },
    error: function (xhr, status, error) {
      $loadingIndicator.hide();
      console.error('AJAX request failed: ' + status + ' ' + error);
      if (typeof callback === 'function') {
        callback();
      }
    }
  });
}

// Function to update the 'active' state for pagination
function updatePaginationActiveState() {
  var currentPage = getUrlParameter('p') || 1;
  $('.pagination .page-item').each(function () {
    var $pageLink = $(this).find('.page-link');
    var pageNum = $pageLink.html();
    $(this).toggleClass('active', pageNum == currentPage); // Toggle 'active' class based on the current page
  });
}

// Function to get a parameter from the URL (e.g., p=2)
function getUrlParameter(name) {
  var url = window.location.href;
  var regex = new RegExp('[?&]' + name + '=([^&#]*)', 'i');
  var results = regex.exec(url); // Execute the regex on the URL
  return results ? results[1] : null; // Return the parameter value or null if not found
}


function loadSection(url, targetElement, callback) {
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      $(targetElement).html(response.html);
      if (callback && typeof callback === 'function') {
        callback(response);
      }
    },
    error: function () {
      console.log('Opp: ' + targetElement);
    }
  });
}

// refill | cancel button
function handleButtonRequestForElements(selector) {
  $(document).on("click", selector, function (event) {
    event.preventDefault();
    var element = $(this),
      url = element.attr("href"),
      data = $.param({ token: token });

    $.post(url, data, function (_result) {
      if (_result.status === 'success') {
        element.replaceWith(_result.btn_text);
      }
    }, 'json');
  });
}

// Initialize tooltips for elements with tooltip || popover
function initializeTooltipsAndPopovers() {
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
}